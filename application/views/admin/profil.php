<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary">PROFIL PENGGUNA</h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div>
        <br>
        <br>
        <!-- row untuk jadi satu baris card -->
        <div class="row">

            <div class="col-md-6">
                <div class="card shadow-lg border-info mb-3" style="max-width: 700px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">

                            <img src=<?= base_url('assets/foto/user/') . $tbl_user['image']; ?> class="card-img " alt="profile">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align:center; color:blue"><b>PROFIL SAYA</b></h5> <br>
                                <p class="card-text">NIK : <?= $tbl_user['nik']; ?></p>
                                <p class="card-text">Nama : <?= $tbl_user['full_name']; ?></p>
                                <p class="card-text">Username : <?= $tbl_user['username']; ?></p>
                                <p class="card-text">Alamat : <?= $tbl_user['alamat']; ?></p>
                                <p class="card-text">Jenis Kelamin : <?= $tbl_user['jenis_kelamin']; ?></p>
                                <p class="card-text">No Hp : <?= $tbl_user['tlp']; ?></p>
                                <!-- <p class="card-text"><small class="text-muted">Member sejak <?= date('d F Y', $tbl_user['data_created']); ?> </small></p> -->
                            </div>
                            <!-- <a href="<?= base_url('profil/edit'); ?>" class="btn btn-sm btn-info float-right mr-2"><i class="fas fa-user-edit"> Edit Profil </i></a> -->

                            <!-- <?php echo anchor('profil/dtl_anggota/' . $tbl_user['id_user'], '<input type=reset class="btn btn-info float-right mr-3 mb-3" value=\'Info\'>'); ?> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.end raw card -->

    </div>
    <!-- /.container-fluid -->

</div>
</div>
<!-- End of Main Content -->