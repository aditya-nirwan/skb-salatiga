<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1>Tambah Peserta Didik</h1>
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
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control <?= form_error('username') ? 'is-invalid' : null ?>" id="username" placeholder="Username" autofocus>
                                    <?= form_error('username') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control <?= form_error('password') ? 'is-invalid' : null ?>" id="password" placeholder="Password">
                                    <?= form_error('password') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passconf" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="passconf" value="<?= set_value('passconf') ?>" class="form-control <?= form_error('passconf') ? 'is-invalid' : null ?>" id="passconf" placeholder="Konfirmasi Password">
                                    <?= form_error('passconf') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control <?= form_error('nama') ? 'is-invalid' : null ?>" id="nama" placeholder="Nama">
                                    <?= form_error('nama') ?>
                                </div>
                            </div>

                            <!-- kolom pd -->
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Gender</label>
                                <div class="col-sm-8">
                                    <select name="gender" class="form-control <?= form_error('gender') ? 'is-invalid' : null ?>">
                                        <option value="">Gender</option>
                                        <option value="L" <?= set_value('gender') == 'L' ? "selected" : null ?>>Laki-Laki</option>
                                        <option value="P" <?= set_value('gender') == 'P' ? "selected" : null ?>>Perempuan</option>
                                    </select>
                                    <?= form_error('gender') ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-8">
                                    <div class="input-group date" id="tanggal" data-target-input="nearest">
                                        <input type="text" name="tgl_lahir" value="<?= set_value('tgl_lahir') ?>" class=" form-control datetimepicker-input <?= form_error('tgl_lahir') ? 'is-invalid' : null ?>" data-target="#tanggal" />
                                        <div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <?= form_error('tgl_lahir') ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" value="<?= set_value('email') ?>" class="form-control <?= form_error('email') ? 'is-invalid' : null ?>" id="email" placeholder="Email">
                                    <?= form_error('email') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea name="alamat" class="form-control <?= form_error('alamat') ? 'is-invalid' : null ?>" rows="2" placeholder="Alamat"><?= set_value('alamat') ?></textarea>
                                    <?= form_error('alamat') ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-4 col-form-label">No Hp</label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_hp" value="<?= set_value('no_hp') ?>" class="form-control <?= form_error('no_hp') ? 'is-invalid' : null ?>" id="no_hp" placeholder="Nomor HP">
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


<script>
    $(function() {
        //Date picker
        $('#tgllahir').datetimepicker({
            // format: 'L'
            format: 'Y-MM-DD'
        });
    })
</script>