<?php
//cek sessionnya sudah di buat atau belum
// session_start();
if (!isset($_SESSION['login'])) {
    header('location: login');
    exit;
}


//ambil username dari session username
$username = $_SESSION['username'];
include('proses/connect.php');
$query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username'");
$result = mysqli_fetch_assoc(($query));


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hikari Kitchen || ひかりキッチン</title>
    <!-- cdn bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- cdn untuk data tabel -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>

    <style>
        /* body {
            background: url("assets/img/icon/background.jpeg") center center;
            background-size: 100% 75%;
        } */

        /* .jumbotron {
            background-color: rgba(255, 255, 255, 0.5);
        } */
    </style>
</head>

<body>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>
    <!-- end navbar -->

    <!-- sidebar & content & footer-->
    <div class="container-lg jumbotron">

        <!-- row sidebar & content -->
        <div class="row mb-5">
            <!-- sidebar -->
            <?php include 'sidebar.php'; ?>
            <!-- end sidebar -->

            <!-- content -->
            <?php
            include $page;
            ?>
            <!-- end content -->
        </div>
        <!-- end row sidebar & content -->

        <!--footer  -->
        <div class="fixed-bottom bg-primary">
            <footer class="text-center text-white p-2 w-50 mx-auto">
                <!-- Copyright -->
                <div class="row">
                    <div class="col-12">
                        © 2025 Copyright:
                        <a class="text-white me-3" href="#">ImanuelHulu.com</a>
                    </div>
                </div>
                <!-- end Copyright -->
            </footer>
        </div>
        <!--end footer  -->

    </div>
    <!-- end sidebar & end content & end footer -->

    <!-- cdn bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- buat ambil id data tabel -->
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

</body>

</html>