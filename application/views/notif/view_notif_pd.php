<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1>Notifikasi</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <?php if ($this->fungsi->user_pd()->pd_id == $pd->pd_id) { ?>

                    <?php foreach ($notif->result() as $key => $data) { ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title font-weight-bold"><?= $data->jenis ?></h5>
                            </div>
                            <div class="card-body">
                                <p>
                                    Anda telah diajukan pada lowongan kerja untuk posisi <span class="text-green"><?= $data->posisi ?></span>
                                    di <span class="text-blue"><?= $data->perusahaan ?></span>
                                </p>

                                <form action="<?= site_url('notif/del_notif') ?>" method="post">
                                    <a href="<?= site_url('loker/detail/' . $data->loker_id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Loker</a>
                                    <!-- hapus -->
                                    <input type="hidden" name="pdid" value="<?= $data->pd_id ?>">
                                    <input type="hidden" name="lokerid" value="<?= $data->loker_id ?>">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted m-0">
                                    <?php
                                    $tanggal = $data->tanggal;
                                    echo $this->fungsi->tgl_indo(date($tanggal));
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                <?php } ?>

            </div>
        </div>
    </div>
</section>