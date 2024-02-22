<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA PENGEMBALIAN</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1">
                        <div class="col-mb-3">
                            <a href="<?php echo site_url('Laporan/cetak') ?>" target="_blank" class="btn btn-primary">
                                <i class="fa fa-print"></i>
                                Cetak
                            </a>
                        </div>
                    </div>
                    <div class="col-mb-3">
                        <a href="<?php echo site_url('Excel/export') ?>" target="_blank" class="btn btn-success">
                            <i class="fa fa-download"></i>
                            Export Excel
                        </a>
                    </div>
                </div>
                <br>
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
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($Pengembalian)) {
                            $no = 1;
                            foreach ($Pengembalian as $p) { 
                                $tanggal_pengembalian = new DateTime($p->tanggal_pengembalian);
                                $tanggal_sekarang = new DateTime();
                                $selisih = $tanggal_sekarang->diff($tanggal_pengembalian)->format("%a");
    
                                $fine_amount = 0; // Default value if not overdue
                                if ($tanggal_pengembalian < $tanggal_sekarang && $selisih > 0) {
                                    $fine_amount = $selisih * 2500; // Rp 2,500 per day
                                }
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $p->nama; ?></td>
                                <td><?php echo $p->judul; ?></td>
                                <td><?php echo $p->tanggal_peminjaman; ?></td>
                                <td><?php echo $p->tanggal_pengembalian; ?></td>
                                <td><?php echo $p->tanggal_kembalikan; ?></td>
                                <td>Rp <?php echo number_format($fine_amount, 0, ',', '.'); ?></td>
                            </tr>
                            <?php 
                            $no++;}
                        } ?>
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
          