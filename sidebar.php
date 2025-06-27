<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-3 border mt-2">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel" style="width: 250px;">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body flex-column">
                    <div class="row my-2">
                        <div class="col text-center">
                            <img src="assets/img/icon/logo.jpeg" alt="" class="rounded-circle" width="150px">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                                <li class="nav-item">
                                    <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'home' || !isset($_GET['x'])) ? 'active link-light' : 'link-dark'; ?>"
                                        aria-current="page" href="home"><i class="bi bi-house-door"></i>
                                        Home</a>
                                </li>


                                <?php if ($result['level'] == 1 || $result['level'] == 3) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'menu') ? 'active link-light' : 'link-dark'; ?>"
                                            href="menu">
                                            <i class="bi bi-menu-up"></i> Daftar Menu</a>
                                    </li>
                                <?php } ?>


                                <?php if ($result['level'] == 1) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'kategori') ? 'active link-light' : 'link-dark'; ?>"
                                            href="kategori"><i class="bi bi-tags"></i> Kategori Menu</a>
                                    </li>
                                <?php } ?>


                                <?php if ($result['level'] == 1 || $result['level'] == 2 || $result['level'] == 3) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'order') ? 'active link-light' : 'link-dark'; ?>"
                                            href="order"><i class="bi bi-cart4"></i> Order</a>
                                    </li>
                                <?php } ?>


                                <?php if ($result['level'] == 1 || $result['level'] == 4) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'dapur') ? 'active link-light' : 'link-dark'; ?>"
                                            href="dapur"><i class="bi bi-fire"></i>
                                            Dapur</a>
                                    </li>
                                <?php } ?>


                                <?php if ($result['level'] == 1) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'user') ? 'active link-light' : 'link-dark'; ?>"
                                            href="user"><i class="bi bi-receipt"></i>
                                            User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'report') ? 'active link-light' : 'link-dark'; ?>"
                                            href="report"><i class="bi bi-file-earmark-bar-graph"></i>
                                            Report</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>