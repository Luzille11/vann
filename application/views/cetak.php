<h2 align="center">Laporan Peminjaman Buku </h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Tangggal Kembalikan</th>
            <th>Denda</th>
        </tr>
    </thead>
    <tbody>
        <?php
                        if(!empty($Laporan)) {
                        $no = 1;
                        foreach ($Laporan as $l) { 
                            $tanggal_pengembalian = new DateTime($l->tanggal_pengembalian);
                            $tanggal_sekarang = new DateTime();
                            $selisih = $tanggal_sekarang->diff($tanggal_pengembalian)->format("%a");
                            $fine_amount = 0; // Default value if not overdue
                            if ($tanggal_pengembalian < $tanggal_sekarang && $selisih > 0) {
                                $fine_amount = $selisih * 2500; // Rp 2,500 per day
                            }
                        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $l->nama; ?></td>
            <td><?php echo $l->judul; ?></td>
            <td><?php echo $l->tanggal_peminjaman; ?></td>
            <td><?php echo $l->tanggal_pengembalian; ?></td>
            <td><?php echo $l->tanggal_kembalikan; ?></td>
            <td>Rp <?php echo number_format($fine_amount, 0, ',', '.'); ?></td>
        </tr>
        <?php 
                        $no++;}
                    } ?>
    </tbody>
</table>
<script>
window.print();
setTimeout(function() {
    window.close();
}, 100);
</script>