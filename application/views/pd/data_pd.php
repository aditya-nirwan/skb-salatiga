<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1>Data Peserta Didik</h1>
            </div>
        </div>
    </div>
</section>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <a href="<?= site_url('pd/add') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-plus"></i>
                            Tambah Data Peserta Didik
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body overflow-hidden">
                        <table id="table1" class="table table-bordered table-striped rounded">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Tgl Lahir</th>
                                    <th>No Hp</th>
                                    <th>Alamat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data->nama_pd ?></td>
                                        <td><?= $data->gender == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                        <td>
                                            <?php
                                            $tanggal = $data->tgl_lahir;
                                            echo $this->fungsi->tgl_indo(date($tanggal));
                                            ?>
                                        </td>
                                        <td><?= $data->no_hp ?></td>
                                        <td><?= $data->alamat ?></td>
                                        <td>
                                            <form action="<?= site_url('pd/del') ?>" method="post">
                                                <a href="<?= site_url('pd/profile/' . $data->pd_id) ?>" style="width: 34px;" class="btn btn-success btn-sm mb-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= site_url('pd/edit/' . $data->pd_id) ?>" style="width: 34px;" class="btn btn-primary btn-sm mb-1">
                                                    <i class="fas fa-pen"></i>
                                                </a>

                                                <!-- hapus -->
                                                <input type="hidden" name="user_id" value="<?= $data->user_id ?>">
                                                <button onclick="return confirm('Data akan di hapus?')" style="width: 34px;" class="btn btn-danger btn-sm mb-1">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.content -->