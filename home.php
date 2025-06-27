<?php
//koneksi ke database
include 'proses/connect.php';

//ambil data menu dari database untuk carousel
$query = "SELECT * FROM tbl_daftar_menu ";
$result = mysqli_query($conn, $query);
$daftar_menu = [];
while ($menu = mysqli_fetch_assoc($result)) {
    $daftar_menu[] = $menu;
}

?>

<div class="col-lg-9 mt-2">
    <!-- carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $slide = 0;
            $firstSlideButton = true;
            foreach ($daftar_menu as $dataTombol) {
                ($firstSlideButton) ? $aktif = 'active' : $aktif = '';
                $firstSlideButton = false;
                ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slide ?>"
                    class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
                <?php $slide++; ?>
            <?php } ?>
        </div>
        <div class="carousel-inner rounded">
            <?php
            $firstSlide = true;
            foreach ($daftar_menu as $menu) {
                ($firstSlide) ? $aktif = 'active' : $aktif = '';
                $firstSlide = false;
                ?>
                <div class="carousel-item <?php echo $aktif ?>">
                    <img src="assets/img/menu/<?php echo $menu['gambar_menu'] ?>" class="img-fluid" alt="..."
                        style="height: 250px; width: 1000px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $menu['nama_menu'] ?></h5>
                        <p><?php echo $menu['keterangan'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end carousel -->


    <!-- Judul -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <h5 class="card-title">Selamat Datang di Restoran Hikari Kitchen | Nikmati Cita Rasa Otentik Jepang</h5>
            <p class="card-text">Selamat datang di Restoran Kami. Rasakan pengalaman kuliner khas Jepang yang autentik
                dan menggugah selera. Kami menghadirkan
                hidangan terbaik yang disiapkan dengan bahan-bahan berkualitas dan keahlian tradisional.</p>
            <p class="card-text">Pesan sekarang dan biarkan kami membawa kebahagiaan ke meja Anda, satu hidangan lezat
                dalam satu waktu!</p>
            <a href="order" class="btn btn-primary">Buat Order</a>
        </div>
    </div>
    <!-- End Judul -->

</div>