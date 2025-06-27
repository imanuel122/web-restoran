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
//koneksi ke database\
include('connect.php');

//ambil data yang di kirim lewat post
$nama_menu = htmlentities($_POST['nama_menu']);
$keterangan = htmlentities($_POST['keterangan']);
$kategori = htmlentities($_POST['kategori']);
$harga = htmlentities($_POST['harga']);

//cek nama menu sudah ada atau belum
$query = "SELECT nama_menu FROM tbl_daftar_menu WHERE nama_menu = '$nama_menu'";
$result = mysqli_query($conn, $query);
$menu = mysqli_fetch_assoc($result);
if ($menu) {
    // echo '<script> 
    //         alert("Nama menu sudah ada");
    //         document.location.href = "index.php";
    //         window.location="../menu";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, nama menu sudah ada!</p>
                        <a href="../menu" class="card-link btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit;
}


//ambil data file gambar yang di upload lalu cek kembali 
$namaFile = $_FILES['gambar_menu']['name'];
$ukuranFile = $_FILES['gambar_menu']['size'];
$error = $_FILES['gambar_menu']['error'];
$tmpName = $_FILES['gambar_menu']['tmp_name'];

//cek apakah gamabar sudah diupload atau belum
if ($error === 4) {
    // echo '<script> 
    //         alert("pilih gambar terlebih dahulu!");
    //         document.location.href = "index.php";
    //         window.location="../menu";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, gambar belum diupload!</p>
                        <a href="../menu" class="card-link btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit;
}

//cek apakah file yang diupload gambar atau tidak
$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
$ekstensiGambar = explode('.', $namaFile);
$ekstensiGambar = strtolower(end($ekstensiGambar));
if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    // echo '<script> 
    //         alert("yang anda upload bukan gambar");
    //         document.location.href = "index.php";
    //         window.location="../menu";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, yang anda upload bukan gambar!</p>
                        <a href="../menu" class="card-link btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit;
}

//cek jika ukurannya terlalu besar
if ($ukuranFile > 1000000) {
    // echo '<script> 
    //         alert("ukuran gambar terlalu besar");
    //         document.location.href = "index.php";
    //         window.location="../menu";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, ukuran gambar terlalu besar!</p>
                        <a href="../menu" class="card-link btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit;
}

//jika lolos pengecekan buat nama baru filenya baru upload directory projek (tmp projek folde img user)
$namaFileBaru = $nama_menu;
$namaFileBaru .= '.';
$namaFileBaru .= $ekstensiGambar;
//buat variabel gambar isinya nama file baru agar di database nama file gambarnya sesuai emailnnya
$gambar_menu = $namaFileBaru;

// Tentukan path folder tujuan
$uploadDir = __DIR__ . '/../assets/img/menu/'; // Path relatif ke folder 'asset/img/user/'
$namaFileBaru = $uploadDir . $namaFileBaru; // Gabungkan path folder dengan nama file

// Pastikan folder tujuan ada
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true); // Buat folder jika belum ada
}

// Pindahkan file ke folder tujuan
move_uploaded_file($tmpName, $namaFileBaru);



if (isset($_POST['tambah_menu'])) {

    $query = "INSERT INTO tbl_daftar_menu (`id_menu`, `gambar_menu`, `nama_menu`, `keterangan`, `id_kategori`, `harga`) VALUES ('', '$gambar_menu', '$nama_menu', '$keterangan', '$kategori', '$harga')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // echo '<script> 
        //     alert("Menu baru berhasil ditambahkan");
        //     document.location.href = "index.php";
        //     window.location="../menu"; 
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, menu baru berhasil ditambahkan!</p>
                            <a href="../menu" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // echo '<script> 
        //             alert("Menu baru gagal ditambahkan");
        //             document.location.href = "index.php";
        //             window.location="../menu"; 
        //         </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, menu baru gagal ditambahkan!</p>
                            <a href="../menu" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>