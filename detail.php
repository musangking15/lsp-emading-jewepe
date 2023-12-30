<?php

include('template/header.php');

?>

<?php 

include('koneksi.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data artikel berdasarkan id
    $sql = "SELECT u.*, a.* FROM tb_artikel a JOIN tb_user u ON a.id_user = u.id WHERE a.id = $id";
    $result = $conn->query($sql);

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        // Redirect ke halaman utama jika data tidak ditemukan
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect ke halaman utama jika tidak ada parameter id
    header("Location: index.php");
    exit();
}

?>

<div class="container-fluid">
    <main class="tm-main">
        <div class="row tm-row">
            <div class="col-12">
                <!-- Video player 1422x800 -->
                <img src="assets/img/<?= $data['gambar']; ?>" width="954" height="500" alt="">
            </div>
        </div>
        <div class="row tm-row">
            <div class="col-12 tm-post-col">
                <div>
                    <div class="mb-4">
                        <h2 class="pt-2 tm-color-primary tm-post-title"><?= $data['judul']; ?></h2>
                        <?php
                        // Convert the database datetime to a DateTime object
                        $createdAt = new DateTime($data['created_at']);

                        // Format the DateTime object as "D, d M Y" (day, date month year)
                        $formattedCreatedAt = $createdAt->format('D, d M Y');
                        ?>
                        <p class="tm-mb-40"><?= $formattedCreatedAt; ?> posted by <?= $data['name']; ?></p>
                        <p>
                        <?= $data['isi']; ?>
                        </p>
                    </div>

                    <!-- Comments -->
                    <div>
                        <h2 class="tm-color-primary tm-post-title">Comments</h2>
                        <hr class="tm-hr-primary tm-mb-45">
                        <div class="tm-comment tm-mb-45">
                            <figure class="tm-comment-figure">
                                <img src="assets/image/comment-1.jpg" alt="Image" class="mb-2 rounded-circle img-thumbnail">
                                <figcaption class="tm-color-primary text-center">Mark Sonny</figcaption>
                            </figure>
                            <div>
                                <p>
                                    Praesent aliquam ex vel lectus ornare tritique. Nunc et eros
                                    quis enim feugiat tincidunt et vitae dui. Nullam consectetur
                                    justo ac ex laoreet rhoncus. Nunc id leo pretium, faucibus
                                    sapien vel, euismod turpis.
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="tm-color-primary">June 14, 2020</span>
                                </div>
                            </div>
                        </div>
                        <div class="tm-comment tm-mb-45">
                            <figure class="tm-comment-figure">
                                <img src="assets/image/comment-2.jpg" alt="Image" class="mb-2 rounded-circle img-thumbnail">
                                <figcaption class="tm-color-primary text-center">Mark Sonny</figcaption>
                            </figure>
                            <div>
                                <p>
                                    Nunc et eros quis enim feugiat tincidunt et vitae dui.
                                    Nullam consectetur justo ac ex laoreet rhoncus. Nunc
                                    id leo pretium, faucibus sapien vel, euismod turpis..
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="tm-color-primary">June 21, 2020</span>
                                </div>
                            </div>
                        </div>
                        <form action="" class="mb-5">
                            <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                            <div class="mb-4">
                                <input class="form-control" name="name" type="text">
                            </div>
                            <div class="mb-4">
                                <input class="form-control" name="email" type="text">
                            </div>
                            <div class="mb-4">
                                <textarea class="form-control" name="message" rows="6"></textarea>
                            </div>
                            <div class="text-right">
                                <button class="tm-btn tm-btn-primary tm-btn-small">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <?php

        include('template/header.php');

        ?>