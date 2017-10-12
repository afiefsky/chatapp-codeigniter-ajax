<?php

class Chat extends CI_Controller
{

    /**
     * Chat Controller Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model(['Chat_model', 'Segment_model', 'User_model', 'Group_model']);
        $this->chat = $this->Chat_model;
        $this->segment = $this->Segment_model;
        $this->user = $this->User_model;
        $this->group = $this->Group_model;
    }

    public function group()
    {
        /* Get all chatroom of group*/
        $data['record'] = $this->group->all();

        $this->template->load('template/main_template', 'chat/group/index', $data);
    }


    /**
     * Chat Index
     */
    public function index()
    {
        // $first_segment = $this->uri->segment(3);
        // $second_segment = $this->uri->segment(4);

        // $this->segment->select($first_segment, $second_segment);

        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(3);
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|sql|xlsx|xls|ppt|pptx';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                die();
                redirect('chat/index/'.$id);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $file_ext = $data['upload_data']['file_ext'];

                if ($file_ext == '.docx' ||
                    $file_ext == '.doc' ||
                    $file_ext == '.pdf' ||
                    $file_ext == '.xls' ||
                    $file_ext == '.xlsx' ||
                    $file_ext == '.ppt' ||
                    $file_ext == '.pptx')
                {
                    $is_image = '0';
                    $is_doc = '1';
                } else {
                    $is_image = '1';
                    $is_doc = '0';
                }


                $chat_id = $this->uri->segment(3);
                $user_id = $this->session->userdata('user_id');
                $content = $data['upload_data']['file_name'];

                $data = [
                    'chat_id' => $chat_id,
                    'user_id' => $user_id,
                    'content' => $content,
                    'is_image' => $is_image,
                    'is_doc' => $is_doc
                ];

                $this->db->insert('chats_messages', $data);

                redirect('chat/index/'.$chat_id);
            }
        } elseif (isset($_POST['submit_video'])) {
            /* If the chat_id on the uri segment 3 is blank */
            if (empty($chat_id = $this->uri->segment(3))) {
                $chat_id = $this->uri->segment(2);
            }

            /* Activate video call */
            $this->view_data['video'] = 1;
            $this->view_data['audio'] = $this->session->userdata('audio');
            $this->session->set_userdata(['video' => 1]);

            $this->chat_component($chat_id);
        } elseif (isset($_POST['submit_audio'])) {
            /* If the chat_id on the uri segment 3 is blank */
            if (empty($chat_id = $this->uri->segment(3))) {
                $chat_id = $this->uri->segment(2);
            }

            /* Activate video call */
            $this->view_data['video'] = $this->session->userdata('video');
            $this->view_data['audio'] = 1;
            $this->session->set_userdata(['audio' => 1]);

            $this->chat_component($chat_id);
        } elseif (isset($_POST['submit_close_audio'])) {
            /* If the chat_id on the uri segment 3 is blank */
            if (empty($chat_id = $this->uri->segment(3))) {
                $chat_id = $this->uri->segment(2);
            }

            /* Activate video call */
            $this->session->unset_userdata('audio');
            $this->view_data['video'] = $this->session->userdata('video');
            $this->view_data['audio'] = 0;

            $this->chat_component($chat_id);
        } elseif (isset($_POST['submit_close_video'])) {
            /* If the chat_id on the uri segment 3 is blank */
            if (empty($chat_id = $this->uri->segment(3))) {
                $chat_id = $this->uri->segment(2);
            }

            /* Activate video call */
            $this->session->unset_userdata('video');
            $this->view_data['video'] = 0;
            $this->view_data['audio'] = $this->session->userdata('audio');

            $this->chat_component($chat_id);
        } else {
            /* If the chat_id on the uri segment 3 is blank */
            if (empty($chat_id = $this->uri->segment(3))) {
                $chat_id = $this->uri->segment(2);
            }

            $this->view_data['audio'] = $this->session->userdata('audio');
            $this->view_data['video'] = $this->session->userdata('video');
            
            $this->chat_component($chat_id);
        }
    }

    /**
     * Redirect method
     */
    public function redirect()
    {
        $first_id = $this->uri->segment(3);
        $second_id = $this->uri->segment(4);

        $this->session->set_userdata('target_id', $second_id);

        $result = $this->segment->locate($first_id, $second_id);
        
        if ($result == 1) {
            redirect('chat/index/'. $this->session->userdata('chat_id'));
        } else {
            /* Crete the chatroom between two id */
            $chat = $this->chat->create($first_id, $second_id);

            if ($chat == 1) {
                $topic = $first_id . $second_id;

                $chat = $this->chat->obtain($topic)->row_array();

                /* Data to be inserted to uri_segments table */
                $data['first'] = $first_id;
                $data['second'] = $second_id;
                $data['chat_id'] = $chat['id'];
                $segment = $this->segment->create($data);

                if ($segment == 1) {
                    redirect('chat/index/'. $data['chat_id']);
                } else {
                    echo "Error!!!";
                    die();
                }

            }

            /* Create the uri segment for locate method */
            $this->segment->create();
        }
    }

    /* Call this method within index method */
    public function chat_component($chat_id)
    {
        /* Get the array of data of chat_id from model */
        $this->view_data['chat_data'] = $this->chat->getOne($chat_id)->row_array();

        /* Send in chat_id and user_id */
        $this->view_data['chat_id'] = $chat_id;
        $this->view_data['user_id'] = $this->session->userdata('user_id');

        $this->session->set_userdata('last_chat_message_id_' . $this->view_data['chat_id'], 0);

        $this->template->load('template/main_template', 'chat/index', $this->view_data);
    }

    public function test()
    {
        $this->load->view('test/index');
    }

    public function video()
    {
        $this->load->view('chat/video');
    }

    /**
     * Ajax Add Chat Message
     */
    public function ajax_add_chat_message()
    {
        /* Posting */
        $chat_id = $this->input->post('chat_id');
        $user_id = $this->input->post('user_id');
        $content = $this->input->post('content', true);

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
            $base_url = base_url();

            /* Store the last chat message id */
            $last_chat_message_id = $chats_messages->row($chats_messages->num_rows() - 1)->id;

            $this->session->set_userdata('last_chat_message_id_' . $chat_id, $last_chat_message_id);

            // return the messages
            $chats_messages_html = "<ul>";

            foreach ($chats_messages->result() as $chats_messages) {
                $record = $this->db->get_where('users', ['id' => $chats_messages->user_id])->row_array();
                $avatar = $record['avatar'];

                $li_class = ($this->session->userdata('user_id') == $chats_messages->user_id) ?
                    'class="by_current_user"' : '';

                if ($chats_messages->is_image == '0') {
                    if ($chats_messages->is_doc == '1') {
                        $chats_messages_html .=
                        '<p><li ' . $li_class . '>'
                            . '<p class="message_content"><img src="'.base_url().'uploads/avatars/'.$avatar.'" height="25" width="25">
                                <a href="'.base_url().'uploads/'.$chats_messages->content.'" target="_BLANK">
                                    '.$chats_messages->content.'
                                </a>
                            </p>
                            <span class="chat_message_header"><b>' .
                                $chats_messages->timestamp .
                                ' by ' .
                                $chats_messages->username .
                            '</b></span>
                        </li></p>';
                    } else {
                        $chats_messages_html .= '<p>
                        <li ' . $li_class . '>'
                        .'<p class="message_content"><img src="'.base_url().'uploads/avatars/'.$avatar.'" height="25" width="25"> '
                        . $chats_messages->content
                        .'</p>
                        <span class="chat_message_header"><b>'
                        . $chats_messages->timestamp
                        . ' by '
                        . $chats_messages->username
                        . '</b></span></li></p>';
                    }
                } else {
                    $chats_messages_html .=
                        '<p><li ' . $li_class . '>'
                            . '<p class="message_content"><img src="'.base_url().'uploads/avatars/'.$avatar.'" height="25" width="25">
                                <a href="'.base_url().'uploads/'.$chats_messages->content.'" target="_BLANK">
                                    <img src="'.base_url().'uploads/'.$chats_messages->content.'" width="100" height="100" />
                                </a>
                            </p>
                            <span class="chat_message_header"><b>' .
                                $chats_messages->timestamp .
                                ' by ' .
                                $chats_messages->username .
                            '</b></span>
                        </li></p>';
                }
            }

            $chats_messages_html .= "</ul>";

            $result = [
                'status'    => 'ok',
                'content'   => $chats_messages_html,
                'last_chat_message_id' => $last_chat_message_id
            ];

            return json_encode($result);
            exit();
        } else {
            $result = [
                'status'    => 'ok',
                'content'   => '',
                'last_chat_message_id' => $last_chat_message_id
            ];

            return json_encode($result);
            exit();
        }
    }
}
