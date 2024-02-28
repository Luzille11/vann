<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VANNPERPUS | Register</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page" style="background-image: url('<?php echo base_url('assets/dist/img/buku2.jpg'); ?>'); background-size: cover;">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo base_url(); ?>assets/index2.html" class="h1"><b>VANN</b>PERPUS</a>
            </div>
            <div class="card-body">
                <?php 
				if($this->session->flashdata('error') !='')
				{
					echo '<div class="alert alert-danger" role="alert">';
					echo $this->session->flashdata('error');
					echo '</div>';
				}
				?>
                <p class="register-box-msg">Silahkan Register !</p>

                <form action="<?php echo base_url('Register/prosesRegister'); ?>" method="post">
                    <div class="form-group mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap">
                    </div>
                    <div class="form-group mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="5" required class="form-control "></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nomor Telepon</label>
                        <input type="tel"  pattern="[0-9]+" name="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon">
                    </div>
                    <div class="form-group mb-3" hidden>
                    <input type="text" name="level" class="form-control" value="peminjam" hidden>
                    </div>
                    <!-- /.col -->
                    <div class="text-center mt-2 mb-3">
                        <!-- /.col -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="text-center ">
                        <!-- /.col -->
                        <a href="<?php echo site_url('Welcome/index')?>" class="btn btn-success btn-block">
                            Kembali
                        </a>
                        <!-- /.col -->
                    </div>
                    <!-- /.col -->
                    <div>
                        <p class="mb-0">already Have an Account?
                            <a href="<?php echo base_url(); ?>auth/login" class="text-center">Login</a>
                        </p>
                    </div>
            </div>
            </form>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
</body>

</html>