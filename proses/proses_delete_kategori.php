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
$id_kategori = $_POST['id_kategori'];

if (isset($_POST['delete_kategori'])) {

    //cek apakah kategori sudah digunakan dalam menu atau tidak jika sudah maka tidak bisa di hapus
    $query = mysqli_query($conn, "SELECT id_kategori FROM tbl_daftar_menu WHERE id_kategori = '$id_kategori'");
    if (mysqli_num_rows($query) > 0) {
        // echo '<script>
        //     alert("Gagal, Kategori menu  sudah digunakan dalam menu");
        //     document.location.href = "index.php";
        //     window.location="../kategori";
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, kategori menu sudah digunakan dalam
                                menu!</p>
                            <a href="../kategori" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        exit;
    }

    //query untuk proses delete
    $query = "DELETE FROM tbl_kategori_menu WHERE id_kategori = '$id_kategori'";
    mysqli_query($conn, $query);

    //cek berhasil atau gagal
    if (mysqli_affected_rows($conn)) {
        //     echo '<script> 
        //     alert("Kategori menu berhasil di delete");
        //     document.location.href = "index.php";
        //     window.location="../kategori"; 
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, kategori menu berhasil didelete!</p>
                            <a href="../kategori" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        //     echo '<script> 
        //     alert("Kategori menu gagal di delete");
        //     document.location.href = "index.php";
        //     window.location="../kategori"; 
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, kategori menu gagal didelete!</p>
                            <a href="../kategori" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>