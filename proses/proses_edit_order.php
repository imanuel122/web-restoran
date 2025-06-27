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
//koneksi ke database\
include('connect.php');

//ambil data yang di kirim lewat post
$kode_order = htmlentities($_POST['kode_order']);
$meja = htmlentities($_POST['meja']);
$nama_pelanggan = htmlentities($_POST['nama_pelanggan']);




if (isset($_POST['edit_order'])) {

    $query = "UPDATE tbl_order SET `id_order`='$kode_order', `pelanggan`='$nama_pelanggan', `meja`='$meja' WHERE id_order='$kode_order'";
    $result = mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) >= 0) {
        // echo '<script> 
        //     alert("Order berhasil diedit");
        //     document.location.href = "index.php";
        //     window.location="../order"; 
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, order berhasil diedit!</p>
                            <a href="../order" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // echo '<script> 
        //             alert("Order gagal diedit");
        //             document.location.href = "index.php";
        //             window.location="../order"; 
        //         </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, order gagal diedit!</p>
                            <a href="../order" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>