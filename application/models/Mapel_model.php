<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_model extends CI_Model
{
    public function getById($id)
    {
        return $this->db->get_where('mata_pelajaran', ['mp_unique' => $id])->row_array();
    }

    public function getAll()
    {
        return $this->db->get('mata_pelajaran')->result_array();
    }

    public function set($data)
    {
        return $this->db->insert('mata_pelajaran', $data);
    }
}
