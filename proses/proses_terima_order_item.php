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
$id_list_order = htmlentities($_POST['id_list_order']);

if (isset($_POST['terima_order_item'])) {

    $query = "UPDATE tbl_list_order SET `status`= 1 WHERE id_list_order='$id_list_order'";
    $result = mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) >= 0) {
        // echo '<script> 
        //     alert("Berhasil diterima oleh dapur");
        //     document.location.href = "index.php";
        //     window.location="../dapur"; 
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, menu order berhasil diterima oleh
                                dapur!</p>
                            <a href="../dapur" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // echo '<script> 
        //             alert("Gagal diterima oleh dapur");
        //             document.location.href = "index.php";
        //             window.location="../dapur"; 
        //         </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, menu order gagal diterima dapur!</p>
                            <a href="../dapur" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>