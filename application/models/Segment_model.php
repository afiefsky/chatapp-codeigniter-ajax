<?php

class Segment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $segment = $this->db->insert('uri_segments', $data);

        if ($segment) {
            return 1;
        } else {
            return 0;
        }
    }

    public function select($first, $second)
    {
        $query = "SELECT
                    *
                FROM
                    uri_segments AS uri
                WHERE
                    (first = $first
                AND
                    second = $second)
                OR
                    (first = $second
                AND
                    second = $first)";

        return $this->db->query($query);
    }

    /**
     * Locate the id on uri_segments table
     * @param int $first_id 
     * @param int $second_id 
     * @return bool
     */
    public function locate($first_id, $second_id)
    {
        $query = "SELECT
                    *
                FROM
                    uri_segments AS uri
                WHERE
                    (first = '$first_id'
                AND
                    second = '$second_id')
                OR
                    (first = '$second_id'
                AND
                    second = '$first_id')
                ORDER BY
                    uri.id
                DESC";

        $record_array = $this->db->query($query)->row_array();
        $this->session->set_userdata(['chat_id' => $record_array['chat_id']]);

        $result = $this->db->query($query)->num_rows();

        if ($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
