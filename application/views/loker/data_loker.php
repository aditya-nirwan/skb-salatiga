<!-- Content Header (Page header) -->
<section class="content-header mb-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="mb-4">Lowongan Kerja</h1>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <!-- Loker -->

        <div class="row justify-content-center align-items-stretch">

            <?php
            // foreach ($row->result() as $key => $data)
            foreach ($loker as $data) {
            ?>

                <div class="col-12 col-sm-6 col-md-4 my-2">
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

        <div class="col-12 my-5">
            <?= $this->pagination->create_links(); ?>
        </div>


        <!-- /.Loker -->
    </div>
</section>