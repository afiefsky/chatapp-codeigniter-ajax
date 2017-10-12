<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->user = $this->User_model;
    }

    public function index()
    {
        redirect('user/setting');
    }

    public function activate()
    {
        $id = $this->uri->segment(3);

        $this->db->where('id', $id);
        $this->db->update('users', ['is_activated' => '1']);
        redirect('dashboard');
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            echo 1;
        } else {
            $this->template->load('template/main_template', 'user/add');
        }
    }

    public function setting()
    {
        $id = $this->uri->segment(3);

        if (isset($_POST['submit'])) {
            $config['upload_path']          = './uploads/avatars/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000000;

            /* Identify the config as load the library */
            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());

                echo $error['error'];
                die();
            } else {
                $image = array('upload_data' => $this->upload->data());

                $data['avatar'] = $image['upload_data']['file_name'];
            }

            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['email'] = $this->input->post('email');
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->input->post('password');

            $this->db->where('id', $this->uri->segment(3));
            $this->db->update('users', $data);

            $this->session->set_userdata('avatar', $data['avatar']);

            redirect('dashboard');
        } elseif (isset($_POST['submit_request_photo'])) {
            /* Button foto on view */
            $id = $this->uri->segment(3);

            $data['record'] = $this->user->getOne($id)->row_array();
            $data['photo'] = 1;

            $this->template->load('template/main_template', 'user/setting/index', $data);
        } else {
            /* Button foto on view */
            $id = $this->uri->segment(3);

            $data['record'] = $this->user->getOne($id)->row_array();
            $data['photo'] = 0;

            $this->template->load('template/main_template', 'user/setting/index', $data);
        }
    }
}
