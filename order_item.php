<?php
//koneksi ke database
include('proses/connect.php');


$nama_pelanggan = $_GET['nama_pelanggan'];
$kode_order = $_GET['order'];
$meja = $_GET['meja'];

$query = mysqli_query($conn, "SELECT *, SUM(tbl_list_order.jumlah * tbl_daftar_menu.harga) AS total, tbl_order.waktu_order FROM tbl_list_order
LEFT JOIN tbl_order ON tbl_list_order.id_order = tbl_order.id_order
LEFT JOIN tbl_daftar_menu ON tbl_list_order.id_menu = tbl_daftar_menu.id_menu
LEFT JOIN tbl_bayar ON tbl_order.id_order = tbl_bayar.id_bayar
GROUP BY tbl_list_order.id_list_order
HAVING tbl_list_order.id_order = '$_GET[order]'");
$result = [];
while ($row = mysqli_fetch_assoc($query)) {
  $result[] = $row;

}

$daftarMenu = mysqli_query($conn, "SELECT *, CONCAT(tbl_daftar_menu.nama_menu,' (',tbl_kategori_menu.jenis_menu,' - ',tbl_kategori_menu.kategori,')') AS daftar_menu FROM tbl_daftar_menu LEFT JOIN tbl_kategori_menu ON tbl_kategori_menu.id_kategori = tbl_daftar_menu.id_kategori");
$menus = [];
while ($menu = mysqli_fetch_assoc($daftarMenu)) {
  $menus[] = $menu;
}



?>


<div class="col-lg-9 mt-2 mb-5">
  <div class="card">
    <h5 class="card-header">Daftar Order Item</h5>
    <div class="card-body">
      <a class="btn btn-secondary mb-3" href="order"><i class="bi bi-arrow-left"></i></a>
      <div class="row">
        <div class="col-4">
          <h6 class="fw-bold">Nama Pelanggan : <?php echo $nama_pelanggan ?></h6>
          <h6 class="fw-bold">Kode Order : <?php echo $kode_order ?></h6>
          <h6 class="fw-bold">Meja : <?php echo $meja ?></h6>
        </div>

        <!-- Modal tambah -->
        <div class="modal fade" id="modalTambahMenuOrder" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg modal-fullscreen-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses/proses_input_order_item.php" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                <input type="hidden" name="nama_pelanggan" value="<?php echo $nama_pelanggan ?>">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="id_menu" required>
                          <option value="" hidden>Pilih Menu Makanan/Minuman</option>
                          <?php foreach ($menus as $menu) { ?>
                            <option value="<?php echo $menu['id_menu'] ?>">
                              <?php echo $menu['daftar_menu'] ?>
                            </option>
                          <?php } ?>
                        </select>
                        <label for="floatingInput">Menu Makanan/Minuman</label>
                        <div class="invalid-feedback">
                          Masukkan menu makanan/minuman.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="jumlah_porsi" required>
                        <label for="floatingInput">Jumlah Porsi</label>
                        <div class="invalid-feedback">
                          Masukkan jumlah porsi.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Password"
                          name="catatan">
                        <label for="floatingPassword">Catatan</label>
                        <div class="invalid-feedback">
                          Masukkan Catatan.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="tambah_order_item" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end modal tambah -->

        <!-- Modal edit -->
        <?php $i = 1; ?>
        <?php foreach ($result as $row) { ?>
          <div class="modal fade" id="modalEdit<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order Item</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses/proses_edit_order_item.php" method="POST" class="needs-validation" novalidate
                  enctype="multipart/form-data">
                  <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order'] ?>">
                  <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                  <input type="hidden" name="meja" value="<?php echo $meja ?>">
                  <input type="hidden" name="nama_pelanggan" value="<?php echo $nama_pelanggan ?>">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="form-floating mb-3">
                          <select class="form-select" aria-label="Default select example" name="id_menu">
                            <?php foreach ($menus as $menu) { ?>
                              <?php if ($row['id_menu'] == $menu['id_menu']) { ?>
                                <option selected value="<?php echo $menu['id_menu'] ?>">
                                  <?php echo $menu['daftar_menu'] ?>
                                </option>
                              <?php } else { ?>
                                <option value="<?php echo $menu['id_menu'] ?>">
                                  <?php echo $menu['daftar_menu'] ?>
                                </option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                          <label for="floatingInput">Menu Makanan/Minuman</label>
                          <div class="invalid-feedback">
                            Masukkan menu makanan/minuman.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com"
                            name="jumlah_porsi" value="<?php echo $row['jumlah'] ?>">
                          <label for="floatingInput">Jumlah Porsi</label>
                          <div class="invalid-feedback">
                            Masukkan jumlah porsi.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingPassword" placeholder="Password"
                            name="catatan" value="<?php echo $row['catatan'] ?>">
                          <label for="floatingPassword">Catatan</label>
                          <div class="invalid-feedback">
                            Masukkan Catatan.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit_order_item" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php $i++; ?>
        <?php } ?>
        <!-- end modal edit -->

        <!-- Modal delete -->
        <?php $i = 1; ?>
        <?php foreach ($result as $row) { ?>
          <div class="modal fade" id="modalDelete<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md modal-fullscreen-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Order Item</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses/proses_delete_order_item.php" method="POST" class="needs-validation" novalidate
                  enctype="multipart/form-data">
                  <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order'] ?>">
                  <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                  <input type="hidden" name="meja" value="<?php echo $meja ?>">
                  <input type="hidden" name="nama_pelanggan" value="<?php echo $nama_pelanggan ?>">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <p>Apakah anda yakin ingin menghapus order menu
                          <b><?php echo $row['nama_menu'] ?></b> ?
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="delete_order_item" class="btn btn-danger">Delete
                      Order Item</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php $i++; ?>
        <?php } ?>
        <!-- end modal delete -->

        <!-- Modal bayar -->
        <div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-fullscreen-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- tabel order item -->
                <?php if ($result) { ?>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr class="text-nowrap">
                          <th scope="col">No</th>
                          <th scope="col">Nama Menu</th>
                          <th scope="col">Harga Menu</th>
                          <th scope="col">Jumlah Order</th>
                          <th scope="col">Status</th>
                          <th scope="col">Catatan</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $total_harga = 0; ?>
                        <?php $i = 1; ?>
                        <?php foreach ($result as $row) { ?>
                          <th scope="row"><?php echo $i ?></th>
                          <td><?php echo $row['nama_menu'] ?></td>
                          <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                          <td><?php echo $row['jumlah'] ?></td>
                          <td>
                            <?php if ($row['status'] == NULL) { ?>
                              <span class="badge text-bg-secondary">Akan diproses</span>
                            <?php } else if ($row['status'] == 1) { ?>
                                <span class="badge text-bg-warning">Diterima dapur</span>
                            <?php } else if ($row['status'] == 2) { ?>
                                  <span class="badge text-bg-primary">Siap saji</span>
                            <?php } ?>
                          </td>
                          <td><?php echo $row['catatan'] ?></td>
                          <td><?php echo number_format($row['total'], 0, ',', '.') ?></td>
                          </tr>
                          <?php $total_harga += $row['total'] ?>
                          <?php $i++; ?>
                        <?php } ?>
                        <tr>
                          <td class="fw-bold" colspan="6">Total Harga</td>
                          <td class="fw-bold"><?php echo number_format($total_harga, 0, ',', '.'); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <?php } else { ?>
                  <p>Data menu makanan dan minuman tidak ada</p>
                <?php } ?>
                <!-- end tabel order item -->
                <p class="text-danger fw-semibold">Apakah anda yakin ingin melakukan pembayaran?</p>
                <form action="proses/proses_bayar.php" method="POST" class="needs-validation" novalidate
                  enctype="multipart/form-data">
                  <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                  <input type="hidden" name="meja" value="<?php echo $meja ?>">
                  <input type="hidden" name="nama_pelanggan" value="<?php echo $nama_pelanggan ?>">
                  <input type="hidden" name="total_harga" value="<?php echo $total_harga ?>">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="nominal_uang" required>
                        <label for="floatingInput">Nominal Uang</label>
                        <div class="invalid-feedback">
                          Masukkan nominal uang.
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end modal bayar -->

        <?php if ($result) { ?>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr class="text-nowrap">
                  <th scope="col">No</th>
                  <th scope="col">Nama Menu</th>
                  <th scope="col">Harga Menu</th>
                  <th scope="col">Jumlah Order</th>
                  <th scope="col">Status</th>
                  <th scope="col">Catatan</th>
                  <th scope="col">Total</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $total_harga = 0; ?>
                <?php $i = 1; ?>
                <?php foreach ($result as $row) { ?>
                  <th scope="row"><?php echo $i ?></th>
                  <td><?php echo $row['nama_menu'] ?></td>
                  <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                  <td><?php echo $row['jumlah'] ?></td>
                  <td>
                    <?php if ($row['status'] == NULL) { ?>
                      <span class="badge text-bg-secondary">Akan diproses</span>
                    <?php } else if ($row['status'] == 1) { ?>
                        <span class="badge text-bg-warning">Diterima dapur</span>
                    <?php } else if ($row['status'] == 2) { ?>
                          <span class="badge text-bg-primary">Siap saji</span>
                    <?php } ?>
                  </td>
                  <td><?php echo $row['catatan'] ?></td>
                  <td><?php echo number_format($row['total'], 0, ',', '.') ?></td>
                  <td>
                    <div class="d-flex">
                      <button
                        class="<?php echo (isset($row['id_bayar'])) ? "btn btn-secondary btn-sm me-1 disabled" : " btn btn-warning btn-sm me-1"; ?>"
                        data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $i ?>">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <button
                        class="<?php echo (isset($row['id_bayar'])) ? "btn btn-secondary btn-sm disabled" : " btn btn-danger btn-sm"; ?>"
                        data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $i ?>">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                  </tr>
                  <?php $total_harga += $row['total'] ?>
                  <?php $i++; ?>
                <?php } ?>
                <tr>
                  <td class="fw-bold" colspan="6">Total Harga</td>
                  <td class="fw-bold"><?php echo number_format($total_harga, 0, ',', '.'); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        <?php } else { ?>
          <p>Data menu makanan dan minuman tidak ada</p>
        <?php } ?>
      </div>
      <div class="row">
        <div class="col-12">
          <div>
            <button
              class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : " btn btn-success"; ?>"
              data-bs-toggle="modal" data-bs-target="#modalTambahMenuOrder">
              <i class="bi bi-plus-circle"></i> Item
            </button>
            <button
              class="<?php echo (!empty($row['id_bayar']) || empty($result)) ? "btn btn-secondary disabled" : " btn btn-success"; ?>"
              data-bs-toggle="modal" data-bs-target="#modalBayar">
              <i class="bi bi-cash-coin"></i> Bayar
            </button>
            <button
              class="<?php echo (empty($row['id_bayar']) || empty($result)) ? "btn btn-secondary disabled" : " btn btn-info"; ?> text-white"
              onclick="printStruk()">
              <i class="bi bi-printer"></i> Cetak Struk
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- membuat struck pembayaran -->
  <div id="strukContent" class="d-none">
    <style>
      .struk {
        font-family: "arial", sans-serif;
        font-size: 12px;
        border: 1px solid #ccc;
        padding: 10px;
      }

      .struk p,
      .struk.kembalian {
        margin: 5px 0;
      }

      .struk h2 {
        text-align: center;
      }

      .struk table {
        margin: 8px 0;
        width: 100%;
        border: 1px solid #ccc;
        font-size: 12px;
      }

      .struk table td,
      .struk table th {
        border: 1px solid #ccc;
        text-wrap: none;
      }

      .struk .kembalian .tabelKembalian {
        border: none;
        width: 100%;
        font-size: 12px;
      }

      .struk .kembalian .tabelKembalian td,
      .struk .kembalian .tabelKembalian th {
        border: none;
        text-wrap: none;
      }

      .ucapan {
        font-size: 12px;
        text-align: center;
        margin: 10px 0;
      }
    </style>
    <div class="struk">
      <h2>Struk Pembayaran Cafee</h2>
      <p>Kode Order: <?php echo $kode_order ?></p>
      <p>Pelanggan: <?php echo $nama_pelanggan ?></p>
      <p>Meja: <?php echo $meja ?></p>
      <p>Waktu Order: <?php echo date('d/m/Y H:i:s', strtotime($result[0]['waktu_order'])) ?></p>

      <table class="table table-hover border-1" cellpadding="5" cellspacing="0">
        <thead>
          <tr class="text-nowrap">
            <th scope="col">No</th>
            <th scope="col">Nama Menu</th>
            <th scope="col">Harga Menu</th>
            <th scope="col">Jumlah Order</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php $total_harga = 0; ?>
          <?php $i = 1; ?>
          <?php foreach ($result as $row) { ?>
            <th scope="row"><?php echo $i ?></th>
            <td><?php echo $row['nama_menu'] ?></td>
            <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
            <td><?php echo $row['jumlah'] ?></td>
            <td><?php echo number_format($row['total'], 0, ',', '.') ?></td>
            </tr>
            <?php $total_harga += $row['total'] ?>
            <?php $i++; ?>
          <?php } ?>
          <tr>
            <td class="fw-bold" colspan="4">Total Harga</td>
            <td class="fw-bold"><?php echo number_format($total_harga, 0, ',', '.'); ?></td>
          </tr>
        </tbody>
      </table>
      <div class="kembalian">
        <table class="tabelKembalian">
          <tr>
            <td>Total order</td>
            <td>: Rp<?php echo number_format($total_harga, 0, ',', '.'); ?></td>
          </tr>
          <tr>
            <td>Nominal uang yang diterima</td>
            <td>: Rp<?php echo number_format($row['nominal_uang'], 0, ',', '.'); ?></td>
          </tr>
          <tr>
            <td>Nominal kemabalian</td>
            <td>: Rp<?php echo number_format($row['kembalian'], 0, ',', '.'); ?></td>
          </tr>
        </table>
      </div>
      <div class="ucapan">
        <p>Selamat Menikmati Pesanan Anda</p>
        <p>Terima kasih.</p>
      </div>
    </div>
  </div>

  <script>
    function printStruk() {
      var strukContent = document.getElementById("strukContent").innerHTML;

      var printFrame = document.createElement('iframe');
      printFrame.style.display = 'none';
      document.body.appendChild(printFrame);
      printFrame.contentDocument.write(strukContent);
      printFrame.contentWindow.print();
      document.body.removeChild(printFrame);
    }
  </script>









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