<?php
include('template/header.php');
?>

<?php
include('template/sidebar_artikel.php');
?>

<?php

include('../koneksi.php');

$sql = "SELECT u.*, a.* FROM tb_user u JOIN tb_artikel a ON u.id = a.id_user";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// menambahkan data
if (isset($_POST['submit'])) {
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $isi = $_POST['isi'];
  $status = $_POST['status'];
  $id_user = $row['id'];

  // Pemrosesan gambar
  $gambar = $_FILES['gambar']['name'];
  $gambar_temp = $_FILES['gambar']['tmp_name'];
  $gambar_path = '../assets/img/' . $gambar;

  if (move_uploaded_file($gambar_temp, $gambar_path)) {
      // Jika gambar berhasil diunggah, tambahkan ke database
      $sql = 'INSERT INTO tb_artikel (`judul`, `deskripsi`, `isi`, `gambar`, `status`, `id_user`) VALUES ("' . $judul . '", "' . $deskripsi . '", "' . $isi . '", "' . $gambar . '", "' . $status . '", "' . $id_user . '")';
      $insert = $conn->query($sql);

      if ($insert) {
          header("Location: index.php");
          exit();
      } else {
          echo 'Tambah artikel gagal!';
      }
  } else {
      echo 'Gagal mengunggah gambar!';
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
          <h1>Artikel</h1>
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
        <a href="" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalTambah">+ Tambah</a>
        <div class="card">
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Status</th>
                  <th>Penulis</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($result as $item) : ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $item['judul']; ?></td>
                    <td><?= $item['deskripsi']; ?></td>
                    <td><?= $item['status']; ?></td>
                    <td><?= $item['name']; ?></td>
                    <td>
                      <a href="" class="btn btn-md btn-warning"><i class="nav-icon fas fa-edit"></i></a>
                      <a href="" class="btn btn-md btn-danger"><i class="nav-icon fas fa-trash"></i></a>
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
              <label for="deskripsi">Isi Artikel</label>
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
</div>