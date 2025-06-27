<?php
// session_start();
include 'proses/connect.php';

//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil data username dari database berdasakan id
    $query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id = '$id'");
    $result = mysqli_fetch_assoc($query);

    //cek apakah username dan cookie sama
    if ($key == hash('sha256', $result["username"])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $result['username'];
        $_SESSION['nama'] = $result['nama'];
        $_SESSION['level'] = $result['level'];
        $_SESSION['id_cafe'] = $result['id'];
    }
}

//cek session
if (isset($_SESSION['login'])) {
    header('location: home');
    exit;
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Login - Hikari Kitchen || ひかりキッチン</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>
        body {
            background: url("assets/img/icon/background.jpeg") no-repeat center center;
            background-size: cover;
            min-height: 100vh;
        }

        .logo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
        }

        .kotak {
            margin: auto;
            background-color: rgba(255, 255, 255, 0.5);
            background-size: cover;
            border-radius: 10px;
            width: 500px;
        }

        .kotak .kotak_form {
            margin: auto;
            width: 70%;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <div class="kotak text-center my-5">
        <img class="logo my-3" src="assets/img/icon/logo_no_bg.png" alt="">
        <div class="kotak_form">
            <form class="text-center needs-validation" novalidate action="proses/proses_login.php" method="POST">

                <h1 class="h3 mb-3 fw-semibold text-center">Selamat Datang Di Hikari Kitchen, Silahkan Login!</h1>
                <!-- <h1 class="h3 mb-3 fw-normal text-center">Login</h1> -->
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="username" required>
                    <label for="floatingInput">Email address</label>
                    <div class="invalid-feedback">
                        Masukkan email yang valid.
                    </div>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                        name="password" required>
                    <label for="floatingPassword">Password</label>
                    <div class="invalid-feedback">
                        Masukkan email yang password.
                    </div>
                </div>

                <div class="form-check text-start my-3">
                    <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault"
                        name="remember">
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember me
                    </label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit" name="login" value="login">Login</button>
                <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2024–<?php echo date("Y") ?></p>
            </form>
        </div>
    </div>

    <!-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>