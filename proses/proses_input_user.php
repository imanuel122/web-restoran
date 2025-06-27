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
$nama = htmlentities($_POST['nama']);
$username = htmlentities($_POST['username']);
$level = htmlentities($_POST['level']);
$nohp = htmlentities($_POST['nohp']);
$alamat = htmlentities($_POST['alamat']);
$password = htmlentities($_POST['password']);
$password2 = htmlentities($_POST['password2']);
$password_enkripsi = password_hash($password, PASSWORD_DEFAULT);

//cek username sudah ada atau belum
mysqli_query($conn, "SELECT username FROM tbl_user WHERE username = '$username '");
if (mysqli_affected_rows($conn) > 0) {
    // echo '<script>
    //         alert("username sudah terdaftar");
    //         document.location.href = "index.php";
    //         window.location="../user";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, username sudah terdaftar!</p>
                        <a href="../user" class="card-link btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit;
}

//cek konfirmasi password
if ($password != $password2) {
    // echo '<script>
    //         alert("konfirmasi password tidak sesuai");
    //         document.location.href = "index.php";
    //         window.location="../user";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, konfirmasi password tidak sesuai!</p>
                        <a href="../user" class="card-link btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit;
}

//ambil data file gambar yang di upload lalu cek kembali 
$namaFile = $_FILES['gambar']['name'];
$ukuranFile = $_FILES['gambar']['size'];
$error = $_FILES['gambar']['error'];
$tmpName = $_FILES['gambar']['tmp_name'];

//cek apakah gamabar sudah diupload atau belum
if ($error === 4) {
    // echo '<script> 
    //         alert("pilih gambar terlebih dahulu!");
    //         document.location.href = "index.php";
    //         window.location="../user";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, gambar belum diupload!</p>
                        <a href="../user" class="card-link btn btn-danger">Back</a>
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
    //         window.location="../user";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, yang anda upload bukan gambar!</p>
                        <a href="../user" class="card-link btn btn-danger">Back</a>
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
    //         window.location="../user";
    //     </script>';

    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-6 text-center">
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                    style="height: 300px;">
                    <div>
                        <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, ukuran gambar terlalu besar!</p>
                        <a href="../user" class="card-link btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    exit;
}

//jika lolos pengecekan buat nama baru filenya baru upload directory projek (tmp projek folde img user)
$namaFileBaru = $username;
$namaFileBaru .= '.';
$namaFileBaru .= $ekstensiGambar;
//buat variabel gambar isinya nama file baru agar di database nama file gambarnya sesuai emailnnya
$gambar = $namaFileBaru;

// Tentukan path folder tujuan
$uploadDir = __DIR__ . '/../assets/img/user/'; // Path relatif ke folder 'asset/img/user/'
$namaFileBaru = $uploadDir . $namaFileBaru; // Gabungkan path folder dengan nama file

// Pastikan folder tujuan ada
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true); // Buat folder jika belum ada
}

// Pindahkan file ke folder tujuan
move_uploaded_file($tmpName, $namaFileBaru);



if (isset($_POST['tambah_user'])) {

    $query = "INSERT INTO tbl_user VALUES ('', '$nama', '$username', '$level', '$nohp', '$alamat', '$password_enkripsi', '$gambar')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // echo '<script> 
        //     alert("User berhasil ditambahkan");
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
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Success, user berhasil ditambahkan!</p>
                            <a href="../user" class="card-link btn btn-success">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // echo '<script> 
        //             alert("User gagal ditambahkan");
        //             document.location.href = "index.php";
        //             window.location="../user"; 
        //         </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal, user gagal ditambahkan!</p>
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