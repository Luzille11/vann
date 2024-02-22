<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">LAPORAN PEMINJAMAN</h1>
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
                <!--<form action="<?php echo site_url('Laporan/metode_filter');?>" method="post">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="tanggalAwal" id="tanggalAwal"
                                onfocus="(this.type='date')" placeholder="Tanggal Awal" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="tanggalAkhir" id="tanggalAkhir"
                                onfocus="(this.type='date')" placeholder="Tanggal Akhir" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                    </form>
                    <br>-->
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($Laporan)) {
                            $no = 1;
                            foreach ($Laporan as $l) { 
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $l->nama; ?></td>
                                <td><?php echo $l->judul; ?></td>
                                <td><?php echo $l->tanggal_peminjaman; ?></td>
                                <td><?php echo $l->tanggal_pengembalian; ?></td>
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