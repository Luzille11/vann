    <!-- Gaya khusus cetak -->
    <style>
        /* Gaya cetak */
        @media print {
            body {
                font-family: Arial, sans-serif;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }
        }
    </style>
</head>
<body>
    <h2 align="center">Laporan Peminjaman Buku</h2>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Tanggal Kembalikan</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            
        <?php
                        if (!empty($Laporan)) {
                            $no = 1;
                            foreach ($Laporan as $p) { 
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
                            <td><?php echo 'Rp ' . number_format($fine_amount, 0, ',', '.'); ?></td>
                        </tr>
                        <?php
                        $no++;}
                        }?>
        </tbody>
    </table>
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
                        <a href="<?php echo site_url('Laporan/cetak') ?>" target="_blank"  class="btn btn-primary">
                                <i class="fa fa-print"></i>
                                Cetak
                            </a>                        </div>
                </div>
                </form>-->
<script>
window.print();
setTimeout(function() {
    window.close();
}, 100);
</script>


