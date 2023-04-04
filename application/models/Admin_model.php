<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('admin')->result_array();
    }

    public function getByUsername($username)
    {
        return $this->db->get_where('admin', ['admin_username' => $username])->row_array();
    }

    public function setAdmin($data)
    {
        return $this->db->insert('admin', $data);
    }
}
