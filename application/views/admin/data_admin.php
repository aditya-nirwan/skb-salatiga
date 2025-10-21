<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1>Data Admin</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <!-- card -->
                <div class="card">
                    <div class="card-header">
                        <a href="<?= site_url('admin/add') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-plus"></i>
                            Tambah data Admin
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body overflow-hidden">
                        <table id="table1" class="table table-striped table-bordered rounded">
                            <thead>
                                <tr>
                                    <th style="min-width: 10px">#</th>
                                    <th>Username</th>
                                    <th>Email</th>
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
                                        <td><?= $data->username ?></td>
                                        <td><?= $data->email ?></td>
                                        <td><?= $data->no_hp ?></td>
                                        <td><?= $data->alamat ?></td>
                                        <td>
                                            <form action="<?= site_url('admin/del') ?>" method="post">

                                                <a href="<?= site_url('admin/view/' . $data->user_id) ?>" style="width: 34px;" class="btn btn-success btn-sm mb-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="<?= site_url('admin/edit/' . $data->user_id) ?>" style="width: 34px;" class="btn btn-primary btn-sm mb-1">
                                                    <i class="fas fa-pen"></i>
                                                </a>

                                                <input type="hidden" name="user_id" value="<?= $data->user_id ?>">
                                                <?php if ($this->fungsi->user_login()->user_id != $data->user_id) { ?>
                                                    <button onclick="return confirm('Data akan di hapus?')" style="width: 34px;" class="btn btn-danger btn-sm mb-1">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                <?php } ?>
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


<div class="modal fade" id="modal-admin">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-striped table-responsive-lg">


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