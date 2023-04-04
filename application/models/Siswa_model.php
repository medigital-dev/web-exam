<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    public function getByNISN($nisn)
    {
        return $this->db->get_where('peserta_didik', ['pd_nisn' => $nisn])->row_array();
    }
}
