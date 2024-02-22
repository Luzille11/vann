<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DASHBOARD</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->
<style>
.grafik-container {
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
    height: 300px;
    background-color: #f0f0f0;
    padding: 20px;
}

.bar-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.bar {
    width: 30px;
    background-color: #3498db;
    margin-top: 10px;
    /* Margin for better spacing */
}

.label {
    text-align: center;
    margin-top: 5px;
    font-size: 12px;
    color: #555;
}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <div>
                <i class="nav-icon fas fa-user"></i>
                Selamat Datang <b><?php echo $this->session->userdata('nama'); ?> </b> Sebagai
                <b><?php echo Ucwords($this->session->userdata('level')); ?></b>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <!-- /.col -->
            <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas') { ?>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Buku</span>
                        <span class="info-box-number"><?php echo $jmlbuku; ?> Buku</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total User</span>
                        <span class="info-box-number"><?php echo $jmluser; ?> User</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-table"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Buku yang Dipinjam</span>
                        <span class="info-box-number">
                            <?php echo $jmlpeminjaman; ?> Buku
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-paper-plane"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Buku Dikembalikan</span>
                        <span class="info-box-number"><?php echo $jmlpengembalian; ?> Buku</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 ">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h2>Grafik Peminjaman Per Bulan</h2>

                            <canvas id="grafikPeminjaman" width="1100" height="400"></canvas>

                            <script>
                            var dataPeminjaman = <?php echo $dataPeminjaman; ?>;
                            var ctx = document.getElementById('grafikPeminjaman').getContext('2d');

                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: dataPeminjaman.map(item => item.bulan),
                                    datasets: [{
                                        label: 'Total Peminjaman',
                                        data: dataPeminjaman.map(item => item.jumlah_peminjaman),
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <?php if ($this->session->userdata('level') == 'peminjam') { ?>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example1" width="100%"
                                    cellspacing="0">
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Cover</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                    <tbody>
                                        <?php
                                    if(!empty($buku)) {
                                    $no = 1;
                                    foreach ($buku as $b) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $b->kategori; ?></td>
                                            <td>
                                                <!-- Menampilkan gambar dengan tag <img> -->
                                                <?php
                                                $gambar_url = base_url('assets/dist/img/') . $b->gambar;
                                                ?>
                                                <img src="<?php echo $gambar_url; ?>"
                                                    alt="Cover <?php echo $b->judul; ?>" style="height: 150px;"
                                                    width="100">
                                            </td>
                                            <td><?php echo $b->judul; ?></td>
                                            <td><?php echo $b->penulis; ?></td>
                                            <td><?php echo $b->penerbit; ?></td>
                                            <td><?php echo $b->tahun_terbit; ?></td>
                                            <td><?php echo $b->deskripsi; ?></td>
                                            <!--<td>
                                            <button type="button" class="btn btn-success " data-bs-toggle="modal"
                                                data-bs-target="#tambahpeminjaman_<?php echo $b->id_buku; ?>">
                                                <i class="nav-icon fas fa-plus"></i>
                                                Pinjam
                                            </button>
                                        </td>-->
                                        </tr>
                                        <?php    
                                    $tanggal_peminjaman = date('Y-m-d');
                                    $tujuh_hari = mktime(0,0,0,date("n"),date("j") + 7, date("Y"));
                                    $tanggal_pengembalian = date('Y-m-d', $tujuh_hari);
                                    ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="tambahpeminjaman_<?php echo $b->id_buku; ?>"
                                            tabindex="-1" aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data
                                                            Peminjaman
                                                        </h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="<?php echo site_url('Peminjaman/tambahPeminjaman/' . $b->id_buku) ?>"
                                                            method="post" class="mx-3">
                                                            <div class="mb-3">
                                                                <!--<label for="inputIDPeminjaman" class="form-label">ID Peminjaman</label>
                                                            <input type="text" name="id_peminjaman" class="form-control" id="inputIDUlasan" hidden>-->
                                                            </div>
                                                            <!--<div class="mb-3">
                                                            <label for="inputUser" class="form-label">User</label>
                                                            <select name="user" class="form-control" readonly required>
                                                            <?php foreach ($user as $u) { ?>
                                                            <?php if ($u->id_user == $this->session->userdata('id_user')) { ?>
                                                            <option value="<?php echo $u->id_user; ?>" selected>
                                                        <?php echo $u->nama; ?>
                                                        </option>
                                                        <?php } ?>
                                                        <?php } ?>
                                                        </select>
                                                        </div>-->
                                                            <div class="mb-3">
                                                                <label for="inputBuku" class="form-label">Buku</label>
                                                                <input type="text" name="judul"
                                                                    value="<?= $b->judul; ?>" class="form-control"
                                                                    readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="inputTanggalPeminjaman"
                                                                    class="form-label">Tanggal
                                                                    Peminjaman</label>
                                                                <input type="date" name="tanggal_peminjaman"
                                                                    value="<?= $tanggal_peminjaman; ?>"
                                                                    class="form-control" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="inputTanggalPengembalian"
                                                                    class="form-label">Tanggal
                                                                    Pengembalian</label>
                                                                <input type="date" name="tanggal_pengembalian"
                                                                    value="<?= $tanggal_pengembalian; ?>"
                                                                    class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                    <div class=" modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                    $no++;}
                                    } ?>
                                    </tbody>
                                </table>
                                <!--AOT-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/aot.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukuaot">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukuaot" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Touge Anki</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/aot.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Komik</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Attack On
                                                                            Titan</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Hajime
                                                                            Isayama</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Elex Media
                                                                            Komputindo</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2021</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Attack On Titan adalah serial komik manga Jepang yang ditulis dan diilustrasikan oleh Hajime Isayama. Komik Attack On Titan ini mulanya menceritakan dunia di mana umat manusia dipaksa untuk hidup di kota-kota yang dikelilingi oleh tiga tembok besar yang melindungi mereka dari humanoid, pemakan manusia raksasa yang disebut sebagai Titans.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--AOT-->

                                <!--One Piece-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/onepiece.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukuop">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukuop" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-One Piece</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/onepiece.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Komik</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>One Piece
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Eichiro
                                                                            Oda</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Elex Media
                                                                            Komputindo</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2023</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>One Piece merupakan karya fiksi Eiichiro Oda yang bercerita tentang seorang remaja Luffy yang ingin mewujudkan cita-citanya untuk mengarungi lautan dan menjadi seorang raja bajak laut.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--One Piece-->

                                <!--Jujutsu Kaisen-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/jujutsukaisen.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukujjs">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukujjs" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Jujutsu Kaisen
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/jujutsukaisen.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Komik</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Jujutsu Kaisen
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Gege
                                                                            Akutami</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Elex Media
                                                                            Komputindo</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2021</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Jujutsu Kaisen dalah sebuah seri manga shōnen asal Jepang yang ditulis dan diilustrasikan oleh Gege Akutami. Manga ini dimuat berseri dalam majalah Weekly Shōnen Jump terbitan Shueisha sejak Maret 2018, dan telah diterbitkan menjadi dua puluh lima volume tankōbon per Januari 2024.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Jujutsu Kaisen-->

                                <!--Tokyo Ghoul Re -->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/tgre.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukutg">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukutg" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Tokyo Ghoul Re</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/tgre.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Komik</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Tokyo Ghoul Re
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Sui
                                                                            Ishida</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>M&C!</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2022</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Serial sekuel Tokyo Ghoul: re menceritakan tentang Kaneki yang amnesia dengan identitas baru Haise Sasaki, pemimpin tim khusus penyidik CCG disebut "Quinx Squad", yang menjalani prosedur yang sama seperti Kaneki, yang memungkinkan mereka untuk mendapatkan kemampuan khusus dari ghoul di CCG untuk melawan mereka, tapi masih bisa hidup sebagai manusia normal karena RC Sell mereka yang kurang lebih masih seperti manusia normal.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Tokyo Ghoul-->

                                <!--Bumi-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/bumi.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukubm">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukubm" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Bumi</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/bumi.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Novel</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Bumi
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Tere Liye
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Gramedia
                                                                            Pustaka Utama</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2022</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Bumi adalah sebuah novel karya Tere Liye. Novel ini merupakan buku pertama dari serial Bumi atau Dunia Paralel dan diterbitkan pertama kali oleh Gramedia Pustaka Utama tahun 2014.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Bumi-->

                                <!--Bulan-->
                                <!---div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/bulan.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukubln">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukubln" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Bulan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/bulan.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Novel</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Bulan
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Tere Liye
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Gramedia
                                                                            Pustaka Utama</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2022</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Bulan adalah sebuah novel karya Tere Liye, novel ini adalah buku kedua dari seri Bumi/serial Dunia Paralel. Diterbitkan pertama kali oleh Gramedia Pustaka Utama tahun 2015.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Bulan-->

                                <!--Matahari-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/matahari.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukumth">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukumth" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Matahari</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/matahari.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Novel</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Matahari
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Tere Liye
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Gramedia
                                                                            Pustaka Utama</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2022</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Matahari adalah sebuah novel karya Tere Liye, novel ini adalah buku ketiga dari seri Bumi/serial Dunia Paralel. Diterbitkan pertama kali oleh Gramedia Pustaka Utama tahun 2016.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Matahari-->

                                <!--Kamus InggrisIndonesia-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/kamusinggris.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukukmsig">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukukmsig" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Kamus Inggris Indonesia
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/kamusinggris.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Kamus</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Kamus Inggris
                                                                            Indonesia
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>John M. Echols
                                                                            & Hassan Shadily
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Gramedia
                                                                            Pustaka Utama</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2012</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Kamus Indoneenglish adalah kamus dwibahasa yang diterbitkan aslinya oleh Cornell University Press dan kemudian diterbitkan di Indonesia oleh Gramedia Pustaka Utama yang disusun oleh ahli bahasa dari Amerika Serikat yang bernama John M. Echols, dan ahli bahasa dari Indonesia yang bernama Hassan Shadily.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Kamus InggrisIndonesia-->

                                <!--Solo Leveling-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/solev3.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukusl">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukusl" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Solo Leveling</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/solev3.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Komik</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Solo Leveling
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Chugong
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>M&C!
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2024</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>SOLO LEVELING merupakan web novel karya Chugong yang diserialkan menjadi manhwa di KakaoPage pada Maret 2018. Ilustrasi dari manhwa ini dilakukan oleh Jang Sung Rak atau DUBU, CEO dari Redice Studio. Manhwa SOLO LEVELING memiliki 179 chapter yang selesai pada Desember 2021.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Solo Leveling-->

                                <!--Atlas Indonesia & dunia-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/dino.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukudino">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukudino" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Pintar Pertamaku
                                                                Dinosaurus
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/dino.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Ensiklopedia</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Pintar
                                                                            Pertamaku Dinosaurus
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Claudia Martin
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Bhuana Ilmu
                                                                            Populer</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2022</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Ensiklopedia pengetahuan pertama tentang dinosaurus ini memiliki beragam konten yang membahas berbagai jenis dan keistimewaan dinosaurus. Dalam buku ini, anak dapat mempelajari berbagai topik meliputi, zaman dinosaurus, dinosaurus karnivor dan herbivor, serta berbagai jenis reptilia. Buku ini dilengkapi dengan ilustrasi yang luar biasa, disertai ilmu dari para ahli dan fakta-fakta menakjubkan untuk anak-anak.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Atlas Indonesia & dunia-->

                                <!--Biografi Soekarno-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/soekarno.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukuse">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukuse" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Biografi Soekarno
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/soekarno.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Biografi</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Biografi
                                                                            Soekarno
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Taufik Adi
                                                                            Susilo
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>
                                                                            Garasi Buku</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2020</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Buku ini berisi biografi singkat Soekarno dari tahun 1901-1970. Buku ini menceritakan bagaimana perjalanan kehidupan seorang Soekarno.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Biografi Soekarno-->

                                <!--Biografi Mohammad Hatta-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/mohatta.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukumh">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukumh" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Biografi Mohammad
                                                                Hatta
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/mohatta.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Biografi</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Biografi
                                                                            Mohammad Hatta
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Salman
                                                                            Alfarizi
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>
                                                                            Garasi Buku</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2020</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Buku ini merupakan biografi singkat Mohammad Hatta, seorang Proklamator Kemerdekaan Republik Indonesia, sosok pribadi yang jujur, sederhana dan intelektual serta berkomitmen yang tinggi terhadap kemerdekaan bangsa ini. Buku ini sangat signifikan sehingga penggugah semangat kita untuk berkarya demi bangsa dan negara ini.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Biografi Mohammad Hatta-->

                                <!--Ragna Crimson-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/ragna.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukurg">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukurg" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Ragna Crimson</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/ragna.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Komik</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Ragna Crimson
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Chugong
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>M&C!
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2022</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Ragna Crimson (Jepang: ラグナクリムゾン, Hepburn: Raguna Kurimuzon) adalah sebuah seri manga Jepang yang ditulis dan diilustrasikan oleh Daiki Kobayashi. Manga ini telah diserialkan di majalah Monthly Gangan Joker milik Square Enix sejak Maret 2017, dengan bab-babnya dikumpulkan menjadi tiga belas volume tankōbon hingga November 2023.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Ragna Crimson-->

                                <!--Ancika : Dia Yang Bersamaku 1995-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/ancika.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukuack">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukuack" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Ancika : Dia Yang
                                                                Bersamaku 1995</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/ancika.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Novel</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Ancika : Dia
                                                                            Yang Bersamaku 1995
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Pidi Baiq
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Pastel
                                                                            Books</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2021</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Ancika: Dia Yang Bersamaku Tahun 1995 menceritakan tentang persahabatan antara Dilan dan Ancika Mehrunisa Rabu. Hubungan mereka yang semakin dekat membuat benih-benih cinta tumbuh dan hubungan mereka pun naik tingkat menjadi hubungan sepasang kekasih.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Ancika : Dia Yang Bersamaku 1995-->

                                <!--Dilan : Dia Adalah Dilanku Tahun 1990-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/dln.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukudln">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukudln" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Dilan : Dia
                                                                Adalah Dilanku Tahun 1990</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/dln.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Novel</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Dilan : Dia
                                                                            Adalah Dilanku Tahun 1990
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Pidi Baiq
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Pastel
                                                                            Books</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2016</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Dilan: Dia adalah Dilanku tahun 1990 adalah sebuah novel karya Pidi Baiq yang diterbitkan oleh Penerbit Pastel Books. Novel tersebut menjadi buku dengan penjualan terbaik di Gramedia, serta diadaptasi ke dalam sebuah film yang berjudul Dilan 1990.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Dilan : Dia Adalah Dilanku Tahun 1990-->

                                <!--Dilan Bagian Kedua: Dia Adalah Dilanku Tahun 1991-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/dln2.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukudln2">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukudln2" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Dilan Bagian Kedua: Dia
                                                                Adalah Dilanku Tahun 1991</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/dln2.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Novel</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Dilan Bagian
                                                                            Kedua: Dia Adalah Dilanku Tahun 1991
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Pidi Baiq
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Pastel
                                                                            Books</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2017</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Dilan Bagian Kedua: Dia adalah Dilanku Tahun 1991 adalah novel sekuel dari Dilan: Dia adalah Dilanku Tahun 1990 yang ditulis oleh Pidi Baiq dan terbit tahun 2015. Novel Dilan 2 diterbitkan oleh Penerbit Pastel Books. Novel ini berisi tentang romansa remaja di Kota Bandung tahun 1991.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Dilan Bagian Kedua: Dia Adalah Dilanku Tahun 1991-->

                                <!--Bobo 44-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/bb44.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukubb44">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukubb44" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Bobo 44 (Edisi 01
                                                                Februari 2024)</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/bb44.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Majalah</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Bobo 44 (Edisi
                                                                            01 Februari 2024)
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>PK Ojong dan
                                                                            Jakob Oetama
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Majalah
                                                                            Gramadia</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2024</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Bobo 44 (Edisi 01 Februari 2024)</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Bobo 44-->

                                <!--Regarding Reincarnated to Slime-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/tensura.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukutensura">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukutensura" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Regarding Reincarnated
                                                                to Slime</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/tensura.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Komik</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Regarding
                                                                            Reincarnated to Slime</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Fuse dan Mitz
                                                                            Vah</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Elex Media
                                                                            Komputindo</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2023</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Tensei Shitara Slime Datta Ken (Jepang: 転生したらスライムだった件), juga dikenal sebagai TenSura (Jepang: 転スラ, Hepburn: Tensura)[3] atau Slime Isekai,[3] yang diterbitkan di Indonesia dengan judul Regarding Reincarnated to Slime oleh Elex Media Komputindo,[4] adalah sebuah seri novel ringan Jepang bergenre fantasi yang ditulis oleh Fuse dan diilustrasikan oleh Mitz Vah.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Regarding Reincarnated to Slime-->

                                <!--Atlas-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/atlas2.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukuatl">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukuatl" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Pintar Pertamaku
                                                                Dinosaurus
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/atlas2.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Ensiklopedia</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Atlas Indonesia
                                                                            & Dunia
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Tim Bintang
                                                                            Indonesia
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Bintang
                                                                            Indonesia</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2015</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Atlas adalah kumpulan peta yang disatukan dalam bentuk buku, tetapi juga ditemukan dalam bentuk multimedia. Atlas dapat memuat informasi geografi, batas negara, statisik geopolitik, sosial, agama, dan ekonomi.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Atlas-->

                                <!--Biografi Gus Dur-->
                                <!--<div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-secondary mb-3">
                                    <div class="card-body" class="container-fluid">
                                        <div class="card-content">
                                            <div>
                                                <img src="<?php echo base_url(); ?>assets/dist/img/gusdur.jpg"
                                                    alt="Deskripsi Gambar" width="100%">
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#detailbukugusdur">
                                                <i class="nav-icon fas fa-info-circle"></i>
                                                Detail
                                            </button>
                                            <div class="modal fade" id="detailbukugusdur" tabindex="-1"
                                                aria-labelledby="tambahkategorilabel aria-hidden=" true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Buku-Biografi Gus Dur
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="card" style="width: 16rem;">
                                                                    <img src="<?php echo base_url(); ?>assets/dist/img/gusdur.jpg"
                                                                        class="card-img-fluid" alt="...">
                                                                </div>
                                                                <form>
                                                                    <div class="col-md col-mb-5" style="width: 23rem;">
                                                                        <label class=" form-label">Kategori
                                                                        </label>
                                                                        <text class="form-control" rows="1"
                                                                            name="kategori" id="inputDeskripsi"
                                                                            readonly>Biografi</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Judul</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Biografi
                                                                            Gus Dur
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penulis</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>Muhammad Rifai
                                                                        </text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Penerbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>
                                                                            Garasi Buku</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Tahun
                                                                            Terbit</label>
                                                                        <text class="form-control" rows="1" name="judul"
                                                                            id="inputDeskripsi" readonly>2020</text>
                                                                    </div>
                                                                    <div class="col-md col-mb-5">
                                                                        <label class="form-label">Deskripsi</label>
                                                                        <textarea class="form-control" rows="5"
                                                                            name="judul" id="inputDeskripsi"
                                                                            readonly>Abdurrahman Wahid, yang akrab dipanggil Gus Dur, adalah pejuang sejati demokrasi, bapak pluralisme, tokoh antikekerasan, pembela orang-orang termarginalkan yang papa suara. Gus Dur sekaligus adalah pelindung bagi kaum minoritas agama, gender, keyakinan, etnis, ras, dan juga posisi sosial. Kendati demikian, Gus Dur tetap dihujat kelompok mayoritas dan bahkan kalangannya sendiri.</textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="<?php echo site_url('Peminjaman/peminjaman')?>"
                                                                class="btn btn-success">
                                                                Pinjam
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Biografi Gus Dur-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>     
        </div>


</section>