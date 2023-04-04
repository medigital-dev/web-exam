<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['session_akun'])) {
            redirect(base_url($_SESSION['session_akun']['levelUser']));
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Guru_model', 'gurumapel');
        $this->load->model('Siswa_model', 'siswa');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Mapel_model', 'mapel');
        $this->load->model('Siswalogin_model', 'siswalog');
    }

    public function index()
    {
        $keyword = $this->input->get('key');
        $dataAdmin = $this->admin->getAll();

        $inaDate = $this->toInaDate(date('ymd', time()));
        if ($inaDate == false) {
            $tanggal = '<span class="text-danger">Tanggal error</span>';
        } else {
            $tanggal = $inaDate['namaHari'] . ', ' . $inaDate['tanggal'] . ' ' . $inaDate['namaBulan'] . ' ' . $inaDate['tahun'];
        }

        $data = [
            'title' => 'Web-Based Exam System',
            'keyword' => $keyword,
            'tanggalSekarang' => $tanggal,
            'admin' => $dataAdmin
        ];

        $this->load->view('template/auth/header', $data);
        $this->load->view('auth/index');
        $this->load->view('template/auth/footer');
        $this->session->unset_userdata('message');
    }

    public function clogin()
    {
        $key = $this->input->post('keyword');
        if ($this->gurumapel->getByNIP($key)) {
            $result = $this->gurumapel->getByNIP($key);
            $data = [
                'levelUser' => 'guru',
                'namaUser' => $result['gmp_nama'],
            ];
            $this->session->set_userdata('session_akun', $data);
        } else if ($this->siswa->getByNISN($key)) {
            $result = $this->siswa->getByNISN($key);
            $dataSiswaLogin = $this->siswalog->getByIdPd($result['pd_unique']);
            $data = [
                'levelUser' => 'siswa',
                'namaUser' => $result['pd_nama'],
                'nisn' => $result['pd_nisn'],
                'kelas' => $result['pd_kelas'],
            ];

            if ($dataSiswaLogin) {
                $data['isActive'] = 1;
            } else {
                $data['isActive'] = 0;
                $this->session->set_userdata('session_akun', $data);
            }
        } else if ($this->admin->getByUsername($key)) {
            $result = $this->admin->getByUsername($key);
            $data = [
                'levelUser' => 'admin',
                'namaUser' => $result['admin_nama'],
                'status' => true
            ];
        }
        echo json_encode($data);
    }

    public function cAdminLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $admin = $this->admin->getByUsername($username);
        if ($admin) {
            if (password_verify($password, $admin['admin_password'])) {
                $data = [
                    'status' => true,
                    'levelUser' => 'admin',
                    'namaUser' => $admin['admin_nama']
                ];
                $this->session->set_userdata('session_akun', $data);
            } else {
                $data = ['status' => false];
            }
        } else {
            $data = ['status' => false];
        }
        echo json_encode($data);
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

    public function register()
    {
        if ($this->admin->getAll()) {
            redirect(base_url());
        }

        $inaDate = $this->toInaDate(date('ymd', time()));
        if ($inaDate == false) {
            $tanggal = '<span class="text-danger">Tanggal error</span>';
        } else {
            $tanggal = $inaDate['namaHari'] . ', ' . $inaDate['tanggal'] . ' ' . $inaDate['namaBulan'] . ' ' . $inaDate['tahun'];
        }

        $data = [
            'title' => 'Registrasi Admin | Web-eXam',
            'tanggalSekarang' => $tanggal,
        ];

        $this->form_validation->set_rules('nama', 'Nama Admin', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Admin', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Nama Pengguna', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password]');
        $this->form_validation->set_message('required', '{field} harus diisi.');
        $this->form_validation->set_message('valid_email', '{field} bukan merupakan format email yang valid.');
        $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
        $this->form_validation->set_message('matches', '{field} tidak sama');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/auth/header', $data);
            $this->load->view('auth/register');
            $this->load->view('template/auth/footer');
            $this->session->unset_userdata('message');
        } else {
            $this->_setAdmin();
        }
    }

    private function _setAdmin()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = [
            'admin_nama' => $nama,
            'admin_email' => $email,
            'admin_username' => $username,
            'admin_password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        if ($this->admin->setAdmin($data)) {
            $this->session->set_userdata('message', 'success|Akun admin telah berhasil diregistrasi.');
            redirect('index');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('session_akun');
    }
}
