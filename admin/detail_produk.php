<?php
require_once '../functions/admin_service.php';
require_once '../functions/general_service.php';

if (!isset($_GET['produk'])) {
    header('location: index');
}

$id_produk = $_GET['produk'];

$produk = $db_connect->query("SELECT * FROM produk WHERE id = '$id_produk'")->fetch_assoc();
$rating = $db_connect->query("SELECT AVG(rating) AS rata_rata_rating FROM rating WHERE id_produk = '" . $produk['id'] . "'")->fetch_assoc();

// Menghitung jumlah bintang yang akan ditampilkan
$jumlah_bintang = ceil($rating['rata_rata_rating']);

// Memastikan jumlah bintang tidak melebihi 5
$jumlah_bintang = min($jumlah_bintang, 5);
?>
<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.1.8
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>Wld Project | Detail Produk</title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="../image/fav.png" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="../theme/Metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../theme/Metronic/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="../theme/Metronic/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../theme/Metronic/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <?php require_once 'header.php' ?>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <?php require_once 'sidebar.php' ?>
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Paket</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="index" class="text-muted text-hover-primary">Admin</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Data Paket</li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Detail Produk</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="card shadow-sm mt-5">
                                            <div class="card-body">
                                                <h1><?= $produk['nama'] ?></h1>
                                                <p><?= $db_connect->query("SELECT * FROM jenis_produk WHERE id = '" . $produk['jenis_produk'] . "'")->fetch_assoc()['jenis_produk'] ?></p>
                                                <p>
                                                    <?php
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $jumlah_bintang) {
                                                            // Bintang dengan warna jika rating lebih dari 0
                                                            echo '<i class="bi bi-star-fill text-warning"></i>';
                                                        } else {
                                                            // Bintang dengan warna default jika rating adalah 0
                                                            echo '<i class="bi bi-star-fill"></i>';
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                                <br>
                                                <h2>Rp <?= number_format($produk['harga']) ?></h2>
                                                <br>
                                            </div>
                                            <div class="card-footer">
                                                <h3>Deskripsi Produk</h3>
                                                <hr>
                                                <p class="text-justify">
                                                    <?= $produk['deskripsi'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div id="kt_carousel_2_carousel" class="carousel carousel-custom slide" data-bs-ride="carousel" data-bs-interval="8000">
                                            <!--begin::Heading-->
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <!--begin::Label-->
                                                <span class="fs-4 fw-bold pe-2">Galeri</span>
                                                <!--end::Label-->

                                                <!--begin::Carousel Indicators-->
                                                <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet">
                                                    <li data-bs-target="#kt_carousel_2_carousel" data-bs-slide-to="0" class="ms-1 active"></li>
                                                    <li data-bs-target="#kt_carousel_2_carousel" data-bs-slide-to="1" class="ms-1"></li>
                                                </ol>
                                                <!--end::Carousel Indicators-->
                                            </div>
                                            <!--end::Heading-->

                                            <!--begin::Carousel-->
                                            <div class="carousel-inner pt-8">
                                                <!--begin::Item-->
                                                <div class="carousel-item active">
                                                    <img src="../image/galery/<?= $produk['photo'] ?>" alt="thumbnail" height="250" width="100%">
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="carousel-item">
                                                    <video controls class="img-fluid">
                                                        <source src="../videos/<?= $produk['video'] ?>" type="video/mp4">
                                                    </video>
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Carousel-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Content wrapper-->
                        <!--begin::Footer-->
                        <?php require_once 'footer.php'; ?>
                        <!--end::Footer-->
                    </div>
                    <!--end:::Main-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
    </div>
    <!--end::App-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "../theme/Metronic/assets/";
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="../theme/Metronic/assets/plugins/global/plugins.bundle.js"></script>
    <script src="../theme/Metronic/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="../theme/Metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script> -->
    <script src="../theme/Metronic/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="../theme/Metronic/assets/js/widgets.bundle.js"></script>
    <script src="../theme/Metronic/assets/js/custom/widgets.js"></script>
    <script src="../theme/Metronic/assets/js/custom/apps/chat/chat.js"></script>
    <script src="../theme/Metronic/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="../theme/Metronic/assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="../theme/Metronic/assets/js/custom/utilities/modals/new-target.js"></script>
    <script src="../theme/Metronic/assets/js/custom/utilities/modals/users-search.js"></script>
    <script>
        $(document).ready(function() {
            // Mengatur keadaan awal
            if ($('#switchEditPhoto').is(':checked')) {
                $('#elementEditPhoto').removeClass('d-none');
            } else {
                $('#elementEditPhoto').addClass('d-none');
            }

            // Mengubah visibilitas saat checkbox berubah
            $('#switchEditPhoto').change(function() {
                if ($(this).is(':checked')) {
                    $('#elementEditPhoto').removeClass('d-none');
                } else {
                    $('#elementEditPhoto').addClass('d-none');
                }
            });

            // Mengatur keadaan awal
            if ($('#switchEditVideo').is(':checked')) {
                $('#elementEditVideo').removeClass('d-none');
            } else {
                $('#elementEditVideo').addClass('d-none');
            }

            // Mengubah visibilitas saat checkbox berubah
            $('#switchEditVideo').change(function() {
                if ($(this).is(':checked')) {
                    $('#elementEditVideo').removeClass('d-none');
                } else {
                    $('#elementEditVideo').addClass('d-none');
                }
            });
        });
    </script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>