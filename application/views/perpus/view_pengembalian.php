<?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA PENGEMBALIAN</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->
<?php } ?>
<?php if ($this->session->userdata('level') == 'peminjam' ){ ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">History Peminjaman</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->
<?php } ?>
<style>
.btn-export{
    margin-left : -80px;
}
</style>
<style>
.tanggalAkhir{
    margin-left : -80px;
}
</style>
<style>
        /* Gaya umum yang akan ditampilkan di layar */
        .content {
            background-color: #f0f0f0;
            padding: 20px;
        }

        /* Gaya khusus untuk mencetak */
        @media print {
            /* Sembunyikan elemen yang tidak ingin dicetak */
            .no-print {
                display: none;
            }

            /* Gaya tambahan khusus saat mencetak */
            body {
                background-color: white;
            }

            .content {
                background-color: white;
                padding: 10px;
            }
        }
    </style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
                <div class="row">
                    <div class="col-md-2">
                        <div class="col-mb-2">
                            <a href="<?php echo site_url('Laporan/cetak') ?>" target="_blank"  class="btn btn-primary">
                                <i class="fa fa-print"></i>
                                Cetak
                            </a>
                        </div>
                    </div>
                    <div class="col-mb-3">
                        <a href="<?php echo site_url('Excel/export') ?>" target="_blank" class="btn btn-success btn-export">
                            <i class="fa fa-download"></i>
                            Export Excel
                        </a>
                    </div>
                </div>
                <br>
                <!--<form action="<?php echo site_url('Laporan/metode_filter');?>" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="tanggalAwal" class="tanggalAwal" id="tanggalAwal"
                            onfocus="(this.type='date')" placeholder="Tanggal Awal" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="tanggalAkhir" id="tanggalAkhir"
                            onfocus="(this.type='date')" placeholder="Tanggal Akhir" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Filter</button>               
                        <button type="button" class="btn btn-secondary" onclick="printWithFilter()">Cetak dengan Filter</button>
                        </div>
                </div>
                </form>-->
                <?php } ?> 
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" class="display" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Tanggal di Kembalikan</th>
                                <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
                                <th>Denda</th>
                                <?php } ?> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($Pengembalian)) {
                        $no = 1;
                        foreach ($Pengembalian as $p) { 
                            $tanggal_pengembalian = new DateTime($p->tanggal_pengembalian);
                            $tanggal_kembali = new DateTime($p->tanggal_kembalikan);

                        // Periksa apakah pengembalian dilakukan lebih lambat dari tanggal pengembalian
                        if ($tanggal_kembali > $tanggal_pengembalian) {
                        $selisih = $tanggal_kembali->diff($tanggal_pengembalian)->format("%a");
                        $fine_amount = $selisih * 2500; // Rp 2,500 per day
                        } else {
                        $fine_amount = 0; // Tidak ada denda jika pengembalian tepat waktu
                        }
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $p->nama; ?></td>
                                <td><?php echo $p->judul; ?></td>
                                <td><?php echo $p->tanggal_peminjaman; ?></td>
                                <td><?php echo $p->tanggal_pengembalian; ?></td>
                                <td><?php echo $p->tanggal_kembalikan; ?></td>
                                <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
                                <td><?php echo 'Rp ' . number_format($fine_amount, 0, ',', '.'); ?></td>
                                <?php } ?>
                            </tr>
                            <?php
                        $no++;
                       }
}?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  $(function () {
    $("#dataTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

          