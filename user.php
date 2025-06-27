<?php
//koneksi ke database
include('proses/connect.php');

$query = mysqli_query($conn, "SELECT * FROM tbl_user");
$users = [];
while ($user = mysqli_fetch_assoc($query)) {
  $users[] = $user;
}


?>


<div class="col-lg-9 mt-2 mb-5">
  <div class="card">
    <h5 class="card-header">Halaman User</h5>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah User</button>
        </div>
      </div>

      <!-- Modal tambah user -->
      <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/proses_input_user.php" method="POST" class="needs-validation" novalidate
              enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="file" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="gambar" required>
                      <label for="floatingInput">Upload gambar</label>
                      <div class="invalid-feedback">
                        Upload gambar.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="nama" required>
                      <label for="floatingInput">Nama</label>
                      <div class="invalid-feedback">
                        Masukkan Nama.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="username" required>
                      <label for="floatingInput">Username/Email</label>
                      <div class="invalid-feedback">
                        Masukkan username/email.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Default select example" name="level" required>
                        <option value="" hidden>Pilih Level user</option>
                        <option value="1">Owner/Admin</option>
                        <option value="2">Kasir</option>
                        <option value="3">Pelayan</option>
                        <option value="4">Dapur</option>
                      </select>
                      <label for="floatingInput">Level user</label>
                      <div class="invalid-feedback">
                        Pilih level user.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="nohp" required>
                      <label for="floatingInput">No Hp</label>
                      <div class="invalid-feedback">
                        Masukkan no hp.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" name="alamat" id="" style="height:100px;" name="alamat"
                    required></textarea>
                  <label for="floatinginput">Alamat</label>
                  <div class="invalid-feedback">
                    Masukkan alamat.
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    name="password" required>
                  <label for="floatingPassword">Password</label>
                  <div class="invalid-feedback">
                    Masukkan password.
                  </div>
                </div>
                <div class="form-floating">
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    name="password2" required>
                  <label for="floatingPassword">Konfirmasi Password</label>
                  <div class="invalid-feedback">
                    Masukkan Konfirmasi password.
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="tambah_user" class="btn btn-primary">Tambah user</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- end modal tambah user -->

      <!-- Modal view -->
      <?php $i = 1; ?>
      <?php foreach ($users as $user) { ?>
        <div class="modal fade" id="modalView<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body d-flex justify-content-center">
                <!-- card -->
                <div class="card mb-3 overflow-auto" style="width: 80%;">
                  <div class="row g-0">
                    <div class="col-lg-4 text-center p-5">
                      <img src="assets/img/user/<?php echo $user['gambar'] ?>"
                        class="img-fluid rounded-start img-thumbnail" alt="foto" style="width=: 100%; height: 100%;">
                    </div>
                    <div class=" col-lg-8">
                      <div class="card-body">
                        <div class="row mb-1">
                          <div class="col">
                            <h5 class="card-title text-center"><b>Data User <?php echo $user['nama'] ?></b></h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <table class="table table-borderless">
                              <tr>
                                <th>ID</th>
                                <td>:</td>
                                <td><?php echo $user['id'] ?></td>
                              </tr>
                              <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td><?php echo $user['nama'] ?></td>
                              </tr>
                              <tr>
                                <th>Username/Email</th>
                                <td>:</td>
                                <td><?php echo $user['username'] ?></td>
                              </tr>
                              <tr>
                                <th>Level</th>
                                <td>:</td>
                                <td>
                                  <?php
                                  if ($user['level'] == 1) {
                                    echo 'Owner/Admin';
                                  } else if ($user['level'] == 2) {
                                    echo 'Kasir';
                                  } else if ($user['level'] == 3) {
                                    echo 'Pelayan';
                                  } else if ($user['level'] == 4) {
                                    echo 'Dapur';
                                  }
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <th>Nomor HP</th>
                                <td>:</td>
                                <td><?php echo $user['nohp'] ?></td>
                              </tr>
                              <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td><?php echo $user['alamat'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end card -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- end modal view -->
        <?php $i++; ?>
      <?php } ?>

      <!-- Modal edit -->
      <?php $i = 1; ?>
      <?php foreach ($users as $user) { ?>
        <div class="modal fade" id="modaledit<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User <?php echo $user['nama'] ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses/proses_edit_user.php" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <input type="hidden" name="gambarLama" value="<?php echo $user['gambar'] ?>">
                <div class="modal-body">
                  <div class="row">
                    <div class="col d-flex justify-content-center">
                      <img src="assets/img/user/<?php echo $user['gambar'] ?>" alt="foto" width="150px" height="150px"
                        class="mb-3 img-thumbnail">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="gambar">
                        <label for="floatingInput">Upload gambar</label>
                        <div class="invalid-feedback">
                          Upload gambar.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="nama" value="<?php echo $user['nama'] ?>" required>
                        <label for="floatingInput">Nama</label>
                        <div class="invalid-feedback">
                          Masukkan Nama.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="username" value="<?php echo $user['username'] ?>" <?php echo ($user['username'] == $_SESSION['username']) ? 'readonly' : ''; ?> required>
                        <label for="floatingInput">Username/Email</label>
                        <div class="invalid-feedback">
                          Masukkan username/email.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="level" required>
                          <?php
                          $data = ["1" => "Owner/Admin", "2" => "Kasir", "3" => "Pelayan", "4" => "Dapur"];
                          foreach ($data as $key => $value) {

                            if ($user['level'] == $key) {
                              echo "<option selected value='$key'>$value</option>";
                            } else {
                              echo "<option value='$key'>$value</option>";
                            }
                          }
                          ?>
                        </select>
                        <label for="floatingInput">Level user</label>
                        <div class="invalid-feedback">
                          Pilih level user.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                          name="nohp" value="<?php echo $user['nohp'] ?>" required>
                        <label for="floatingInput">No hp</label>
                        <div class="invalid-feedback">
                          Masukkan no hp.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-floating mb-3">
                    <textarea class="form-control" name="alamat" id="" style="height:100px;" name="alamat"
                      value="<?php echo $user['alamat'] ?>" required><?php echo $user['alamat'] ?></textarea>
                    <label for="floatinginput">Alamat</label>
                    <div class="invalid-feedback">
                      Masukkan alamat.
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="edit_user" class="btn btn-primary">Edit Data User</button>
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
      <?php foreach ($users as $user) { ?>
        <div class="modal fade" id="modalDelete<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-md modal-fullscreen-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="proses/proses_delete_user.php" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <input type="hidden" name="gambarLama" value="<?php echo $user['gambar'] ?>">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <!-- cek agar user tidak bisa hapus akunnya sendiri -->
                      <?php if ($user['username'] == $_SESSION['username']) { ?>
                        <div class="alert alert-danger">Anda tidak dapat menghapus akun sendiri</div>
                      <?php } else { ?>
                        <p>Apakah anda yakin ingin menghapus user <b><?php echo $user['nama'] ?></b> ?</p>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <!-- pada saat user ingin menghapus akunya sendiri maka tombol deletenya jadi disabled -->
                  <button type="submit" name="delete_user" class="btn btn-danger" <?php echo ($user['username'] == $_SESSION['username']) ? 'disabled' : ''; ?>>Delete User</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php $i++; ?>
      <?php } ?>
      <!-- end modal delete -->

      <div class="table-responsive" id="container">
        <table class="table table-hover" id="example">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Username</th>
              <th scope="col">No Hp</th>
              <th scope="col">Level</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($users as $user) { ?>
              <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo $user['nama'] ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['nohp'] ?></td>
                <td>
                  <?php
                  if ($user['level'] == 1) {
                    echo 'Owner/Admin';
                  } else if ($user['level'] == 2) {
                    echo 'Kasir';
                  } else if ($user['level'] == 3) {
                    echo 'Pelayan';
                  } else if ($user['level'] == 4) {
                    echo 'Dapur';
                  }
                  ;
                  ?>
                </td>
                <td class="d-flex">
                  <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                    data-bs-target="#modalView<?php echo $i ?>">
                    <i class="bi bi-eye"></i>
                  </button>
                  <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                    data-bs-target="#modaledit<?php echo $i ?>">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalDelete<?php echo $i ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
              <?php $i++; ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
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