<?php
include('template/header.php');
?>

<?php
include('template/sidebar_artikel.php');
?>

<?php

include('../koneksi.php');

include('../functions.php');

// mengambil data dari tabel artikel
$sql = "SELECT u.*, a.* FROM tb_artikel a JOIN tb_user u ON a.id_user = u.id";
$result = $conn->query($sql);

// menambahkan data ke tabel artikel
if (isset($_POST['submit'])) {
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $isi = $_POST['isi'];
  $status = $_POST['status'];
  $id_user = $_SESSION['id'];
  $created = date('Y-m-d H:i:s');
  $updated = date('Y-m-d H:i:s');
  $msgSuccess = 'Berhasil menambahkan artikel';
  $msgFailure = 'Gagal menambahkan artikel';

  // pemrosesan gambar
  $gambar = $_FILES['gambar']['name'];
  $gambar_temp = $_FILES['gambar']['tmp_name'];
  $gambar_path = '../assets/img/' . $gambar;

  // jika gambar berhasil diunggah maka jalankan fungsi uploadImage
  if (uploadImage($gambar_temp, $gambar_path)) {
    $sql = 'INSERT INTO tb_artikel (`judul`, `deskripsi`, `isi`, `gambar`, `status`, `id_user`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $params = ['sssssiss', $judul, $deskripsi, $isi, $gambar, $status, $id_user, $created, $updated];

    // menjalankan fungsi insertArtikel
    insertArtikel($conn, $sql, $params, $msgSuccess, $msgFailure);

  } else {
    echo 'Gagal mengunggah gambar!';
  }
}

// mengupdate data artikel dari tabel user berdasarkan id
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $isi = $_POST['isi'];
  $status = $_POST['status'];
  $updated = date('Y-m-d H:i:s');
  $msgSuccess = 'Berhasil mengupdate artikel';
  $msgFailure = 'Gagal mengupdate artikel';

  // cek jika ada gambar baru
  if ($_FILES['gambar']['name'] != "") {
    // Pemrosesan gambar baru
    $gambar = $_FILES['gambar']['name'];
    $gambar_temp = $_FILES['gambar']['tmp_name'];
    $gambar_path = '../assets/img/' . $gambar;

    $sqlImg = "SELECT gambar FROM tb_artikel WHERE id = $id";
    $resultImage = $conn->query($sqlImg);
    $img = $resultImage->fetch_assoc();
    $old_image_path = '../assets/img/' . $img['gambar'];

    // memindahkan gambar baru ke folder dengan menjalankan fungsi uploadImage
    if (uploadImage($gambar_temp, $gambar_path)) {
      // menghapus gambar lama dari folder dengan menjalankan fungsi deleteImage
      deleteImage($old_image_path);

      // update artikel jika ada gambar baru dan melakukan query update berdasarkan $id
      $sql = "UPDATE `tb_artikel` SET `judul`=?, `deskripsi`=?, `isi`=?, `gambar`=?, `status`=?, `updated_at`=? WHERE `id`=?";
      $params = ['ssssssi', $judul, $deskripsi, $isi, $gambar, $status, $updated, $id];

      // menjalankan fungsi updateArtikel
      updateArtikel($conn, $sql, $params, $msgSuccess, $msgFailure);
      
    } else {
      echo 'Gagal mengunggah gambar baru!';
    }
  } else {
    // update artikel jikda tidak ada gambar baru dan melakukan query update berdasarkan $id
    $sql = "UPDATE `tb_artikel` SET `judul`=?, `deskripsi`=?, `isi`=?, `status`=?, `updated_at`=? WHERE `id`=?";
    $params = ['sssssi', $judul, $deskripsi, $isi, $status, $updated, $id];

    // menjalankan fungsi updateArtikel
    updateArtikel($conn, $sql, $params, $msgSuccess, $msgFailure);
  }
}

// menghapus artikel
if (isset($_POST['hapus'])) {
  $id = $_POST['id'];
  $msgSuccess = 'Berhasil menghapus data artikel';
  $msgFailure = 'Gagal menghapus data artikel';


  $sqlImg = "SELECT gambar FROM tb_artikel WHERE id = $id";
  $resultImage = $conn->query($sqlImg);
  $img = $resultImage->fetch_assoc();
  $old_image_path = '../assets/img/' . $img['gambar'];

  // menjalankan fungsi deleteImage
  deleteImage($old_image_path);

  // melakukan query delete berdasarkan $id
  $sql = "DELETE FROM tb_artikel WHERE `id`=?";
  $params = ['i', $id];

  deleteArtikel($conn, $sql, $params, $msgSuccess, $msgFailure);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <p class="card-title fs-4 fw-semibold">Artikel</p>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <a href="" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalTambah">+ Tambah</a>
        <?php if (isset($_SESSION['msgSuccess'])) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['msgSuccess']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['msgSuccess']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['msgFailure'])) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['msgFailure']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['msgFailure']); ?>
        <?php endif; ?>
        <div class="card">
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Gambar</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($result as $item) : ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><img src="../assets/img/<?= $item['gambar']; ?>" width="50" alt="Gambar Artikel"></td>
                    <td><?= $item['judul']; ?></td>
                    <td><?= $item['name']; ?></td>
                    <td><?= $item['status']; ?></td>
                    <td>
                      <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModalDetail-<?= $item['id'] ?>">
                        <i class="fas fa-database"></i>
                      </a>
                      <a href="#" class="btn btn-md btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalEdit-<?= $item['id'] ?>">
                        <i class="nav-icon fas fa-edit"></i>
                      </a>
                      <form action="index.php" onsubmit="return deleteArtikel('<?= $item['judul'] ?>')" method="POST" class="d-inline">
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
  function deleteArtikel(judul) {
    pesan = confirm(`Are you sure you wanna delete this '${judul}' ?`);
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
        <h1 class="modal-title fs-2 fw-bold" id="exampleModalLabel">Tambah Artikel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="judul">Judul Artikel</label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi Artikel</label>
            <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi">
          </div>
          <div class="form-group">
            <label for="isi">Isi Artikel</label>
            <textarea id="summernote" name="isi">
                    Masukkan isi artikel
              </textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Gambar</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
              <option selected disabled>Pilih Status</option>
              <option value="publish">Publish</option>
              <option value="draft">Draft</option>
            </select>
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


<!-- Modal Edit -->
<?php foreach ($result as $edit) : ?>
  <div class="modal fade" id="exampleModalEdit-<?= $edit['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-2 fw-bold" id="exampleModalLabel">Edit Artikel</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
            <div class="form-group">
              <label for="judul">Judul Artikel</label>
              <input type="text" class="form-control" name="judul" id="judul" value="<?= $edit['judul']  ?>">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi Artikel</label>
              <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="<?= $edit['deskripsi']  ?>">
            </div>
            <div class="form-group">
              <label for="deskripsi">Isi Artikel</label>
              <textarea id="summernote-<?= $edit['id'] ?>" name="isi">
                <?= $edit['isi']  ?>
              </textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Gambar</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile" value="<?= $edit['gambar']  ?>">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control" required>
                <option selected disabled>Pilih Status</option>
                <option value="publish" <?php echo ($edit['status'] == 'publish') ? 'selected' : ''; ?>>Publish</option>
                <option value="draft" <?php echo ($edit['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
              </select>
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
  <script>
    $('#summernote-<?= $edit['id'] ?>').summernote();
  </script>
<?php endforeach; ?>

<!-- Modal Detail -->
<?php foreach ($result as $item) : ?>
  <div class="modal fade" id="exampleModalDetail-<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-2 fw-bold" id="exampleModalLabel">Detail Artikel</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item text-center">
              <img src="../assets/img/<?= $item['gambar']; ?>" width="100">
            </li>
            <li class="list-group-item">
              <label class="d-block">Judul</label>
              <?= $item['judul']; ?>
            </li>
            <li class="list-group-item">
              <label class="d-block">Deskripsi</label>
              <?= $item['deskripsi']; ?>
            </li>
            <li class="list-group-item">
              <label class="d-block">Isi</label>
              <?= $item['isi']; ?>
            </li>
            <li class="list-group-item">
              <label class="d-block">Status</label>
              <?= $item['status']; ?>
            </li>
            <li class="list-group-item">
              <label class="d-block">Penulis</label>
              <?= $item['name']; ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>