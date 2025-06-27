<?php
//koneksi ke database
include('proses/connect.php');

//set waktu indonesia
date_default_timezone_set('Asia/Jakarta');

// ambil data menu dari database untuk chart
$query = "SELECT tbl_order.tanggal_order, SUM(tbl_daftar_menu.harga * tbl_list_order.jumlah) AS jumlah_pembayaran
FROM tbl_order
LEFT JOIN tbl_list_order ON tbl_list_order.id_order = tbl_order.id_order
LEFT JOIN tbl_daftar_menu ON tbl_list_order.id_menu = tbl_daftar_menu.id_menu
JOIN tbl_bayar ON tbl_order.id_order = tbl_bayar.id_bayar
GROUP BY tbl_order.tanggal_order  
ORDER BY `tbl_bayar`.`tanggal_bayar` ASC;";
$data_pembayaran = mysqli_query($conn, $query);
$charts = [];
while ($chart = mysqli_fetch_assoc($data_pembayaran)) {
    $charts[] = $chart;
}

// mebuat array tanggal
$array_tanggal = array_column($charts, 'tanggal_order');
$array_tanggal_qoute = array_map(function ($tanggal) {
    return "'" . $tanggal . "'";
}, $array_tanggal);
$string_tanggal = implode(',', $array_tanggal_qoute);

// mebuat array jumlah
$array_jumlah_pembayaran = array_column($charts, 'jumlah_pembayaran');
$string_jumlah_pembayaran = implode(',', $array_jumlah_pembayaran);

?>

<!-- cdn chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- end cdn chart -->

<!-- Chart -->
<div class="card mt-4 border-0 bg-light">
    <h4>Grafik Pembayaran</h4>
    <div class="card-body text-center">
        <div style="height: 250px; width: 100%;">
            <canvas id="grafikpembayaran"></canvas>
        </div>

        <script>
            const ctxPembayaran = document.getElementById('grafikpembayaran');

            new Chart(ctxPembayaran, {
                data: {
                    labels: [<?php echo $string_tanggal ?>],
                    datasets: [{
                        type: 'bar',
                        label: '# Pembayaran Lunas Pertanggal',
                        data: [<?php echo $string_jumlah_pembayaran ?>],
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
    $total_pembayaran = 0;
    foreach ($charts as $chart) {
        $total_pembayaran += $chart['jumlah_pembayaran'];
    }
    ?>
    <p class="fw-semibold">Total Pembayaran Lunas Keseluruhan:
        Rp<?php echo number_format($total_pembayaran, 0, ',', '.') ?>
    </p>
    <p class="fw-semibold">Total Pembayaran yang Belum Lunas Keseluruhan :
        Rp<?php echo number_format(($total_pendapatan_keseluruhan - $total_pembayaran), 0, ',', '.') ?>
    </p>
</div>
<!-- End Chart -->