<?php

include('template/header.php');

?>

<?php

include('koneksi.php');

$sql = "SELECT u.*, a.* FROM tb_artikel a JOIN tb_user u ON a.id_user = u.id WHERE `status` = 'publish'";
$result = $conn->query($sql);

?>

<div class="container-fluid">
    <main class="tm-main">
        <div class="row tm-row">
            <?php foreach ($result as $value) : ?>
                <article class="col-12 col-md-6 tm-post">
                    <hr class="tm-hr-primary">
                    <a href="detail.php?id=<?= $value['id']; ?>" class="effect-lily tm-post-link tm-pt-20">
                        <div class="tm-post-link-inner">
                            <img src="assets/img/<?= $value['gambar']; ?>" alt="Image" height="300">
                        </div>
                        <h2 class="tm-pt-30 tm-color-primary tm-post-title"><?= $value['judul']; ?></h2>
                    </a>
                    <p class="tm-pt-30">
                        <?= $value['deskripsi']; ?>
                    </p>
                    <div class="d-flex justify-content-between tm-pt-45">
                        <a href="detail.php?id=<?= $value['id']; ?>" class="btn btn-primary">Detail</a>
                        <?php
                        // mengonversi datetime basis data menjadi objek DateTime
                        $createdAt = new DateTime($value['created_at']);
                        $formattedCreatedAt = $createdAt->format('D, d M Y');
                        ?>
                        <span class="tm-color-primary"><?= $formattedCreatedAt; ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>by <?= $value['name']; ?></span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="row tm-row tm-mt-100 tm-mb-75">
            <div class="tm-prev-next-wrapper">
                <a href="#" class="mb-2 tm-btn tm-btn-primary tm-prev-next disabled tm-mr-20">Prev</a>
                <a href="#" class="mb-2 tm-btn tm-btn-primary tm-prev-next">Next</a>
            </div>
            <div class="tm-paging-wrapper">
                <span class="d-inline-block mr-3">Page</span>
                <nav class="tm-paging-nav d-inline-block">
                    <ul>
                        <li class="tm-paging-item active">
                            <a href="#" class="mb-2 tm-btn tm-paging-link">1</a>
                        </li>
                        <li class="tm-paging-item">
                            <a href="#" class="mb-2 tm-btn tm-paging-link">2</a>
                        </li>
                        <li class="tm-paging-item">
                            <a href="#" class="mb-2 tm-btn tm-paging-link">3</a>
                        </li>
                        <li class="tm-paging-item">
                            <a href="#" class="mb-2 tm-btn tm-paging-link">4</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <footer class="row tm-row">
            <hr class="col-12">
            <div class="col-md-6 col-12 tm-color-gray">
                Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-external-link">TemplateMo</a>
            </div>
            <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                Copyright 2020 Xtra Blog Company Co. Ltd.
            </div>
        </footer>
    </main>
</div>

<?php

include('template/footer.php');

?>