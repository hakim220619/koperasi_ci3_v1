<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_login extends CI_Model
{
    function Aplikasi()
    {
        return $this->db->get('aplikasi');
    }

    function Auth($username, $password)
    {

        //menggunakan active record . untuk menghindari sql injection
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        $this->db->where("is_active", 'Y');
        return $this->db->get("tbl_user");
    }

    function check_db($username)
    {
        return $this->db->get_where('tbl_user', array('username' => $username));
    }

    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $user = $this->db->get('tbl_user')->row();

        // Periksa apakah pengguna ditemukan dan verifikasi passwordnya
        if ($user && password_verify($password, $user->password)) {
            return $user; // Kembalikan data pengguna jika login sukses
        } else {
            return false; // Jika gagal, kembalikan false
        }
    }
}
