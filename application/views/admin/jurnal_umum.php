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
                        
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead class="center">
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>NAMA & TRANSAKSI</th>
                                        <th>DEBIT</th>
                                        <th>KREDIT</th>
                                        <th>SALDO</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    $no = 1;
                                    $saldo = 0; // Inisialisasi saldo awal
                                    foreach ($jurnal_umum as $a) {
                                        // Hitung saldo berdasarkan jenis transaksi
                                        if ($a->type == 'DEBIT') {
                                            $saldo += $a->jumlah;
                                        } elseif ($a->type == 'KREDIT') {
                                            $saldo -= $a->jumlah;
                                        }
                                    ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $a->tanggal_bayar ?></td>
                                            <td><?= $a->full_name . '-' . $a->name ?></td>
                                            <td><?= ($a->type == 'DEBIT') ?rupiah($a->jumlah) : '' ?></td>
                                            <td><?= ($a->type == 'KREDIT') ?rupiah($a->jumlah) : '' ?></td>
                                            <td><b><?=rupiah($saldo) ?></b></td> <!-- Tampilkan saldo terbaru -->
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
<div class="modal fade" id="simpananModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Jenis Simpanan</span>
                    <span class="fw-light">
                        Add
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="aset" method="post" action="<?= base_url('admin/insert_jenis_simpanan'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden field for ID (auto-incremented in the database, if necessary) -->
                        <!-- Input for judul -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Jenis Simpanan</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= set_value('name'); ?>" maxlength="300">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan" value="<?= set_value('keterangan'); ?>" maxlength="300">
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>



                        <!-- Hidden field for created_at (set to current timestamp if needed) -->
                        <input hidden type="text" class="form-control" id="created_at" name="created_at" value="<?= date('Y-m-d H:i:s'); ?>">
                    </div>

                    <!-- Modal footer with buttons -->
                    <div class="modal-footer no-bd">
                        <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>