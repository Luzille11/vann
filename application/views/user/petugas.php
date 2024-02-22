<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA PETUGAS</h1>
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
                        data-bs-target="#tambahpetugas">
                        <i class="nav-icon fas fa-plus"></i>
                        Tambah Data
                    </button>
                </div>
                <div class="mb-3"><?php echo $this->session->flashdata('msg'); ?></div>
                <table class="table table-bordered" id="example1" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($Petugas)) {
                        $no = 1;
                        foreach ($Petugas as $p) { 
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $p->nama; ?></td>
                            <td><?php echo $p->username; ?></td>
                            <td><?php echo str_repeat('*', strlen($p->password)); ?></td>
                            <td><?php echo $p->email; ?></td>
                            <td><?php echo $p->alamat; ?></td>
                            <td><?php echo $p->no_telp; ?></td>
                            <td><?php echo $p->level; ?></td>
                            <td>
                                <button type=" button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editpetugas_<?php echo $p->id_user; ?>">
                                    <i class="nav-icon fas fa-pen"></i>
                                    Edit</button>
                                <a href="<?php echo site_url('User/hapusPetugas/'.$p->id_user)?>"
                                    onclick="return confirm('Apakah anda ingin menghapus data ?')"
                                    class="btn btn-danger">
                                    <i class="nav-icon fas fa-trash"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editpetugas_<?php echo $p->id_user; ?>" tabindex="-1"
                            aria-labelledby="tambahkategorilabel aria-hidden=" true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kategori</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo site_url('User/updatePetugas/'. $p->id_user) ?>"
                                            method="post" class="mx-3">
                                            <div class="mb-3">
                                                <input type="text" name="id_user" class="form-control" id="inputBuku"
                                                    value="<?= $p->id_user; ?>" hidden>
                                            </div>
                                            <div class=" mb-3">
                                                <label for="inputJudul" class="form-label">Nama</label>
                                                <input type="text" name="nama" class="form-control" id="inputjudul"
                                                    value="<?= $p->nama; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPenulis" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control"
                                                    id="inputpenulis" value="<?= $p->username; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPenerbit" class="form-label">Password</label>
                                                <input type="text" name="password" class="form-control"
                                                    id="inputpenerbit" value="<?= $p->password; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputtahun" class="form-label">Email</label>
                                                <input type="text" name="email" class="form-control"
                                                    id="inputtahun_terbit " value="<?= $p->email; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputDeskripsi" class="form-label">Alamat</label>
                                                <div class="form-floating">
                                                    <textarea class="form-control" rows="5" name="alamat"
                                                        id="inputDeskripsi" required><?= $p->alamat; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inputPenerbit" class="form-label">No Telepon</label>
                                                <input type="text" name="no_telp" class="form-control"
                                                    id="inputpenerbit" value="<?= $p->no_telp; ?>" required>
                                            </div>
                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary">Simpan</button>
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
        <div class="modal fade" id="tambahpetugas" tabindex="-1" aria-labelledby="tambahkategorilabel aria-hidden="
            true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kategori</h1>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo site_url('User/tambahpetugas') ?>" method="post" class="mx-3">
                            <div class="mb-3">
                                <input type="text" name="id_user" class="form-control" id="inputBuku" hidden>
                            </div>
                            <div class=" mb-3">
                                <label for="inputJudul" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="inputjudul" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputPenulis" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="inputpenulis" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputPenerbit" class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" id="inputpenerbit" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputtahun" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="inputtahun_terbit " required>
                            </div>
                            <div class="mb-3">
                                <label for="inputDeskripsi" class="form-label">Alamat</label>
                                <div class="form-floating">
                                    <textarea class="form-control" rows="5" name="alamat" id="inputDeskripsi"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inputPenerbit" class="form-label">No Telepon</label>
                                <input type="text" name="no_telp" class="form-control" id="inputpenerbit" required>
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
    </div>
</div>

<script>
  $(function () {
    $("#example1").DataTable({
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
          