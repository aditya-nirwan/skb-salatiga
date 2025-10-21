<!-- Content Header (Page header) -->
<section class="content-header bg-blue mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-2">Profil Admin</h3>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <?php if ($row->image == NULL) { ?>
                            <div class="text-center">
                                <a href="" data-toggle="modal" data-target="#modal-upload">
                                    <p class="bg-primary mx-auto" style="font-size: 3rem; width: 100px; height: 100px; line-height: 100px; border-radius: 50%;"><?= ucfirst($row->username[0]) ?></p>
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="text-center">
                                <a href="" data-toggle="modal" data-target="#modal-upload">
                                    <img class=" profile-user-img img-fluid img-circle" style="height: 180px; width: 180px; object-fit: cover;" src="<?= base_url('assets/dist/img/foto/' . $row->image) ?>" alt="Foto User">
                                </a>
                            </div>
                        <?php } ?>

                        <div class="col text-center my-3">
                            <h3 class="profile-username"><?= ucfirst($row->username) ?></h3>
                        </div>
                        <div class="col text-center">
                            <a href="https://api.whatsapp.com/send?phone=<?= $row->no_hp ?>" target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp"></i> <?= $row->no_hp ?>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <?php if ($this->fungsi->user_login()->level != 2) { ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">User</h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width: 50%;">Username</th>
                                        <td><?= $row->username ?></td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td><?= $row->password ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $row->email ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td><?= $row->alamat ?></td>
                                    </tr>
                                    <tr>
                                        <th>No Hp</th>
                                        <td><?= $row->no_hp ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


</section>


<!-- modal upload -->
<div class="modal fade" id="modal-upload">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Foto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <?php echo form_open_multipart('admin/upload'); ?>
            <div class="modal-body">
                <div class="form-group my-2">
                    <input type="hidden" name="user_id" value="<?= $row->user_id ?>">
                    <input type="file" name="image" required>
                </div>

                <hr>
                <div class="text-muted">
                    <p>Format foto yang didukung : jpg jpeg png</p>
                    <p>Foto tidak boleh lebih dari 2 MB</p>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Upload
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>