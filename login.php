<?php
// memanggil file koneksi
include('koneksi.php');

session_start();

if (isset($_SESSION["login"])) {
  header("Location: admin/index.php");
  exit;
}

// proses login
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  // cek inputan tidak boleh kosong
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION['msg'] = 'Field tidak boleh kosong';
    header('Location: login.php');
    exit();
  } else {
    $sql = "SELECT * FROM tb_user WHERE username = '$username'";
    $result = $conn->query($sql);

    // cek apakah datanya terdapat di database
    if ($result->num_rows <= 0) {
      $_SESSION['msg'] = 'Username atau password salah';
      header('Location: login.php');
      exit();
    } else {
      $row = $result->fetch_assoc();
      // cek password
      if ($password !== $row['password']) {
        $_SESSION['msg'] = 'Password anda salah';
        header('Location: login.php');
        exit();
      } else {
        // login berhasil
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id'];
        header('Location: admin/index.php');
        exit();
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jewepe || Admin</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <p class="h1"><b>Admin</b></p>
      </div>
      <div class="card-body">

        <?php if (isset($_SESSION['msg'])) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['msg']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>

        <form method="POST">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </div>
          </div>
        </form>
        <div class="row mt-3">
          <div class="col-12">
            <a href="index.php" name="login" class="btn btn-danger btn-block">Back</a>
          </div>
        </div>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>