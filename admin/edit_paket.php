<?php
global $db_connect;
require_once '../functions/admin_service.php';

if (!isset($_GET['paket'])) {
    header("location: data_paket");
}



$data = $db_connect->query("SELECT * FROM produk WHERE id = '" . $_GET['paket'] . "'")->fetch_assoc();
$daftar_jenis_produk = $db_connect->query("SELECT * FROM jenis_produk");

if (isset($_POST['save'])) {
    $editPhoto = isset($_POST['editPhoto']);
    $editVideo = isset($_POST['editVideo']);
    $id = mysqli_real_escape_string($db_connect, $_POST['id_paket']);
    $paket = mysqli_real_escape_string($db_connect, $_POST['paket']);
    $deskripsi = mysqli_real_escape_string($db_connect, $_POST['deskripsi']);
    $jenis_paket = mysqli_real_escape_string($db_connect, $_POST['jenis_produk']);
    $harga = mysqli_real_escape_string($db_connect, $_POST['harga']);
    $foto = $editPhoto ? $_FILES['foto'] : $data['photo'];
    $inout = $_POST['inout'];
    $video = $editVideo ? $_FILES['video'] : $data['video'];
    $edit_photo = $editPhoto ? $_POST['editPhoto'] : false;
    $edit_video = $editVideo ? $_POST['editVideo'] : false;

    if (edit_produk($id, $paket, $deskripsi, $jenis_paket, $inout, $harga, $foto, $video, $edit_photo, $edit_video)) {
        $_SESSION['action_ed'] = 1;
        $_SESSION['edit_data'] = 1;
        $_SESSION['message_data'] = "Data berhasil diubah";
        echo "<script>location.href='detail_produk?produk=$id'</script>";
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
    <title>Wld Project | Edit Paket</title>
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Paket</h1>
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
                                        <li class="breadcrumb-item text-muted">Edit Paket</li>
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
                                <!--begin::Tables Widget 10-->
                                <div class="card mb-5 mb-xl-8">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold fs-3 mb-1">Edit Paket</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <!-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target"><i class="ki-duotone ki-plus fs-2"></i>Tambah Kategori</a> -->
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-3">
                                        <!--begin:Form-->
                                        <form id="kt_modal_new_target_form" class="form" method="post" action="#" enctype="multipart/form-data">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="required">Nama Paket</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Masukan nama paket baru">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <input type="hidden" class="form-control form-control-solid" placeholder="id paket" name="id_paket" value="<?= $data['id'] ?>" required><br>
                                                <input type="text" class="form-control form-control-solid" placeholder="paket" name="paket" value="<?= $data['nama'] ?>" autofocus required />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="required">Deskripsi Paket</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Masukan Deskripsi paket baru">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <textarea type="text" class="form-control form-control-solid" placeholder="deskripsi" name="deskripsi" required /><?= $data['deskripsi'] ?></textarea>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row g-9 mb-8">
                                                <!--begin::Col-->
                                                <div class="col-md-12 fv-row">
                                                    <label class="required fs-6 fw-semibold mb-2">Kategori Paket</label>
                                                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Jenis Produk" name="jenis_produk" required>
                                                        <option value="">pilih.</option>
                                                        <?php foreach ($daftar_jenis_produk as $jenis_produk) : ?>
                                                            <option value="<?= $jenis_produk['id'] ?>" <?= $jenis_produk['id'] == $data['jenis_produk'] ? 'selected' : ''; ?>><?= $jenis_produk['jenis_produk'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row g-9 mb-8">
                                                <!--begin::Col-->
                                                <div class="col-md-12 fv-row">
                                                    <label class="required fs-6 fw-semibold mb-2">In Door / Out Door</label>
                                                    <select class="form-select form-select-solid" data-control="select2"
                                                            data-hide-search="true" name="inout" required>
                                                        <option <?= $data['inout'] == 0 ? 'selected' : ''; ?> value="0">Out Door</option>
                                                        <option <?= $data['inout'] == 1 ? 'selected' : ''; ?>  value="1">In Door</option>
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="required">Harga Paket</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Masukan Deskripsi paket baru">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" placeholder="Harga" name="harga" value="<?= $data['harga'] ?>" required />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="switchEditPhoto" name="editPhoto">
                                                    <label class="form-check-label" for="switchEditPhoto">Edit Photo</label>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div id="elementEditPhoto" class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="required">Foto</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Masukan Foto">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control form-control-solid" placeholder="Harga" name="foto" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-8 fv-row">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="switchEditVideo" value="false" name="editVideo">
                                                    <label class="form-check-label" for="switchEditVideo">Edit Video</label>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div id="elementEditVideo" class="d-flex flex-column mb-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="required">Video</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Masukan Video">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <input type="file" accept="video/mp4" class="form-control form-control-solid" placeholder="Harga" name="video" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary me-3" name="save">Ubah</button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <!--end::Tables Widget 10-->
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