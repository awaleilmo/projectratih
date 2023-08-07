<?php
require_once '../functions/admin_service.php';

if (!isset($_GET['id'])) {
    header('Location: galeri_foto');
}

if (isset($_POST['simpan'])) {
    if (ubah_galery($_POST)) {
        $id = $_POST['id'];
        echo "<script>window.location.href='galeri_foto'; window.alert('berhasil di rubah');</script>";
    }
}


$data_galeri = $db_connect->query("SELECT * FROM galery WHERE id = '" . $_GET['id'] . "'")->fetch_assoc();
$daftar_jenis_produk = $db_connect->query("SELECT * FROM jenis_produk");

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
    <title>Wld Project | Data Foto</title>
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Photo</h1>
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
                                        <li class="breadcrumb-item text-muted">Galeri Photo</li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Edit Photo</li>
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
                                <!--begin::Content-->
                                <div id="kt_app_content" class="app-content flex-column-fluid">
                                    <!--begin::Content container-->
                                    <div id="kt_app_content_container" class="app-container container-xxl">
                                        <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row" method="POST" action="" enctype="multipart/form-data">
                                            <!--begin::Main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                                <!--begin::General options-->
                                                <div class="card card-flush py-4">
                                                    <!--begin::Card header-->
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <h2>Ubah data</h2>
                                                        </div>
                                                    </div>
                                                    <!--end::Card header-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body pt-0">
                                                        <!--begin::Input group-->
                                                        <div class="mb-10 fv-row">
                                                            <!--begin::Label-->
                                                            <label class="required form-label">Judul foto</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" name="judul" class="form-control mb-2" placeholder="Judul foto" value="<?= $data_galeri['nama'] ?>" />
                                                            <input type="hidden" name="id" class="form-control mb-2" value="<?= $data_galeri['id'] ?>" />
                                                            <input type="hidden" name="jenis_media" class="form-control mb-2" value="<?= $data_galeri['jenis_media'] ?>" />
                                                            <!--end::Input-->
                                                            <!--begin::Description-->
                                                            <div class="text-muted fs-7">Masukan judul foto</div>
                                                            <!--end::Description-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="d-flex flex-column mb-8 fv-row">
                                                            <!--begin::Label-->
                                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                                <span class="required">Deskripsi foto</span>
                                                                <span class="ms-1" data-bs-toggle="tooltip" title="Masukan Deskripsi foto">
                                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                    </i>
                                                                </span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <textarea type="text" class="form-control form-control-solid" placeholder="deskripsi" name="deskripsi" required /><?= $data_galeri['deskripsi'] ?></textarea>
                                                            <div class="text-muted fs-7">Deskripsi foto</div>
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="row g-9 mb-8">
                                                            <!--begin::Col-->
                                                            <div class="col-md-12 fv-row">
                                                                <label class="required fs-6 fw-semibold mb-2">Jenis Produk</label>
                                                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Jenis Produk" name="jenis_produk" required>
                                                                    <option value="">pilih.</option>
                                                                    <?php foreach ($daftar_jenis_produk as $jenis_produk) : ?>
                                                                        <option value="<?= $jenis_produk['id'] ?>" <?= $jenis_produk['id'] == $data_galeri['jenis_produk'] ? 'selected' : ''; ?>><?= $jenis_produk['jenis_produk'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="d-flex flex-column mb-8 fv-row">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="switchEditPhoto" name="editPhoto">
                                                                <label class="form-check-label" for="switchEditPhoto">Edit foto</label>
                                                            </div>
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div id="elementEditPhoto" class="d-flex flex-column mb-8">
                                                            <label class="fs-6 fw-semibold mb-2">Files</label>
                                                            <input type="file" accept=".jpg, .jpeg, .png" class="form-control form-control-solid" rows="3" name="media" placeholder="photo">
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                    <!--end::Card header-->
                                                </div>
                                                <!--end::General options-->
                                                <div class="d-flex justify-content-end">
                                                    <!--begin::Button-->
                                                    <a href="galeri_video" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                                                    <!--end::Button-->
                                                    <!--begin::Button-->
                                                    <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary" name="simpan">Save Changes</button>
                                                    <!--end::Button-->
                                                </div>
                                            </div>
                                            <!--end::Main column-->
                                        </form>
                                    </div>
                                    <!--end::Content container-->
                                </div>
                                <!--end::Content-->
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
        <script src="../theme/Metronic/assets/js/custom/utilities/modals/new-target.js"></script>
        <script src="../theme/Metronic/assets/js/custom/utilities/modals/users-search.js"></script>
        <!--end::Custom Javascript-->
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
            });
        </script>
</body>
<!--end::Body-->

</html>