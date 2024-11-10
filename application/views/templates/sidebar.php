<?php
date_default_timezone_set("Asia/Jakarta");
?>
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?php echo base_url(); ?>assets/foto/user/<?php echo $this->session->userdata['image']; ?>" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php echo $this->session->userdata['username']; ?>

                        </span>
                    </a>
                </div>
                &nbsp;
            </div>
            <ul class="nav nav-primary">
                <?php if ($_SESSION["id_level"] == "1") { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard') ?>" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item <?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['anggota', 'pegawai', 'user_data'])) ? 'active' : '' ?>">
                        <a data-toggle="collapse" href="#master" aria-expanded="<?= in_array($this->uri->segment(2), ['anggota', 'pegawai', 'user_data']) ? 'true' : 'false' ?>">
                            <i class="fas fa-layer-group"></i>
                            <p>Master Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse <?= in_array($this->uri->segment(2), ['anggota', 'pegawai', 'user_data', 'aset_koperasi', 'surat']) ? 'show' : '' ?>" id="master">
                            <ul class="nav nav-collapse">
                                <li class="<?= ($this->uri->segment(2) == 'anggota') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/anggota') ?>">
                                        <span class="sub-item">Anggota</span>
                                    </a>
                                </li>
                                <li class="<?= ($this->uri->segment(2) == 'pegawai') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/pegawai') ?>">
                                        <span class="sub-item">Pegawai</span>
                                    </a>
                                </li>
                                <li class="<?= ($this->uri->segment(2) == 'user_data') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/user_data') ?>">
                                        <span class="sub-item">Admin</span>
                                    </a>
                                </li>
                                <li class="<?= ($this->uri->segment(2) == 'aset_koperasi') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/aset_koperasi') ?>">
                                        <span class="sub-item">Aset Koperasi</span>
                                    </a>
                                </li>
                                <li class="<?= ($this->uri->segment(2) == 'surat') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/surat') ?>">
                                        <span class="sub-item">Kelola Surtat</span>
                                    </a>
                                </li>
                                <li class="<?= ($this->uri->segment(2) == 'jenis_simpanan') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/jenis_simpanan') ?>">
                                        <span class="sub-item">Jenis Simpanan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item <?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['simpanan', 'penarikan'])) ? 'active' : '' ?>">
                        <a data-toggle="collapse" href="#simpanan" aria-expanded="<?= in_array($this->uri->segment(2), ['simpanan', 'penarikan']) ? 'true' : 'false' ?>">
                            <i class="fas fa-save"></i>
                            <p>Master Transaksi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse <?= in_array($this->uri->segment(2), ['simpanan', 'penarikan']) ? 'show' : '' ?>" id="simpanan">
                            <ul class="nav nav-collapse">
                                <li class="<?= ($this->uri->segment(2) == 'simpanan') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/simpanan') ?>">
                                        <span class="sub-item">Simpanan</span>
                                    </a>
                                </li>
                                <li class="<?= ($this->uri->segment(2) == 'penarikan') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/penarikan') ?>">
                                        <span class="sub-item">Penarikan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item <?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['jurnalUmum', 'neracaSaldo'])) ? 'active' : '' ?>">
                        <a data-toggle="collapse" href="#jurnalUmum" aria-expanded="<?= in_array($this->uri->segment(2), ['jurnalUmum', 'neracaSaldo']) ? 'true' : 'false' ?>">
                            <i class="fas fa-file-invoice"></i>
                            <p>Akuntansi</p>
                            <span class="caret"></span>
                        </a>

                        <div class="collapse <?= in_array($this->uri->segment(2), ['jurnalUmum', 'penarikan']) ? 'show' : '' ?>" id="jurnalUmum">
                            <ul class="nav nav-collapse">
                                <li class="<?= ($this->uri->segment(2) == 'jurnalUmum') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/jurnalUmum') ?>">
                                        <span class="sub-item">Jurnal Umum</span>
                                    </a>
                                </li>
                                <li class="<?= ($this->uri->segment(2) == 'neracaSaldo') ? 'active' : '' ?>">
                                    <a href="<?= base_url('admin/neracaSaldo') ?>">
                                        <span class="sub-item">Neraca Saldo</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item <?= ($this->uri->segment(1) == 'laporan') ? 'active' : '' ?>">
                        <a href="<?= base_url('laporan') ?>" class="collapsed" aria-expanded="false">
                            <i class="fas fa-print"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                    <li class="nav-item <?= ($this->uri->segment(1) == 'login' && $this->uri->segment(2) == 'logout') ? 'active' : '' ?>">
                        <a href="<?= base_url('login/logout') ?>" class="collapsed" aria-expanded="false">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                <?php } ?>
                <!-- Similar conditions for levels "2" and "3" -->
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.onload = function() {
        jam();
    }

    function jam() {
        var e = document.getElementById('jam'),
            d = new Date(),
            h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        e.innerHTML = h + ':' + m + ':' + s;

        setTimeout('jam()', 1000);
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }
</script>