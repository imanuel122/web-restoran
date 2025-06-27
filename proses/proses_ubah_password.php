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
session_start();
//koneksi ke database
include 'connect.php';

//ambil data yang dikirim lewat post
$username = htmlentities($_SESSION['username']);
$passwordLama = htmlentities($_POST['passwordLama']);
$passwordBaru = htmlentities($_POST['passwordBaru']);
$passwordBaru2 = htmlentities($_POST['passwordBaru2']);

if (isset($_POST['ubah_password'])) {
    //cek apakah password lama nya benar sesuai dengan database
    //cek apakah password lama sama dengan password yang ada di database
    $query = "SELECT `password` FROM tbl_user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $passwordDb = mysqli_fetch_assoc($result);

    if (!password_verify($passwordLama, $passwordDb['password'])) {
        // echo '<script> 
        //     alert("Password lama yang di masukkan salah");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, password lama yang dimasukkan salah!</p>
                            <a href="javascript:history.back();" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        exit;
    }

    //cek konfirmasi password baru
    if ($passwordBaru != $passwordBaru2) {
        // echo '<script> 
        //     alert("Konfirmasi password baru salah");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, konfirmasi password baru salah!</p>
                            <a href="javascript:history.back();" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        exit;
    }

    //enkripsi password
    $passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);
    //jika lulus pengecekan masuk mengubah password
    $query = "UPDATE tbl_user SET `password` = '$passwordBaru' WHERE username = '$username'";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        // echo '<script> 
        //     alert("Password berhasil diubah");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, password berhasil diubah!</p>
                            <a href="javascript:history.back();" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        exit;
    } else {
        // echo '<script> 
        //     alert("Password gagal diubah ");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Password gagal diubah!</p>
                            <a href="javascript:history.back();" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        exit;
    }

}

?>