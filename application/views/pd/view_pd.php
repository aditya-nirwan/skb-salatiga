<!-- Content Header (Page header) -->
<section class="content-header bg-blue mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-2">Detail Data Peserta Didik</h3>
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
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/dist/img/user.png" alt="User profile picture">
                        </div>

                        <div class="col text-center">
                            <h3 class="profile-username"><?= $row->nama ?></h3>
                            <label class="badge badge-success">Peserta Didik</lab>
                        </div>

                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted"><?= $row->alamat ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Gender</strong>
                        <p class="text-muted"><?= $row->gender ? 'Laki-laki' : 'Perempuan' ?></p>
                        <hr>
                        <strong><i class="fas fa-phone mr-1"></i> Nomor HP</strong>
                        <p class="text-muted"><?= $row->no_hp ?></p>
                        <hr>
                        <strong><i class="fas fa-school mr-1"></i> Asal Sekolah</strong>
                        <p class="text-muted"><?= $row->asal_sekolah ?></p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= site_url('pd/add') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-file"></i>
                            Tambah Sertifikat
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 d-flex align-items-stretch flex-column">
                                <div class="callout callout-success">
                                    <h5>Pelatihan Menyetir</h5>
                                    <p class="text-muted">Dari : Kartika</p>
                                    <p class="text-muted">20 Maret 2021</p>

                                    <button class="btn btn-primary btn-sm">Lihat sertifikat</button>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 d-flex align-items-stretch flex-column">
                                <div class="callout callout-success">
                                    <h5>Pelatihan Komputer</h5>
                                    <p class="text-muted">Dari : Kartika</p>
                                    <p class="text-muted">3 Juni 2020</p>

                                    <button class="btn btn-primary btn-sm">Lihat sertifikat</button>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-stretch flex-column">
                                <div class="callout callout-success">
                                    <h5>Pelatihan Tata Rias</h5>
                                    <p class="text-muted">Dari : SKB Salatiga</p>
                                    <p class="text-muted">3 maret 2020</p>

                                    <button class="btn btn-primary btn-sm">Lihat sertifikat</button>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 d-flex align-items-stretch flex-column">
                                <div class="callout callout-success">
                                    <h5>Pelatihan Memasak</h5>
                                    <p class="text-muted">Dari : Unistama</p>
                                    <p class="text-muted">20 Maret 2021</p>

                                    <button class="btn btn-primary btn-sm">Lihat sertifikat</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>