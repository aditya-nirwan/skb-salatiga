<!-- Content Header (Page header) -->
<section class="content-header bg-blue mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-2">Loker <?= ucfirst($row->nama_perusahaan) ?></h3>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <dl style="line-height: 1.8rem;">
                            <dt>Posisi</dt>
                            <dd><?= $row->posisi ?></dd>
                            <dt>Tipe Kontrak</dt>
                            <dd><?= $row->tipe ?></dd>
                            <dt>Jenis Industri</dt>
                            <dd><?= $row->jenis ?></dd>
                            <dt>Deskripsi Pekerjaan</dt>
                            <dd><?= $row->deskripsi_loker ?></dd>
                            <dt>Syarat</dt>
                            <dd><?= $row->syarat ?></dd>
                            <dt>Gaji</dt>
                            <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                <dd><?= $row->gaji == '' ? '-' : $row->gaji; ?></dd>
                            <?php } ?>
                            <?php if ($this->fungsi->user_login()->level == 2) { ?>
                                <?php if ($this->fungsi->user_perusahaan()->perusahaan_id == $row->perusahaan_id) { ?>
                                    <dd><?= $row->gaji == '' ? '-' : $row->gaji; ?></dd>
                                <?php } else { ?>
                                    <dd>-</dd>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($this->fungsi->user_login()->level == 3) { ?>
                                <dd>-</dd>
                            <?php } ?>

                            <dt class="mt-3">Dibuat</dt>
                            <dd>
                                <?php
                                $tanggal = $row->created;
                                echo $this->fungsi->tgl_indo(date($tanggal));
                                ?>
                            </dd>
                            <dt>Deadline</dt>
                            <dd>
                                <?php
                                $tanggal = $row->deadline;
                                echo $this->fungsi->tgl_indo(date($tanggal));
                                ?>
                            </dd>
                        </dl>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <!-- <div class="card card-primary card-outline">
                    <div class="card-body">
                        
                    </div>
                </div> -->

                <!-- <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <p class="bg-primary mx-auto elevation-2" style="font-size: 3rem; width: 100px; height: 100px; line-height: 100px; border-radius: 50%;"><?= ucfirst($row->nama_perusahaan[0]) ?></p>
                        </div>

                        <div class="col text-center">
                            <h3 class="profile-username"><?= $row->nama_perusahaan ?></h3>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- /.col -->


        </div>


        <!-- Pengajuan dan Diterima -->
        <div class="row">
            <div class="col-md-8">
                <!-- Diterima -->
                <div class="card card-primary mb-5">
                    <div class="card-header">
                        <h5 class="card-title">Diterima</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($pengajuan as $key => $pd) { ?>
                                <?php if ($pd->status == 'Y') { ?>
                                    <div class="col-12 col-md-4">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <?php if ($pd->image != null) { ?>
                                                    <img src="<?= base_url('assets/dist/img/foto/' . $pd->image) ?>" class="img-circle mb-3" style="width: 50px; height: 50px;" alt="User Image">
                                                <?php } else { ?>
                                                    <p class="bg-primary img-circle mx-auto" style="font-size:1.5rem; width:50px; height:50px; line-height:50px"><?= $pd->nama_pd[0] ?></p>
                                                <?php } ?>

                                                <p class="font-weight-bold"><?= $pd->nama_pd ?></p>

                                                <a href="<?= site_url('pesertadidik/profile/' . $pd->pd_id) ?>" class="btn btn-primary btn-sm m-1" style="min-width: 100px;">
                                                    <i class="fas fa-eye"></i> Profil
                                                </a>
                                                <?php if ($this->fungsi->user_login()->level == 2) { ?>
                                                    <?php if ($this->fungsi->user_perusahaan()->perusahaan_id == $row->perusahaan_id) { ?>
                                                        <form action="<?= site_url('loker/batal_pengajuan/' . $row->loker_id) ?>" method="post">
                                                            <input type="hidden" name="pengajuan_id" value="<?= $pd->pengajuan_id ?>">
                                                            <input type="hidden" name="pd_id" value="<?= $pd->pd_id ?>">
                                                            <button onclick="return confirm('Batalkan pengajuan ?')" class="btn btn-warning btn-sm m-1" style="min-width:100px;">
                                                                <i class="fas fa-times-circle"></i> Batal
                                                            </button>
                                                        </form>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <div class="card-footer p-0">
                                                <div class="text-muted">
                                                    <small>Pengajuan :</small>
                                                    <p>
                                                        <?php
                                                        $tanggal = $pd->tgl_pengajuan;
                                                        echo $this->fungsi->tgl_indo(date($tanggal));
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- pengajuan -->
                <div class="card card-primary mb-5">
                    <div class="card-header p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Pengajuan</h4>
                            </div>
                            <div class="col">
                                <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                    <button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#modal-lg">
                                        Pengajuan
                                    </button>
                                <?php } ?>
                                <?php if ($this->session->userdata('level') == 2) { ?>
                                    <!-- <a href="#" class="btn btn-primary btn-sm float-right">
                                    <i class="fas fa-paper-plane"></i>
                                    Tutup Loker
                                    </a> -->
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- PD yang diajukan -->
                        <div class="row">
                            <?php foreach ($pengajuan as $key => $pd) { ?>
                                <?php if ($pd->status == 'W') { ?>
                                    <div class="col-12 col-md-4">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <?php if ($pd->image != null) { ?>
                                                    <img src="<?= base_url('assets/dist/img/foto/' . $pd->image) ?>" class="img-circle mb-3" style="width: 50px; height: 50px;" alt="User Image">
                                                <?php } else { ?>
                                                    <p class="bg-primary img-circle mx-auto" style="font-size:1.5rem; width:50px; height:50px; line-height:50px"><?= $pd->nama_pd[0] ?></p>
                                                <?php } ?>

                                                <p class="font-weight-bold"><?= $pd->nama_pd ?></p>
                                                <form action="<?= site_url('loker/del_pengajuan/' . $row->loker_id) ?>" method="post">

                                                    <a href="<?= site_url('pesertadidik/profile/' . $pd->pd_id) ?>" class="btn btn-primary btn-sm m-1" style="min-width: 100px;">
                                                        <i class="fas fa-eye"></i> Profil
                                                    </a>

                                                    <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                                        <!-- hapus -->
                                                        <input type="hidden" name="pengajuan_id" value="<?= $pd->pengajuan_id ?>">
                                                        <input type="hidden" name="pd_id" value="<?= $pd->pd_id ?>">
                                                        <button onclick="return confirm('Hapus pengajuan ?')" class="btn btn-danger btn-sm m-1" style="min-width:100px;">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    <?php } ?>
                                                </form>

                                                <?php if ($this->fungsi->user_login()->level == 2) { ?>
                                                    <?php if ($this->fungsi->user_perusahaan()->perusahaan_id == $row->perusahaan_id) { ?>
                                                        <form action="<?= site_url('loker/terima_pengajuan/' . $row->loker_id) ?>" method="post">
                                                            <input type="hidden" name="pengajuan_id" value="<?= $pd->pengajuan_id ?>">
                                                            <input type="hidden" name="pd_id" value="<?= $pd->pd_id ?>">
                                                            <button onclick="return confirm('Terima pengajuan ?')" class="btn btn-success btn-sm m-1" style="min-width:100px;">
                                                                <i class="fas fa-check-circle"></i> Terima
                                                            </button>
                                                        </form>
                                                    <?php } ?>
                                                <?php } ?>

                                            </div>
                                            <div class="card-footer p-0">
                                                <div class="text-muted">
                                                    <small>Pengajuan :</small>
                                                    <p>
                                                        <?php
                                                        $tanggal = $pd->tgl_pengajuan;
                                                        echo $this->fungsi->tgl_indo(date($tanggal));
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                        </div>
                        <!-- /.pd -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengajuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body overflow-hidden">
                <table id="table2" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Peserta Didik</th>
                            <th>Gender</th>
                            <th>Tgl Lahir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesertadidik as $i => $data) { ?>
                            <tr>
                                <td><?= $data->nama_pd ?></td>
                                <td><?= $data->gender == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                <td>
                                    <?php
                                    $tanggal = $data->tgl_lahir;
                                    echo $this->fungsi->tgl_indo(date($tanggal));
                                    ?>
                                </td>
                                <td>
                                    <form action="<?= site_url('loker/pengajuan_pd/' . $row->loker_id) ?>" method="post">
                                        <input type="hidden" name="loker_id" value="<?= $row->loker_id ?>">
                                        <input type="hidden" name="perusahaan" value="<?= $row->nama_perusahaan ?>">
                                        <input type="hidden" name="posisi" value="<?= $row->posisi ?>">
                                        <input type="hidden" name="pd_id" value="<?= $data->pd_id ?>">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-paper-plane"></i> Ajukan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->