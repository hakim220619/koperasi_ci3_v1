<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_admin');
        $this->load->model('Mod_user');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
        // $params = array('server_key' => 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k', 'production' => false);
        // $this->load->library('veritrans');
        // $this->veritrans->config($params);

    }

    public function user_data()
    {
        $data['title'] = "Data Admin";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['user'] = $this->Mod_admin->admin()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/user_data', $data);
    }
    public function insert_admin()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function update_admin()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/user_data');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function del_admin()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/user_data');
    }

    public function pegawai()
    {
        $data['title'] = "Data Kasir";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['pegawai'] = $this->Mod_admin->pegawai()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/pegawai', $data);
    }
    public function insert_pegawai()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }
    public function update_pegawai()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),

                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/pegawai');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function del_pegawai()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('swal', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/pegawai');
    }
    public function anggota()
    {
        $data['title'] = "Data Anggota";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['anggota'] = $this->Mod_admin->anggota()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/anggota', $data);
    }
    public function insert_anggota()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }
    public function update_anggota()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),

                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/anggota');
            // echo json_encode(array("status" => TRUE));
        }
    }
    public function del_anggota()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/anggota');
    }

    public function simpanan()
    {
        $data['title'] = "Simpanan Data";

        $data['user_level'] = $this->Mod_user->userlevel();
        $data['anggota'] = $this->Mod_admin->anggota()->result();

        // dead($nik);
        $this->template->load('layoutbackend', 'admin/simpanan', $data);
    }
    public function tambah_simpanan($id_user)
    {
        $data['title'] = "Simpanan Data";

        $data['simpanan'] = $this->Mod_user->getnik($id_user)->row_array();
        $data['jenis_simpanan'] = $this->db->query("select * from jenis_simpanan")->result();
        // dead($data['simpanan']);
        $this->template->load('layoutbackend', 'admin/tambah_simpanan', $data);
    }
    public function insert_simpanan()
    {
        // var_dump($this->input->post('username'));

        $save  = array(
            'id' => rand(00000, 99999),
            'id_user' => $this->input->post('id_user'),
            'id_jenis_simpanan' => $this->input->post('id_jenis_simpanan'),
            'nik' => $this->input->post('nik'),
            'metode_pembayaran' => "Manual",
            'status' => "200",
            'jumlah' => $this->input->post('jumlah'),
            'tanggal_bayar' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->insertSimpanan("simpanan", $save);
        redirect('admin/simpanan');
        // echo json_encode(array("status" => TRUE));
    }
    public function update_simpanan()
    {
        // var_dump($this->input->post('username'));
        $id = $this->input->post('id');
        $nik = $this->input->post('nik');
        $save  = array(
            'nik' => $nik,
            'jumlah' => $this->input->post('jumlah'),
            'tanggal_bayar' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->updateSimpanan($id, $save);
        redirect('admin/detail_simpanan/' . $nik . '');
        // echo json_encode(array("status" => TRUE));
    }
    public function delete($id)
    {
        $this->Mod_user->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Simpanan Wajib Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function del_simpanan($nik)
    {
        // dead($nik);
        $id = $this->input->get('id');
        $this->db->delete('simpanan', array('id' => $id));

        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/detail_simpanan/' . $nik . '');
    }

    public function backup_data()
    {
        $data["title"]         = "Backup Database Dengan CodeIgniter";
        $this->template->load('layoutbackend', 'admin/backup_data', $data);
    }
    public function detail_simpanan($id_user)
    {
        $data['title'] = "Detail Simpanan Data";

        $data['det_simpanan'] = $this->Mod_user->detail_simpanan($id_user)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($id_user)->row_array();
        // dead($data['jumlah']);
        $this->template->load('layoutbackend', 'admin/detail_simpanan', $data);
    }
    public function detail_penarikan($id_user)
    {
        $data['title'] = "Detail Penarikan Data";

        $data['det_simpanan'] = $this->Mod_user->detail_simpanan($id_user)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($id_user)->row_array();
        // dead($data['jumlah']);
        $this->template->load('layoutbackend', 'admin/detail_penarikan', $data);
    }

    
    
    public function cetak_perangsuran($id)
    {
        $data['title'] = "Tambah Angsuran Data";
        // $data['lama'] = ['6', '10', '12'];
        $data['riwayat_angsuran'] = $this->Mod_admin->riwayat_perangsuran($id)->result();
        $data['angsuran'] = $this->Mod_admin->detail_angsuran($id)->row();
        // $angsuran = $data['angsuran'];
        $data['lama'] = $this->Mod_admin->lama_jml()->result();
        $data['sb'] = $this->Mod_admin->sdhbyr()->result();


        // $data['total'] = $total;
        // dead($data['riwayat_angsuran']);
        $this->load->view('admin/cetak_perangsuran', $data);
    }
    public function cetak_persimpanan($id)
    {
        $data['title'] = "Simpanan Data";
        $data['simpanan_anggota'] = $this->Mod_user->persimpanan_anggota($id)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($id)->row_array();
        // dead($nik);
        // $data['total'] = $total;
        // dead($data['riwayat_angsuran']);
        $this->load->view('admin/cetak_persimpanan', $data);
    }

    function laporan()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $id_user = $_GET['id_user'];
                $ket = 'Data Transaksi dari Siswa dengan Nomor Induk ' . $id_user;
                $url_cetak = 'admin/cetak1?&id_user=' . $id_user;
                $url_excel = 'admin/excel1?&id_user=' . $id_user;
                $anggota = $this->Mod_user->view_by_anggota($id_user)->result();
            } else if ($filter == '2') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'admin/cetak2?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $url_excel = 'admin/cetak1?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $anggota = $this->Mod_user->view_by_date($tanggal1, $tanggal2)->result();
            }
        } else {
            $ket = 'Semua Data Angsuran';
            $url_cetak = 'admin/cetak';
            $url_excel = 'admin/excel';
            $anggota = $this->Mod_user->view_all()->result();
        }

        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['url_excel'] = base_url($url_excel);
        $data['anggota'] = $anggota;
        // dead($data['anggota']);
        $data['anggota_list'] = $this->Mod_user->anggota()->result();
        // $data['tahun_ajaran'] = $this->Mod_user->tahun()->result();
        $data['title'] = 'Laporan Data Angsuran Diterima';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->template->load('layoutbackend', 'admin/laporan', $data);
    }
    public function cetak()
    {
        $ket = 'Semua Data Angsuran Diterima';

        $data['anggota'] = $this->Mod_user->view_all()->result();;
        $data['ket'] = $ket;
        $this->load->view('admin/print_angsuran', $data);
    }
    public function cetak1()
    {
        $id_user = $_GET['id_user'];
        $ket = 'Data Siswa Dengan Id ' . $id_user;

        $data['anggota'] = $this->Mod_user->view_by_anggota($id_user)->result();
        $data['ket'] = $ket;
        $this->load->view('admin/print_angsuran', $data);
    }
    public function cetak2()
    {
        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        $data['anggota'] = $this->Mod_user->view_by_date($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        $this->load->view('admin/print_angsuran', $data);
    }

    public function print_simpanan($nik)
    {
        $data['ket'] = 'Semua Data Simpanan Diterima';

        $data['det_simpanan'] = $this->Mod_user->detail_simpanan($nik)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($nik)->row_array();
        $this->load->view('admin/print_simpanan', $data);
    }
    public function print_allsimpanan()
    {
        $data['ket'] = 'Semua Data Simpanan Diterima';

        $data['det_simpanan'] = $this->Mod_user->print_allsimpanan()->result();

        $this->load->view('admin/print_allsimpanan', $data);
    }

 
    public function cetak_simpanan_anggota()
    {
        $data['ket'] = 'Semua Data Angsuran Diterima';
        $id_user = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $id_user = $id_user['id_user'];
        $data['simpanan_anggota'] = $this->Mod_user->simpanan_anggota($id_user)->result();
        $this->load->view('admin/cetak_simpanan_anggota', $data);
    }
    public function cetak_pinjaman($id)
    {
        $data['cetak_pinjaman'] = $this->Mod_user->cetak_pinjaman($id)->result();
        // dead($data['cetak_pinjaman']);
        $this->load->view('admin/cetak_pinjaman', $data);
    }

    public function cetak_all_pinjaman()
    {
        $data['cetak_all_pinjaman'] = $this->Mod_user->cetak_all_pinjaman()->result();
        // dead($data['cetak_pinjaman']);
        $this->load->view('admin/cetak_all_pinjaman', $data);
    }

    public function penarikan()
    {
        $data['title'] = "Penarikan";
        $data['penarikan'] =  $this->db->query("SELECT(SUM(CASE WHEN s.type = 'DEBIT' THEN s.jumlah ELSE 0 END) 
    - SUM(CASE WHEN s.type = 'KREDIT' THEN s.jumlah ELSE 0 END)) AS jumlah, tu.full_name, tu.nik, tu.alamat, tu.jenis_kelamin, s.id_user  FROM simpanan s, tbl_user tu WHERE s.id_user=tu.id_user AND s.status = '200' GROUP BY s.id_user")->result();
        // dead($data['list_angsuran']);
        $this->template->load('layoutbackend', 'admin/penarikan', $data);
    }
    public function aset_koperasi()
    {
        $data['title'] = "Aset Koperasi";
        $data['aset'] =  $this->db->query("SELECT * FROM aset")->result();
        // dead($data['list_angsuran']);
        $this->template->load('layoutbackend', 'admin/aset_koperasi', $data);
    }
    public function tarik_simpanan($id_user)
    {
        $data['title'] = "Tarik Simpanan";
        $data['penarikan'] =  $this->db->query("SELECT 
    tu.full_name, 
    tu.nik, 
    tu.alamat, 
    tu.jenis_kelamin, 
    s.id_user,
    s.id_jenis_simpanan,
    (SUM(CASE WHEN s.type = 'DEBIT' THEN s.jumlah ELSE 0 END) 
    - SUM(CASE WHEN s.type = 'KREDIT' THEN s.jumlah ELSE 0 END)) AS jumlah
FROM 
    simpanan s
JOIN 
    tbl_user tu ON s.id_user = tu.id_user
WHERE 
    s.status = '200' 
    AND s.id_user = '" . $id_user . "'
")->row_array();
        // dead($data['list_angsuran']);
        $this->template->load('layoutbackend', 'admin/tarik_simpanan', $data);
    }
    public function insert_tarikSimpanan()
    { {
            // var_dump($this->input->post('username'));

            $save  = array(
                'id' => rand(00000, 99999),
                'id_user' => $this->input->post('id_user'),
                'id_jenis_simpanan' => $this->input->post('id_jenis_simpanan'),
                'nik' => $this->input->post('nik'),
                'metode_pembayaran' => "Manual",
                'type' => "KREDIT",
                'status' => "200",
                'jumlah' => $this->input->post('jumlah'),
                'tanggal_bayar' => date("Y-m-d H:i:s"),

            );
            // dead($save);
            $this->Mod_user->insertSimpanan("simpanan", $save);
            redirect('admin/penarikan');
            // echo json_encode(array("status" => TRUE));
        }
    }
    public function insert_aset()
    {
        // Persiapan data yang akan disimpan
        $data = array(
            'no_aset' => $this->input->post('no_aset'),
            'nama_aset' => $this->input->post('nama_aset'),
            'keterangan' => $this->input->post('keterangan'),
            'status' => $this->input->post('status'),
            'created_at' => date("Y-m-d H:i:s")
        );

        // Melakukan insert ke tabel 'aset'
        $this->db->insert('aset', $data);

        // Redirect ke halaman 'aset_koperasi' setelah data berhasil disimpan
        redirect('admin/aset_koperasi');
    }

    public function update_aset()
    {
        $id =  $this->input->post('id');
        // Mengambil data yang diinputkan dari form
        $data = array(
            'no_aset' => $this->input->post('no_aset'),
            'nama_aset' => $this->input->post('nama_aset'),
            'keterangan' => $this->input->post('keterangan'),
            'status' => $this->input->post('status'),
            'created_at' => $this->input->post('created_at') ? $this->input->post('created_at') : date("Y-m-d H:i:s") // Mempertahankan created_at atau mengisi dengan waktu saat ini
        );

        // Melakukan update ke tabel 'aset' dengan kondisi 'id' tertentu
        $this->db->where('id', $id);
        $this->db->update('aset', $data);

        // Redirect ke halaman 'aset_koperasi' setelah data berhasil diperbarui
        redirect('admin/aset_koperasi');
    }

    public function surat()
    {
        $data['title'] = "Surat";
        $data['surat'] =  $this->db->query("SELECT * FROM surat")->result();
        // dead($data['list_angsuran']);
        $this->template->load('layoutbackend', 'admin/surat', $data);
    }


    public function insert_surat()
    {
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '9000';
        $config['max_width']     = '9000';
        $config['max_height']    = '9024';
        $config['file_name']     = $this->input->post('judul') . rand(0000, 9999);

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
            $fileData = $this->upload->data();
            // Prepare data for insertion
            $data = array(
                'judul' => $this->input->post('judul'),
                'file' => $fileData['file_name'], // Store the file name in the database
                'created_at' => date("Y-m-d H:i:s")
            );

            // Insert data into 'surat' table
            $this->db->insert('surat', $data);

            // Redirect to 'surat' page after successful insertion
            redirect('admin/surat');
        } else {
            // File upload failed, capture and display the error message
            $error = $this->upload->display_errors();

            // Set flashdata for error and redirect back to the form page
            $this->session->set_flashdata('error', $error);
            redirect('admin/surat'); // Adjust this to the form page URL if necessary
        }
    }

    public function update_surat()
    {
        // Ambil ID surat yang akan diupdate
        $id = $this->input->post('id');

        // Ambil data lama untuk mendapatkan nama file yang lama
        $this->db->where('id', $id);
        $oldData = $this->db->get('surat')->row();

        // Konfigurasi upload file
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png'; // Mencegah upload backdor
        $config['max_size']      = '9000';
        $config['max_width']     = '9000';
        $config['max_height']    = '9024';
        $config['file_name']     = $this->input->post('judul') . rand(0000, 9999);

        $this->upload->initialize($config);

        // Siapkan data untuk pembaruan
        $data = array(
            'judul' => $this->input->post('judul'),
            'created_at' => date("Y-m-d H:i:s")
        );

        // Jika ada file yang diupload
        if (!empty($_FILES['file']['name'])) {
            if ($this->upload->do_upload('file')) {
                // Hapus file lama jika ada
                if ($oldData && file_exists('./assets/uploads/' . $oldData->file)) {
                    unlink('./assets/uploads/' . $oldData->file); // Menghapus file lama
                }
                $fileData = $this->upload->data();
                $data['file'] = $fileData['file_name']; // Menyimpan nama file baru
            } else {
                // File upload gagal, tangkap dan tampilkan pesan kesalahan
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('admin/surat'); // Sesuaikan dengan URL halaman form jika perlu
                return; // Hentikan eksekusi lebih lanjut
            }
        }

        // Update data dalam tabel 'surat'
        $this->db->where('id', $id);
        $this->db->update('surat', $data);

        // Redirect ke halaman 'surat' setelah pembaruan berhasil
        redirect('admin/surat');
    }



    public function del_surat()
    {
        // Mendapatkan ID dari parameter URL
        $id = $this->input->get('id');

        // Memastikan ID ada sebelum mencoba menghapus
        if ($id) {
            // Menentukan kondisi 'WHERE' berdasarkan ID
            $this->db->where('id', $id);
            // Mengambil data surat untuk mendapatkan nama file yang terkait
            $surat = $this->db->get('surat')->row();

            if ($surat) {
                // Menghapus file yang terkait dari server
                $filePath = './assets/uploads/' . $surat->file;
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
                $this->db->where('id', $id);

                // Melakukan penghapusan data dari tabel 'surat'
                $this->db->delete('surat');

                // Set pesan atau notifikasi jika diinginkan, misal: 'Data berhasil dihapus'
                $this->session->set_flashdata('success', 'Data berhasil dihapus.');
            } else {
                // Jika surat tidak ditemukan
                $this->session->set_flashdata('error', 'Surat tidak ditemukan.');
            }
        } else {
            // Jika ID tidak ada atau tidak valid
            $this->session->set_flashdata('error', 'ID tidak valid.');
        }

        // Redirect ke halaman 'surat' setelah proses selesai
        redirect('admin/surat');
    }

    public function jenis_simpanan()
    {
        $data['title'] = "Jenis Simpanan";
        $data['jenis_simpanan'] =  $this->db->query("SELECT * FROM jenis_simpanan")->result();
        // dead($data['list_angsuran']);
        $this->template->load('layoutbackend', 'admin/jenis_simpanan', $data);
    }
    

    public function insert_jenis_simpanan()
    {
        // Persiapan data yang akan disimpan
        $data = array(
            'name' => $this->input->post('name'),
            'keterangan' => $this->input->post('keterangan'),
            'created_at' => date("Y-m-d H:i:s")
        );

        // Melakukan insert ke tabel 'aset'
        $this->db->insert('jenis_simpanan', $data);

        // Redirect ke halaman 'aset_koperasi' setelah data berhasil disimpan
        redirect('admin/jenis_simpanan');
    }

    public function jurnalUmum()
    {
        $data['title'] = "Jurnal Umum";
        $data['jurnal_umum'] =  $this->db->query("SELECT s.*, tu.full_name, js.name FROM simpanan s, tbl_user tu, jenis_simpanan js where s.id_user=tu.id_user AND s.id_jenis_simpanan=js.id")->result();
        // dead($data['list_angsuran']);
        $this->template->load('layoutbackend', 'admin/jurnal_umum', $data);
    }


    public function del_aset()
    {
        // Mendapatkan ID dari parameter URL
        $id = $this->input->get('id');

        // Memastikan ID ada sebelum mencoba menghapus
        if ($id) {
            // Menentukan kondisi 'WHERE' berdasarkan ID
            $this->db->where('id', $id);

            // Melakukan penghapusan data dari tabel 'aset'
            $this->db->delete('aset');

            // Set pesan atau notifikasi jika diinginkan, misal: 'Data berhasil dihapus'
            redirect('admin/aset_koperasi');
        } else {
            // Jika ID tidak ada atau tidak valid
            $this->session->set_flashdata('error', 'ID tidak valid.');
        }

        // Redirect ke halaman 'aset_koperasi' setelah proses selesai
        redirect('admin/aset_koperasi');
    }



    public function backup()
    {

        $this->load->dbutil();
        $data['setting_school'] = "DATA";
        $prefs = [
            'format' => 'zip',
            'filename' => $data['setting_school'] . '-' . date("Y-m-d H-i-s") . '.sql'
        ];
        $backup = $this->dbutil->backup($prefs);
        $file_name = $data['setting_school'] . '-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->download($file_name);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('full_name') == '') {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Full Name is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
