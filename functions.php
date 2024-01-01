<?php 

// logika CRUD untuk halaman index

// fungsi upload image
function uploadImage($tempPath, $targetPath) {
    if (move_uploaded_file($tempPath, $targetPath)) {
        return true;
    } else {
        return false;
    }
}

// fungsi menghapus image
function deleteImage($imagePath) {
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

// fungsi menambah data artikel
function insertArtikel($conn, $sql, $params, $msgSuccess, $msgFailure) {
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(...$params);
    $insert = $stmt->execute();

    if ($insert) {
        $_SESSION['msgSuccess'] = $msgSuccess;
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['msgFailure'] = $msgFailure;
        header("Location: index.php");
        exit();
    }

    $stmt->close();
}

// fungsi mengupdate data artikel
function updateArtikel($conn, $sql, $params, $msgSuccess, $msgFailure) {
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(...$params);
    $insert = $stmt->execute();

    if ($insert) {
        $_SESSION['msgSuccess'] = $msgSuccess;
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['msgFailure'] = $msgFailure;
        header("Location: index.php");
        exit();
    }

    $stmt->close();
}

// fungsi mengupdate data artikel
function deleteArtikel($conn, $sql, $params, $msgSuccess, $msgFailure) {
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(...$params);
    $insert = $stmt->execute();

    if ($insert) {
        $_SESSION['msgSuccess'] = $msgSuccess;
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['msgFailure'] = $msgFailure;
        header("Location: index.php");
        exit();
    }

    $stmt->close();
}




// logika CRUD untuk halaman user

// fungsi menambah data user
function insertUser($conn, $sql, $params, $msgSuccess, $msgFailure) {
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(...$params);
    $insert = $stmt->execute();

    if ($insert) {
        $_SESSION['msgSuccess'] = $msgSuccess;
        header("Location: user.php");
        exit();
    } else {
        $_SESSION['msgFailure'] = $msgFailure;
        header("Location: user.php");
        exit();
    }

    $stmt->close();
}

// fungsi mengupdate data user
function updateUser($conn, $sql, $params, $msgSuccess, $msgFailure) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(...$params);
    $update = $stmt->execute();

    if ($update) {
        $_SESSION['msgSuccess'] = $msgSuccess;
        header("Location: user.php");
        exit();
    } else {
        $_SESSION['msgFailure'] = $msgFailure;
        header("Location: user.php");
        exit();
    }

    $stmt->close();
}

// fungsi menghapus data user
function deleteUser($conn, $sql, $params, $msgSuccess, $msgFailure) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(...$params);
    $delete = $stmt->execute();

    if ($delete) {
        $_SESSION['msgSuccess'] = $msgSuccess;
        header("Location: user.php");
        exit();
    } else {
        $_SESSION['msgFailure'] = $msgFailure;
        header("Location: user.php");
        exit();
    }

    $stmt->close();
}