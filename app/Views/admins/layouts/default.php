<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zuramai.github.io/mazer/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Aug 2021 19:52:32 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= site_url() ?>dash_assets/assets/css/bootstrap.css">

    <link rel="stylesheet" href="<?= site_url() ?>dash_assets/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="<?= site_url() ?>dash_assets/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= site_url() ?>dash_assets/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= site_url() ?>dash_assets/assets/css/app.css">
    <link rel="shortcut icon" href="<?= site_url() ?>dash_assets/assets/images/favicon.html" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a551bd7de4.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?= site_url() ?>"><img src="<?= site_url() ?>dash_assets/assets/images/logo/logo.png"
                                    alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="<?= base_url('admin') ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li class="sidebar-title">Users</li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('admin/users') ?>" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url('admin/deactivated') ?>" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Deactivated Account</span>
                            </a>
                        </li>



                        <li class="sidebar-title">Withdrawal</li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('admin/pendingWithdrawal') ?>" class='sidebar-link'>
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                                <span>Pending Withdrawal</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="<?= base_url('admin/approvedWithdrawal') ?>" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Approved Withdrawal</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="<?= base_url('admin/declinedWithdrawal') ?>" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Declined Withdrawal</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Deposit</li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('admin/pendingDeposit') ?>" class='sidebar-link'>
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                                <span>Pending Deposit</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="<?= base_url('admin/approvedDeposit') ?>" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Approved Deposit</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="<?= base_url('admin/declinedDeposit') ?>" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Declined Deposit</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Settings</li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('admin/profile') ?>" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Profile</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('admin/settings') ?>" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>General Settings</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Logout</li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('logout') ?>" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>



                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3><?= $page_title ?></h3>
                <small>Hello, <?= session()->user['firstname'].' '.session()->user['lastname']?></small>
            </div>

            <?= $this->renderSection('content') ?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Condie Investments Limited</p>
                    </div>
                    <!-- <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com/">A. Saugi</a></p>
                    </div> -->
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= site_url() ?>dash_assets/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= site_url() ?>dash_assets/assets/js/bootstrap.bundle.min.js"></script>

    <script src="<?= site_url() ?>dash_assets/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="<?= site_url() ?>dash_assets/assets/js/pages/dashboard.js"></script>

    <script src="<?= site_url() ?>dash_assets/assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>

    $(document).ready(function() {
      $('#data_table').DataTable();
    } );




  </script>
</body>


<!-- Mirrored from zuramai.github.io/mazer/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Aug 2021 19:53:39 GMT -->

</html>
