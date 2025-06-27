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

//ambil data yang dikirim lewat post
$id_kategori = htmlentities($_POST['id_kategori']);
$jenis_menu = htmlentities($_POST['jenis_menu']);
$kategori = htmlentities($_POST['kategori']);

//cek apakah nama kategori menu sudah ada atau belum
$cekKategori = mysqli_query($conn, "SELECT kategori FROM tbl_kategori_menu WHERE id_kategori != '$id_kategori'");
$kategoriDbs = [];
while ($kategoriDb = mysqli_fetch_assoc($cekKategori)) {
    $kategoriDbs[] = $kategoriDb;
}

for ($i = 0; $i < count($kategoriDbs); $i++) {
    if (in_array($kategori, $kategoriDbs[$i])) {
        // echo '<script>
        //     alert("Gagal, Kategori menu  sudah ada");
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
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, kategori menu sudah ada!</p>
                            <a href="../kategori" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        exit;
    }
}



if (isset($_POST['edit_kategori'])) {

    $query = "UPDATE tbl_kategori_menu SET jenis_menu = '$jenis_menu', kategori='$kategori' WHERE id_kategori='$id_kategori'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // echo '<script> 
        //     alert("Kategori menu  berhasil diedit");
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
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, kategori menu berhasil diedit!</p>
                            <a href="../kategori" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // echo '<script> 
        //             alert("Kategori menu gagal diedit");
        //             document.location.href = "index.php";
        //             window.location="../kategori"; 
        //         </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, kategori menu gagal diedit!</p>
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