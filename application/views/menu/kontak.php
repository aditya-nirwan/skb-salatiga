<!-- Main Content -->
<section class="content py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 class="text-center p-3">Hubungi Kami Melalui Email atau Whatsapp</h5>
            </div>
        </div>

        <div class="col-12">
            <div class="row justify-content-center">
                <?php
                $no = 1;
                foreach ($row->result() as $key => $data) {
                ?>

                    <div class="col-12 col-md-4 col-sm-6">
                        <div class="card text-center card-navy card-outline">
                            <div class="card-body">
                                <?php if ($data->image == NULL) { ?>
                                    <img class="img-fluid img-circle mb-2" style="width: 70px; height: 70px" src="<?= base_url() ?>assets/dist/img/user.png" alt="User profile picture">
                                <?php } else { ?>
                                    <img class="img-rounded d-block mx-auto mb-3" style="height: 70px; width: 70px; object-fit: contain;" src="<?= base_url('assets/dist/img/foto/' . $data->image) ?>" alt="Foto User">
                                <?php } ?>


                                <p class="font-weight-bold my-2">Admin <?= $no++ ?></p>

                                <p><?= $data->email ?></p>

                                <a href="https://api.whatsapp.com/send?phone=<?= $data->no_hp ?>" target="_blank" class="btn btn-success btn-sm">
                                    <i class="fab fa-whatsapp"></i> <?= $data->no_hp ?>
                                </a>

                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>

        </div>

    </div>
</section>
<!-- /.Content -->