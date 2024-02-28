<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA ULASAN</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->

<style>
        .star-container {
            display: flex;
        }

        .star {
            font-size: 15px; /* Sesuaikan dengan ukuran yang diinginkan */
            margin-right: 5px; /* Sesuaikan dengan jarak antar bintang */
            width: 20px; /* Sesuaikan dengan ukuran bintang kosong */
            height: 20px; /* Sesuaikan dengan ukuran bintang kosong */
            background-image: url('assets/dist/img/star-removebg-preview.png'); /* Ganti dengan path gambar bintang kosong */
            background-size: cover;
        }

        .filled-star {
            color: #ffd700; /* Warna bintang diisi (warna kuning dalam contoh) */
        }

        .empty-star {
            font-size: 15px; /* Sesuaikan dengan ukuran yang diinginkan */
            background-image: none; /* Hapus gambar latar belakang */
        }
    </style>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <button type="button" class="btn btn-success " data-bs-toggle="modal"
                        data-bs-target="#tambahulasan">
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
                                <th>User</th>
                                <th>Cover</th>
                                <th>Buku</th>
                                <th>Ulasan</th>
                                <th>Rating</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($Ulasan)) {
                            $no = 1;
                            foreach ($Ulasan as $u) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $u->nama; ?></td>
                                <td>                                        <!-- Menampilkan gambar dengan tag <img> -->
                                    <?php
                                    $gambar_url = base_url('assets/dist/img/') . $u->gambar;
                                    ?>
                                    <img src="<?php echo $gambar_url; ?>" alt="Cover <?php echo $u->judul; ?>"
                                    style="height: 150px;" width="100%">
                                </td>
                                <td><?php echo $u->judul; ?></td>
                                <td><?php echo $u->ulasan; ?></td>
                                <td>
                                <?php
                                $rating = 5; 

                                echo '<div class="star-container">';
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $u->rating) {
                                            echo '<div class="star filled-star">⭐</div>';
                                        } else {
                                        echo '<div class="star empty-star">☆</div>';
                                        }
                                    } echo '</div>';
                                    ?>
                                </td>
                                <?php if ($this->session->userdata('id_user') == $u->id_user): ?>
                                <td>
                                    <button type=" button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editulasan_<?php echo $u->id_ulasan; ?>">
                                        <i class="nav-icon fas fa-pen"></i>
                                        </button>
                                    <a href="<?php echo site_url('Ulasan/hapusulasan/'. $u->id_ulasan)?>"
                                        onclick="return confirm('Apakah anda ingin menghapus data ?')"
                                        class="btn btn-danger">
                                        <i class="nav-icon fas fa-trash"></i>
                                        </a>
                                </td>
                                <?php endif; ?>
                            </tr>

                            <div class="modal fade" id="editulasan_<?php echo $u->id_ulasan; ?>" tabindex="-1"
                                aria-labelledby="editulasanlabel" aria-hidden=" true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Ulasan/h1>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo site_url('Ulasan/updateulasan/') ?>" method="post"
                                                class="mx-3">
                                                <div class="">
                                                    <input type="text" name="id_ulasan" class="form-control"
                                                        value="<?= $u->id_ulasan; ?>" hidden>
                                                </div>
                                                <!--<div class="mb-3">
                                                    <label for="editIDDetail" class="form-label">User</label>
                                                    <select name="user" class="form-control" required>
                                                        <div class="mb-3">
                                                            <option value="">Pilih User</option>
                                                            <?php foreach ($user as $r) { ?>
                                                            <option <?php if($u->id_user == $r->id_user) {echo "selected";
                                                                } ?> value="<?php echo $r->id_user; ?>">
                                                                <?php echo $r->nama; ?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>
                                                </div>-->
                                                <div class="mb-3">
                                                    <label for="editIDDetail" class="form-label">User</label>
                                                    <select name="buku" class="form-control" required>
                                                        <div class="mb-3">
                                                            <option value="">Pilih Buku</option>
                                                            <?php foreach ($ulas as $b) {?>
                                                            <option <?php if ($u->id_buku == $b->id_buku) { echo "selected"; 
                                                            } ?> value="<?php echo $b->id_buku;  ?>">
                                                                <?php echo $b->judul ?>
                                                            </option>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                                <div class=" mb-3">
                                                    <label for="editUlasan" class="form-label">Ulasan</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" rows="5" name="ulasan" value=""
                                                            required><?= $u->ulasan; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edittahun" class="form-label">Tahun Terbit</label>
                                                    <select name="rating" class="form-control">
                                                        <option selected><?= $u->rating; ?></option>
                                                        <option value="1">1</i></option>
                                                        <option value="2">2</i></option>
                                                        <option value="3">3</i></option>
                                                        <option value="4">4</i></option>
                                                        <option value="5">5</i></option>
                                                    </select>
                                                </div>
                                                <div class=" modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
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
</div>
    <div class="modal fade" id="tambahulasan" tabindex="-1" aria-labelledby="tambahkategorilabel aria-hidden=" true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Ulasan</h1>
                </div>
                <div class="modal-body">
                    <form action="<?php echo site_url('Ulasan/tambahulasan') ?>" method="post" class="mx-3">
                        <div class="mb-3">
                            <input type="text" name="id_ulasan" class="form-control" id="inputBuku" hidden>
                        </div>
                        <div class="mb-3">
                            <select name="user" class="form-control" required hidden>
                                <?php foreach ($user as $u) { ?>
                                <?php if ($u->id_user == $this->session->userdata('id_user')) { ?>
                                <option value="<?php echo $u->id_user; ?>" selected>
                                    <?php echo $u->nama; ?>
                                </option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputIDDetail" class="form-label">Buku</label>
                            <select name="buku" class="form-control" id="InputIDKategori" required>
                                <option value="">Pilih Buku</option>
                                <?php foreach ($ulas as $b) { ?>
                                <option value="<?php echo $b->id_buku; ?>"><?php echo $b->judul; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tambahUlasan" class="form-label">Ulasan</label>
                            <div class="form-floating">
                                <textarea class="form-control" rows="5" name="ulasan" value="" required></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edittahun" class="form-label">Rating</label>
                            <select name="rating" class="form-control">
                                <option selected>Pilih Rating</option>
                                <option value="1">1</i></option>
                                <option value="2">2</i></option>
                                <option value="3">3</i></option>
                                <option value="4">4</i></option>
                                <option value="5">5</i></option>
                            </select>
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
          