<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    public function getByNIP($nip)
    {
        return $this->db->get_where('guru_mapel', ['gmp_nip' => $nip])->row_array();
    }

    public function getByEmail($email)
    {
        return $this->db->get_where('guru_mapel', ['gmp_email' => $email])->row_array();
    }

    public function getByIdUnique($id)
    {
        return $this->db->get_where('guru_mapel', ['gmp_unique' => $id])->row_array();
    }

    public function getAll()
    {
        // $this->db->select('*');
        // $this->db->from('mata_pelajaran');
        // $this->db->join('guru_mapel', 'guru_mapel.gmp_mapel_id = mata_pelajaran.mp_unique');
        return $this->db->get('guru_mapel')->result_array();
    }

    public function set($data)
    {
        return $this->db->insert('guru_mapel', $data);
    }

    public function deleteByIdUnique($id)
    {
        return $this->db->delete('guru_mapel', ['gmp_unique' => $id]);
    }

    public function update($id, $data)
    {
        return $this->db->update('guru_mapel', $data, ['gmp_unique' => $id]);
    }
}
