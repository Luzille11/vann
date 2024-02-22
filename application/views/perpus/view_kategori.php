<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA KATEGORI</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <button type="button" class="btn btn-success " data-bs-toggle="modal"
                        data-bs-target="#tambahkategori">
                        <i class="nav-icon fas fa-plus"></i>
                        Tambah Data
                    </button>
                </div>
                <div class="mb-3"><?php echo $this->session->flashdata('msg'); ?></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($Kategori)) {
                            $no = 1;
                            foreach ($Kategori as $k) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $k->id_kategori; ?></td>
                                <td><?php echo $k->kategori; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editkategori_<?php echo $k->id_kategori; ?>">
                                        <i class="nav-icon fas fa-pen"></i>
                                        Edit</button>
                                    <a href="<?php echo site_url('Kategori/hapuskategori/'.$k->id_kategori)?>"
                                        onclick="return confirm('Apakah anda ingin menghapus data ?')"
                                        class="btn btn-danger">
                                        <i class="nav-icon fas fa-trash"></i>
                                        Hapus
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editkategori_<?php echo $k->id_kategori; ?>" tabindex="-1"
                                aria-labelledby="editkategorilabel aria-hidden=" true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kategori</h1>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="<?php echo site_url('Kategori/editkategori/' . $k->id_kategori) ?>"
                                                method="post" class="mx-3">
                                                <div class="">
                                                    <input type="text" name="id_kategori" class="form-control"
                                                        value="<?= $k->id_kategori; ?>" hidden>
                                                </div>
                                                <div class=" mb-3">
                                                    <label for="editNamaKategori" class="form-label">Nama
                                                        Kategori</label>
                                                    <input type="text" name="kategori" class="form-control"
                                                        value="<?= $k->kategori; ?>" required>
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
    <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="tambahkategorilabel aria-hidden=" true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kategori</h1>
                </div>
                <div class="modal-body">
                    <form action="<?php echo site_url('Kategori/tambahkategori') ?>" method="post" class="mx-3">
                        <div class="mb-3">
                            <label for="inputIDKategori" class="form-label">ID Kategori</label>
                            <input type="text" name="id_kategori" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputNamaKategori" class="form-label">Nama Kategori</label>
                            <input type="text" name="kategori" class="form-control" required>
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
          