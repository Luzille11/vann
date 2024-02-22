<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VANNPERPUS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <link rel="stylesheet"
        href="<?php echo base_url('assets/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">


    <script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script> <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
    </script>

    <script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.js"></script> <!-- Bootstrap --> 
    <script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
    </script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->

    <script type="text/javascript" src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <!-- Select2 CSS -->

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?php echo base_url('assets/'); ?>/dist/img/vp4.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight h3 mt-2"><b>VANN</b>PERPUS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-header">CORE</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">NAVIGASI</li>
                        <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>Kategori/kategori" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>Rak/rak" class="nav-link">
                                <i class="nav-icon fas fa-border-all"></i>
                                <p>
                                    Rak
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>Buku/buku" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Buku
                                </p>
                            </a>
                        </li>
                        <?php } ?>

                        <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Transaksi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>Peminjaman/peminjaman" class="nav-link">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Peminjaman
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>Pengembalian/pengembalian" class="nav-link">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Pengembalian
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } else if ($this->session->userdata('level') == 'peminjam') { ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>Peminjaman/peminjaman" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Peminjaman
                                </p>
                            </a>
                        </li>
                        </li>
                        <?php } ?>

                        <?php if ($this->session->userdata('level') == 'peminjam'){ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>Ulasan/ulasan" class="nav-link">
                                <i class="nav-icon fas fa-comment"></i>
                                <p>
                                    Ulasan
                                </p>
                            </a>
                        </li>
                        <?php } ?>

                        <?php if ($this->session->userdata('level') == 'admin'){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    User
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>User/petugas" class="nav-link">
                                        <i class="nav-icon fas fa-user-tie"></i>
                                        <p>
                                            Petugas
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>User/peminjam" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Peminjam
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } else if ($this->session->userdata('level') == 'petugas'){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    User
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>User/peminjam" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Peminjam
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <!--<?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>Laporan/laporan" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Laporan Peminjaman
                                </p>
                            </a>
                        </li>
                        <?php }   ?>-->
                        <li class="nav-header">LOGOUT</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>auth/logout" class="nav-link">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <?php echo $contents; ?>
                    <!-- Control Sidebar -->
                    <aside class="control-sidebar control-sidebar-dark">
                        <!-- Control sidebar content goes here -->
                    </aside>
                    <!-- /.control-sidebar -->

                    <!-- Main Footer -->
                    <footer class="main-footer">
                        <strong><a href="https://www.instagram.com/arfnurrr/">VannPerpus</a>.</strong>

                        <div class="float-right d-none">
                            <b><?php echo $this->session->userdata('nama'); ?></b>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->





    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

</body>

</html>