<!-- Content Header (Page header) -->
<section class="content-header bg-blue mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-2">Halo <?= ucfirst($this->fungsi->user_login()->username) ?></h3>
                <p>Selamat datang di website Mitra Job SKB Salatiga</p>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content py-2">
    <div class="container-fluid">
        <!-- Login sebagai admin -->
        <?php if ($this->session->userdata('level') == 1) { ?>
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fas fa-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Lowongan Kerja</span>
                            <span class="info-box-number"><?= $loker_count ?></span>
                            <!-- <span class="info-box-number">10</span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Peserta Didik</span>
                            <span class="info-box-number"><?= $pesertadidik_count ?></span>
                            <!-- <span class="info-box-number">10</span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Perusahaan</span>
                            <span class="info-box-number"><?= $perusahaan_count ?></span>
                            <!-- <span class="info-box-number">10</span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Admin</span>
                            <span class="info-box-number" id="admin_count"><?= $admin_count ?></span>
                            <!-- <span class="info-box-number">10</span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- tabel pengajuan -->
            <div class="row">
                <div class="col-12 my-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold">Data Pengajuan</h5>
                        </div>
                        <div class="card-body overflow-hidden">
                            <table id="table2" class="table table-striped table-bordered rounded">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Loker</th>
                                        <th>Peserta Didik</th>
                                        <th>Tgl pengajuan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pengajuan as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <a href="<?= site_url('loker/detail/' . $data->loker_id) ?>">
                                                    <?= $data->nama_perusahaan . ' | ' . $data->posisi ?>
                                                </a>
                                            </td>
                                            <td><?= $data->nama_pd ?></td>
                                            <td>
                                                <?php
                                                $tanggal = $data->tgl_pengajuan;
                                                echo $this->fungsi->tgl_indo(date($tanggal));
                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($data->status == 'W') { ?>
                                                    <span class="badge badge-warning">Diajukan</span>
                                                <?php } else if ($data->status == 'Y') { ?>
                                                    <span class="badge badge-success">Diterima</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /. table pengajuan -->
        <?php } ?>

        <!-- Login sebagai perusahaan -->
        <?php if ($this->session->userdata('level') == 2) { ?>
            <div class="row">
                <div class="col-12">
                    <div class="jumbotron jumbotron-fluid text-center bg-light p-3">
                        <h4 class="text-primary">Temukan Tenaga Kerja Kompeten Disini</h4>
                        <p class="mt-4">Mitra Job SKB Salatiga adalah platform yang menghubungkan industri dengan peserta didik non formal.</p>
                    </div>
                </div>
            </div>
        <?php } ?>


    </div>



</section>

<section class="content bg-navy">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 class="text-center pt-5 pb-3">CARA KERJA</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card text-center">
                    <div class="card-header">
                        <p class="bg-primary img-circle mx-auto my-0 font-weight-bold" style="width:50px; height:50px; line-height:50px">1</p>
                    </div>
                    <div class="card-body">
                        <img src="<?= base_url() ?>assets/dist/img/illustration/job.svg" alt="cara-kerja" class="img-fluid">
                    </div>
                    <div class="card-footer" style="min-height: 130px;">
                        <p class="text-dark">Perusahaan membuat lowongan kerja pada Form Loker</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card text-center">
                    <div class="card-header">
                        <p class="bg-primary img-circle mx-auto my-0 font-weight-bold" style="width:50px; height:50px; line-height:50px">2</p>
                    </div>
                    <div class="card-body">
                        <img src="<?= base_url() ?>assets/dist/img/illustration/users.svg" alt="cara-kerja" class="img-fluid">
                    </div>
                    <div class="card-footer" style="min-height: 130px;">
                        <p class="text-dark">Loker disebar ke seluruh pengguna Mitra Job SKB Salatiga</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card text-center">
                    <div class="card-header">
                        <p class="bg-primary img-circle mx-auto my-0 font-weight-bold" style="width:50px; height:50px; line-height:50px">3</p>
                    </div>
                    <div class="card-body">
                        <img src="<?= base_url() ?>assets/dist/img/illustration/man.svg" alt="cara-kerja" class="img-fluid">
                    </div>
                    <div class="card-footer" style="min-height: 130px;">
                        <p class="text-dark">Pihak Mitra Job SKB Salatiga mengajukan peserta didik</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card text-center">
                    <div class="card-header">
                        <p class="bg-primary img-circle mx-auto my-0 font-weight-bold" style="width:50px; height:50px; line-height:50px">4</p>
                    </div>
                    <div class="card-body">
                        <img src="<?= base_url() ?>assets/dist/img/illustration/looking.svg" alt="cara-kerja" class="img-fluid">
                    </div>
                    <div class="card-footer" style="min-height: 130px;">
                        <p class="text-dark">Perusahaan memilih peserta didik yang telah diajukan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pt-3 pb-5">
                <div class="text-center">
                    <?php if ($this->fungsi->user_login()->level == 2) { ?>
                        <a href="<?= site_url('loker/add') ?>" class="btn btn-primary px-5">Buat Loker</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 class="text-center p-3">LOWONGAN KERJA</h5>
            </div>
        </div>

        <div class="row justify-content-center">

            <?php
            foreach ($loker->result() as $key => $data) {
            ?>

                <div class="col-12 col-md-4 col-sm-6">
                    <div class="card text-center card-navy card-outline">
                        <div class="card-body">
                            <?php if ($data->image == NULL) { ?>
                                <p class="bg-primary img-circle mx-auto" style="font-size:2rem; width:70px; height:70px; line-height:70px"><?= $data->nama_perusahaan[0] ?></p>
                            <?php } else { ?>
                                <img class="img-rounded d-block mx-auto mb-3" style="height: 70px; width: 70px; object-fit: contain;" src="<?= base_url('assets/dist/img/foto/' . $data->image) ?>" alt="Foto User">
                            <?php } ?>

                            <b><?= $data->posisi ?></b>
                            <p class="text-muted font-italic mt-2">Oleh : <?= $data->nama_perusahaan ?></p>

                            <div class="mb-3">
                                <span class="badge badge-success"><?= $data->tipe ?></span>
                                <span class="badge badge-warning"><?= $data->jenis ?></span>
                            </div>

                            <i class="fas fa-map-marker-alt"></i>
                            <p><?= $data->lokasi ?></p>
                            <p class="font-italic font-weight-light">
                                <span class="text-muted">Sampai : </span>
                                <?php
                                $tanggal = $data->deadline;
                                echo $this->fungsi->tgl_indo(date($tanggal));
                                ?>
                            </p>

                        </div>
                        <div class="card-footer">
                            <a href="<?= site_url('loker/detail/' . $data->loker_id) ?>" class="btn btn-primary btn-sm">Lihat selengkapnya</a>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>


        <div class="row">
            <div class="col-12 py-5">
                <div class="text-center">
                    <a href="<?= site_url('loker') ?>" class="btn btn-primary">Lihat Loker Lainnya</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->