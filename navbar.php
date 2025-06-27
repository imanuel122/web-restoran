<?php
//koneksi ke database
include('proses/connect.php');

$query = mysqli_query($conn, "SELECT * FROM tbl_user");
$users = [];
while ($user = mysqli_fetch_assoc($query)) {
    $users[] = $user;
}


?>


<nav class="navbar navbar-expand navbar-dark bg-primary sticky-top">
    <div class="container-lg">
        <a class="navbar-brand d-flex" href=".">
            <div class="">
                <p class="">Hikari Kitchen</p>
                <hr class="" style="margin-top: -20px;">
                <p class="text-align ms-2" style="margin-top: -19px; margin-bottom:0px; font-size:15px;">ひかりキッチン</p>
            </div>
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown d-flex">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="d-inline-block">
                            <img src="assets/img/user/<?php echo $result['gambar']; ?>" alt="" width="100%"
                                height="40px" style="border-radius: 50%; border: 1px solid #FFF">
                        </div>
                        <?php echo $result['nama']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalubahprofile">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#modalubahpassword">
                                <i class="bi bi-key"></i> Ubah Paswword
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal ubah password -->
<div class="modal fade" id="modalubahpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/proses_ubah_password.php" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="username"
                                    value="<?php echo $_SESSION['username']; ?>" disabled>
                                <label for="floatingInput">Username/Email</label>
                                <div class="invalid-feedback">
                                    Masukkan username/email.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="passwordLama" required>
                        <label for="floatingPassword">Password Lama</label>
                        <div class="invalid-feedback">
                            Masukkan password lama.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="passwordBaru" required>
                        <label for="floatingPassword">Password Baru</label>
                        <div class="invalid-feedback">
                            Masukkan password baru.
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="passwordBaru2" required>
                        <label for="floatingPassword">Konfirmasi Password Baru</label>
                        <div class="invalid-feedback">
                            Masukkan Konfirmasi password baru.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="ubah_password" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal ubah password -->


<!-- Modal ubah profile -->
<div class="modal fade" id="modalubahprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/proses_ubah_profile.php" method="POST" class="needs-validation" novalidate
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
                <input type="hidden" name="gambarLama" value="<?php echo $result['gambar'] ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <img src="assets/img/user/<?php echo $result['gambar'] ?>" alt="foto" width="150px"
                                height="150px" class="mb-3 img-thumbnail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="file" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="gambar">
                                <label for="floatingInput">Upload gambar</label>
                                <div class="invalid-feedback">
                                    Upload gambar.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="nama" value="<?php echo $result['nama'] ?>"
                                    required>
                                <label for="floatingInput">Nama</label>
                                <div class="invalid-feedback">
                                    Masukkan Nama.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="username"
                                    value="<?php echo $result['username'] ?>" <?php echo ($result['username'] == $_SESSION['username']) ? 'readonly' : ''; ?> required>
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

                                        if ($result['level'] == $key) {
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
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="nohp" value="<?php echo $result['nohp'] ?>"
                                    required>
                                <label for="floatingInput">No hp</label>
                                <div class="invalid-feedback">
                                    Masukkan no hp.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="alamat" id="" style="height:100px;" name="alamat"
                            value="<?php echo $result['alamat'] ?>" required><?php echo $result['alamat'] ?></textarea>
                        <label for="floatinginput">Alamat</label>
                        <div class="invalid-feedback">
                            Masukkan alamat.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="ubah_profile" class="btn btn-primary">Ubah Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal ubah profile -->