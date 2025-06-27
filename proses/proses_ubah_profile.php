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

$id = htmlentities($_POST['id']);
$nama = htmlentities($_POST['nama']);
$username = htmlentities($_POST['username']);
$level = htmlentities($_POST['level']);
$nohp = htmlentities($_POST['nohp']);
$alamat = htmlentities($_POST['alamat']);
$gambarLama = htmlentities($_POST['gambarLama']);

//cek username sudah ada atau belum
$cekUsername = mysqli_query($conn, "SELECT username FROM tbl_user WHERE id != '$id'");
$usernameDbs = [];
while ($usernameDb = mysqli_fetch_assoc($cekUsername)) {
    $usernameDbs[] = $usernameDb;
}

for ($i = 0; $i < count($usernameDbs); $i++) {
    if (in_array($username, $usernameDbs[$i])) {
        //     echo '<script> 
        //     alert("Gagal, username sudah terdaftar ");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, username sudah terdaftar!</p>
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



// cek apakah gambarnya diupload untuk di edit atau tidak
if ($_FILES['gambar']['error'] === 4) {
    // File gambar tidak diunggah, gunakan nama lama dengan nama pengguna baru
    $ekstensiGambar = explode('.', $gambarLama);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // Buat nama file baru berdasarkan nama pengguna baru
    $namaFileBaru = $username . '.' . $ekstensiGambar;

    // Tentukan path folder tujuan
    $uploadDir = __DIR__ . '/../assets/img/user/';
    $pathFileLama = $uploadDir . $gambarLama; // Path file lama
    $pathFileBaru = $uploadDir . $namaFileBaru; // Path file baru

    // Jika nama file lama berbeda dengan nama file baru, ganti nama file
    if ($gambarLama !== $namaFileBaru) {
        if (file_exists($pathFileLama)) {
            rename($pathFileLama, $pathFileBaru); // Ganti nama file
        }
    }

    // Gunakan nama file baru untuk database
    $gambar = $namaFileBaru;
} else {
    $gambar = upload();
    if (!$gambar) {
        exit;
    }
}

//buat function upload
function upload()
{
    global $gambarLama;
    global $username;
    global $id;

    // File baru diunggah, proses penggantian
    $uploadDir = __DIR__ . '/../assets/img/user/'; // Direktori tujuan
    $pathFileLama = $uploadDir . $gambarLama; // Path file lama

    // Hapus file lama jika ada
    if (file_exists($pathFileLama)) {
        unlink($pathFileLama); // Hapus file lama
    }


    //ambil data file gambar yang di upload lalu cek kembali 
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah file yang diupload gambar atau tidak
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        //     echo '<script> 
        //     alert("Yang anda upload bukan gambar ");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, yang anda upload bukan gambar!</p>
                            <a href="javascript:history.back();" class="card-link btn btn-danger">Back</a>
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
        //     echo '<script> 
        //     alert("Gagal, ukuran gambar terlalu besar ");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, ukuran gambar terlalu besar!</p>
                            <a href="javascript:history.back();" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return false;
    }

    //jika lolos pengecekan buat nama baru filenya baru upload directory projek (tmp projek folde img user)
    $namaFileBaru = $username;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    //buat variabel gambar isinya nama file baru agar di database nama file gambarnya sesuai emailnnya
    $gambar = $namaFileBaru;

    // Tentukan path folder tujuan
    $uploadDir = __DIR__ . '/../assets/img/user/'; // Path relatif ke folder 'asset/img/user/'
    $namaFileBaruDirectori = $uploadDir . $namaFileBaru; // Gabungkan path folder dengan nama file

    // Pastikan folder tujuan ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Buat folder jika belum ada
    }

    // Pindahkan file ke folder tujuan
    move_uploaded_file($tmpName, $namaFileBaruDirectori);

    return $gambar;
}
//end function upload


if (isset($_POST['ubah_profile'])) {

    $query = "UPDATE tbl_user SET nama='$nama', username='$username', `level`='$level', nohp='$nohp', alamat='$alamat',  gambar='$gambar' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        //     echo '<script> 
        //     alert("Data profile berhasil diubah ");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, data profile berhasil diubah!</p>
                            <a href="javascript:history.back();" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        exit;
    } else {
        //     echo '<script> 
        //     alert("Data profile gagal diubah ");
        //     window.history.back();
        // </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, data profile gagal diubah!</p>
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