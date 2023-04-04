<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CSession extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cek()
    {
        if (!$this->session->session_akun) {
            $data = [
                'status' => false,
                'code' => 'sess_expired'
            ];
            echo json_encode($data);
        }
    }
}
