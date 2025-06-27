<?php
//koneksi ke database
include('proses/connect.php');

$query = mysqli_query($conn, "SELECT * FROM tbl_kategori_menu");
$kategoris = [];
while ($kategori = mysqli_fetch_assoc($query)) {
    $kategoris[] = $kategori;
}

?>


<div class="col-lg-9 mt-2 mb-5">
    <div class="card">
        <h5 class="card-header">Kategori Menu</h5>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">Tambah
                        Kategori Menu</button>
                </div>
            </div>

            <!-- Modal tambah kategori -->
            <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="proses/proses_input_kategori.php" method="POST" class="needs-validation"
                            novalidate enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example"
                                                name="jenis_menu" required>
                                                <option value="" hidden>Pilih Jenis Menu</option>
                                                <option value="Makanan">Makanan</option>
                                                <option value="Minuman">Minuman</option>
                                            </select>
                                            <label for="floatingInput">Jenis Menu</label>
                                            <div class="invalid-feedback">
                                                Pilih jenis menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="name@example.com" name="kategori" required>
                                            <label for="floatingInput">Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kategori Menu.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="tambah_kategori" class="btn btn-primary">Tambah
                                    Kategori</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal tambah kategori -->


            <!-- Modal edit -->
            <?php $i = 1; ?>
            <?php foreach ($kategoris as $kategori) { ?>
                <div class="modal fade" id="modalEdit<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="proses/proses_edit_kategori.php" method="POST" class="needs-validation" novalidate
                                enctype="multipart/form-data">
                                <input type="hidden" name="id_kategori" value="<?php echo $kategori['id_kategori'] ?>">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="jenis_menu" required>
                                                    <?php
                                                    $data = ['Makanan', 'Minuman'];
                                                    ?>
                                                    <?php foreach ($data as $kat) { ?>
                                                        <?php if ($kategori['jenis_menu'] == $kat) { ?>
                                                            <option selected value="<?php echo $kat ?>">
                                                                <?php echo $kat ?>
                                                            </option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $kat ?>">
                                                                <?php echo $kat ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <label for="floatingInput">Jenis Menu</label>
                                                <div class="invalid-feedback">
                                                    Pilih jenis menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com" name="kategori"
                                                    value="<?php echo $kategori['kategori'] ?>">
                                                <label for="floatingInput">Kategori Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Kategori Menu.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edit_kategori" class="btn btn-primary">Edit
                                        Kategori</button>
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
            <?php foreach ($kategoris as $kategori) { ?>
                <div class="modal fade" id="modalDelete<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Kategori Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="proses/proses_delete_kategori.php" method="POST" class="needs-validation"
                                novalidate enctype="multipart/form-data">
                                <input type="hidden" name="id_kategori" value="<?php echo $kategori['id_kategori'] ?>">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>Apakah anda yakin ingin menghapus kategori menu
                                                <b><?php echo $kategori['kategori'] ?></b> ?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="delete_kategori" class="btn btn-danger">Delete
                                        Kategori Menu</button>
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
                            <th scope="col">Jenis Menu</th>
                            <th scope="col">Kategori Menu</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kategoris as $kategori) { ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $kategori['jenis_menu'] ?></td>
                                <td><?php echo $kategori['kategori'] ?></td>
                                <td class="d-flex">
                                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit<?php echo $i ?>">
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