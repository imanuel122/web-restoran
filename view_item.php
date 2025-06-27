<?php
//koneksi ke database
include('proses/connect.php');


$nama_pelanggan = $_GET['nama_pelanggan'];
$kode_order = $_GET['order'];
$meja = $_GET['meja'];

$query = mysqli_query($conn, "SELECT *, SUM(tbl_list_order.jumlah * tbl_daftar_menu.harga) AS total FROM tbl_list_order
LEFT JOIN tbl_order ON tbl_list_order.id_order = tbl_order.id_order
LEFT JOIN tbl_daftar_menu ON tbl_list_order.id_menu = tbl_daftar_menu.id_menu
LEFT JOIN tbl_bayar ON tbl_order.id_order = tbl_bayar.id_bayar
GROUP BY tbl_list_order.id_list_order
HAVING tbl_list_order.id_order = '$_GET[order]'");
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
        <h5 class="card-header">Daftar Order Item</h5>
        <div class="card-body">
            <a class="btn btn-secondary mb-3" href="report"><i class="bi bi-arrow-left"></i></a>
            <div class="row">
                <div class="col-4">
                    <h6 class="fw-bold">Nama Pelanggan : <?php echo $nama_pelanggan ?></h6>
                    <h6 class="fw-bold">Kode Order : <?php echo $kode_order ?></h6>
                    <h6 class="fw-bold">Meja : <?php echo $meja ?></h6>
                </div>

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
                                        <?php if ($row['status'] == 1) { ?>
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