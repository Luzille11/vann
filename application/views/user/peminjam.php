<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">DATA PEMINJAM</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
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
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($Peminjam)) {
                        $no = 1;
                        foreach ($Peminjam as $p) { 
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
                                <span class="badge <?= ($p->status == 0) ? 'badge-warning' : 'badge-success'; ?>">
                                    <?= ($p->status == 0) ? 'Pending' : 'Approved'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($p->status == 0): ?>
                                <a class="btn btn-success"
                                    href="<?= base_url('User/approve_user/' . $p->id_user); ?>">Approve</a>
                                <?php else: ?>
                                <a class="btn btn-danger"
                                    href="<?= base_url('User/hapusUser/' . $p->id_user); ?>">Hapus</a>
                                <?php endif; ?>
                            </td 
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
          