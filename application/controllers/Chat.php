<?php

class Chat extends CI_Controller
{

    /**
     * Chat Controller Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Chat_model');
        $this->chat = $this->Chat_model;
    }

    /**
     * Chat Index
     */
    public function index()
    {
        /* Send in chat_id and user_id */
        $this->view_data['chat_id'] = 1;
        $this->view_data['user_id'] = $this->session->userdata('user_id');

        $this->session->set_userdata('last_chat_message_id_' . $this->view_data['chat_id'], 0);

        $this->template->load('template/chat', 'chat/index', $this->view_data);
    }

    /**
     * Ajax Add Chat Message
     */
    public function ajax_add_chat_message()
    {
        /* Posting */
        $chat_id = $this->input->post('chat_id');
        $user_id = $this->input->post('user_id');
        $content = $this->input->post('content', TRUE);

        $this->chat->add_chat_message($chat_id, $user_id, $content);

        /* Executing the method on model */
        echo $this->_get_chats_messages($chat_id);
    }

    public function ajax_get_chats_messages()
    {
        /* Posting */
        $chat_id = $this->input->post('chat_id');

        echo $this->_get_chats_messages($chat_id);
    }

    /**
     * Ajax Get Chat Message
     * @return array
     */
    public function _get_chats_messages($chat_id)
    {   
        $last_chat_message_id = (int) $this->session->userdata('last_chat_message_id_' . $chat_id);

        /* Executing the method on model */
        $chats_messages = $this->chat->get_chats_messages($chat_id, $last_chat_message_id);

        if ($chats_messages->num_rows() > 0) {
            /* Store the last chat message id */
            $last_chat_message_id = $chats_messages->row($chats_messages->num_rows() - 1)->id;

            $this->session->set_userdata('last_chat_message_id_' . $chat_id, $last_chat_message_id);

            // return the messages
            $chats_messages_html = "<ul>";

            foreach ($chats_messages->result() AS $chats_messages) {

                $li_class = ($this->session->userdata('user_id') == $chats_messages->user_id) ? 'class="by_current_user"' : '';

                $chats_messages_html .= '<li ' . $li_class . '>' . '<span class="chat_message_header">' . $chats_messages->timestamp . ' by ' . $chats_messages->username . '</span><p class="message_content">' . $chats_messages->content .'</p></li>';
            }

            $chats_messages_html .= "</ul>";

            $result = [
                'status'    => 'ok',
                'content'   => $chats_messages_html
            ];

            return json_encode($result);
            exit();
        } else {
            $result = [
                'status'    => 'ok',
                'content'   => ''
            ];

            return json_encode($result);
            exit();
        }

    }

}   