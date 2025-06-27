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

$id_menu = htmlentities($_POST['id_menu']);
$nama_menu = htmlentities($_POST['nama_menu']);
$keterangan = htmlentities($_POST['keterangan']);
$kategori = htmlentities($_POST['kategori']);
$harga = htmlentities($_POST['harga']);
$gambarLama = htmlentities($_POST['gambarLama']);

//cek username sudah ada atau belum
$cekNamaMenu = mysqli_query($conn, "SELECT nama_menu FROM tbl_daftar_menu WHERE id_menu != '$id_menu'");
$namaMenuDbs = [];
while ($namaMenuDb = mysqli_fetch_assoc($cekNamaMenu)) {
    $namaMenuDbs[] = $namaMenuDb;
}

for ($i = 0; $i < count($namaMenuDbs); $i++) {
    if (in_array($nama_menu, $namaMenuDbs[$i])) {
        // echo '<script>
        //     alert("Gagal, nama menu sudah ada");
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
}



// cek apakah gambarnya diupload untuk di edit atau tidak
if ($_FILES['gambar_menu']['error'] === 4) {
    // File gambar tidak diunggah, gunakan nama lama dengan nama pengguna baru
    $ekstensiGambar = explode('.', $gambarLama);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // Buat nama file baru berdasarkan nama pengguna baru
    $namaFileBaru = $nama_menu . '.' . $ekstensiGambar;

    // Tentukan path folder tujuan
    $uploadDir = __DIR__ . '/../assets/img/menu/';
    $pathFileLama = $uploadDir . $gambarLama; // Path file lama
    $pathFileBaru = $uploadDir . $namaFileBaru; // Path file baru

    // Jika nama file lama berbeda dengan nama file baru, ganti nama file
    if ($gambarLama !== $namaFileBaru) {
        if (file_exists($pathFileLama)) {
            rename($pathFileLama, $pathFileBaru); // Ganti nama file
        }
    }

    // Gunakan nama file baru untuk database
    $gambar_menu = $namaFileBaru;
} else {
    $gambar_menu = upload();
    if (!$gambar_menu) {
        exit;
    }
}

//buat function upload
function upload()
{
    global $gambarLama;
    global $nama_menu;
    global $id_menu;

    // File baru diunggah, proses penggantian
    $uploadDir = __DIR__ . '/../assets/img/menu/'; // Direktori tujuan
    $pathFileLama = $uploadDir . $gambarLama; // Path file lama

    // Hapus file lama jika ada
    if (file_exists($pathFileLama)) {
        unlink($pathFileLama); // Hapus file lama
    }


    //ambil data file gambar yang di upload lalu cek kembali 
    $namaFile = $_FILES['gambar_menu']['name'];
    $ukuranFile = $_FILES['gambar_menu']['size'];
    $error = $_FILES['gambar_menu']['error'];
    $tmpName = $_FILES['gambar_menu']['tmp_name'];

    //cek apakah file yang diupload gambar atau tidak
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        // echo '<script> 
        //     alert("yang anda upload bukan gambar");
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
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, yang anda upload bukan gambar!</p>
                            <a href="../menu" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return false;
    }

    //cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        // echo '<script> 
        //     alert("ukuran gambar terlalu besar");
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
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, ukuran gambar terlalu besar!</p>
                            <a href="../menu" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return false;
    }

    //jika lolos pengecekan buat nama baru filenya baru upload directory projek (tmp projek folde img user)
    $namaFileBaru = $nama_menu;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    //buat variabel gambar isinya nama file baru agar di database nama file gambarnya sesuai emailnnya
    $gambar_menu = $namaFileBaru;

    // Tentukan path folder tujuan
    $uploadDir = __DIR__ . '/../assets/img/menu/'; // Path relatif ke folder 'asset/img/user/'
    $namaFileBaruDirectori = $uploadDir . $namaFileBaru; // Gabungkan path folder dengan nama file

    // Pastikan folder tujuan ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Buat folder jika belum ada
    }

    // Pindahkan file ke folder tujuan
    move_uploaded_file($tmpName, $namaFileBaruDirectori);

    return $gambar_menu;
}
//end function upload


if (isset($_POST['edit_menu'])) {

    $query = "UPDATE tbl_daftar_menu SET gambar_menu = '$gambar_menu', nama_menu='$nama_menu', keterangan='$keterangan', id_kategori='$kategori', harga='$harga' WHERE id_menu='$id_menu'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // echo '<script> 
        //     alert("Data menu berhasil diedit");
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
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, data menu berhasil diedit!</p>
                            <a href="../menu" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // echo '<script> 
        //             alert("Data menu gagal diedit");
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
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, data menu gagal diedit!</p>
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