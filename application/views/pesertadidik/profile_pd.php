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
                                        <p class="bg-primary mx-auto" style="font-size: 3rem; width: 100px; height: 100px; line-height: 100px; border-radius: 50%;"><?= $row->nama_pd[0] ?></p>
                                    </a>
                                <?php } else { ?>
                                    <p class="bg-primary mx-auto" style="font-size: 3rem; width: 100px; height: 100px; line-height: 100px; border-radius: 50%;"><?= $row->nama_pd[0] ?></p>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="text-center">
                                <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                    <a href="" data-toggle="modal" data-target="#modal-upload">
                                        <img class="profile-user-img img-fluid img-circle" style="height: 200px; width: 200px; object-fit: cover;;" src="<?= base_url('assets/dist/img/foto/' . $row->image) ?>" alt="Foto User">
                                    </a>
                                <?php } else { ?>
                                    <img class="profile-user-img img-fluid img-circle" style="height: 200px; width: 200px; object-fit: cover;;" src="<?= base_url('assets/dist/img/foto/' . $row->image) ?>" alt="Foto User">
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <div class="col text-center my-3">
                            <h3 class="profile-username"><?= $row->nama_pd ?></h3>
                            <label class="badge badge-success">Peserta Didik</label>
                        </div>


                        <hr>
                        <strong><i class="fas fa-calendar mr-1"></i> Tanggal Lahir</strong>
                        <p class="text-muted"><?= date("d F Y", strtotime($row->tgl_lahir)); ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Gender</strong>
                        <p class="text-muted"><?= $row->gender ? 'Laki-laki' : 'Perempuan' ?></p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted"><?= $row->alamat ?></p>
                        <hr>
                        <strong><i class="fas fa-phone-alt"></i> WhatsApp</strong>
                        <div>
                            <a href="https://api.whatsapp.com/send?phone=<?= $row->no_hp ?>" target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp"></i> <?= $row->no_hp ?>
                            </a>
                        </div>
                        <hr>

                        <!-- <a href="#" class="btn btn-primary btn-sm btn-block">Download CV</a> -->

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-8">
                <!-- login -->
                <?php if ($this->fungsi->user_login()->level == 1) { ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">User</h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-responsive-lg">
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

                <!-- card sekolah -->
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Riwayat Sekolah</h4>
                            </div>
                            <div class="col">
                                <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                    <button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#modal-sekolah">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped table-responsive-lg">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Sekolah</th>
                                    <th>Masuk</th>
                                    <th>Lulus</th>
                                    <th>Keterangan</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($sekolah->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data->sekolah ?></td>
                                        <td><?= $data->tahun_masuk ?></td>
                                        <td><?= $data->tahun_lulus ?></td>
                                        <td><?= $data->keterangan ?></td>
                                        <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                            <td>
                                                <form action="<?= site_url('pesertadidik/del_sekolah') ?>" method="post">
                                                    <!-- hapus -->
                                                    <input type="hidden" name="pd_id" value="<?= $row->pd_id ?>">
                                                    <input type="hidden" name="sekolah" value="<?= $data->sekolah ?>">
                                                    <button onclick="return confirm('Data akan di hapus?')" class="btn btn-danger btn-sm float-right">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- card sertifikat -->
                <div class="card card-primary mt-5">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Sertifikat</h4>
                            </div>
                            <div class="col">
                                <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                    <button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#modal-sertifikat">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped table-responsive-lg">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Pelatihan</th>
                                    <th>Penyelenggara</th>
                                    <th>Tahun</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($sertifikat->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data->pelatihan ?></td>
                                        <td><?= $data->penyelenggara ?></td>
                                        <td><?= $data->tahun ?></td>
                                        <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                            <td>
                                                <form action="<?= site_url('pesertadidik/del_sertifikat') ?>" method="post">
                                                    <!-- hapus -->
                                                    <input type="hidden" name="pd_id" value="<?= $row->pd_id ?>">
                                                    <input type="hidden" name="pelatihan" value="<?= $data->pelatihan ?>">
                                                    <input type="hidden" name="penyelenggara" value="<?= $data->penyelenggara ?>">
                                                    <button onclick="return confirm('Data akan di hapus?')" class="btn btn-danger btn-sm float-right">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
    </div>
</section>


<div class="modal fade" id="modal-sekolah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Sekolah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form action="<?= site_url('pesertadidik/add_sekolah') ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="sekolah" class="col-sm-4 col-form-label">Sekolah</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="pd_id" value="<?= $row->pd_id ?>">
                            <input type="text" name="sekolah" value="<?= set_value('sekolah') ?>" class="form-control <?= form_error('sekolah') ? 'is-invalid' : null ?>" id="sekolah" placeholder="Sekolah" required autofocus>
                            <?= form_error('sekolah') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="masuk" class="col-sm-4 col-form-label">Tahun Masuk</label>
                        <div class="col-sm-8">
                            <input type="text" name="masuk" value="<?= set_value('masuk') ?>" class="form-control <?= form_error('masuk') ? 'is-invalid' : null ?>" id="masuk" placeholder="Tahun Masuk" required>
                            <?= form_error('masuk') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lulus" class="col-sm-4 col-form-label">Tahun Lulus</label>
                        <div class="col-sm-8">
                            <input type="text" name="lulus" value="<?= set_value('lulus') ?>" class="form-control <?= form_error('lulus') ? 'is-invalid' : null ?>" id="lulus" placeholder="Tahun Lulus" required>
                            <?= form_error('lulus') ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                            <input type="text" name="keterangan" value="<?= set_value('keterangan') ?>" class="form-control <?= form_error('keterangan') ? 'is-invalid' : null ?>" id="keterangan" placeholder="Keterangan">
                            <?= form_error('keterangan') ?>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-sertifikat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Sertifikat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form action="<?= site_url('pesertadidik/add_sertifikat') ?>" method="post" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="pelatihan" class="col-sm-4 col-form-label">Pelatihan</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="pd_id" value="<?= $row->pd_id ?>">
                            <input type="text" name="pelatihan" value="<?= set_value('pelatihan') ?>" class="form-control <?= form_error('pelatihan') ? 'is-invalid' : null ?>" id="pelatihan" placeholder="Pelatihan" required autofocus>
                            <?= form_error('pelatihan') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penyelenggara" class="col-sm-4 col-form-label">Penyelenggara</label>
                        <div class="col-sm-8">
                            <input type="text" name="penyelenggara" value="<?= set_value('penyelenggara') ?>" class="form-control <?= form_error('penyelenggara') ? 'is-invalid' : null ?>" id="penyelenggara" placeholder="Penyelenggara" required>
                            <?= form_error('penyelenggara') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-4 col-form-label">Tahun</label>
                        <div class="col-sm-8">
                            <input type="text" name="tahun" value="<?= set_value('tahun') ?>" class="form-control <?= form_error('tahun') ? 'is-invalid' : null ?>" id="tahun" placeholder="Tahun" required>
                            <?= form_error('tahun') ?>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


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
            <?php echo form_open_multipart('pesertadidik/upload/' . $row->user_id); ?>
            <!-- <form action="<?= site_url('pesertadidik/add_sertifikat') ?>" method="post" class="form-horizontal"> -->
            <div class="modal-body overflow-hidden">
                <div class="form-group my-2">
                    <input type="hidden" name="user_id" value="<?= $row->user_id ?>">
                    <input type="hidden" name="pd_id" value="<?= $row->pd_id ?>">
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