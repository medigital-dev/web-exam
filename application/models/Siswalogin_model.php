<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswalogin_model extends CI_Model
{
    public function getByIdPd($id)
    {
        return $this->db->get_where('peserta_didik_login', ['pdl_pd_id' => $id])->row_array();
    }
}
