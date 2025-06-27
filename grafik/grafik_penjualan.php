<?php
//koneksi ke database
include('proses/connect.php');

//set waktu indonesia
date_default_timezone_set('Asia/Jakarta');

// ambil data menu dari database untuk chart
$query = "SELECT tbl_daftar_menu.id_menu, tbl_daftar_menu.nama_menu, SUM(tbl_list_order.jumlah) AS jumlah_penjualan 
FROM tbl_daftar_menu LEFT JOIN tbl_list_order ON tbl_list_order.id_menu = tbl_daftar_menu.id_menu
GROUP BY tbl_daftar_menu.id_menu
ORDER BY tbl_daftar_menu.id_menu ASC";
$data_menu = mysqli_query($conn, $query);
$charts = [];
while ($chart = mysqli_fetch_assoc($data_menu)) {
    $charts[] = $chart;
}

// mebuat array menunya memiliki tanda petik satu dan koma di setiap menu
$array_menu = array_column($charts, 'nama_menu');
$array_menu_qoute = array_map(function ($menu) {
    return "'" . $menu . "'";
}, $array_menu);
$string_menu = implode(',', $array_menu_qoute);

// mebuat array jumlah pembelianya memiliki tanda  koma di setiap jumlahnya
$array_jumlah_pembelian = array_column($charts, 'jumlah_penjualan');
$string_jumlah_pembelian = implode(',', $array_jumlah_pembelian);

?>

<!-- cdn chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- end cdn chart -->

<!-- Chart -->
<div class="card border-0 bg-light">
    <h4>Grafik Penjualan</h4>
    <div class="card-body text-center">
        <div style="height: 300px; width: 100%;">
            <canvas id="grafikpenjualan"></canvas>
        </div>

        <script>
            const ctxPenjualan = document.getElementById('grafikpenjualan');

            new Chart(ctxPenjualan, {
                type: 'doughnut',
                data: {
                    labels: [<?php echo $string_menu ?>],
                    datasets: [{
                        label: '# Jumlah Porsi Terjual',
                        data: [<?php echo $string_jumlah_pembelian ?>],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(245, 39, 102, 0.45)',
                            'rgba(0, 57, 239, 0.45)',
                            'rgba(228, 236, 0, 0.45)',
                            'rgba(37, 236, 0, 0.45)',
                            'rgba(145, 0, 236, 0.45)',
                            'rgba(236, 169, 0, 0.45)',
                            'rgba(255, 26, 26, 0.8)',
                            'rgba(26, 48, 255, 0.8)',
                            'rgba(248, 255, 40, 0.8)',
                            'rgba(23, 255, 30, 0.8)',
                            'rgba(170, 9, 240, 0.8)',
                            'rgba(255, 148, 5, 0.8)',
                            'rgba(165, 19, 19, 1)',
                            'rgba(0, 146, 165, 1)',
                            'rgba(255, 253, 23, 1)',
                            'rgba(0, 255, 8, 1)',
                            'rgba(210, 0, 255, 1)',
                            'rgba(255, 88, 0, 1)',
                            'rgba(255, 38, 38, 0.61)',
                            'rgba(131, 255, 249, 0.61)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    <?php
    $total_penjualan = 0;
    foreach ($charts as $chart) {
        $total_penjualan += $chart['jumlah_penjualan'];
    }
    ?>
    <p class="fw-semibold">Total Penjualan Keseluruhan :
        <?php echo number_format($total_penjualan, 0, ',', '.') ?>
        porsi
    </p>
</div>
<!-- End Chart -->