<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA Rak</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#tambahrak">
                        <i class="nav-icon fas fa-plus"></i>
                        Tambah Data
                    </button>
                </div>
                <br>
                    <!-- Tampilan Anda -->
                    <div class="mb-3"><?php echo $this->session->flashdata('msg'); ?></div>
                    <script>
                    // Tunggu selama 3 detik setelah halaman dimuat
                    setTimeout(function() {
                    // Sembunyikan pesan alert dengan menghapus elemen
                    document.querySelector('.alert').style.display = 'none';
                    }, 3000);
                    </script>                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Rak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($Rak)) {
                            $no = 1;
                            foreach ($Rak as $k) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $k->rak; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editrak_<?php echo $k->id_rak; ?>">
                                        <i class="nav-icon fas fa-pen"></i>
                                        </button>
                                    <a href="<?php echo site_url('Rak/hapusrak/'.$k->id_rak)?>"
                                        onclick="return confirm('Apakah anda ingin menghapus data ?')"
                                        class="btn btn-danger">
                                        <i class="nav-icon fas fa-trash"></i>
                                        
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editrak_<?php echo $k->id_rak; ?>" tabindex="-1"
                                aria-labelledby="editraklabel aria-hidden=" true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data rak</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo site_url('Rak/editrak/' . $k->id_rak) ?>"
                                                method="post" class="mx-3">
                                                <div class="">
                                                    <input type="text" name="id_rak" class="form-control"
                                                        value="<?= $k->id_rak; ?>" hidden>
                                                </div>
                                                <div class=" mb-3">
                                                    <label for="editNamarak" class="form-label">Nama
                                                        rak</label>
                                                    <input type="text" name="rak" class="form-control"
                                                        value="<?= $k->rak; ?>" required>
                                                </div>
                                        </div>
                                        <div class=" modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        </form>
                                        <div id="pesan" class="alert" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>

                            <?php 
                            $no++;}
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahrak" tabindex="-1" aria-labelledby="tambahraklabel aria-hidden=" true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data rak</h1>
                </div>
                <div class="modal-body">
                    <form action="<?php echo site_url('Rak/tambahrak') ?>" method="post" class="mx-3">
                        <div class="mb-3">
                            <input type="text" name="id_rak" class="form-control" hidden>
                        </div>
                        <div class="mb-3">
                            <label for="inputNamarak" class="form-label">Nama rak</label>
                            <input type="text" name="rak" class="form-control" required>
                        </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
                <div id="pesan" class="alert" style="display: none;"></div>
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
          