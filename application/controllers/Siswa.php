<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->has_userdata('session_akun')) {
            $dataSession = $this->session->userdata('session_akun');
            if ($dataSession['levelUser'] !== 'siswa') {
                redirect(base_url($dataSession['levelUser']));
            }
        } else {
            redirect('auth');
        }

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Siswa_model', 'siswa');
    }

    public function index()
    {
        session_destroy();
        echo 'Siswa Page';
    }
}
