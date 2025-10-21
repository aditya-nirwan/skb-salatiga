<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1>Edit Admin</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <!-- form start -->
                    <form action="" method="post" class="form-horizontal">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-12 col-sm-8">
                                    <input type="hidden" name="user_id" value="<?= $row->user_id ?>">
                                    <input type="text" name="username" value="<?= $this->input->post('username') ?? $row->username ?>" class="form-control <?= form_error('username') ? 'is-invalid' : null ?>" id="username" placeholder="Username">
                                    <?= form_error('username') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-12 col-sm-8">
                                    <input type="password" name="password" value="<?= $this->input->post('password') ?>" class="form-control <?= form_error('password') ? 'is-invalid' : null ?>" id="password" placeholder="Biarkan kosong jika tidak diganti">
                                    <?= form_error('password') ?>
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
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" value="<?= $this->input->post('email') ?? $row->email ?>" class="form-control <?= form_error('email') ? 'is-invalid' : null ?>" id="email" placeholder="Email">
                                    <?= form_error('email') ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" name="alamat" value="<?= $this->input->post('alamat') ?? $row->alamat ?>" class="form-control <?= form_error('alamat') ? 'is-invalid' : null ?>" id="alamat" placeholder="Alamat">
                                    <?= form_error('alamat') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-4 col-form-label">Nomor HP</label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_hp" value="<?= $this->input->post('no_hp') ?? $row->no_hp ?>" class="form-control <?= form_error('no_hp') ? 'is-invalid' : null ?>" id="no_hp" placeholder="Nomor HP">
                                    <?= form_error('no_hp') ?>
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