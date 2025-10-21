<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1>Edit Perusahaan</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-primary card-outline">
                    <!-- form start -->
                    <form action="" method="post" class="form-horizontal">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="perusahaan_id" value="<?= $row->perusahaan_id ?>">
                                    <input type="hidden" name="user_id" value="<?= $row->user_id ?>">
                                    <input type="text" name="username" value="<?= $this->input->post('username') ?? $row->username ?>" class="form-control <?= form_error('username') ? 'is-invalid' : null ?>" id="username" placeholder="Username">
                                    <?= form_error('username') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" value="<?= $this->input->post('password') ?>" class="form-control <?= form_error('password') ? 'is-invalid' : null ?>" id="password" placeholder="Password">
                                    <?= form_error('password') ?><small>(biarkan saja jika tidak di ganti)</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passconf" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="passconf" value="<?= $this->input->post('passconf') ?>" class="form-control <?= form_error('passconf') ? 'is-invalid' : null ?>" id="passconf" placeholder="Konfirmasi Password">
                                    <?= form_error('passconf') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" value="<?= $this->input->post('nama') ?? $row->nama_perusahaan ?>" class="form-control <?= form_error('nama') ? 'is-invalid' : null ?>" id="nama" placeholder="Nama Perusahaan">
                                    <?= form_error('nama') ?>
                                </div>
                            </div>

                            <!-- perusahaan -->
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea name="alamat" class="form-control <?= form_error('alamat') ? 'is-invalid' : null ?>" rows="3"><?= $this->input->post('alamat') ?? $row->alamat ?></textarea>
                                    <?= form_error('alamat') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" value="<?= $this->input->post('email') ?? $row->email ?>" class="form-control <?= form_error('username') ? 'is-invalid' : null ?>" id="email" placeholder="Email">
                                    <?= form_error('email') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="notelp" class="col-sm-4 col-form-label">No Telp</label>
                                <div class="col-sm-8">
                                    <input type="text" name="notelp" value="<?= $this->input->post('notelp') ?? $row->no_telp ?>" class="form-control <?= form_error('notelp') ? 'is-invalid' : null ?>" id="notelp" placeholder="No Telp">
                                    <?= form_error('notelp') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nohp" class="col-sm-4 col-form-label">No HP</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nohp" value="<?= $this->input->post('nohp') ?? $row->no_hp ?>" class="form-control" id="nohp" placeholder="No Hp">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bidang" class="col-sm-4 col-form-label">Bidang</label>
                                <div class="col-sm-8">
                                    <input type="text" name="bidang" value="<?= $this->input->post('bidang') ?? $row->bidang ?>" class="form-control <?= form_error('bidang') ? 'is-invalid' : null ?>" id="bidang" placeholder="Bidang">
                                    <?= form_error('bidang') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi" class="col-sm-4 col-form-label">Profil</label>
                                <div class="col-sm-8">
                                    <textarea name="deskripsi" class="form-control <?= form_error('deskripsi') ? 'is-invalid' : null ?>" rows="3"><?= $this->input->post('deskripsi') ?? $row->profil ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-warning">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
</section>
<!-- /.content -->