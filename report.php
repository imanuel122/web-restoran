<?php
//koneksi ke database
include('proses/connect.php');

//set waktu indonesia
date_default_timezone_set('Asia/Jakarta');

$query = mysqli_query($conn, "SELECT tbl_order.*, tbl_user.*, tbl_bayar.*, SUM(harga*jumlah) as total_harga FROM tbl_order 
LEFT JOIN tbl_user ON tbl_order.id = tbl_user.id
LEFT JOIN tbl_list_order ON tbl_list_order.id_order = tbl_order.id_order
LEFT JOIN tbl_daftar_menu ON tbl_list_order.id_menu = tbl_daftar_menu.id_menu
JOIN tbl_bayar ON tbl_order.id_order = tbl_bayar.id_bayar
GROUP BY id_order
ORDER BY waktu_order DESC");
$result = [];
while ($row = mysqli_fetch_assoc($query)) {
  $result[] = $row;
}

?>

<div class="col-lg-9 mt-2 mb-5">
  <div class="card">
    <h5 class="card-header">Report</h5>
    <div class="card-body">

      <!-- collapse grafik peenjualan dan pendapatan  -->
      <div class="row mb-4 gx-4 gy-4">
        <div class="col-md-12">
          <div>
            <div class="card card-body">
              <?php include $grafik_penjualan; ?>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div>
            <div class="card card-body">
              <?php include $grafik_pendapatan; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- end collapse grafik peenjualan dan pendapatan  -->

      <!-- tabel pembayaran -->
      <div class="row">
        <div class="col">
          <h4>Tabel Pembayaran</h4>
          <?php if ($result) { ?>
            <div class="table-responsive">
              <table class="table table-hover" id="example">
                <thead>
                  <tr class="text-nowrap">
                    <th scope="col">No</th>
                    <th scope="col">Kode Order</th>
                    <th scope="col">Waktu Order</th>
                    <th scope="col">Waktu Bayar</th>
                    <th scope="col">Pelanggan</th>
                    <th scope="col">Meja</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Pelayan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($result as $row) { ?>
                    <tr>
                      <th scope="row"><?php echo $i ?></th>
                      <td><?php echo $row['id_order'] ?></td>
                      <td><?php echo $row['waktu_order'] ?></td>
                      <td><?php echo $row['waktu_bayar'] ?></td>
                      <td><?php echo $row['pelanggan'] ?></td>
                      <td><?php echo $row['meja'] ?></td>
                      <td><?php echo number_format($row['total_harga'], 0, ',', '.') ?></td>
                      <td><?php echo $row['nama'] ?></td>
                      <td>
                        <div class="d-flex">
                          <a class="btn btn-info btn-sm me-1"
                            href="./?x=viewitem&order=<?php echo $row['id_order'] ?>&nama_pelanggan=<?php echo $row['pelanggan'] ?>&meja=<?php echo $row['meja'] ?>">
                            <i class="bi bi-eye"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } else { ?>
            <p>Data order menu belum ada</p>
          <?php } ?>
        </div>
      </div>
      <!-- end tabel pembayaran -->




      <!--collapse grafik pembayaran  -->
      <div class="row mb-2">
        <div class="col">
          <button class="btn btn-primary mt-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsegrafikpembayaran" aria-expanded="false" aria-controls="collapseExample">
            Grafik Pembayaran<i class="bi bi-chevron-down"></i>
          </button>
          <div class="collapse" id="collapsegrafikpembayaran">
            <div class="card card-body">
              <?php include $grafik_pembayaran; ?>
            </div>
          </div>
        </div>
      </div>
      <!--end collapse grafik pembayaran  -->





    </div>