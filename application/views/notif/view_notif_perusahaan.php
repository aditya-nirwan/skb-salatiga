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

                <?php if ($this->fungsi->user_perusahaan()->perusahaan_id == $notif->row()->perusahaan_id) { ?>
                    <?php foreach ($notif->result() as $key => $data) { ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title font-weight-bold">Pengajuan</h5>
                            </div>
                            <div class="card-body">
                                <p>
                                    <?php
                                    $query = $this->db->query("select nama_pd from tb_pd where pd_id='$data->pd_id'");
                                    $namapd = $query->row()->nama_pd;
                                    ?>
                                    <span class="text-blue"><?= $namapd ?></span>
                                    telah diajukan pada lowongan kerja anda untuk posisi <span class="text-blue"><?= $data->posisi ?></span>
                                </p>

                                <form action="<?= site_url('notif/del_notif') ?>" method="post">
                                    <a href="<?= site_url('loker/detail/' . $data->loker_id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Loker</a>
                                    <!-- hapus -->
                                    <input type="hidden" name="notifid" value="<?= $data->notif_id ?>">
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