<style>
    .center {
        text-align: center;
    }
</style>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title"><?= $title ?></h4>
                            <a href="<?= base_url('admin/print_allsimpanan') ?>"  target="_blank"
                                class="btn btn-primary btn-round ml-auto">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Cetak
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead class="center">
                                    <tr>
                                        <th>NO</th>
                                        <th>NIK</th>
                                        <th>NAMA LENGKAP</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>JUMLAH SIMPANAN</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    $no = 1;
                                    foreach ($penarikan as $a) { ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $a->nik ?></td>
                                            <td><?= $a->full_name ?></td>
                                            <td><?= $a->jenis_kelamin ?></td>
                                            <td>Rp. <?= number_format($a->jumlah) ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('admin/tarik_simpanan/' . $a->id_user . '') ?>"
                                                        class="btn btn-secondary">
                                                        <span class="btn-label">
                                                            <i class="fa fa-plus"></i>
                                                        </span>
                                                        Tarik Dana
                                                    </a>
                                                    &nbsp;
                                                    <a href="<?= base_url('admin/detail_penarikan/' . $a->id_user . '') ?>"
                                                        class="btn btn-warning">
                                                        <span class="btn-label">
                                                            <i class="fa fa-exclamation-circle"></i>
                                                        </span>
                                                        Detail Simpanan
                                                    </a>
                                                    &nbsp;

                                                    <a href="<?= base_url('admin/print_simpanan/' . $a->id_user . '') ?>"
                                                        class="btn btn-primary"
                                                        target="_blank">
                                                        <span class="btn-label">
                                                            <i class="fa fa-print"></i>
                                                        </span>
                                                        Cetak
                                                    </a>


                                                </div>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>