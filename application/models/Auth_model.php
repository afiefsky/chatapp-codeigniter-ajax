<?php

class Auth_model extends CI_Model
{
    /**
     * Verify Method Description
     * @param text $username
     * @param text $password
     * @return boolean
     */
    public function verify($username, $password)
    {
        $verify = $this->db->get_where('users', ['username' => $username, 'password' => $password]);

        $data = $verify->row_array();

        if ($verify->num_rows() > 0) {
            $this->session->set_userdata([
                'user_id' => $data['id'],
                'first_name' => $data['first_name'],
                'avatar' => $data['avatar']
            ]);

            return 1;
        } else {
            return 0;
        }
    }
}