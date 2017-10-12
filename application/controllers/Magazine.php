<?php

class Magazine extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Magazine_model']);
        $this->magazine = $this->Magazine_model;
    }

    public function index()
    {
        if (isset($_POST['submit'])) {
            $data['messages'] = $this->input->post('messages');
            $data['user_id'] = $this->session->userdata('user_id');

            $this->db->insert('dashboard', $data);

            redirect('magazine');
        } else {
            $data['record'] = $this->magazine->index();

            $this->template->load('template/main_template', 'magazine/index', $data);
        }
    }
}