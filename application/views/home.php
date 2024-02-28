<!DOCTYPE html>
<html lang="en">

<head>
    <title>VANNPERPUS | Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google font -->
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url('assets/landing/'); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href=" <?php echo base_url('assets/landing/'); ?>css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/landing/'); ?>css/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/landing/'); ?>css/slicknav.min.css" />

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url('assets/landing/'); ?>css/style.css" />


    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<style>
.image {
    width: 150px;
    /* Sesuaikan ukuran yang diinginkan */
    height: auto;
    margin-top: -150px;
    margin-bottom: -150px;
    /* Sesuaikan margin atas yang diinginkan */
}

.image2 {
    width: 100%;
    /* Sesuaikan ukuran yang diinginkan */
    height: auto;
    margin-top: -180px;
    margin-bottom: -50px;
    /* Sesuaikan margin atas yang diinginkan */
}

.header-section {
	padding-left: 55px;
	padding-right: 72px;
	background: #08192D;
}
.hs-item {
	height: 724px;
	padding-bottom: 90px;
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-align: center;
	-ms-flex-align: center;
	align-items: center;
	background: #08192D;
}
</style>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header section -->
    <header class="header-section clearfix">
        <div class="container">
            <a href="index.html" class="site-logo" class="navbar-brand">
                <img src="<?php echo base_url(); ?>assets/dist/img/VANNPERPUS.png" alt="AdminLTE Logo" class="image ">
                <span class="brand-text font-weight-light"></span> </a>
            <div class="header-right">
                <div class="user-panel">
                    <a href="<?php echo base_url('Auth/login'); ?>" class=" btn
                        btn-primary">Login</a>
                    <a href="<?php echo base_url('Register/register'); ?>" class="btn btn-success">Register</a>
                </div>
            </div>
            <ul class="main-menu">
            </ul>
        </div>
    </header>
    <!-- Header section end -->

    <!-- Hero section -->
    <section class="hero-section">
        <div class="hero-slider owl-carousel">
            <div class="hs-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="hs-text">
                                <h2><span>Selamat</span>Datang</h2>
                                <h2>di</h2>
                                <h2>VANNPERPUS</h2>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="hr-img">
                                <img src="<?php echo base_url(); ?>assets/dist/img/perpus.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section end -->

    <!-- Intro section -->
    <section class="intro-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="<?php echo base_url(); ?>assets/dist/img/vp2.png" alt="" class="image2">
                </div>
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3>Apa itu VANNPERPUS?</h3>
                        <p>VannPerpus adalah sebuah aplikasi perpustakaan berbasis web yang dirancang untuk
                            memudahkan
                            pengelolaan koleksi buku secara efisien. Dengan fokus pada kemudahan penggunaan dan
                            aksesibilitas melalui platform web, VannPerpus memungkinkan pengelola perpustakaan untuk
                            secara
                            efektif mengelola inventaris, melacak peminjaman, dan memberikan layanan informasi
                            kepada
                            pengguna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Intro section end -->

    <!-- How section -->
    <section class="how-section spad set-bg" data-setbg="img/how-to-bg.jpg">
        <!--<div class="container text-white">
            <div class="section-title">
                <h2>How it works</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="how-item">
                        <div class="hi-icon">
                            <img src="img/icons/brain.png" alt="">
                        </div>
                        <h4>Create an account</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipi-scing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="how-item">
                        <div class="hi-icon">
                            <img src="img/icons/pointer.png" alt="">
                        </div>
                        <h4>Choose a plan</h4>
                        <p>Donec in sodales dui, a blandit nunc. Pellen-tesque id eros venenatis, sollicitudin neque
                            sodales, vehicula nibh. Nam massa odio, portti-tor vitae efficitur non. </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="how-item">
                        <div class="hi-icon">
                            <img src="img/icons/smartphone.png" alt="">
                        </div>
                        <h4>Download Music</h4>
                        <p>Ablandit nunc. Pellentesque id eros venenatis, sollicitudin neque sodales, vehicula nibh. Nam
                            massa odio, porttitor vitae efficitur non, ultric-ies volutpat tellus. </p>
                    </div>
                </div>
            </div>
        </div>-->
    </section>
    <!-- How section end -->

    <!-- Concept section -->
    <section class="concept-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h2>Buku di VANNPERPUS</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p>Beberapa buku yang terdapat di VANNPERPUS adalah seperti dibawah ini. </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="concept-item">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/onepiece.jpg" alt="">
                        <h5>One Piece</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="concept-item">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/jujutsukaisen.jpg" alt="">
                        <h5>Jujutsu Kaisen</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="concept-item">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/ancika.jpg" alt="">
                        <h5>Ancika Dia Yang Bersamaku 1995</h5>
                    </div>
                </div>
                <div class=" col-lg-3 col-sm-6">
                    <div class="concept-item">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/matahari.jpg" alt="">
                        <h5>Bulan</h5>
                    </div>
                </div>
                <div class=" col-lg-3 col-sm-6">
                    <div class="concept-item">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/kamusinggris.jpg" alt="">
                        <h5>Kamus Inggris Indonesia</h5>
                    </div>
                </div>
                <div class=" col-lg-3 col-sm-6">
                    <div class="concept-item">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/tgre.jpg" alt="">
                        <h5>Tokyo Ghoul :re</h5>
                    </div>
                </div>
                <div class=" col-lg-3 col-sm-6">
                    <div class="concept-item">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/soekarno.jpg" alt="">
                        <h5>Biografi Soekarno</h5>
                    </div>
                </div>
                <div class=" col-lg-3 col-sm-6">
                    <div class="concept-item">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/aot.jpg" alt="">
                        <h5>Attack on Titan</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Concept section end -->

    <!-- Subscription section end -->


    <!-- Premium section end -->

    <!-- Footer section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 order-lg-2">
                    <div class="row">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 order-lg-1">
            </div>
        </div>
        </div>
    </footer>
    <!-- Footer section end -->

    <!--====== Javascripts & Jquery ======-->
    <script src="<?php echo base_url('assets/landing/'); ?>js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url('assets/landing/'); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/landing/'); ?>js/jquery.slicknav.min.js"></script>
    <script src="<?php echo base_url('assets/landing/'); ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('assets/landing/'); ?>js/mixitup.min.js"></script>
    <script src="<?php echo base_url('assets/landing/'); ?>js/main.js"></script>

</body>

</html>