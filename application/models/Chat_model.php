<?php

class Chat_model extends CI_Model 
{
    /**
     * Chat_model Constructor
     * 
     * chats = ['id', 'topic', 'created_by', 'created_at']
     * chats_messages = ['id', 'chat_id', 'user_id', 'content', 'created_at']
     * created_at auto timestamp (currentdate)
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Description
     * @param int $chat_id 
     * @param int $user_id 
     * @param text $content 
     * @return array
     */
    public function add_chat_message($chat_id, $user_id, $content)
    {
        $query = "INSERT INTO chats_messages (chat_id, user_id, content) VALUES (?, ?, ?)";

        return $this->db->query($query, array($chat_id, $user_id, $content));
    }

    public function get_chats_messages($chat_id, $last_chat_message_id = 0)
    {
        $query = "SELECT
                    cm.id,
                    cm.user_id,
                    cm.content,
                    DATE_FORMAT(cm.created_at, '%D of %M %Y at %H:%i:%s') AS timestamp,
                    u.username,
                    u.first_name,
                    u.last_name
                FROM
                    chats_messages AS cm
                JOIN
                    users AS u
                ON
                    cm.user_id = u.id
                WHERE 
                    cm.chat_id = ?
                AND 
                    cm.id > ?
                ORDER BY
                    cm.id
                ASC";

        $result = $this->db->query($query, [$chat_id, $last_chat_message_id]);

        return $result;
    }
}