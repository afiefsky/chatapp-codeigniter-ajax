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
        $user = $this->db->get_where('users', ['username' => $username, 'password' => $password]);

        $data = $user->row_array();
        $user_array = $user->row_array();

        if ($user->num_rows() > 0) {
            if ($user_array['is_activated'] == '1') {
                $this->session->set_userdata([
                    'user_id' => $data['id'],
                    'first_name' => $data['first_name'],
                    'avatar' => $data['avatar'],
                    'role' => $data['role']
                ]);
                return 1;
            } else {
                $this->session->set_userdata('error', 'Silahkan minta admin untuk memberikan verifikasi terhadap akun anda!!');
                redirect('auth/login');
            }
        } else {
            return 0;
        }
    }
}
