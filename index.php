<?php

session_start();
//ambil username dari session username
// $username = $_SESSION['username'];
// include('proses/connect.php');
// $query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username'");
// $result = mysqli_fetch_assoc(($query));


if (isset($_GET['x']) && $_GET['x'] == 'home') {
  $page = 'home.php';
  include 'main.php';
} else if (isset($_GET['x']) && $_GET['x'] == 'order') {
  if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2 || $_SESSION['level'] == 3) {
    $page = 'order.php';
    include 'main.php';
  } else {
    $page = 'home.php';
    include 'main.php';
  }
} else if (isset($_GET['x']) && $_GET['x'] == 'dapur') {
  if ($_SESSION['level'] == 1 || $_SESSION['level'] == 4) {
    $page = 'dapur.php';
    include 'main.php';
  } else {
    $page = 'home.php';
    include 'main.php';
  }
} else if (isset($_GET['x']) && $_GET['x'] == 'user') {
  if ($_SESSION['level'] == 1) {
    $page = 'user.php';
    include 'main.php';
  } else {
    $page = 'home.php';
    include 'main.php';
  }
} else if (isset($_GET['x']) && $_GET['x'] == 'report') {
  if ($_SESSION['level'] == 1) {
    $grafik_penjualan = 'grafik/grafik_penjualan.php';
    $grafik_pendapatan = 'grafik/grafik_pendapatan.php';
    $grafik_pembayaran = 'grafik/grafik_pembayaran.php';
    $page = 'report.php';
    include 'main.php';
  } else {
    $page = 'home.php';
    include 'main.php';
  }
} else if (isset($_GET['x']) && $_GET['x'] == 'menu') {
  if ($_SESSION['level'] == 1 || $_SESSION['level'] == 3) {
    $page = 'menu.php';
    include 'main.php';
  } else {
    $page = 'home.php';
    include 'main.php';
  }
} else if (isset($_GET['x']) && $_GET['x'] == 'kategori') {
  if ($_SESSION['level'] == 1) {
    $page = 'kategori.php';
    include 'main.php';
  } else {
    $page = 'home.php';
    include 'main.php';
  }
} else if (isset($_GET['x']) && $_GET['x'] == 'orderitem') {
  if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2 || $_SESSION['level'] == 3) {
    $page = 'order_item.php';
    include 'main.php';
  } else {
    $page = 'home.php';
    include 'main.php';
  }
} else if (isset($_GET['x']) && $_GET['x'] == 'viewitem') {
  if ($_SESSION['level'] == 1) {
    $page = 'view_item.php';
    include 'main.php';
  } else {
    $page = 'home.php';
    include 'main.php';
  }
} else if (isset($_GET['x']) && $_GET['x'] == 'login') {
  include 'login.php';
} else if (isset($_GET['x']) && $_GET['x'] == 'logout') {
  include 'proses/proses_logout.php';
} else {
  $page = 'home.php';
  include 'main.php';
}
?>
<!-- end content -->