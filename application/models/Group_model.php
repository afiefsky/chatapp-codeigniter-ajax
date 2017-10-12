<?php 
class Group_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $this->db->select('group.*, chats.*');
        $this->db->from('groups_chats as group, chats as chats');
        $this->db->where('group.chat_id = chats.id');
        return $this->db->get();
    }

    public function check($user_id, $chat_id)
    {
        $check = $this->db->get_where('groups_members', ['chat_id' => $chat_id, 'user_id' => $user_id]);

        if ($check->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}