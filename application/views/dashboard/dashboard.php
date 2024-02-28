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

<style>
    .btn-refresh {
        margin-left: 10px;
    }
    .btn-cari {
        margin-left: 10px;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <div class="alert alert-secondary d-flex align-items-center" role="alert">
            <div>
                <i class="nav-icon fas fa-user"></i>
                Selamat Datang <b><?php echo $this->session->userdata('nama'); ?> </b> Sebagai
                <b><?php echo Ucwords($this->session->userdata('level')); ?></b>
            </div>
        </div>
        <!--<div class="card ">
            <div class="card-header text-white bg-secondary">
                Informasi Pengguna
            </div>
            <div class="card-body">
                Nama : <?php echo $this->session->userdata('nama'); ?>
                <br>
                Status : <?php echo Ucwords($this->session->userdata('level')); ?>
            </div>
        </div>-->
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
                            <h2>Grafik Pengembalian Per Bulan</h2>

                            <canvas id="grafikPengembalian" width="1100" height="400"></canvas>

                            <script>
                            var dataPengembalian = <?php echo $dataPengembalian; ?>;
                            var ctx = document.getElementById('grafikPengembalian').getContext('2d');

                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: dataPengembalian.map(item => item.bulan),
                                    datasets: [{
                                        label: 'Total Pengembalian',
                                        data: dataPengembalian.map(item => item.jumlah_pengembalian),
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
                                        backgroundColor: 'rgba(255, 0, 0, 0.2)', 
                                        borderColor: 'rgba(255, 0, 0, 1)',
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
                            <div class="col-md-12">
                            <div class="row">
                                <div class="search-form ml-auto">
                                    <form action="<?= base_url('Dashboard/pencarian'); ?>" method="get">
                                        <div class="row">
                                            <div class="col-mb-3">
                                                <input type="text" name="keyword" class="form-control" placeholder="Cari...">
                                            </div>
                                            <div class="col-mb-3">
                                                <button type="submit" class="btn btn-primary btn-cari">
                                                <i class="nav-icon fas fa-search"></i>
                                                    Cari
                                                </button>
                                            </div>
                                            <div class="col-mb-3">
                                                <button type="submit" class="btn btn-warning text-white btn-refresh" onclick="refreshPage()">
                                                <i class="nav-icon fas fa-retweet"></i>
                                                    Refresh
                                                </button>
                                            </div>
                                            <script>
                                            function refreshPage() {
                                                location.reload(true);
                                                    }
                                            </script>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                <br>
                                <div class="row">
    <?php
    if (!empty($buku)) {
        foreach ($buku as $b) {
    ?>
            <div class="col-md-3">
                <div class="card mb-3 text-truncate">
                    <img src="<?php echo base_url('assets/dist/img/') . $b->gambar; ?>" alt="Cover <?php echo $b->judul; ?>"
                        class="card-img-top" style="height: 400px;">
                        <div class="card-body">
                            <div>
                                <h6 class="card-title "><b><?php echo $b->judul; ?></b></h6>
                                <br>
                                <div class="row">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDetail<?php echo $b->id_buku; ?>">
                                        <i class="nav-icon fas fa-info-circle"></i>
                                            Detail
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                    <?php if ($b->jumlah > 0) : ?>
    <form action="<?php echo base_url('Peminjaman/tambahpeminjaman'); ?>" method="post">
        <input type="hidden" name="id_buku" value="<?php echo $b->id_buku; ?>">
        <button type="submit" class="btn btn-success" onclick="return confirm('Apakah anda ingin meminjam buku ini?')">
            <i class="nav-icon fas fa-"></i>
            Pinjam
        </button>
    </form>
<?php else : ?>
    <p class="btn btn-danger">Stok Kosong</p>
<?php endif; ?>
                                    </div>
                                </div>
                            </div>
</div>

<div class="col-md-3">
    <div class="card mb-3">
        <!-- ... (kode sebelumnya) ... -->
        <!-- Modal -->
        <div class="modal fade" id="modalDetail<?php echo $b->id_buku; ?>" tabindex="-1" role="dialog"
            aria-labelledby="modalDetailLabel<?php echo $b->id_buku; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailLabel<?php echo $b->id_buku; ?>"><?php echo $b->judul; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="inputIDKategori" class="form-label">Kategori</label>
                            <input type="text" name="judul" value="<?= $b->kategori; ?>" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="inputIDKategori" class="form-label">Penulis</label>
                            <input type="text" name="judul" value="<?= $b->penulis; ?>" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="inputIDKategori" class="form-label">Penerbit</label>
                            <input type="text" name="judul" value="<?= $b->penerbit; ?>" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="inputIDKategori" class="form-label">Tahun Terbit</label>
                            <input type="text" name="judul" value="<?= $b->tahun_terbit?>" class="form-control" readonly>
                        </div>
                        <div>
                            <label class="form-label">Deskripsi</label>
                                <div class="form-floating">
                                    <textarea class="form-control" rows="5" name="ulasan" value="" readonly><?php echo $b->deskripsi; ?></textarea>
                                </div>                       
                        </div>

                        <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
    <?php
        }
    } else {
        echo '<div class="col-md-12"><p>Tidak ada data buku.</p></div>';
    }
    ?>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
</section>
