<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Mod_login');
        $this->load->model('Mod_user');

    }

    public function login()
    {
        header("Content-Type: application/json");

        // Ambil data input dari POST request
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Validasi input
        if (empty($username) || empty($password)) {
            echo json_encode(['status' => 'failed', 'message' => 'Username atau password tidak boleh kosong']);
            return;
        }

        // Cek login melalui model
        $user = $this->Mod_login->check_login($username, $password);

        if ($user) {
            // Jika berhasil login, kembalikan data user (tanpa password untuk keamanan)
            $user_data = [
                'id_user' => $user->id_user,
                'username' => $user->username,
                'full_name' => $user->full_name,
                'nik' => $user->nik,
                'tlp' => $user->tlp,
                'id_level' => $user->id_level,
            ];
            echo json_encode(['status' => 'success', 'message' => 'Login berhasil', 'user' => $user_data]);
        } else {
            // Jika gagal login
            echo json_encode(['status' => 'failed', 'message' => 'Username atau password salah']);
        }
    }

    // Contoh endpoint GET
    public function get_data_simpanan($id)
    {
        // Query database untuk mengambil data dengan ID tertentu
        $data = $this->db->query("SELECT * FROM simpanan WHERE id_user = ?", array($id))->result();
        echo json_encode($data); // Keluarkan data dalam format JSON
    }
    public function riwayat_simpanan($id)
    {
        // Query database untuk mengambil data dengan ID tertentu
        $data = $this->Mod_user->detail_simpanan($id)->result();
        echo json_encode($data); // Keluarkan data dalam format JSON
    }
    public function sum_simpanan($id)
    {
        // Query database untuk mengambil data dengan ID tertentu
        $data = $this->db->query("SELECT sum(jumlah) as jumlah FROM simpanan WHERE id_user = ?", array($id))->result();
        echo json_encode($data); // Keluarkan data dalam format JSON
    }
    public function detail_simpanan($id)
    {
        // Validasi ID agar tidak berisi nilai yang tidak valid
        $id = (int)$id;

        // Ambil data rincian simpanan
        $this->db->select('s.id_jenis_simpanan, js.name, js.keterangan, s.jumlah')
            ->from('simpanan s')
            ->join('jenis_simpanan js', 's.id_jenis_simpanan = js.id')
            ->where('s.id_user', $id)
            ->where('s.status !=', 300);
        $rincian_data = $this->db->get()->result();

        // Ambil data setoran
        $this->db->select('s.id_jenis_simpanan, js.name, js.keterangan, SUM(s.jumlah) as jumlah')
            ->from('simpanan s')
            ->join('jenis_simpanan js', 's.id_jenis_simpanan = js.id')
            ->where('s.id_user', $id)
            ->where('s.status !=', 300)
            ->where('s.type', 'DEBIT')
            ->group_by('s.id_jenis_simpanan');
        $setoran_data = $this->db->get()->result();


        $this->db->select('s.id_jenis_simpanan, js.name, js.keterangan, s.jumlah')
            ->from('simpanan s')
            ->join('jenis_simpanan js', 's.id_jenis_simpanan = js.id')
            ->where('s.id_user', $id)
            ->where('s.status !=', 300)
            ->where('s.type', 'KREDIT');
        $penarikan_data = $this->db->get()->result();
        // Ambil saldo total
        $this->db->select_sum('jumlah');
        $this->db->from('simpanan');
        $this->db->where('id_user', $id);
        $this->db->where('type', 'DEBIT');
        $total_debit_result = $this->db->get()->row();
        $total_debit = $total_debit_result->jumlah;
        
        $this->db->select_sum('jumlah');
        $this->db->from('simpanan');
        $this->db->where('id_user', $id);
        $this->db->where('type', 'KREDIT');
        $total_kredit_result = $this->db->get()->row();
        $total_kredit = $total_kredit_result->jumlah;
        
        $total_saldo = $total_debit - $total_kredit;
        

        // Ambil total setoran
        $this->db->select_sum('jumlah');
        $this->db->from('simpanan');
        $this->db->where('id_user', $id);
        $this->db->where('type', 'DEBIT');
        $total_setoran_result = $this->db->get()->row();
        $total_setoran = $total_setoran_result->jumlah;

        // // Ambil sisa saldo setelah penarikan
        $this->db->select_sum('jumlah');
        $this->db->from('simpanan');
        $this->db->where('id_user', $id);
        $this->db->where('type', 'KREDIT');
        $penarikan_result = $this->db->get()->row();
        $sisa_saldo = $total_saldo - $penarikan_result->jumlah;
// dead($total_setoran);
        // Struktur data dalam format JSON
        $response = [
            'rincian' => array_map(function ($item) {
                return [
                    'title' => $item->name,
                    'amount' => number_format($item->jumlah, 0, ',', '.')
                ];
            }, $rincian_data),
            'setoran' => array_map(function ($item) {
                return [
                    'title' => $item->name,
                    'amount' => number_format($item->jumlah, 0, ',', '.')
                ];
            }, $setoran_data),
            'penarikan' => array_map(function($item) {
                return [
                    'title' => $item->name,
                    'amount' => number_format($item->jumlah, 0, ',', '.')
                ];
            }, $penarikan_data),
            'total_saldo' => number_format($total_saldo, 0, ',', '.'),
            'total_setoran' => number_format($total_setoran, 0, ',', '.'),
            'sisa_saldo' => number_format($sisa_saldo, 0, ',', '.')
        ];

        // Keluarkan data dalam format JSON
        echo json_encode($response);
    }



    // // Contoh endpoint POST
    // public function post_data() {
    //     $input = $this->input->post(); // Ambil data dari POST request
    //     $result = $this->Api_model->insert_data($input); // Simpan data ke database
    //     echo json_encode(['status' => $result ? 'success' : 'failed']);
    // }
}
