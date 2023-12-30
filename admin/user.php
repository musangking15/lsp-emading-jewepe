<?php
include('template/header.php');
?>

<?php
include('template/sidebar_user.php');
?>

<?php

include('../koneksi.php');

// mengambil data dari tabel user
$sql = "SELECT * FROM tb_user";
$result = $conn->query($sql);

// menambahkan data
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $created = date('Y-m-d H:i:s');
  $updated = date('Y-m-d H:i:s');

  $sql = 'INSERT INTO tb_user (`name`, `username`, `password`, `created_at`, `updated_at`) VALUES ("' . $name . '", "' . $username . '", "' . $password . '", "' . $created . '", "' . $updated . '")';
  $insert = $conn->query($sql);

  if ($insert) {
    $_SESSION['msg'] = 'Berhasil menambahkan data user';
    header("Location: user.php");
    exit();
  } else {
    echo 'Tambah user gagal!';
  }
}

// mengedit data
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $username = $_POST['username'];
  $updated = date('Y-m-d H:i:s');

  // melakukan query update berdasarkan $id
  $sql = "UPDATE `tb_user` SET `name`='$name', `username`='$username', `updated_at`='$updated' WHERE `id`='$id'";
  $update = $conn->query($sql);

  if ($update) {
    $_SESSION['msg'] = 'Berhasil mengupdate data user';
    header("Location: user.php");
    exit();
  } else {
    echo 'Edit user gagal!';
  }
}

// menghapus data
if (isset($_POST['hapus'])) {
  $id = $_POST['id'];
  $sql = "DELETE FROM tb_user WHERE id = $id";
  $delete = $conn->query($sql);

  if ($delete) {
    $_SESSION['msg'] = 'Berhasil menghapus data user';
    header("Location: user.php");
    exit();
  } else {
    echo 'Hapus user gagal!';
  }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <a href="#" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalTambah">+ Tambah</a>
        <?php if (isset($_SESSION['msg'])) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['msg']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>
        <div class="card">
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($result as $item) : ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $item['name']; ?></td>
                    <td><?= $item['username']; ?></td>
                    <td>
                      <a href="#" class="btn btn-md btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalEdit-<?= $item['id'] ?>"><i class="nav-icon fas fa-edit"></i></a>
                      <form action="user.php" onsubmit="return deleteUser('<?= $item['name'] ?>')" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" name="hapus" class="btn btn-danger">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  function deleteUser(name) {
    pesan = confirm(`Are you sure you wanna delete this '${name}' ?`);
    return pesan
  }
</script>

<?php
include('template/footer.php');
?>

<!-- Modal Tambah -->
<div class="modal fade" id="exampleModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-2 fw-bold" id="exampleModalLabel">Tambah User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<?php foreach ($result as $item) : ?>
  <div class="modal fade" id="exampleModalEdit-<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-2 fw-bold" id="exampleModalLabel">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= $item['name'] ?>">
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $item['username'] ?>">
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>