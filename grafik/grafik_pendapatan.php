<?php
//koneksi ke database
include('proses/connect.php');

//set waktu indonesia
date_default_timezone_set('Asia/Jakarta');

// ambil data menu dari database untuk chart
$query = "SELECT tbl_order.tanggal_order, SUM(tbl_daftar_menu.harga * tbl_list_order.jumlah) AS pendapatan_pertanggal
FROM tbl_list_order
LEFT JOIN tbl_daftar_menu ON tbl_list_order.id_menu = tbl_daftar_menu.id_menu
LEFT JOIN tbl_order ON tbl_list_order.id_order = tbl_order.id_order
GROUP BY tbl_order.tanggal_order
ORDER BY tbl_order.tanggal_order ASC";
$data_pendapatan_pertanggal = mysqli_query($conn, $query);
$charts = [];
while ($chart = mysqli_fetch_assoc($data_pendapatan_pertanggal)) {
    $charts[] = $chart;
}

// mebuat array tanggal
$array_tanggal = array_column($charts, 'tanggal_order');
$array_tanggal_qoute = array_map(function ($tanggal) {
    return "'" . $tanggal . "'";
}, $array_tanggal);
$string_tanggal = implode(',', $array_tanggal_qoute);

// mebuat array jumlah 
$array_jumlah_pendapatan_pertanggal = array_column($charts, 'pendapatan_pertanggal');
$string_jumlah_pendapatan_pertanggal = implode(',', $array_jumlah_pendapatan_pertanggal);

?>

<!-- cdn chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- end cdn chart -->

<!-- Chart -->
<div class="card border-0 bg-light">
    <h4>Grafik Pendapatan</h4>
    <div class="card-body text-center">
        <div style="height: 300px; width: 100%;">
            <canvas id="grafikpendapatan"></canvas>
        </div>

        <script>
            const ctxPendapatan = document.getElementById('grafikpendapatan');

            new Chart(ctxPendapatan, {
                type: 'bar',
                data: {
                    labels: [<?php echo $string_tanggal ?>],
                    datasets: [{
                        label: '# Pendapatan Pertanggal',
                        data: [<?php echo $string_jumlah_pendapatan_pertanggal ?>],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(245, 39, 102, 0.45)',
                            'rgba(0, 57, 239, 0.45)',
                            'rgba(228, 236, 0, 0.45)',
                            'rgba(37, 236, 0, 0.45)',
                            'rgba(145, 0, 236, 0.45)',
                            'rgba(236, 169, 0, 0.45)'
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
    $total_pendapatan_keseluruhan = 0;
    foreach ($charts as $chart) {
        $total_pendapatan_keseluruhan += $chart['pendapatan_pertanggal'];
    }
    ?>
    <p class="fw-semibold">Total Pendapatan Keseluruhan :
        Rp<?php echo number_format($total_pendapatan_keseluruhan, 0, ',', '.') ?>
    </p>
</div>
<!-- End Chart -->