<?php
require_once '../functions/admin_service.php';

$id_produk = $_GET['id'];
$rating = $db_connect->query("SELECT AVG(rating) AS rata_rata_rating FROM rating WHERE id_produk = '" . $_GET['id'] . "'")->fetch_assoc();
$detail_paket = $db_connect->query("SELECT * FROM produk WHERE id = '" . $_GET['id'] . "'")->fetch_assoc();
$list_rating = $db_connect->query("SELECT * FROM rating WHERE id_produk = '" . $_GET['id'] . "'");
$nomor = 1;

if (isset($_GET['display'])) {
    if ($db_connect->query("UPDATE rating SET display = '1' WHERE id = '" . $_GET['display'] . "'")) {
        echo "<script>alert('berhasil');location.href='detail_ulasan_produk?id=$id_produk'</script>";
    }
}

if (isset($_GET['undisplay'])) {
    if ($db_connect->query("UPDATE rating SET display = '0' WHERE id = '" . $_GET['undisplay'] . "'")) {
        echo "<script>alert('berhasil');location.href='detail_ulasan_produk?id=$id_produk'</script>";
    }
}


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
    <title>Wld Project | Halaman Ulasan</title>
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
    <script src="../theme/Metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Ulasan & Rating</h1>
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
                                        <li class="breadcrumb-item text-muted">Ulasan & Rating</li>
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
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <!--begin::Content container-->
                                <div id="kt_app_content_container" class="app-container container-xxxl">
                                    <div class="card card-custom gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Total rating kepuasan paket <?= $detail_paket['nama'] ?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="text-center" style="font-size: 100px;">
                                                <i class="bi bi-star-fill text-warning" style="font-size: 100px;"></i>
                                                <?= number_format($rating['rata_rata_rating'], 1) ?>
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="card card-custom gutter-b mt-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Data ulasan pelanggan
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach ($list_rating as $rating) : ?>
                                                    <?php
                                                    $jumlah_bintang = $rating['rating'];
                                                    $user_details = $db_connect->query("SELECT * FROM user WHERE id = '" . $rating['id_user'] . "'")->fetch_assoc();
                                                    ?>
                                                    <div class="col-xl-12 mb-5">
                                                        <div class="card shadow-lg">
                                                            <div class="card-body d-flex align-items-center">
                                                                <div class="mr-4" style="width: 11%;">
                                                                    <img class="img-thumbnail rounded-circle" src="../image/user_profile/<?= $user_details['photo'] ?>" alt="" style="width: 100px; height:100px; object-fit:cover;">
                                                                </div>
                                                                <div style="width: 87%;">
                                                                    <h2 class="h4 text-muted m-0 d-flex justify-content-between">
                                                                        <span>
                                                                            <?= $user_details['nama'] ?>
                                                                        </span>
                                                                    </h2>
                                                                    <small class="d-block mb-2 text-gray"><?= $user_details['email'] ?></small>
                                                                    <p class="mb-4 text-discussions"><?= $rating['pesan'] ?></p>
                                                                    <span class="btn btn-sm btn-second">
                                                                        <?php for ($i = 1; $i <= 5; $i++) {
                                                                            if ($i <= $jumlah_bintang) {
                                                                                // Bintang dengan warna jika rating lebih dari 0
                                                                                echo '<i class="bi bi-star-fill text-warning"></i>';
                                                                            } else {
                                                                                // Bintang dengan warna default jika rating adalah 0
                                                                                echo '<i class="bi bi-star-fill"></i>';
                                                                            }
                                                                        } ?>
                                                                    </span>
                                                                    <br>
                                                                    <?php if($_SESSION['role'] == 1){ ?>
                                                                    <?php if ($rating['rating'] > 0 and $rating['display'] < 1) : ?>
                                                                        <a href="detail_ulasan_produk?id=<?= $_GET['id'] ?>&display=<?= $rating['id'] ?>" class="btn btn-sm btn-primary">Munculkan di homepage</a>
                                                                    <?php elseif ($rating['display'] > 0) : ?>
                                                                        <a href="detail_ulasan_produk?id=<?= $_GET['id'] ?>&undisplay=<?= $rating['id'] ?>" class="btn btn-sm btn-danger">Hapus dari homepage</a>
                                                                    <?php endif; ?>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end::Content container -->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Content wrapper-->
                        <!--begin::Footer-->
                        <div id="kt_app_footer" class="app-footer">
                            <!--begin::Footer container-->
                            <?php require_once 'footer.php'; ?>
                            <!--end::Footer-->
                        </div>
                        <!--end:::Main-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Page-->
            </div>
            <!--end::App-->
            <!--begin::Javascript-->
            <script>
                var hostUrl = "../theme/Metronic/assets/";
            </script>
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
            <!--end::Custom Javascript-->
            <!--end::Javascript-->
</body>
<!--end::Body-->

</html>