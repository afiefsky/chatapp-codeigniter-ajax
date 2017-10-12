<?php 

class Group extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(['Chat_model', 'Segment_model', 'User_model', 'Group_model']);
        $this->chat = $this->Chat_model;
        $this->segment = $this->Segment_model;
        $this->user = $this->User_model;
        $this->group = $this->Group_model;
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $data['topic'] = $this->input->post('group_name');

            /* Insert into chats table */
            $chat = $this->db->insert('chats', $data);

            if ($chat) {
                /* Getting the data of just-inputted data */
                $chat_data = $this->db->get_where('chats', ['topic' => $data['topic']]);
                $chat_data = $chat_data->row_array();

                /* Variable of chat_id and user_id */
                $group['chat_id'] = $chat_data['id'];
                $group['created_by'] = $this->session->userdata('user_id');
                $group['total_member'] = 1;
                /* Then chat_id will be used to insert the required parameter of groups_chats table */

                $this->db->insert('groups_chats', $group);

                $group_member['chat_id'] = $chat_data['id'];
                $group_member['user_id'] = $this->session->userdata('user_id');
                $this->db->insert('groups_members', $group_member);

                redirect('chat/group/index');
            }
        } else {
            $this->template->load('template/main_template', 'chat/group/add');
        }
    }

    public function check()
    {
        $data['chat_id'] = $this->uri->segment(3);
        $data['user_id'] = $this->session->userdata('user_id');

        /**
         * 1. check if the user is already registered on groups_members table
         */ 
        $check = $this->group->check($this->session->userdata('user_id'), $this->uri->segment(3));

        if ($check == 1) {
            redirect('group/index/'.$this->uri->segment(3));
        } else {
            $this->db->insert('groups_members', $data);
            $this->db->query("UPDATE groups_chats SET total_member = total_member + 1 WHERE chat_id = ".$this->uri->segment(3));
            redirect('group/index/'.$this->uri->segment(3));
        }
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
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                redirect('chat/index/'.$id);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $chat_id = $this->uri->segment(3);
                $user_id = $this->session->userdata('user_id');
                $content = $data['upload_data']['file_name'];

                $data = [
                    'chat_id' => $chat_id,
                    'user_id' => $user_id,
                    'content' => $content,
                    'is_image' => 1
                ];

                $this->db->insert('chats_messages', $data);

                redirect('group/chat/'.$chat_id);
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

    /* Call this method within index method */
    public function chat_component($chat_id)
    {
        /* Get the array of data of chat_id from model */
        $this->view_data['chat_data'] = $this->chat->getOne($chat_id)->row_array();

        /* Send in chat_id and user_id */
        $this->view_data['chat_id'] = $chat_id;
        $this->view_data['user_id'] = $this->session->userdata('user_id');

        $this->session->set_userdata('last_chat_message_id_' . $this->view_data['chat_id'], 0);

        $this->template->load('template/main_template', 'chat/group/chat', $this->view_data);
    }
}
