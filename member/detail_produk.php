<?php
global $db_connect;
require_once '../functions/member_service.php';
require_once '../functions/general_service.php';
if (!isset($_GET['produk'])) {
    header('location: index');
}
$xan = isset($_POST['gantiRating']) ? $_POST['gantiRating'] : '';
$id_produk = $_GET['produk'];

$produk = $db_connect->query("SELECT * FROM produk WHERE id = '$id_produk'")->fetch_assoc();
if(!isset($_POST['gantiRating']) || $_POST['gantiRating'] === '0') {
    $ratingdesc = $db_connect->query("SELECT a.*, b.nama, b.photo FROM rating as a LEFT JOIN user as b on a.id_user = b.id WHERE a.id_produk = '" . $produk['id']."'");
}else{
    $ratingdesc = $db_connect->query("SELECT a.*, b.nama, b.photo FROM rating as a LEFT JOIN user as b on a.id_user = b.id WHERE a.id_produk = '" . $produk['id'] . "' AND a.rating = '".$_POST['gantiRating']."'");
}
$rating = $db_connect->query("SELECT AVG(rating) AS rata_rata_rating FROM rating WHERE id_produk = '" . $produk['id'] . "'")->fetch_assoc();
$ratingtotal = $db_connect->query("SELECT count(*) as total FROM rating WHERE id_produk = '" . $produk['id'] . "'")->fetch_assoc();
$rating1 = $db_connect->query("SELECT count(*) as total FROM rating WHERE id_produk = '" . $produk['id'] . "' AND rating = '1'")->fetch_assoc();
$rating2 = $db_connect->query("SELECT count(*) as total FROM rating WHERE id_produk = '" . $produk['id'] . "' AND rating = '2'")->fetch_assoc();
$rating3 = $db_connect->query("SELECT count(*) as total FROM rating WHERE id_produk = '" . $produk['id'] . "' AND rating = '3'")->fetch_assoc();
$rating4 = $db_connect->query("SELECT count(*) as total FROM rating WHERE id_produk = '" . $produk['id'] . "' AND rating = '4'")->fetch_assoc();
$rating5 = $db_connect->query("SELECT count(*) as total FROM rating WHERE id_produk = '" . $produk['id'] . "' AND rating = '5'")->fetch_assoc();

// Menghitung jumlah bintang yang akan ditampilkan
$jumlah_bintang = ceil($rating['rata_rata_rating']);

// Memastikan jumlah bintang tidak melebihi 5
$jumlah_bintang = min($jumlah_bintang, 5);

$is_favorite = $db_connect->query("SELECT * FROM favorit WHERE id_user = '" . $_SESSION['id_user'] . "' AND id_produk = '" . $id_produk . "'");
$on_chart = $db_connect->query("SELECT * FROM keranjang WHERE id_user = '" . $_SESSION['id_user'] . "' AND id_produk = '" . $id_produk . "'");
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
    <base href=""/>
    <title>Wld Project | Detail Produk</title>
    <meta charset="utf-8"/>
    <meta name="description"
          content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free."/>
    <meta name="keywords"
          content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template"/>
    <meta property="og:url" content="https://keenthemes.com/metronic"/>
    <meta property="og:site_name" content="Keenthemes | Metronic"/>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>
    <link rel="shortcut icon" href="../image/fav.png"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="../theme/Metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
          type="text/css"/>
    <link href="../theme/Metronic/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
          type="text/css"/>
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="../theme/Metronic/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="../theme/Metronic/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true"
      data-kt-app-toolbar-enabled="true" class="app-default">
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
        <?php require_once "header.php"; ?>
        <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <!--begin::Toolbar-->
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <!--begin::Toolbar container-->
                        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                            <!--begin::Page title-->
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                <!--begin::Title-->
                                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                    Detail Produk</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="index" class="text-muted text-hover-primary">Member</a>
                                    </li>
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
                                            <h1><?= $produk['nama'] ?> ( <i class="fs-sm-1"><?= $produk['inout'] == 0 ? 'OUTDOOR' : 'INDOOR' ?></i> )</h1>
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
                                            <?php if ($on_chart->num_rows > 0) : ?>
                                                <a href="remove_chart?produk=<?= $produk['id'] ?>"
                                                   class="btn btn-danger">Hapus dari Keranjang</a>
                                            <?php else : ?>
                                                <a href="add_chart?produk=<?= $produk['id'] ?>" class="btn btn-primary">Masukan
                                                    Keranjang</a>
                                            <?php endif; ?>
                                            &nbsp;&nbsp;
                                            <?php if ($is_favorite->num_rows > 0) : ?>
                                                <a href="delete_favorit?produk=<?= $produk['id'] ?>"><i
                                                            class="bi bi-heart-fill fs-4 text-danger"></i></a>
                                            <?php else : ?>
                                                <a href="add_favorit?produk=<?= $produk['id'] ?>"><i
                                                            class="bi bi-heart-fill fs-4"></i></a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-footer">
                                            <h3>Deskripsi Produk</h3>
                                            <hr>
                                            <p class="text-justify" style="white-space: pre-line">
                                                <?= $produk['deskripsi'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="kt_carousel_2_carousel" class="carousel carousel-custom slide"
                                         data-bs-ride="carousel" data-bs-interval="8000">
                                        <!--begin::Heading-->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <!--begin::Label-->
                                            <span class="fs-4 fw-bold pe-2">Galeri</span>
                                            <!--end::Label-->

                                            <!--begin::Carousel Indicators-->
                                            <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet">
                                                <li data-bs-target="#kt_carousel_2_carousel" data-bs-slide-to="0"
                                                    class="ms-1 active"></li>
                                                <li data-bs-target="#kt_carousel_2_carousel" data-bs-slide-to="1"
                                                    class="ms-1"></li>
                                            </ol>
                                            <!--end::Carousel Indicators-->
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Carousel-->
                                        <div class="carousel-inner pt-8 position-absolute">
                                            <!--begin::Item-->
                                            <div class="carousel-item active">
                                                <img src="../image/galery/<?= $produk['photo'] ?>" alt="thumbnail"
                                                     height="250" width="100%">
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
                            <div class="row">
                                <div class="col-8">
                                    <div class="card shadow-sm mt-5">
                                        <div class="card-header row text-center align-content-center">
                                            <div class="col-4 d-flex py-5">
                                                <h1>Ulasan</h1>
                                            </div>
                                            <br>
                                            <div class="col-7 row">
                                                <div class="col-6 d-flex align-items-baseline">
                                                    <div class="p-2">
                                                        <i class="bi pb-4 fs-1 bi-star-fill text-warning"></i>
                                                    </div>
                                                    <div class="fa-4x fw-bold">
                                                        <?= number_format((float)$rating['rata_rata_rating'], 1, '.', '') ?>
                                                    </div>
                                                    <div class="fs-1 text-gray-500">
                                                        / 5.0
                                                    </div>
                                                </div>
                                                <div class="col-6 px-2 py-4">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                            </td>
                                                            <td class="fw-bold text-gray-500">
                                                                5
                                                            </td>
                                                            <td class="w-125px">
                                                                <div class="h-8px mx-3 bg-gray-500 bg-opacity-50 rounded">
                                                                    <div class="bg-success rounded h-8px"
                                                                         role="progressbar"
                                                                         style="width: <?php echo $rating5['total'] != '0' ? ($rating5['total'] / $ratingtotal['total'] * 100) : '0' ?>%"></div>
                                                                </div>
                                                            </td>
                                                            <td class="fw-normal text-gray-700">
                                                                <?= $rating5['total'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                            </td>
                                                            <td class="fw-bold text-gray-500">
                                                                4
                                                            </td>
                                                            <td class="w-125px">
                                                                <div class="h-8px mx-3 bg-gray-500 bg-opacity-50 rounded">
                                                                    <div class="bg-success rounded h-8px"
                                                                         role="progressbar"
                                                                         style="width: <?php echo $rating4['total'] != '0' ? ($rating4['total'] / $ratingtotal['total'] * 100) : '0' ?>%"></div>
                                                                </div>
                                                            </td>
                                                            <td class="fw-normal text-gray-700">
                                                                <?= $rating4['total'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                            </td>
                                                            <td class="fw-bold text-gray-500">
                                                                3
                                                            </td>
                                                            <td class="w-125px">
                                                                <div class="h-8px mx-3 bg-gray-500 bg-opacity-50 rounded">
                                                                    <div class="bg-success rounded h-8px"
                                                                         role="progressbar"
                                                                         style="width: <?php echo $rating3['total'] != '0' ? ($rating3['total'] / $ratingtotal['total'] * 100) : '0' ?>%"></div>
                                                                </div>
                                                            </td>
                                                            <td class="fw-normal text-gray-700">
                                                                <?= $rating3['total'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                            </td>
                                                            <td class="fw-bold text-gray-500">
                                                                2
                                                            </td>
                                                            <td class="w-125px">
                                                                <div class="h-8px mx-3 bg-gray-500 bg-opacity-50 rounded">
                                                                    <div class="bg-success rounded h-8px"
                                                                         role="progressbar"
                                                                         style="width: <?php echo $rating2['total'] != '0' ? ($rating2['total'] / $ratingtotal['total'] * 100) : '0' ?>%"></div>
                                                                </div>
                                                            </td>
                                                            <td class="fw-normal text-gray-700">
                                                                <?= $rating2['total'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                            </td>
                                                            <td class="fw-bold text-gray-500">
                                                                1
                                                            </td>
                                                            <td class="w-125px">
                                                                <div class="h-8px mx-3 bg-gray-500 bg-opacity-50 rounded">
                                                                    <div class="bg-success rounded h-8px"
                                                                         role="progressbar"
                                                                         style="width: <?php echo $rating1['total'] != '0' ? ($rating1['total'] / $ratingtotal['total'] * 100) : '0' ?>%"></div>
                                                                </div>
                                                            </td>
                                                            <td class="fw-normal text-gray-700">
                                                                <?= $rating1['total'] ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="" method="post">
                                            <select class="form-select" id="gantiRating" aria-label="Select example"
                                                    name="gantiRating" onchange="this.form.submit()">
                                                <option <?= !isset($_POST['gantiRating']) ? 'selected' : '' ?> value="0">ALL</option>
                                                <option <?= isset($_POST['gantiRating']) ? $_POST['gantiRating'] == '5' ? 'selected' : '' : '' ?> value="5">5</option>
                                                <option <?= isset($_POST['gantiRating']) ? $_POST['gantiRating'] == '4' ? 'selected' : '' : '' ?> value="4">4</option>
                                                <option <?= isset($_POST['gantiRating']) ? $_POST['gantiRating'] == '3' ? 'selected' : '' : '' ?> value="3">3</option>
                                                <option <?= isset($_POST['gantiRating']) ? $_POST['gantiRating'] == '2' ? 'selected' : '' : '' ?> value="2">2</option>
                                                <option <?= isset($_POST['gantiRating']) ? $_POST['gantiRating'] == '1' ? 'selected' : '' : '' ?> value="1">1</option>
                                            </select>
                                        </form>
                                        <div class="card-body bg-gray-300 max-h-100px overflow-auto">
                                            <div class="row">
                                                <?php
                                                foreach ($ratingdesc as $item) {
                                                    ?>
                                                    <div class="row bg-white rounded py-6 m-2">
                                                        <div class="col-2 d-flex flex-column align-items-center">
                                                            <p>
                                                                <?php
                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    if ($i <= $item['rating']) {
                                                                        // Bintang dengan warna jika rating lebih dari 0
                                                                        echo '<i class="bi bi-star-fill text-warning"></i>';
                                                                    } else {
                                                                        // Bintang dengan warna default jika rating adalah 0
                                                                        echo '<i class="bi bi-star-fill"></i>';
                                                                    }
                                                                }
                                                                ?>
                                                            </p>
                                                            <div class="symbol symbol-50px">
                                                                <img alt="user_profile_image"
                                                                     src="../image/user_profile/<?= $item['photo'] ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-10">
                                                            <p class="text-capitalize fw-bold"><?php echo $item['nama'] ?></p>
                                                            <p>
                                                                <?php echo $item['pesan'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
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
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="../theme/Metronic/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="../theme/Metronic/assets/js/widgets.bundle.js"></script>
    <script src="../theme/Metronic/assets/js/custom/widgets.js"></script>
    <script src="../theme/Metronic/assets/js/custom/apps/chat/chat.js"></script>
    <script src="../theme/Metronic/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="../theme/Metronic/assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="../theme/Metronic/assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>