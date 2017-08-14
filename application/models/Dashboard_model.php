<?php

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->db->select('*');
        $this->db->from('chats');
        return $this->db->get();
    }

    // public function getAll()
    // {
    //     $query = "SELECT
    //                 uc.id,
    //                 uc.user_id,
    //                 uc.chat_id,
    //                 ct.topic,
    //                 ct.created_at,
    //                 us.username
    //             FROM
    //                 users_chats AS uc,
    //                 chats AS ct,
    //                 users AS us
    //             WHERE
    //                 uc.chat_id = ct.id
    //             AND
    //                 uc.user_id = us.id";
    //     return $this->db->query($query);
    // }

}