<!-- Content Header (Page header) -->
<section class="content-header bg-blue mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-2">Profil <?= ucfirst($this->fungsi->user_login()->nama) ?></h3>
            </div>
        </div>
    </div>
</section>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">


        <?php if ($this->session->userdata('level') == 2) { ?>
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/dist/img/user.png" alt="User profile picture">
                            </div>

                            <div class="col text-center">
                                <h3 class="profile-username"><?= ucfirst($this->fungsi->user_login()->nama) ?></h3>
                                <label class="badge badge-warning">Perusahaan</lab>
                            </div>

                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                            <p class="text-muted">Salatiga</p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Email</strong>
                            <p class="text-muted">perusahaan@gmail.com</p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Kontak</strong>
                            <p class="text-muted">08212121</p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= site_url('loker/add') ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-file"></i>
                                Tambah Lowongan Kerja
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                foreach ($row->result() as $key => $data) { ?>
                                    <div class="col-12 col-md-6 d-flex align-items-stretch flex-column">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body">
                                                <h5><?= $data->posisi ?></h5>
                                                <div class="text-gray my-3">
                                                    <div class="mb-3">
                                                        <span class="badge badge-success"><?= $data->tipe ?></span>
                                                        <span class="badge badge-warning"><?= $data->jenis ?></span>
                                                    </div>
                                                    <p><i class="fas fa-map-marker-alt"></i> <?= $data->lokasi ?></p>
                                                    <p>Batas Waktu : <?= $data->deadline ?></p>
                                                </div>

                                                <a href="<?= site_url('loker/view/' . $data->loker_id) ?>">
                                                    <button class="btn btn-primary btn-sm">Lihat selengkapnya</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        <?php } ?>

        <?php if ($this->session->userdata('level') == 12) { ?>
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/dist/img/user.png" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $this->fungsi->user_login()->nama ?></h3>
                            <p class="text-muted text-center">Perusahaan</p>


                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-cogs"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-number">3</span>
                                    <span class="info-box-text">Loker Aktif</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#loker" data-toggle="tab">Loker</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="profile">
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th class="col-4">Username</th>
                                                    <td class="col-8"><?= $this->fungsi->ph_detail()->username ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Perusahaan</th>
                                                    <td><?= $this->fungsi->ph_detail()->nama ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td><?= $this->fungsi->ph_detail()->alamat ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>admin@<?= $this->fungsi->ph_detail()->email ?></td>
                                                </tr>
                                                <tr>
                                                    <th>No Telp</th>
                                                    <td><?= $this->fungsi->ph_detail()->no_telp ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Profil</th>
                                                    <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi ut expedita corrupti unde quo dignissimos cumque, iure, repudiandae deserunt rem nostrum officiis sed! Placeat tempore harum distinctio velit mollitia, fuga eligendi! Consectetur voluptates nesciunt neque, at distinctio harum alias eaque atque aliquam dignissimos eum necessitatibus dolores perspiciatis voluptatibus, similique nihil.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane p-0" id="loker">
                                    <div class="callout callout-warning">
                                        <h5>Loker 1</h5>
                                        <p class="text-muted">20 Maret 2021</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                    <div class="callout callout-warning">
                                        <h5>Loker 2</h5>
                                        <p class="text-muted">20 Maret 2021</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                    <div class="callout callout-warning">
                                        <h5>Loker 3</h5>
                                        <p class="text-muted">20 Maret 2021</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="sertifikat">
                                    <div class="callout callout-success">
                                        <h5>Sertifikat ABCD</h5>
                                        <p class="text-muted">Berlaku sampai 20 Maret 2024</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                    <div class="callout callout-success">
                                        <h5>Sertifikat ABCD</h5>
                                        <p class="text-muted">Berlaku sampai 20 Maret 2024</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                    <div class="callout callout-success">
                                        <h5>Sertifikat ABCD</h5>
                                        <p class="text-muted">Berlaku sampai 20 Maret 2024</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        <?php } ?>

        <?php if ($this->session->userdata('level') == 3) { ?>
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/dist/img/user.png" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $this->fungsi->user_login()->nama ?></h3>

                            <p class="text-muted text-center">Peserta Didik</p>

                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-cogs"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-number">3</span>
                                    <span class="info-box-text">Pelatihan</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->

                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-certificate"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-number">5</span>
                                    <span class="info-box-text">Sertifikat</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pelatihan" data-toggle="tab">Pelatihan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#sertifikat" data-toggle="tab">Sertifikat</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="profile">
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th class="col-sm-3">Username</th>
                                                    <td class="col-9"><?= $this->fungsi->user_login()->username ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama</th>
                                                    <td><?= $this->fungsi->user_login()->nama ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td><?= $this->fungsi->pd_detail()->alamat ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td><?= $this->fungsi->pd_detail()->gender ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Asal Sekolah</th>
                                                    <td><?= $this->fungsi->pd_detail()->asal_sekolah ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane p-0" id="pelatihan">
                                    <div class="callout callout-success">
                                        <h5>Pelatihan 1</h5>
                                        <p class="text-muted">20 Maret 2021</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                    <div class="callout callout-success">
                                        <h5>Pelatihan 2</h5>
                                        <p class="text-muted">20 Maret 2021</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                    <div class="callout callout-success">
                                        <h5>Sertifikat 3</h5>
                                        <p class="text-muted">20 Maret 2021</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="sertifikat">
                                    <div class="callout callout-success">
                                        <h5>Sertifikat ABCD</h5>
                                        <p class="text-muted">Berlaku sampai 20 Maret 2024</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                    <div class="callout callout-success">
                                        <h5>Sertifikat ABCD</h5>
                                        <p class="text-muted">Berlaku sampai 20 Maret 2024</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                    <div class="callout callout-success">
                                        <h5>Sertifikat ABCD</h5>
                                        <p class="text-muted">Berlaku sampai 20 Maret 2024</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus, possimus.</p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        <?php } ?>




    </div>
</section>
<!-- /.content -->