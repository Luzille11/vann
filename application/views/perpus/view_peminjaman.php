<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA PEMINJAMAN</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php if ($this->session->userdata('level') == 'peminjam'){ ?>
                <div>
                    <button type="button" class="btn btn-success " data-bs-toggle="modal"
                        data-bs-target="#tambahpeminjaman">
                        <i class="nav-icon fas fa-plus"></i>
                        Tambah Data
                    </button>
                </div>
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
                                <th>Status Peminjaman</th>
                                <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
                                <th>Denda</th>
                                <th>Aksi</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($Peminjaman)) {
                            $no = 1;
                            foreach ($Peminjaman as $p) { 
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
                                <td><?php  echo date('Y-m-d', strtotime($p->tanggal_peminjaman)); ?>
                                </td>
                                <!--<td><?php echo date('Y-m-d ', strtotime('+7 days', strtotime($p->tanggal_peminjaman))); ?>-->
                                </td>
                                <td><?php echo date('Y-m-d', strtotime($p->tanggal_pengembalian)); ?>
                                </td>
                                <td>
                                    <?php 
                                    if ($tanggal_pengembalian >= $tanggal_sekarang OR $selisih == 0) {
                                        echo "<span class='badge badge-warning'>Belum di Kembalikan</span>";
                                    }else{
                                        echo "<span class='badge badge-danger'>Telat <b style = 'color:white;'>".$selisih."</b> Hari</span>";
                                    }
                                    ?>
                                </td>
                                <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas'){ ?>
                                <td>Rp <?php echo number_format($fine_amount, 0, ',', '.'); ?></td>
                                <td>
                                    <a href="<?php echo site_url('Peminjaman/kembalikan/'. $p->id_peminjaman) ?>"
                                        onclick="return confirm('Apakah anda yakin ingin Mengembalikan Buku ini?')"
                                        class=" btn btn-primary">
                                        <i class="nav-icon fas fa-paper-plane"></i>
                                        Kembalikan</a>
                                </td>
                                <!--<td>
                                    <a href="<?php echo site_url('Peminjaman/batalkan/'. $p->id_peminjaman) ?>"
                                        onclick="return confirm('Apakah anda yakin ingin Membatalkan Peminjaman Buku ini?')"
                                        class=" btn btn-danger">
                                        Batalkan</a>
                                </td>-->
                                <?php } ?>
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
    <?php    
$tanggal_peminjaman = date('Y-m-d');

$tujuh_hari = mktime(0,0,0,date("n"),date("j") + 7, date("Y"));
$tanggal_pengembalian = date('Y-m-d', $tujuh_hari);
?>


    <!-- Modal -->
    <div class="modal fade" id="tambahpeminjaman" tabindex="-1" aria-labelledby="tambahkategorilabel aria-hidden="
        true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data
                        Peminjaman
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="<?php echo site_url('Peminjaman/tambahPeminjaman') ?>" method="post" class="mx-3">
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
                            <select name="buku" id="id_buku" class="form-control" required>
                                <datalist id="bukuList">
                                <option value="">Pilih Buku</option>
                                    <?php foreach ($buku as $b) { ?>
                                <option value="<?php echo $b->id_buku; ?>">
                                    <?php echo $b->judul; ?>
                                </option>
                                <?php } ?>
                                <datalist id="bukuList">
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="inputTanggalPeminjaman" class="form-label">Tanggal
                                Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" value="<?= $tanggal_peminjaman; ?>"
                                class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="inputTanggalPengembalian" class="form-label">Tanggal
                                Pengembalian</label>
                            <input type="date" name="tanggal_pengembalian" value="<?= $tanggal_pengembalian; ?>"
                                class="form-control" readonly>
                        </div>
                    </form>
                </div>
                <script>
                $('#id_buku').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: '<?php echo site_url('Peminjaman/jumlah_buku'); ?>',
                        data: {
                            id: id
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(hasil) {
                            var jumlah = JSON.stringify(hasil.jumlah);
                            var jumlah1 = jumlah.split('"').join('');
                            if (jumlah1 <= 0) {
                                alert('Maaf, Stok untuk buku ini sedang kosong!');
                                location.reload();
                            }
                        }
                    });
                });
                </script>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
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




          