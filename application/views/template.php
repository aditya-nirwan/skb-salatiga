<?php
$this->ci = &get_instance();
$this->ci->load->model('notif_model');

if ($this->fungsi->user_login()->level == 1) {
    $notif = $this->ci->notif_model->notif_admin();
} else if ($this->fungsi->user_login()->level == 2) {
    $notif = $this->ci->notif_model->notif_perusahaan();
} else if ($this->fungsi->user_login()->level == 3) {
    $notif = $this->ci->notif_model->notif_pd();
}


?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SKB Salatiga</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins' !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Menu -->
                <li class="nav-item">
                    <?php if ($this->fungsi->user_login()->level != 2) { ?>
                        <a href="<?= site_url('notif/view/' . $this->fungsi->user_login()->user_id) ?>" class="nav-link">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge" id="count_notif"><?= $notif ?></span>
                        </a>
                    <?php } ?>
                    <?php if ($this->fungsi->user_login()->level == 2) { ?>
                        <a href="<?= site_url('notif/view/' . $this->fungsi->user_perusahaan()->perusahaan_id) ?>" class="nav-link">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge" id="count_notif"><?= $notif ?></span>
                        </a>
                    <?php } ?>
                </li>

                <!-- Akun -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="">
                        <?php if ($this->fungsi->user_login()->image != null) { ?>
                            <img src="<?= base_url('assets/dist/img/foto/' . $this->fungsi->user_login()->image) ?>" class="img-circle" style="width: 24px; height: 24px;" alt="User Image">
                        <?php } else { ?>
                            <p class="bg-primary text-center align-self-center" style="font-size:.8rem; width: 24px; height: 24px; line-height: 24px; border-radius: 50%; "><?= ucfirst($this->fungsi->user_login()->username[0]) ?></p>
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">
                            <?php if ($this->fungsi->user_login()->image != null) { ?>
                                <img src="<?= base_url('assets/dist/img/foto/' . $this->fungsi->user_login()->image) ?>" class="img-circle" style="width: 60px; height: 60px;" alt="User Image">
                            <?php } else { ?>
                                <p class="bg-primary text-center mx-auto" style="font-size: 1.5rem; width: 50px; height: 50px; line-height: 50px; border-radius: 50%; "><?= ucfirst($this->fungsi->user_login()->username[0]) ?></p>
                            <?php } ?>
                        </span>
                        <div class="dropdown-divider"></div>

                        <div class="dropdown-item text-center">
                            <h6><?= $this->fungsi->user_login()->username ?></h6>
                            <?php
                            $level = $this->fungsi->user_login()->level;
                            if ($level == 1) :
                                echo '<div class="badge badge-danger">Admin</div>';
                            elseif ($level == 2) :
                                echo '<div class="badge badge-warning">Perusahaan</div>';
                            elseif ($level == 3) :
                                echo '<div class="badge badge-success">Peserta Didik</div>';
                            endif
                            ?>
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('menu/about') ?>" class="dropdown-item text-center">Tentang SKB Salatiga</a>

                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('menu/kontak') ?>" class="dropdown-item text-center">Kontak Kami</a>

                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('menu/faq') ?>" class="dropdown-item text-center">FAQ</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item dropdown-footer" href="<?= site_url('auth/logout') ?>">
                            <button type="button" class="btn btn-block btn-danger btn-sm">Keluar</button>
                        </a>
                    </div>
                </li>
                <!-- /. Akun -->

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>" class="brand-link">
                <img src="<?= base_url() ?>assets/dist/img/handayani.png" alt="Tut wuri handayani" class="brand-image img-circle elevation-1" style="opacity: .8">
                <span class="brand-text font-weight-light"><strong>SKB</strong> Salatiga</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-0 mb-3 d-flex">
                    <div class="image">
                        <?php if ($this->fungsi->user_login()->image != null) { ?>
                            <img src="<?= base_url('assets/dist/img/foto/' . $this->fungsi->user_login()->image) ?>" class="img-circle mb-3" style="width: 34px; height: 34px;" alt="User Image">
                        <?php } else { ?>
                            <p class="bg-primary text-center align-self-center" style="width: 34px; height: 34px; line-height: 34px; border-radius: 50%; "><?= ucfirst($this->fungsi->user_login()->username[0]) ?></p>
                        <?php } ?>

                    </div>
                    <div class="info">
                        <a href="<?= base_url() ?>" class="d-block"><?= $this->fungsi->user_login()->username ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="<?= site_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= site_url('loker') ?>" class="nav-link <?= $this->uri->segment(1) == 'loker' && $this->uri->segment(2) == '' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>Lowongan Kerja</p>
                            </a>
                        </li>

                        <!-- MENU PERUSAHAAN -->
                        <?php if ($this->fungsi->user_login()->level == 2) { ?>
                            <li class="nav-item">
                                <a href="<?= site_url('loker/add') ?>" class="nav-link <?= $this->uri->segment(1) == 'loker' && $this->uri->segment(2) == 'add' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <p>Form Loker</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('perusahaan/profile/' . $this->fungsi->user_perusahaan()->perusahaan_id) ?>" class="nav-link <?= $this->uri->segment(1) == 'perusahaan' && $this->uri->segment(2) == 'profile' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Profil</p>
                                </a>
                            </li>
                        <?php } ?>


                        <!-- MENU PESERTA DIDIK -->
                        <?php if ($this->fungsi->user_login()->level == 3) { ?>
                            <li class="nav-item">
                                <a href="<?= site_url('pesertadidik/profile/' . $this->fungsi->user_pd()->pd_id) ?>" class="nav-link <?= $this->uri->segment(1) == 'pesertadidik' && $this->uri->segment(2) == 'profile' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Profil</p>
                                </a>
                            </li>
                        <?php } ?>


                        <!-- MENU ADMIN KELOLA USER -->
                        <?php if ($this->fungsi->user_login()->level == 1) { ?>
                            <li class="nav-item">
                                <a href="<?= site_url('admin') ?>" class="nav-link <?= $this->uri->segment(1) == 'admin' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Admin</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('perusahaan') ?>" class="nav-link <?= $this->uri->segment(1) == 'perusahaan' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Perusahaan</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('pesertadidik') ?>" class="nav-link <?= $this->uri->segment(1) == 'pesertadidik' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Peserta Didik</p>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $contents ?>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer p-0">
            <div class="p-3 pb-5">
                <strong>SKB Salatiga 2022</strong>
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 1.0
                </div>
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <p>asdfa</p>
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- bs-custom-file-input -->
    <script src="<?= base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>

    <!-- InputMask -->
    <script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


    <script>
        $(function() {
            $("#table1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                "buttons": ["copy", "excel", "print"]
            }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
            $('#table2').DataTable({
                "pageLength": 4,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            //Date picker
            $('#tanggal').datetimepicker({
                // format: 'L'
                format: 'Y-MM-DD'
            });
            $('#deadline').datetimepicker({
                // format: 'L'
                format: 'Y-MM-DD',
                minDate: new Date()
            });
        });

        $(document).ready(function() {
            $('#pengajuan').DataTable();
        });

        // notif
        function loadDoc() {
            setInterval(function() {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    document.getElementById("count_notif").innerHTML = this.responseText;
                }
                xhttp.open("GET", "<?= base_url() ?>notif/count", true);
                xhttp.send();
            }, 1000)
        }
        loadDoc();

        $('#inputGroupFile02').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

</body>

</html>