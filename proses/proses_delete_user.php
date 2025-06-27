<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>


<?php
//koneksi ke database
include 'connect.php';

//ambil data id user
$id = $_POST['id'];
$gambarLama = $_POST['gambarLama'];

//cek apakah user pernah melakukan pemesan terhadap pelanggan
//kalau sudah maka tidak bisa di hapus
$query = "SELECT id FROM tbl_order WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    // echo '<script> 
    //     alert("Gagal, user tidak dapat dihapus karena sudah melakukan pemesan terhadap pelanggan");
    //     document.location.href = "index.php";
    //     window.location="../menu"; 
    // </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, user tidak dapat dihapus karena sudah
                            melakukan pemesan terhadap pelanggan!</p>
                        <a href="../user" class="card-link btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit;
}

if (isset($_POST['delete_user'])) {
    //query untuk proses delete
    $query = "DELETE FROM tbl_user WHERE id = '$id'";
    mysqli_query($conn, $query);

    // File baru diunggah, proses penggantian
    $uploadDir = __DIR__ . '/../assets/img/user/'; // Direktori tujuan
    $pathFileLama = $uploadDir . $gambarLama; // Path file lama

    // Hapus file lama jika ada
    if (file_exists($pathFileLama)) {
        unlink($pathFileLama); // Hapus file lama
    }

    //cek berhasil atau gagal
    if (mysqli_affected_rows($conn)) {
        //     echo '<script> 
        //     alert("Data user berhasil di delete");
        //     document.location.href = "index.php";
        //     window.location="../user"; 
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, data user berhasil didelete!</p>
                            <a href="../user" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        //     echo '<script> 
        //     alert("Data user gagal di delete");
        //     document.location.href = "index.php";
        //     window.location="../user"; 
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, data user gagal didelete!</p>
                            <a href="../user" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>