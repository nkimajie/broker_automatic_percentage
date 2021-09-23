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


    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/60f5f687649e0a0a5cccfe88/1fb0cm1bo';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
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
                            <a href="<?= base_url('users') ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li class="sidebar-title">Transactions</li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('users/history') ?>" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Transactions History</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="<?= base_url('users/trade') ?>" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Live Trade</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Investment</li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('users/deposit_amount') ?>" class='sidebar-link'>
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                                <span>Deposit Investment</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="<?= base_url('users/withdrawal') ?>" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Withdraw Investment</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url('users/deposit') ?>" class='sidebar-link'>
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                                <span>Top-up Investment</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Profile</li>

                        <li class="sidebar-item">
                            <a href="<?= base_url('users/profile') ?>" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Profile</span>
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

    <script>

    $(document).ready(function() {
      $('#data_table').DataTable();
    } );


  </script>
</body>


<!-- Mirrored from zuramai.github.io/mazer/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Aug 2021 19:53:39 GMT -->

</html>
