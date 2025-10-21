<!-- Content Header (Page header) -->
<section class="content-header bg-blue mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-2">Profil <?= $row->username ?></h3>
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
                                <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                    <a href="" data-toggle="modal" data-target="#modal-upload">
                                        <p class="bg-primary mx-auto" style="font-size: 3rem; width: 100px; height: 100px; line-height: 100px; border-radius: 50%;"><?= $row->nama_perusahaan[0] ?></p>
                                    </a>
                                <?php } else { ?>
                                    <p class="bg-primary mx-auto" style="font-size: 3rem; width: 100px; height: 100px; line-height: 100px; border-radius: 50%;"><?= $row->nama_perusahaan[0] ?></p>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="text-center">
                                <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                    <a href="" data-toggle="modal" data-target="#modal-upload">
                                        <img class="img-fluid img-rounded" style="height: 200px; width: 200px; object-fit: contain;" src="<?= base_url('assets/dist/img/foto/' . $row->image) ?>" alt="Foto User">
                                    </a>
                                <?php } else { ?>
                                    <img class="img-fluid img-rounded" style="height: 200px; width: 200px; object-fit: contain;" src="<?= base_url('assets/dist/img/foto/' . $row->image) ?>" alt="Foto User">
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- <div class="text-center">
                            <p class="bg-primary mx-auto elevation-2" style="font-size: 3rem; width: 100px; height: 100px; line-height: 100px; border-radius: 50%;"><?= ucfirst($row->username[0]) ?></p>
                        </div> -->

                        <div class="col text-center mb-4">
                            <h3 class="profile-username"><?= $row->nama_perusahaan ?></h3>
                            <label class="badge badge-warning">Perusahaan</label>
                        </div>

                        <hr>
                        <strong><i class="fas fa-industry mr-1"></i> Bidang Industri</strong>
                        <p class="text-muted"><?= $row->bidang ?></p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>
                        <p class="text-muted"><?= $row->alamat ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Email</strong>
                        <p class="text-muted"><?= $row->email ?></p>
                        <hr>
                        <strong><i class="fas fa-phone mr-1"></i> Telepon</strong>
                        <p class="text-muted"><?= $row->no_telp ?></p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">Profil</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $row->profil ?></p>
                    </div>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-8">
                <!--  -->
                <?php if ($this->fungsi->user_login()->level == 1) { ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">User</h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-responsive">
                                <tbody>
                                    <tr>
                                        <th style="width: 50%;">Username</th>
                                        <td><?= $row->username ?></td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td><?= $row->password ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <!-- Loker -->
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Loker <?= $row->nama_perusahaan ?></h4>
                            </div>
                            <div class="col">
                                <?php if ($this->fungsi->user_login()->level == 2) { ?>
                                    <a href="<?= site_url('loker/add') ?>" class="btn btn-warning btn-sm text-dark float-right">
                                        <i class="fas fa-plus"></i>
                                        Buat Loker
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <!-- Loker -->
                        <div class="row">
                            <?php
                            foreach ($loker->result() as $key => $data) { ?>
                                <div class="col-12 col-md-6 d-flex align-items-stretch flex-column">
                                    <div class="card card-navy card-outline">
                                        <div class="card-body">
                                            <h5><?= $data->posisi ?></h5>
                                            <div class="my-3">
                                                <div class="mb-3">
                                                    <span class="badge badge-success"><?= $data->tipe ?></span>
                                                    <span class="badge badge-warning"><?= $data->jenis ?></span>
                                                </div>
                                                <p><i class="fas fa-map-marker-alt"></i> <?= $data->lokasi ?></p>
                                                <p class="font-italic">
                                                    Sampai :
                                                    <?php
                                                    $tanggal = $data->deadline;
                                                    echo $this->fungsi->tgl_indo(date($tanggal));
                                                    ?>
                                                </p>
                                            </div>

                                            <form action="<?= site_url('loker/del') ?>" method="post">
                                                <a href="<?= site_url('loker/detail/' . $data->loker_id) ?>" class="btn btn-success btn-sm mr-1 mt-1" style="min-width:80px;">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>

                                                <?php if ($this->fungsi->user_login()->level == 2) { ?>
                                                    <?php if ($this->fungsi->user_perusahaan()->perusahaan_id == $row->perusahaan_id) { ?>
                                                        <!-- edit -->
                                                        <a href="<?= site_url('loker/edit/' . $data->loker_id) ?>" class="btn btn-primary btn-sm mr-1 mt-1" style="min-width:80px;">
                                                            <i class="fas fa-pen"></i> Edit
                                                        </a>

                                                        <!-- hapus -->
                                                        <input type="hidden" name="loker_id" value="<?= $data->loker_id ?>">
                                                        <button onclick="return confirm('Data akan di hapus?')" class="btn btn-danger btn-sm mr-1 mt-1" style="min-width:80px;">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    <?php } ?>
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.Loker -->
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>

    </div>
</section>
<!-- /.content -->

<!-- modal upload -->
<div class="modal fade" id="modal-upload">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Logo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <?php echo form_open_multipart('perusahaan/upload/' . $row->user_id); ?>
            <div class="modal-body overflow-hidden">
                <div class="form-group my-2">
                    <!-- <input type="hidden" name="user_id" value="<?= $row->user_id ?>"> -->
                    <input type="hidden" name="perusahaan_id" value="<?= $row->perusahaan_id ?>">
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