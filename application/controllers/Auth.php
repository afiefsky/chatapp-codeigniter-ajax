<?php

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Auth_model');

        $this->auth = $this->Auth_model;
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        if (isset($_POST['submit']))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            /**
             *  Verify process and storing user_id to session
             */
            $verify = $this->auth->verify($username, $password);

            if ($verify == 1) {
                redirect('chat/index');
            } else {
                echo "Login failed!!";
            }
        } else {
            $this->load->view('auth/index');
        }
    }

}
