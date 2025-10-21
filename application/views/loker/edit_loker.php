<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Form Edit Loker</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <!-- card -->
                <div class="card card-primary">
                    <div class="card-body">

                        <!-- Form -->
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="posisi">Posisi</label>
                                    <input type="hidden" name="loker_id" value="<?= $row->loker_id ?>">
                                    <input type="text" name="posisi" value="<?= $this->input->post('posisi') ?? $row->posisi ?>" class="form-control <?= form_error('posisi') ? 'is-invalid' : null ?>" placeholder="Posisi Pekerjaan">
                                    <?= form_error('posisi') ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tipe">Tipe Kontrak</label>
                                    <input type="text" name="tipe" value="<?= $this->input->post('tipe') ?? $row->tipe ?>" class="form-control <?= form_error('tipe') ? 'is-invalid' : null ?>" placeholder="Contoh : Fulltime">
                                    <?= form_error('tipe') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jenis">Jenis Industri</label>
                                    <input type="text" name="jenis" value="<?= $this->input->post('jenis') ?? $row->jenis ?>" class="form-control <?= form_error('jenis') ? 'is-invalid' : null ?>" placeholder="Contoh : Manufaktur, Dagang, Edukasi">
                                    <?= form_error('jenis') ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lokasi">Lokasi Kerja</label>
                                    <input type="text" name="lokasi" value="<?= $this->input->post('lokasi') ?? $row->lokasi ?>" class="form-control <?= form_error('lokasi') ? 'is-invalid' : null ?>" placeholder="Lokasi Kerja">
                                    <?= form_error('lokasi') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="deskripsi">Deskripsi Pekerjaan</label>
                                    <textarea rows="5" name="deskripsi" value="<?= set_value('deskripsi') ?>" class="form-control <?= form_error('deskripsi') ? 'is-invalid' : null ?>" placeholder="Deskripsi Pekerjaan"><?= $this->input->post('deskripsi') ?? $row->deskripsi_loker ?></textarea>
                                    <?= form_error('deskripsi') ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="syarat">Syarat</label>
                                    <textarea rows="5" name="syarat" value="<?= set_value('syarat') ?>" class="form-control <?= form_error('syarat') ? 'is-invalid' : null ?>" placeholder="Syarat"><?= $this->input->post('syarat') ?? $row->syarat ?></textarea>
                                    <?= form_error('syarat') ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="gaji">Gaji</label>
                                    <input type="text" name="gaji" class="form-control" placeholder="Opsional tidak perlu diisi">
                                </div>
                                <!-- Date -->
                                <div class="form-group col-md-6">
                                    <label>Deadline</label>
                                    <div class="input-group date" id="deadline" data-target-input="nearest">
                                        <input type="text" name="deadline" value="<?= $this->input->post('deadline') ?? $row->deadline ?>" class="form-control datetimepicker-input <?= form_error('deadline') ? 'is-invalid' : null ?>" data-target="#tanggal" />
                                        <div class="input-group-append" data-target="#deadline" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <?= form_error('deadline') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <!-- <input type="checkbox"> Saya setuju dengan <a href="#">syarat dan ketentuan</a> yang berlaku -->
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Simpan Loker</button>
                            </div>
                        </form>
                        <!-- /.Form -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
</section>
<!-- /.content -->