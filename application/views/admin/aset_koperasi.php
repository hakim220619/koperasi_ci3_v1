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
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#asetmodal">
                                <i class="fa fa-plus"></i>
                                Add Aset
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead class="center">
                                    <tr>
                                        <th>NO</th>
                                        <th>NO ASET</th>
                                        <th>NAMA ASET</th>
                                        <th>KETERANGAN</th>
                                        <th>STATUS</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    $no = 1;
                                    foreach ($aset as $a) { ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $a->no_aset ?></td>
                                            <td><?= $a->nama_aset ?></td>
                                            <td><?= $a->keterangan ?></td>
                                            <td><?= $a->status ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button data-target="#edit-apk<?= $a->id ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#deluser<?= $a->id ?>">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="edit-apk<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Edit</span>
                                                            <span class="fw-light">
                                                                Aset
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="<?= base_url('admin/update_aset'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <!-- Hidden field for ID (jika diatur secara otomatis di database) -->
                                                                <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= isset($a->id) ? $a->id : ''; ?>">

                                                                <!-- Input untuk no_aset -->
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>No Aset</label>
                                                                        <input type="text" class="form-control" id="no_aset" name="no_aset" placeholder="No Aset" value="<?= isset($a->no_aset) ? $a->no_aset : ''; ?>" maxlength="20" readonly>
                                                                        <?= form_error('no_aset', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Input untuk nama_aset -->
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Nama Aset</label>
                                                                        <input type="text" class="form-control" id="nama_aset" name="nama_aset" placeholder="Nama Aset" value="<?= isset($a->nama_aset) ? $a->nama_aset : ''; ?>" maxlength="200">
                                                                        <?= form_error('nama_aset', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Input untuk keterangan -->
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Keterangan</label>
                                                                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" maxlength="400"><?= isset($a->keterangan) ? $a->keterangan : ''; ?></textarea>
                                                                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Dropdown untuk status -->
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Status</label>
                                                                        <select class="form-control" id="status" name="status">
                                                                            <option value="ON" <?= isset($a->status) && $a->status == 'ON' ? 'selected' : ''; ?>>ON</option>
                                                                            <option value="OFF" <?= isset($a->status) && $a->status == 'OFF' ? 'selected' : ''; ?>>OFF</option>
                                                                        </select>
                                                                        <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Hidden field untuk created_at (jika ingin otomatis menggunakan waktu saat ini) -->
                                                                <input hidden type="text" class="form-control" id="created_at" name="created_at" value="<?= isset($a->created_at) ? $a->created_at : date('Y-m-d H:i:s'); ?>">
                                                            </div>

                                                            <div class="modal-footer no-bd">
                                                                <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deluser<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addNewDonaturLabel">Hapus Anggota</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Anda yakin ingin menghapus <?= $a->nama_aset ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('admin/del_aset?id=') ?><?= $a->id ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
<div class="modal fade" id="asetmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Aset</span>
                    <span class="fw-light">
                        Add
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="aset" method="post" action="<?= base_url('admin/insert_aset'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden field for ID (auto-incremented in the database, if necessary) -->
                        <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= set_value('id'); ?>">

                        <!-- Input for no_aset -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>No Aset</label>
                                <input type="text" class="form-control" id="no_aset" name="no_aset" placeholder="No Aset" value="AST-<?= rand(0000, 9999) ?>" maxlength="20" readonly>
                                <?= form_error('no_aset', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Input for nama_aset -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Nama Aset</label>
                                <input type="text" class="form-control" id="nama_aset" name="nama_aset" placeholder="Nama Aset" value="<?= set_value('nama_aset'); ?>" maxlength="200">
                                <?= form_error('nama_aset', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Input for keterangan -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" maxlength="400"><?= set_value('keterangan'); ?></textarea>
                                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Dropdown for status -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="ON" <?= set_value('status') == 'ON' ? 'selected' : ''; ?>>ON</option>
                                    <option value="OFF" <?= set_value('status') == 'OFF' ? 'selected' : ''; ?>>OFF</option>
                                </select>
                                <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Hidden field for created_at (set to current timestamp if needed) -->
                        <input hidden type="text" class="form-control" id="created_at" name="created_at" placeholder="created_at" value="<?= date('Y-m-d H:i:s'); ?>">
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