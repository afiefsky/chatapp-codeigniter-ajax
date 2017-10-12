<?php

class Magazine_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $query = "SELECT *, u.first_name FROM dashboard d, users u WHERE d.user_id = u.id ORDER BY created_at DESC";

        return $this->db->query($query);
    }
}