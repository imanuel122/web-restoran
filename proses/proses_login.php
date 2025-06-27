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


// ambil data yang dikirim lewat post dan cek username dan passwordnya
if (isset($_POST['login'])) {

    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    //ambil data dari database berdasarkan username
    $query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username'");

    //cek apakah ada data yang memiliki username yang sama seperti yang diinput
    if (mysqli_num_rows($query) === 1) {
        //cek password
        $result = mysqli_fetch_assoc($query);
        if (password_verify($password, $result['password'])) {

            //membuat session
            $_SESSION['login'] = true;
            $_SESSION['username'] = $result['username'];
            $_SESSION['nama'] = $result['nama'];
            $_SESSION['level'] = $result['level'];
            $_SESSION['id_cafe'] = $result['id'];

            //membuat cookie
            if (isset($_POST["remember"])) {
                setcookie('id', $result['id'], time() + 60, '/');
                setcookie('key', hash('sha256', $result["username"]), time() + 60, '/');
            }

            header('location: ../home');
            exit;
        } else {
            // echo '<script> 
            //         alert("gagal login password salah");
            //         document.location.href = "index.php";
            //         window.location="../login"; 
            //     </script>';

            ?>
            <div class="container">
                <div class="row justify-content-center align-items-center" style="height: 100vh;">
                    <div class="col-6 text-center">
                        <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                            style="height: 300px;">
                            <div>
                                <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal login password salah!</p>
                                <a href="../login" class="card-link btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        // echo '<script> 
        //             alert("gagal login username tidak di temukan");
        //             document.location.href = "index.php"; 
        //             window.location="../login"; 
        //         </script>';

        ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-6 text-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert"
                        style="height: 300px;">
                        <div>
                            <p class="fw-semibold mb-4" style="font-size: 18px;">Gagal login username tidak ditemukan!</p>
                            <a href="../login" class="card-link btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}


?>