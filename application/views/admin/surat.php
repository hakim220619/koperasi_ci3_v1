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
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#suratmodal">
                                <i class="fa fa-plus"></i>
                                Add Surat
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
                                        <th>JUDUL</th>
                                        <th>FILE</th>
                                        <th>DIBUAT</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php
                                    $no = 1;
                                    foreach ($surat as $a) { ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $a->judul ?></td>
                                            <td><?= $a->file ?></td>
                                            <td><?= $a->created_at ?></td>
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
                                                                Surat
                                                            </span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="<?= base_url('admin/update_surat'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <!-- Hidden field for ID -->
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($a->id) ? $a->id : ''; ?>">

                                                                <!-- Input untuk Judul -->
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label for="judul">Judul</label>
                                                                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" value="<?= isset($a->judul) ? $a->judul : ''; ?>" maxlength="300">
                                                                        <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Input untuk File -->
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label for="file">File</label>
                                                                        <input type="file" class="form-control" id="file" name="file">
                                                                        <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                    </div>
                                                                </div>

                                                                <!-- Hidden field untuk created_at -->
                                                                <input type="hidden" class="form-control" id="created_at" name="created_at" value="<?= isset($a->created_at) ? $a->created_at : date('Y-m-d H:i:s'); ?>">
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
                                                        <p>Anda yakin ingin menghapus <?= $a->judul ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="<?= base_url('admin/del_surat?id=') ?><?= $a->id ?>" class="btn btn-primary">Hapus</a>
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
<div class="modal fade" id="suratmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Surat</span>
                    <span class="fw-light">
                        Add
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="aset" method="post" action="<?= base_url('admin/insert_surat'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Hidden field for ID (auto-incremented in the database, if necessary) -->
                        <!-- Input for judul -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" value="<?= set_value('judul'); ?>" maxlength="300">
                                <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Input for file upload -->
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>File</label>
                                <input type="file" class="form-control" id="file" name="file">
                                <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
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