<?php
require_once '../functions/member_service.php';
require_once '../functions/general_service.php';

if (!isset($_GET['give'])) {
    header('location: index');
}

$list_pesanan = $db_connect->query("SELECT dp.*, p.nama FROM detail_penjualan dp JOIN produk p ON p.id = dp.id_produk WHERE dp.nomor_invoice = '" . $_GET['give'] . "'");


if (isset($_POST['submit'])) {
    var_dump($_POST);
    $nomor_invoice = $_POST['nomor_invoice'];
    for ($i = 0; $i < count($_POST['produk']); $i++) {
        $id_produk = $_POST['produk'][$i];
        $rating = $_POST['rating'][$i];
        $pesan = mysqli_real_escape_string($db_connect, $_POST['pesan'][$i]);
        $db_connect->query("INSERT INTO `rating`( `id_user`, `id_produk`, `nomor_invoice`, `pesan`, `rating`) VALUES ('" . $_SESSION['id_user'] . "','$id_produk', '$nomor_invoice', '$pesan', '$rating')");
    }

    echo "<script>alert('terimakasih');location.href='pesanan'</script>";
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
    <title>Wld Project | Ratig</title>
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
    <style>
        .rating {
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            float: right;
            cursor: pointer;
            color: #ddd;
        }

        .rating label:before {
            content: "\2605";
            padding: 5px;
        }

        .rating input:checked~label {
            color: yellow;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true" class="app-default">
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Beri Rating & Ulasan</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="#" class="text-muted text-hover-primary">Member</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Beri Rating</li>
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
                                <form action="#" method="POST">
                                    <input type="hidden" name="nomor_invoice" value="<?= $_GET['give'] ?>">
                                    <div class="card shadow-lg p-5">
                                        <div class="card-body">
                                            <?php foreach ($list_pesanan as $index => $pesanan) : ?>
                                                <div class="card shadow-sm mb-5">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><?= $pesanan['nama'] ?></h3>
                                                        <input type="hidden" name="produk[]" value="<?= $pesanan['id_produk'] ?>">
                                                    </div>
                                                    <div class="card-body">
                                                        <label class="required fs-6 fw-semibold mb-2">Rating Produk</label>
                                                        <br>
                                                        <div class="rating" style="font-size: 32px;">
                                                            <input type="radio" id="star5_<?= $index ?>" name="rating[<?= $index ?>]" value="5">
                                                            <label for="star5_<?= $index ?>"></label>
                                                            <input type="radio" id="star4_<?= $index ?>" name="rating[<?= $index ?>]" value="4">
                                                            <label for="star4_<?= $index ?>"></label>
                                                            <input type="radio" id="star3_<?= $index ?>" name="rating[<?= $index ?>]" value="3">
                                                            <label for="star3_<?= $index ?>"></label>
                                                            <input type="radio" id="star2_<?= $index ?>" name="rating[<?= $index ?>]" value="2">
                                                            <label for="star2_<?= $index ?>"></label>
                                                            <input type="radio" id="star1_<?= $index ?>" name="rating[<?= $index ?>]" value="1">
                                                            <label for="star1_<?= $index ?>"></label>
                                                        </div>
                                                        <br>
                                                        <label class="required fs-6 fw-semibold mb-2">Ulasan</label>
                                                        <textarea class="form-control" name="pesan[]" rows="5" placeholder="Berikan ulasan"></textarea>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
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
        <script>
            const ratings = document.querySelectorAll('.rating');

            ratings.forEach((rating) => {
                const ratingInputs = rating.querySelectorAll('input');
                const ratingLabels = rating.querySelectorAll('label');

                ratingInputs.forEach((input, index) => {
                    input.addEventListener('change', () => {
                        const selectedRating = input.value;
                        const selectedProduct = input.closest('.card').querySelector('input[name="produk[]"]').value;
                        const ulasanTextarea = input.closest('.card').querySelector('textarea[name="pesan[]"]');

                        ratingLabels.forEach((label, labelIndex) => {
                            if (labelIndex <= index) {
                                label.classList.add('filled');
                            } else {
                                label.classList.remove('filled');
                            }
                        });

                        console.log(`Product: ${selectedProduct}, Rating: ${selectedRating}, Ulasan: ${ulasanTextarea.value}`);
                    });
                });
            });
        </script>
</body>
<!--end::Body-->

</html>