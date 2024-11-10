<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By ARYO
 */
class Mod_admin extends CI_Model
{
    public function count_all()
    {

        $this->db->from('aplikasi');
        return $this->db->count_all_results();
    }
    public function admin()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '1'
        ");
        return $query;
    }
    public function pegawai()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '2'
        ");
        return $query;
    }

    public function anggota()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '3'
        ");
        return $query;
    }
    public function total_simpanan($id_user)
    {
        $query = $this->db->query("
         SELECT SUM(CASE 
              WHEN type = 'DEBIT' THEN jumlah 
              WHEN type = 'KREDIT' THEN -jumlah 
              ELSE 0 
           END) AS jumlah
FROM simpanan
WHERE id_user = " . $id_user . " AND status = '200'
        ");
        return $query;
    }
    public function pinjaman()
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        order by p.status desc
        ");
        return $query;
    }
    public function pinjamanacc()
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where p.status = 'Y'
        order by p.status desc
        ");
        return $query;
    }
    public function pinjamanAnggota()
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where p.status = 'Y'
        and p.id_user = " . $this->session->userdata('id_user') . "
        order by p.status desc
        ");
        return $query;
    }
    public function nama_peminjam()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '3'
        ");
        return $query;
    }
    public function angsuran()
    {
        $query = $this->db->query("
        select a.*, tu.nik, tu.full_name, p.no_pinjaman, p.jumlah, p.lama, .p.bunga, sum(a.jumlah_angsuran) as total_angsuran
        from angsuran a
        left join tbl_user tu
        on a.id_user=tu.id_user
        left join pinjaman p
        on a.id_pinjaman=p.id
        ");
        return $query;
    }
    public function detail_angsuran($id)
    {

        $query = $this->db->query("
        select a.id, a.id_pinjaman, a.id_user, a.no_angsuran, a.jumlah_angsuran, a.nilai, a.tanggal, a.metode_pembayaran, a.no_virtual, a.status, a.order_id, tu.nik, tu.full_name, sum(a.nilai) as total_angsuran, p.id, p.id_user, p.no_pinjaman, p.jumlah, p.tanggal, p.lama, p.bunga
        from angsuran a
        left join tbl_user tu
        on a.id_user=tu.id_user
        left join pinjaman p
        on a.id_pinjaman=p.id
        where p.id = " . $id . " and a.status = '200'
        ");
        return $query;
    }
    public function riwayat_angsuran($id)
    {
        $query = $this->db->query("
        select *
        from angsuran
        where id_pinjaman = " . $id . "
        
        ");
        return $query;
    }
    public function riwayat_perangsuran($id)
    {
        $query = $this->db->query("
        select *
        from angsuran
        where id = " . $id . "
        order by jumlah_angsuran asc
        ");
        return $query;
    }
    public function lama($id)
    {
        $query = $this->db->query("
        select lama
        from pinjaman where id = " . $id . "
        ");
        return $query;
    }
    public function lama_jml()
    {
        $query = $this->db->query("
        select *
        from lama 
        ");
        return $query;
    }
    function insertangsuran($tabel, $data)
    {
        $insert = $this->db->insert_batch($tabel, $data);
        return $insert;
    }
    public function save_batch($data)
    {
        return $this->db->insert_batch('angsuran', $data);
    }
    public function sdhbyr()
    {
        $query = $this->db->query("
       select jumlah_angsuran, no_angsuran
        from angsuran 
        where no_angsuran = 'AN0010'
        ");
        return $query;
    }
    public function angsuran_anggota($id_user)
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where tu.id_user = " . $id_user . "
        order by p.status desc
        ");
        return $query;
    }

    public function pinjaman_ang($id)
    {
        $query = $this->db->query("
        select * 
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where id = " . $id . "
        ");
        return $query;
    }

    public function jum_lama($id)
    {
        $query = $this->db->query("
        select jumlah_angsuran as total from angsuran
        where id_pinjaman = " . $id . "
        ");
        return $query;
    }
}
