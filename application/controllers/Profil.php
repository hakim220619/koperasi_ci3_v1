<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_user', 'user');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Profil';
        $data['tbl_user'] = $this->db->get_where('tbl_user', ['username' =>
        $this->session->userdata('username')])->row_array();
        // $data['ang'] = $this->db->get('tbl_user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/profil', $data);
        $this->load->view('templates/footer');
    }
}
