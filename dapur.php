<?php
//koneksi ke database
include('proses/connect.php');


$query = mysqli_query($conn, "SELECT * FROM tbl_list_order
LEFT JOIN tbl_order ON tbl_list_order.id_order = tbl_order.id_order
LEFT JOIN tbl_daftar_menu ON tbl_list_order.id_menu = tbl_daftar_menu.id_menu
LEFT JOIN tbl_bayar ON tbl_order.id_order = tbl_bayar.id_bayar
HAVING tbl_list_order.status != 2
ORDER BY waktu_order ASC");
$result = [];
while ($row = mysqli_fetch_assoc($query)) {
  $result[] = $row;

}

$daftarMenu = mysqli_query($conn, "SELECT * FROM tbl_daftar_menu");
$menus = [];
while ($menu = mysqli_fetch_assoc($daftarMenu)) {
  $menus[] = $menu;
}



?>


<div class="col-lg-9 mt-2 mb-5">
  <div class="card">
    <h5 class="card-header">Dapur</h5>
    <div class="card-body">
      <div class="row">

        <!-- Modal terima -->
        <?php $i = 1; ?>
        <?php foreach ($result as $row) { ?>
          <div class="modal fade" id="modalTerima<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Orderan Menu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses/proses_terima_order_item.php" method="POST" class="needs-validation" novalidate
                  enctype="multipart/form-data">
                  <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order'] ?>">
                  <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                  <input type="hidden" name="meja" value="<?php echo $meja ?>">
                  <input type="hidden" name="nama_pelanggan" value="<?php echo $nama_pelanggan ?>">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="form-floating mb-3">
                          <select class="form-select" aria-label="Default select example" name="id_menu" disabled>
                            <?php foreach ($menus as $menu) { ?>
                              <?php if ($row['id_menu'] == $menu['id_menu']) { ?>
                                <option selected value="<?php echo $menu['id_menu'] ?>">
                                  <?php echo $menu['nama_menu'] ?>
                                </option>
                              <?php } else { ?>
                                <option value="<?php echo $menu['id_menu'] ?>">
                                  <?php echo $menu['nama_menu'] ?>
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
                            name="jumlah_porsi" value="<?php echo $row['jumlah'] ?>" disabled>
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
                            name="catatan" value="<?php echo $row['catatan'] ?>" disabled>
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
                    <button type="submit" name="terima_order_item" class="btn btn-primary">Terima Orderan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php $i++; ?>
        <?php } ?>
        <!-- end modal terima -->

        <!-- Modal siap saji -->
        <?php $i = 1; ?>
        <?php foreach ($result as $row) { ?>
          <div class="modal fade" id="modalSiapSaji<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Siap Saji Orderan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses/proses_siap_saji_order_item.php" method="POST" class="needs-validation" novalidate
                  enctype="multipart/form-data">
                  <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order'] ?>">
                  <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                  <input type="hidden" name="meja" value="<?php echo $meja ?>">
                  <input type="hidden" name="nama_pelanggan" value="<?php echo $nama_pelanggan ?>">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="form-floating mb-3">
                          <select class="form-select" aria-label="Default select example" name="id_menu" disabled>
                            <?php foreach ($menus as $menu) { ?>
                              <?php if ($row['id_menu'] == $menu['id_menu']) { ?>
                                <option selected value="<?php echo $menu['id_menu'] ?>">
                                  <?php echo $menu['nama_menu'] ?>
                                </option>
                              <?php } else { ?>
                                <option value="<?php echo $menu['id_menu'] ?>">
                                  <?php echo $menu['nama_menu'] ?>
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
                            name="jumlah_porsi" value="<?php echo $row['jumlah'] ?>" disabled>
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
                            name="catatan" value="<?php echo $row['catatan'] ?>" disabled>
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
                    <button type="submit" name="siap_saji_order_item" class="btn btn-primary">Siap Saji</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php $i++; ?>
        <?php } ?>
        <!-- end modal siap saji -->

        <?php if ($result) { ?>
          <div class="table-responsive">
            <table class="table table-hover" id="example">
              <thead>
                <tr class="text-nowrap">
                  <th scope="col">No</th>
                  <th scope="col">Kode Order</th>
                  <th scope="col">Waktu Order</th>
                  <th scope="col">Nama Menu</th>
                  <th scope="col">Harga Menu</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Catatan</th>
                  <th scope="col">Status</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($result as $row) { ?>
                  <th scope="row"><?php echo $i ?></th>
                  <td><?php echo $row['id_order'] ?></td>
                  <td><?php echo $row['waktu_order'] ?></td>
                  <td><?php echo $row['nama_menu'] ?></td>
                  <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                  <td><?php echo $row['jumlah'] ?></td>
                  <td><?php echo $row['catatan'] ?></td>
                  <td>
                    <?php if ($row['status'] == NULL) { ?>
                      <span class="badge text-bg-secondary">Akan diproses</span>
                    <?php } else if ($row['status'] == 1) { ?>
                        <span class="badge text-bg-warning">Diterima dapur</span>
                    <?php } else if ($row['status'] == 2) { ?>
                          <span class="badge text-bg-primary">Siap saji</span>
                    <?php } ?>
                  </td>
                  <td>
                    <div class="d-flex">
                      <button
                        class="<?php echo (!empty($row['status'])) ? "btn btn-secondary btn-sm me-1 disabled" : " btn btn-primary btn-sm me-1"; ?>"
                        data-bs-toggle="modal" data-bs-target="#modalTerima<?php echo $i ?>">
                        Terima
                      </button>
                      <button
                        class="<?php echo (empty($row['status']) || $row['status'] != 1) ? "btn btn-secondary btn-sm disabled" : " btn btn-success btn-sm"; ?> text-nowrap"
                        data-bs-toggle="modal" data-bs-target="#modalSiapSaji<?php echo $i ?>">
                        Siap Saji
                      </button>
                    </div>
                  </td>
                  </tr>
                  <?php $i++; ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } else { ?>
          <p>Data menu makanan dan minuman yang dipesan belum ada</p>
        <?php } ?>
      </div>
    </div>
  </div>

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