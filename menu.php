<?php
//koneksi ke database
include('proses/connect.php');

$query = mysqli_query($conn, "SELECT * FROM tbl_daftar_menu LEFT JOIN tbl_kategori_menu ON tbl_daftar_menu.id_kategori = tbl_kategori_menu.id_kategori");
$menus = [];
while ($menu = mysqli_fetch_assoc($query)) {
    $menus[] = $menu;
}

$kat_menu = mysqli_query($conn, "SELECT * FROM tbl_kategori_menu");
$kat_menu_dbs = [];
while ($kat_menu_db = mysqli_fetch_assoc($kat_menu)) {
    $kat_menu_dbs[] = $kat_menu_db;
}



?>


<div class="col-lg-9 mt-2 mb-5">
    <div class="card">
        <h5 class="card-header">Daftar Menu</h5>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMenu">Tambah
                        Menu</button>
                </div>
            </div>

            <!-- Modal tambah menu -->
            <div class="modal fade" id="modalTambahMenu" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="proses/proses_input_menu.php" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="file" class="form-control" id="floatingInput"
                                                placeholder="name@example.com" name="gambar_menu" required>
                                            <label for="floatingInput">Upload gambar menu</label>
                                            <div class="invalid-feedback">
                                                Upload gambar menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="name@example.com" name="nama_menu" required>
                                            <label for="floatingInput">Nama menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan nama menu.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example"
                                                name="kategori" required>
                                                <option value="" hidden>Pilih Kategori Makanan atau Minuman</option>
                                                <?php foreach ($kat_menu_dbs as $kat) { ?>
                                                    <option value="<?php echo $kat['id_kategori'] ?>">
                                                        <?php echo $kat['kategori'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <label for="floatingInput">Kategori</label>
                                            <div class="invalid-feedback">
                                                Masukkan kategori.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingPassword"
                                                placeholder="Password" name="harga" required>
                                            <label for="floatingPassword">Harga</label>
                                            <div class="invalid-feedback">
                                                Masukkan harga.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="keterangan" id="" style="height:100px;"
                                                required></textarea>
                                            <label for="floatingInput">Keterangan</label>
                                            <div class="invalid-feedback">
                                                Masukkan keterangan.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="tambah_menu" class="btn btn-primary">Tambah menu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal tambah menu -->

            <!-- Modal view -->
            <?php $i = 1; ?>
            <?php foreach ($menus as $menu) { ?>
                <div class="modal fade" id="modalView<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-center">
                                <!-- card -->
                                <div class="card mb-3 overflow-auto" style="width: 80%;">
                                    <div class="row g-0">
                                        <div class="col-lg-4 text-center p-4">
                                            <img src="assets/img/menu/<?php echo $menu['gambar_menu'] ?>"
                                                class="img-fluid img-thumbnail rounded border border-secondary-subtle p-1 w-100 h-100"
                                                alt="foto">
                                        </div>
                                        <div class=" col-lg-8">
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <h5 class="card-title text-center"><b>Detail Menu
                                                                <?php echo $menu['nama_menu'] ?></b></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <th>Nama Menu</th>
                                                                <td>:</td>
                                                                <td><?php echo $menu['nama_menu'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Jenis Menu</th>
                                                                <td>:</td>
                                                                <td><?php echo $menu['jenis_menu'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kategori</th>
                                                                <td>:</td>
                                                                <td><?php echo $menu['kategori'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Harga</th>
                                                                <td>:</td>
                                                                <td><?php echo number_format($menu['harga'], 0, ',', '.') ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="3">Keterangan</th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <?php echo $menu['keterangan'] ?>
                                                                </td>
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
            <?php foreach ($menus as $menu) { ?>
                <div class="modal fade" id="modalEdit<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="proses/proses_edit_menu.php" method="POST" class="needs-validation" novalidate
                                enctype="multipart/form-data">
                                <input type="hidden" name="id_menu" value="<?php echo $menu['id_menu'] ?>">
                                <input type="hidden" name="gambarLama" value="<?php echo $menu['gambar_menu'] ?>">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col d-flex justify-content-center">
                                            <img src="assets/img/menu/<?php echo $menu['gambar_menu'] ?>" alt="foto"
                                                width="150px" height="150px" class="mb-3 img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="file" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com" name="gambar_menu">
                                                <label for="floatingInput">Upload gambar menu</label>
                                                <div class="invalid-feedback">
                                                    Upload gambar menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com" name="nama_menu"
                                                    value="<?php echo $menu['nama_menu'] ?>" required>
                                                <label for="floatingInput">Nama menu</label>
                                                <div class="invalid-feedback">
                                                    Masukkan nama menu.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="kategori">
                                                    <?php foreach ($kat_menu_dbs as $kat) { ?>
                                                        <?php if ($menu['id_kategori'] == $kat['id_kategori']) { ?>
                                                            <option selected value="<?php echo $kat['id_kategori'] ?>">
                                                                <?php echo $kat['kategori'] ?>
                                                            </option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $kat['id_kategori'] ?>">
                                                                <?php echo $kat['kategori'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <label for="floatingInput">Kategori</label>
                                                <div class="invalid-feedback">
                                                    Masukkan kategori.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingPassword"
                                                    placeholder="Password" name="harga"
                                                    value="<?php echo $menu['harga'] ?>">
                                                <label for="floatingPassword">Harga</label>
                                                <div class="invalid-feedback">
                                                    Masukkan harga.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="keterangan" id=""
                                                    style="height:100px;"><?php echo $menu['keterangan'] ?></textarea>
                                                <label for="floatingInput">Keterangan</label>
                                                <div class="invalid-feedback">
                                                    Masukkan keterangan.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edit_menu" class="btn btn-primary">Edit menu</button>
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
            <?php foreach ($menus as $menu) { ?>
                <div class="modal fade" id="modalDelete<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="proses/proses_delete_menu.php" method="POST" class="needs-validation" novalidate
                                enctype="multipart/form-data">
                                <input type="hidden" name="id_menu" value="<?php echo $menu['id_menu'] ?>">
                                <input type="hidden" name="gambarLama" value="<?php echo $menu['gambar_menu'] ?>">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>Apakah anda yakin ingin menghapus menu
                                                <b><?php echo $menu['nama_menu'] ?></b> ?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="delete_menu" class="btn btn-danger">Delete
                                        Menu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            <?php } ?>
            <!-- end modal delete -->

            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Menu</th>
                            <th scope="col">Jenis Menu</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menus as $menu) { ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td>
                                    <div>
                                        <img class="rounded border border-secondary-subtle p-1"
                                            src="assets/img/menu/<?php echo $menu['gambar_menu'] ?>" alt="menu"
                                            width="100px" height="100px">
                                    </div>
                                </td>
                                <td><?php echo $menu['nama_menu'] ?></td>
                                <td><?php echo $menu['jenis_menu'] ?></td>
                                <td><?php echo $menu['kategori'] ?></td>
                                <td><?php echo number_format($menu['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                            data-bs-target="#modalView<?php echo $i ?>">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit<?php echo $i ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete<?php echo $i ?>">
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