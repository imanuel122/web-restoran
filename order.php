<?php
//koneksi ke database
include('proses/connect.php');

//set waktu indonesia
date_default_timezone_set('Asia/Jakarta');

$query = mysqli_query($conn, "SELECT tbl_order.*, tbl_user.*, tbl_bayar.*, SUM(harga*jumlah) as total_harga FROM tbl_order 
LEFT JOIN tbl_user ON tbl_order.id = tbl_user.id
LEFT JOIN tbl_list_order ON tbl_list_order.id_order = tbl_order.id_order
LEFT JOIN tbl_daftar_menu ON tbl_list_order.id_menu = tbl_daftar_menu.id_menu
LEFT JOIN tbl_bayar ON tbl_order.id_order = tbl_bayar.id_bayar
GROUP BY id_order
ORDER BY waktu_order DESC");
$result = [];
while ($row = mysqli_fetch_assoc($query)) {
  $result[] = $row;
}

$kat_menu = mysqli_query($conn, "SELECT * FROM tbl_kategori_menu");
$kat_menu_dbs = [];
while ($kat_menu_db = mysqli_fetch_assoc($kat_menu)) {
  $kat_menu_dbs[] = $kat_menu_db;
}



?>


<div class="col-lg-9 mt-2 mb-5">
  <div class="card">
    <h5 class="card-header">Daftar Order</h5>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahOrder">Tambah
            Order</button>
        </div>
      </div>

      <!-- Modal tambah  -->
      <div class="modal fade" id="modalTambahOrder" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order Makanan dan Minuman</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/proses_input_order.php" method="POST" class="needs-validation" novalidate
              enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="kode_order" value="<?php echo date('ymdHi') . rand(100, 999) ?>" readonly>
                      <label for="floatingInput">Kode Order</label>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="meja" required>
                      <label for="floatingInput">Meja</label>
                      <div class="invalid-feedback">
                        Masukkan nomor meja.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="nama_pelanggan" required>
                      <label for="floatingInput">Nama Pelanggan</label>
                      <div class="invalid-feedback">
                        Masukkan nama pelanggan.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="buat_order" class="btn btn-primary">Buat Order</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- end modal tambah  -->

      <!-- Modal edit -->
      <?php $i = 1; ?>
      <?php foreach ($result as $row) { ?>
        <div class="modal fade" id="modalEdit<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses/proses_edit_order.php" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="kode_order" value="<?php echo $row['id_order'] ?>" readonly>
                        <label for="floatingInput">Kode Order</label>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="meja" value="<?php echo $row['meja'] ?>">
                        <label for="floatingInput">Meja</label>
                        <div class="invalid-feedback">
                          Masukkan nomor meja.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="nama_pelanggan" value="<?php echo $row['pelanggan'] ?>">
                        <label for="floatingInput">Nama Pelanggan</label>
                        <div class="invalid-feedback">
                          Masukkan nama pelanggan.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="edit_order" class="btn btn-primary">Edit Order</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses/proses_delete_order.php" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                <input type="hidden" name="id_order" value="<?php echo $row['id_order'] ?>">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <p>Apakah anda yakin ingin menghapus order atas nama
                        <b><?php echo $row['pelanggan'] ?></b> dengan kode order <b><?php echo $row['id_order'] ?></b>?
                      </p>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="delete_order" class="btn btn-danger">Delete
                    Order</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php $i++; ?>
      <?php } ?>
      <!-- end modal delete -->

      <?php if ($result) { ?>
        <div class="table-responsive">
          <table class="table table-hover" id="example">
            <thead>
              <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Kode Order</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Meja</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Pelayan</th>
                <th scope="col">Status</th>
                <th scope="col">Waktu Order</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($result as $row) { ?>
                <tr>
                  <th scope="row"><?php echo $i ?></th>
                  <td><?php echo $row['id_order'] ?></td>
                  <td><?php echo $row['pelanggan'] ?></td>
                  <td><?php echo $row['meja'] ?></td>
                  <td><?php echo number_format($row['total_harga'], 0, ',', '.') ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo (isset($row['id_bayar'])) ? "<span class='badge text-bg-success'>Lunas</span>" : ""; ?>
                  </td>
                  <td><?php echo $row['waktu_order'] ?></td>
                  <td>
                    <div class="d-flex">
                      <a class="btn btn-info btn-sm me-1"
                        href="./?x=orderitem&order=<?php echo $row['id_order'] ?>&nama_pelanggan=<?php echo $row['pelanggan'] ?>&meja=<?php echo $row['meja'] ?>">
                        <i class="bi bi-eye"></i>
                      </a>
                      <button
                        class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-1 disabled" : " btn btn-warning btn-sm me-1"; ?>"
                        data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $i ?>">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <button
                        class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm disabled" : " btn btn-danger btn-sm"; ?>"
                        data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $i ?>">
                        <i class="bi bi-trash"></i>
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
        <p>Data order menu belum ada</p>
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