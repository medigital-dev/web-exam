<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->has_userdata('session_akun')) {
            $dataSession = $this->session->userdata('session_akun');
            if ($dataSession['levelUser'] !== 'admin') {
                redirect(base_url($dataSession['levelUser']));
            }
        } else {
            redirect('auth');
        }

        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Guru_model', 'gurumapel');
        $this->load->model('Mapel_model', 'mapel');
        $this->load->model('Item_m', 'item_m');
    }

    public function tanggal()
    {
        $inaDate = $this->toInaDate(date('ymd', time()));
        if ($inaDate == false) {
            $tanggal = '<span class="text-danger">Tanggal error</span>';
        } else {
            $tanggal = $inaDate['namaHari'] . ', ' . $inaDate['tanggal'] . ' ' . $inaDate['namaBulan'] . ' ' . $inaDate['tahun'];
        }
        return $tanggal;
    }

    public function index()
    {
        $data = [
            'title' => 'Admin Page | Web-eXam',
            'page' => 'dashboard',
            'jamTanggal' => $this->tanggal()
        ];

        $this->load->view('template/admin-page/header', $data);
        $this->load->view('template/admin-page/sidebar');
        $this->load->view('admin/index');
        $this->load->view('template/admin-page/footer');
    }
    public function akunguru()
    {
        $mapelAll = $this->mapel->getAll();

        $data = [
            'title' => 'Admin Page | Web-eXam',
            'page' => 'akun',
            'mapel' => $mapelAll,
            'jamTanggal' => $this->tanggal()
        ];

        $this->load->view('template/admin-page/header', $data);
        $this->load->view('admin/akunguru');
        $this->load->view('template/admin-page/footer');
    }

    // public function getAkunGuru()
    // {

    //     $result = $this->gurumapel->getAll();
    //     $resultData = [];
    //     foreach ($result as $row) {
    //         $a = array(
    //             $row['gmp_id'],
    //             $row['gmp_unique'],
    //             $row['gmp_nama'],
    //             $row['gmp_nip'],
    //             $row['gmp_mapel_id'],
    //             'null',
    //         );
    //         array_push($resultData, $a);
    //     }
    //     $data = [
    //         'draw' => 1,
    //         "recordsTotal" => count($result),
    //         "recordsFiltered" => count($result),
    //         'data' => $resultData
    //     ];
    //     echo json_encode($data);
    // }

    public function get_ajax()
    {
        $list = $this->item_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->gmp_unique;
            $row[] = $item->gmp_nama;
            $row[] = $item->gmp_email;
            $row[] = $item->gmp_nip;
            $row[] = $item->gmp_nomor_hp;
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->item_m->count_all(),
            "recordsFiltered" => $this->item_m->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function akunpd()
    {
        $data = ['title' => 'Admin Page | Web-eXam'];

        $this->load->view('template/admin-page/header', $data);
        $this->load->view('admin/akunpd');
        $this->load->view('template/admin-page/footer');
    }

    public function toInaDate($date)
    {
        // Format YYMMDD
        $dateCreate = date_create_from_format('ymd', $date);

        if ($dateCreate == false) {
            return false;
        } else {
            $data = [
                'namaHari' => $this->getNamaHari($dateCreate->format('N')),
                'namaBulan' => $this->getNamaBulan($dateCreate->format('n')),
                'tanggal' => $dateCreate->format('d'),
                'tahun' => $dateCreate->format('Y')
            ];
            return $data;
        }
    }

    public function getNamaBulan($kode)
    {

        switch ($kode) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3;
                return 'Maret';
                break;
            case 4;
                return 'April';
                break;
            case 5;
                return 'Mei';
                break;
            case 6;
                return 'Juni';
                break;
            case 7;
                return 'Juli';
                break;
            case 8;
                return 'Agustus';
                break;
            case 9;
                return 'September';
                break;
            case 10;
                return 'Oktober';
                break;
            case 11;
                return 'November';
                break;
            case 12;
                return 'Desember';
                break;
            default:
                return false;
                break;
        }
    }

    public function getNamaHari($kode)
    {
        switch ($kode) {
            case 1:
                return 'Senin';
                break;
            case 2:
                return 'Selasa';
                break;
            case 3:
                return 'Rabu';
                break;
            case 4:
                return 'Kamis';
                break;
            case 5:
                return 'Jumat';
                break;
            case 6:
                return 'Sabtu';
                break;
            case 7:
                return 'Minggu';
                break;

            default:
                return false;
                break;
        }
    }

    public function setMapel()
    {
        $namaMapel = $this->input->post('namaMapel');
        $mapelSingkat = $this->input->post('namaMapelSingkat');
        do {
            $mapel_unique = 'mp' . random_string('alnum', 10);
        } while ($this->mapel->getById($mapel_unique));

        $data = [
            'mp_id' => null,
            'mp_unique' => $mapel_unique,
            'mp_nama' => $namaMapel,
            'mp_singkat' => $mapelSingkat
        ];

        if ($this->mapel->set($data)) {
            $result = [
                'status' => true,
                'data' => $data
            ];
        } else {
            $result = [
                'status' => false
            ];
        }
        echo json_encode($result);
    }

    public function setAkunGuru()
    {
        $idUnique = $this->input->post('idGuru');
        $nama = $this->input->post('namaLengkap');
        $email = $this->input->post('email');
        $nip = $this->input->post('nip');
        $nomorHP = $this->input->post('nomorHP');

        if ($idUnique == '') {
            $checkAkunByNIP = $this->gurumapel->getByNIP($nip);
            $checkAkunByEmail = $this->gurumapel->getByEmail($email);
            if ($nip == '') {
                do {
                    $nip = 'G-' . random_string('numeric', 4);
                } while ($checkAkunByNIP);
            }
            if ($checkAkunByNIP) {
                $result = [
                    'status' => false,
                    'message' => 'NIP sudah terdaftar!',
                    'error' => 'nip'
                ];
            } else if ($checkAkunByEmail) {
                $result = [
                    'status' => false,
                    'message' => 'Email sudah terdaftar!',
                    'error' => 'email'
                ];
            } else {
                $data = [
                    'gmp_email' => $email,
                    'gmp_unique' => 'guru_' . random_string('alnum', 11),
                    'gmp_nama' => $nama,
                    'gmp_nip' => $nip,
                    'gmp_nomor_hp' => $nomorHP
                ];

                if ($this->gurumapel->set($data)) {
                    $result = [
                        'status' => true,
                        'message' => 'Akun guru berhasil ditambahkan'
                    ];
                }
            }
        } else {
            $data = [
                'gmp_email' => $email,
                'gmp_nama' => $nama,
                'gmp_nip' => $nip,
                'gmp_nomor_hp' => $nomorHP
            ];
            if ($this->gurumapel->update($idUnique, $data)) {
                $result = [
                    'status' => true,
                    'message' => 'Akun guru an. ' . $nama . ' berhasil diedit'
                ];
            }
        }
        echo json_encode($result);
    }

    public function deleteAkunGuru($id)
    {
        $data = $this->gurumapel->getByIdUnique($id);
        if ($data) {
            if ($this->gurumapel->deleteByIdUnique($id)) {
                $result = [
                    'status' => true,
                    'message' => 'Akun ' . $data['gmp_nama'] . ' berhasil dihapus!',
                    'error' => null
                ];
            }
        } else {
            $result = [
                'status' => false,
                'message' => 'ID Unique <strong>' . $id . '</strong> tidak ditemukan!',
                'error' => 'id unique'
            ];
        }
        echo json_encode($result);
    }

    public function importGuru()
    {

        $file = $this->input->post('file');
        $result = [
            'status' => true,
            'message' => 'Sukses di import!'
        ];
        echo json_encode($result);
    }
}
