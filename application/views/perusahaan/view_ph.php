<!-- Content Header (Page header) -->
<section class="content-header bg-blue mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-2">Detail Perusahaan</h3>

            </div>
        </div>
    </div><!-- /.container-fluid -->
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
                            <label class="badge badge-warning">Perusahaan</lab>
                        </div>

                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted"><?= $row->alamat ?></p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Email</strong>
                        <p class="text-muted"><?= $row->email ?></p>
                        <hr>
                        <strong><i class="fas fa-phone mr-1"></i> Kontak</strong>
                        <p class="text-muted"><?= $row->no_telp ?></p>

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
                            Lowongan Kerja
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 d-flex align-items-stretch flex-column">
                                <div class="callout callout-success">
                                    <h5>Loker 1</h5>
                                    <div class="text-gray my-3">
                                        <p>Jenis Kontrak : <span class="badge badge-warning">Fulltime</span></p>
                                    </div>

                                    <button class="btn btn-primary btn-sm">Lihat selengkapnya</button>
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