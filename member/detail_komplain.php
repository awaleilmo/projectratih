<?php
require_once '../functions/member_service.php';
require_once '../functions/general_service.php';


$list_komplain = $db_connect->query("SELECT komplain.*, user.nama FROM komplain JOIN user ON user.id = komplain.id_user WHERE komplain.id = '" . $_GET['komplain'] . "'")->fetch_assoc();

$timeline_komplain = $db_connect->query("SELECT * FROM timeline_komplain WHERE id_komplain = '" . $_GET['komplain'] . "'");

if (isset($_GET['delete']) && $_GET['delete'] == 'true') {
    $delete = $db_connect->query("DELETE FROM komplain WHERE id = ' " . $_GET['komplain'] . "'");
    $delete_timeline = $db_connect->query("DELETE FROM timeline_komplain WHERE id_komplain   = ' " . $_GET['komplain'] . "'");
    if ($delete) {
        echo "<script>alert('berhasil dihapus');location.href='komplain'</script>";
    }
}

// if (isset($_GET['finish']) && $_GET['finish'] == 'true') {
//     $date = date("Y-m-d H:i:s");
//     $id_user = $_SESSION['id_user'];
//     $finish = $db_connect->query("UPDATE komplain SET `status` = 'selesai', updated_at = '$date' WHERE id = ' " . $_GET['id_komplain'] . "'");
//     $update_timeline = $db_connect->query("INSERT INTO `timeline_komplain` (`id_komplain`, `created_at`, `created_by`, `status`, `description`) VALUES ('$id_komplain', '$date', '$id_user', 'selesai', 'komplainan diselesaikan oleh user')");
//     if ($finish && $update_timeline) {
//         echo "<script>alert('berhasil');location.href='komplain'</script>";
//     }
// }

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
    <title>Wld Project | Komplain</title>
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Komplain</h1>
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
                                        <li class="breadcrumb-item text-muted">
                                            <a href="komplain" class="text-muted text-hover-primary">Komplain</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Detail Komplain</li>
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
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Detail Komplain</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-5">
                                                        <label class="required form-label">Nomor Invoice</label>
                                                        <input type="text" name="nomor_invoice" class="form-control form-control-solid" placeholder="Nomor Invoice" value="<?= $list_komplain['nomor_invoice'] ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-5">
                                                        <label class="required form-label">Status</label>
                                                        <input type="text" name="status" class="form-control form-control-solid" placeholder="Status" value="<?= $list_komplain['status'] ?>" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-5">
                                                <label class="required form-label">Keterangan</label>
                                                <textarea name="keterangan" class="form-control form-control-solid" placeholder="Keterangan" readonly /><?= $list_komplain['keterangan'] ?></textarea>
                                            </div>
                                            <div class="mb-5">
                                                <label class="required form-label">Media</label>
                                                <input type="text" name="media" class="form-control form-control-solid" placeholder="Media" value="<?= $list_komplain['media'] ?>" readonly />
                                                <a href="../media_komplain/<?= $list_komplain['media'] ?>">Download media</a>
                                            </div>
                                            <div class="mb-5">
                                                <label class="required form-label">Dibuat pada</label>
                                                <input type="text" name="created_at" class="form-control form-control-solid" placeholder="Created at" value="<?= $list_komplain['created_at'] ?>" readonly />
                                            </div>
                                            <div class="text-end">
                                                <a href="edit_komplain?id=<?= $_GET['komplain'] ?>&edit=media" class="btn btn-info <?= $list_komplain['status']  != 'pending' ? 'd-none' : '' ?>">Ubah Media</a>
                                                <a href="edit_komplain?id=<?= $_GET['komplain'] ?>&edit=keterangan" class="btn btn-primary <?= $list_komplain['status']  != 'pending' ? 'd-none' : '' ?>">Ubah Keterangan</a>
                                                <a href="detail_komplain?komplain=<?= $_GET['komplain'] ?>&delete=true" class="btn btn-danger" onclick="return confirm('hapus komplain ini ?')">Hapus Komplain</a>
                                                <!-- <a href="detail_komplain?komplain=<?= $_GET['komplain'] ?>&finish=true" class="btn btn-success" onclick="return confirm('Yakin untuk menyelesaikan komplainan ini ?')">Selesai</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-5">
                                    <!--begin::Timeline-->
                                    <div class="card">
                                        <!--begin::Card head-->
                                        <div class="card-header card-header-stretch">
                                            <!--begin::Title-->
                                            <div class="card-title d-flex align-items-center">
                                                <i class="ki-duotone ki-pin fs-1 text-primary me-3 lh-0">
                                                    <i class="path1"></i>
                                                    <i class="path2"></i>
                                                </i>
                                                <h3 class="fw-bold m-0 text-gray-800">Track Record</h3>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Card head-->

                                        <!--begin::Card body-->
                                        <div class="card-body">
                                            <!--begin::Tab Content-->
                                            <div class="tab-content">
                                                <!--begin::Tab panel-->
                                                <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="kt_activity_today_tab">
                                                    <!--begin::Timeline-->
                                                    <div class="timeline">
                                                        <?php foreach ($timeline_komplain as $timeline) : ?>
                                                            <?php
                                                            $nama_user = $db_connect->query("SELECT * FROM user WHERE id = '" . $timeline['created_by'] . "'")->fetch_assoc()['nama'];
                                                            ?>
                                                            <!--begin::Timeline item-->
                                                            <div class="timeline-item">
                                                                <!--begin::Timeline line-->
                                                                <div class="timeline-line w-40px"></div>
                                                                <!--end::Timeline line-->

                                                                <?php if ($timeline['status'] == 'komplain dibuat') : ?>
                                                                    <!--begin::Timeline icon-->
                                                                    <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                                                        <div class="symbol-label bg-light">
                                                                            <i class="ki-duotone ki-message-add fs-2 text-gray-500">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Timeline icon-->
                                                                <?php elseif ($timeline['status'] == 'dalam proses') : ?>
                                                                    <!--begin::Timeline icon-->
                                                                    <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                                                        <div class="symbol-label bg-light">
                                                                            <i class="ki-duotone ki-loading fs-2 text-gray-500">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Timeline icon-->
                                                                <?php elseif ($timeline['status'] == 'selesai') : ?>
                                                                    <!--begin::Timeline icon-->
                                                                    <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                                                        <div class="symbol-label bg-light">
                                                                            <i class="ki-duotone ki-flag fs-2 text-gray-500">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Timeline icon-->
                                                                <?php elseif ($timeline['status'] == 'ditolak') : ?>
                                                                    <!--begin::Timeline icon-->
                                                                    <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                                                        <div class="symbol-label bg-light">
                                                                            <i class="ki-duotone ki-cross-square fs-2 text-gray-500">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Timeline icon-->
                                                                <?php endif; ?>

                                                                <!--begin::Timeline content-->
                                                                <div class="timeline-content mb-10 mt-n1">
                                                                    <!--begin::Timeline heading-->
                                                                    <div class="pe-3 mb-5">
                                                                        <!--begin::Title-->
                                                                        <div class="fs-5 fw-semibold mb-2 text-capitalize"><?= $timeline['status'] ?></div>
                                                                        <!--end::Title-->

                                                                        <!--begin::Description-->
                                                                        <div class="d-flex align-items-center mt-1 fs-6">
                                                                            <!--begin::Info-->
                                                                            <div class="text-muted me-2 fs-7">Dibuat pada <?= $timeline['created_at'] ?> oleh <?= $nama_user ?></div>
                                                                            <!--end::Info-->
                                                                        </div>
                                                                        <!--end::Description-->
                                                                    </div>
                                                                    <!--end::Timeline heading-->

                                                                    <!--begin::Timeline details-->
                                                                    <div class="overflow-auto pb-5">
                                                                        <!--begin::Record-->
                                                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                            <!--begin::Title-->
                                                                            <p class="fs-5 text-dark fw-semibold w-375px min-w-200px"><?= $timeline['description'] ?></p>
                                                                            <!--end::Title-->
                                                                        </div>
                                                                        <!--end::Record-->
                                                                    </div>
                                                                    <!--end::Timeline details-->
                                                                </div>
                                                                <!--end::Timeline content-->
                                                            </div>
                                                            <!--end::Timeline item-->
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <!--end::Tab panel-->
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
</body>
<!--end::Body-->

</html>