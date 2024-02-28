<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA BUKU</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div>
                        <button type="button" class="btn btn-success " data-bs-toggle="modal"
                            data-bs-target="#tambahbuku">
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
                        <table class="table table-bordered table-hover" id="example1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Buku</th>
                                    <th>Kategori</th>
                                    <th>Rak</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($Buku)) {
                                    $no = 1;
                                    foreach ($Buku as $b) {
                                    ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $b->id_buku; ?></td>
                                    <td><?php echo $b->kategori; ?></td>
                                    <td><?php echo $b->rak; ?></td>
                                    <td>
                                        <!-- Menampilkan gambar dengan tag <img> -->
                                        <?php
                                        $gambar_url = base_url('assets/dist/img/') . $b->gambar;
                                        ?>
                                        <img src="<?php echo $gambar_url; ?>" alt="Cover <?php echo $b->judul; ?>"
                                            style="height: 100px;" width="100%">
                                    </td>
                                    <td><?php echo $b->judul; ?></td>
                                    <td><?php echo $b->penulis; ?></td>
                                    <td><?php echo $b->penerbit; ?></td>
                                    <td><?php echo $b->tahun_terbit; ?></td>
                                    <td><?php echo $b->jumlah; ?></td>
                                    <td>
                                        <button type=" button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editbuku_<?php echo $b->id_buku; ?>">
                                            <i class="nav-icon fas fa-pen"></i>
                                            </button>
                                        <a href="<?php echo site_url('Buku/hapusbuku/'.$b->id_buku)?>"
                                            onclick="return confirm('Apakah anda ingin menghapus data ?')"
                                            class="btn btn-danger">
                                            <i class="nav-icon fas fa-trash"></i>
                                            
                                        </a>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editbuku_<?php echo $b->id_buku; ?>" tabindex="-1"
                                    aria-labelledby="editkategorilabel" aria-hidden=" true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Buku</h1>
                                            </div>
                                            <div class="modal-body">
                                            <?php echo form_open_multipart('Buku/updatebuku', array('class' => 'mx-3')); ?>
                                                    <div class="">
                                                        <input type="text" name="id_buku" class="form-control"
                                                            value="<?= $b->id_buku; ?>" hidden>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editIDDetail" class="form-label">Nama
                                                            Kategori</label>
                                                        <select name="kategori" class="form-control" required>
                                                            <div class="mb-3">
                                                                <option value="">Pilih Kategori</option>
                                                                <?php foreach ($kategori as $k) { ?>
                                                                <option <?php if($b->id_kategori == $k->id_kategori) {echo "selected";
                                                                } ?> value="<?php echo $k->id_kategori; ?>">
                                                                    <?php echo $k->kategori; ?>
                                                                </option>
                                                                <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editIDDetail" class="form-label">
                                                            Rak</label>
                                                        <select name="rak" class="form-control" required>
                                                            <div class="mb-3">
                                                                <option value="">Pilih Rak</option>
                                                                <?php foreach ($rak as $r) { ?>
                                                                <option <?php if($b->id_rak == $r->id_rak) {echo "selected";
                                                                } ?> value="<?php echo $r->id_rak; ?>">
                                                                    <?php echo $r->rak; ?>
                                                                </option>
                                                                <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputJudul" class="form-label">Cover</label>
                                                            <input type="file" name="gambar" class="form-control-file" id="inputfile" accept="image/*">
                                                        <?php if ($b->gambar): ?>
                                                            <p>Current Image: <?= $b->gambar; ?></p>
                                                            <input type="hidden" name="gambar_lama" value="<?= $b->gambar; ?>">
                                                        <?php endif; ?>
                                                        </div>
                                                    <div class="mb-3">
                                                        <label for="editJudul" class="form-label">Judul</label>
                                                        <input type="text" name="judul" class="form-control"
                                                            value="<?= $b->judul; ?>" required>
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label for="editPenulis" class="form-label">Penulis</label>
                                                        <input type="text" name="penulis" class="form-control"
                                                            value="<?= $b->penulis; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editPenerbit" class="form-label">Penerbit</label>
                                                        <input type="text" name="penerbit" class="form-control"
                                                            value="<?= $b->penerbit; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edittahun" class="form-label">Tahun Terbit</label>
                                                        <input type="text" name="tahun_terbit" class="form-control"
                                                            value="<?= $b->tahun_terbit; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                                                        <div class="form-floating">
                                                            <textarea class="form-control" rows="5" name="deskripsi"
                                                                value="" required><?= $b->deskripsi; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editJudul" class="form-label">Jumlah</label>
                                                        <input type="text" name="jumlah" class="form-control"
                                                            value="<?= $b->jumlah; ?>" required>
                                                    </div>
                                                    <div class=" modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
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

        <div class="modal fade" id="tambahbuku" tabindex="-1" aria-labelledby="tambahkategorilabel aria-hidden=" true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Buku</h1>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('Buku/tambahbuku', array('class' => 'mx-3')); ?>
                        <div class="mb-3">
                            <label for="inputIDBuku" class="form-label">ID Buku</label>
                            <input type="text" name="id_buku" class="form-control" id="inputBuku" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputIDDetail" class="form-label">Nama Kategori</label>
                            <select name="kategori" class="form-control" id="InputIDKategori" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori as $k) { ?>
                                <option value="<?php echo $k->id_kategori; ?>"><?php echo $k->kategori; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputIDDetail" class="form-label">Rak</label>
                            <select name="rak" class="form-control" id="InputIDKategori" required>
                                <option value="">Pilih Rak</option>
                                <?php foreach ($rak as $r) { ?>
                                <option value="<?php echo $r->id_rak; ?>"><?php echo $r->rak; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class=" mb-3">
                            <label for="inputJudul" class="form-label">Cover</label>
                            <input type="file" name="gambar" class="form-control-file" id="inputfile" accept="image/*"
                                required>
                        </div>
                        <div class=" mb-3">
                            <label for="inputJudul" class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" id="inputjudul" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputPenulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control" id="inputpenulis" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputPenerbit" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" id="inputpenerbit" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputtahun" class="form-label">Tahun Terbit</label>
                            <input type="text" name="tahun_terbit" class="form-control" id="inputtahun_terbit "
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="inputDeskripsi" class="form-label">Deskripsi</label>
                            <div class="form-floating">
                                <textarea class="form-control" rows="5" name="deskripsi" id="inputDeskripsi"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="inputPenerbit" class="form-label">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" id="inputpenerbit" required>
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
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper');
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