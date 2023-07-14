<?php
require_once '../functions/admin_service.php';
$list_pelanggan = $_SESSION['role'] == 1 ? $db_connect->query("SELECT * FROM user WHERE is_admin = 0") : $db_connect->query("SELECT * FROM user WHERE is_admin = 1");

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
    <title>Wld Project | Pesan Administrator</title>
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

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
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
                                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                    Pesan</h1>
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
                                    <li class="breadcrumb-item text-muted">Pesan</li>
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
                        <div id="kt_app_content_container" class="app-container container-xxxl">
                            <div class="d-flex flex-column flex-lg-row">
                                <!--begin::Sidebar-->
                                <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                                    <!--begin::Contacts-->
                                    <div class="card card-flush">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-5" id="kt_chat_contacts_body">
                                            <!--begin::List-->
                                            <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true"
                                                 data-kt-scroll-activate="{default: false, lg: true}"
                                                 data-kt-scroll-max-height="auto"
                                                 data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header"
                                                 data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body"
                                                 data-kt-scroll-offset="5px">
                                                <?php foreach ($list_pelanggan as $pelanggan) : ?>
                                                    <?php
                                                    $user = $_SESSION['id_user'];
                                                    $pelanggan1 = $pelanggan['id'];
                                                    $unread_message = $db_connect->query("SELECT * FROM `pesan` WHERE id_user_1 = '$pelanggan1' AND id_user_2 = '$user' AND `read` = '0'")->num_rows;
                                                    ?>
                                                    <!--begin::User-->
                                                    <div class="d-flex flex-stack py-4">
                                                        <!--begin::Details-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Avatar-->
                                                            <div class="symbol symbol-45px symbol-circle">
                                                                <img alt="<?= $pelanggan['nama'] ?> profil"
                                                                     src="../image/user_profile/<?= $pelanggan['photo'] ?>">
                                                            </div>
                                                            <!--end::Avatar-->
                                                            <!--begin::Details-->
                                                            <div class="ms-5">
                                                                <a href="pesan?user=<?= $pelanggan['id'] ?>"
                                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2"><?= $pelanggan['nama'] ?></a>
                                                                <div class="fw-semibold text-muted"><?= $pelanggan['email'] ?> </div>
                                                            </div>
                                                            <!--end::Details-->
                                                        </div>
                                                        <!--end::Details-->
                                                        <!--begin:: Unread Message-->
                                                        <div class="d-flex flex-column align-items-end ms-2">
                                                            <?php if ($unread_message > 0) : ?>
                                                                <span class="badge badge-sm badge-circle badge-light-success"
                                                                      data-toggle="tooltip" data-placement="top"
                                                                      title="<?= $unread_message ?> pesan belum dibaca"><?= $unread_message ?></span>
                                                            <?php endif ?>
                                                        </div>
                                                        <!--end::Unread Message-->
                                                    </div>
                                                    <!--end::User-->
                                                    <!--begin::Separator-->
                                                    <div class="separator separator-dashed d-none"></div>
                                                    <!--end::Separator-->
                                                <?php endforeach; ?>
                                            </div>
                                            <!--end::List-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <!--end::Sidebar-->
                                <!--begin::Content-->
                                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                                    <?php
                                    if (isset($_GET['user'])) : ?>
                                        <?php
                                        $user = $_GET['user'];
                                        $data_user = $db_connect->query("SELECT * FROM user WHERE id = '$user'")->fetch_assoc();
                                        ?>
                                        <!--begin::Messenger-->
                                        <div class="card" id="kt_chat_messenger">
                                            <!--begin::Card header-->
                                            <div class="card-header" id="kt_chat_messenger_header">
                                                <!--begin::Title-->
                                                <div class="card-title">
                                                    <!--begin::User-->
                                                    <div class="d-flex justify-content-center flex-column me-3">
                                                        <a href="#"
                                                           class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1"><?= $data_user['nama'] ?></a>
                                                        <!--begin::Info-->
                                                        <!-- <div class="mb-0 lh-1">
                                                            <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                                            <span class="fs-7 fw-semibold text-muted">Active</span>
                                                        </div> -->
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body" id="kt_chat_messenger_body">
                                                <!--begin::Messages-->
                                                <div id="message-container"
                                                     class="scroll-y me-n5 pe-5 h-300px h-lg-auto"
                                                     data-kt-element="messages" data-kt-scroll="true"
                                                     data-kt-scroll-activate="{default: false, lg: true}"
                                                     data-kt-scroll-max-height="auto"
                                                     data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                                                     data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                                                     data-kt-scroll-offset="5px" style="max-height: 51px;">

                                                </div>
                                                <!--end::Messages-->
                                            </div>
                                            <!--end::Card body-->
                                            <!--begin::Card footer-->
                                            <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                                <!--begin::Input-->
                                                <textarea id="isi_pesan"
                                                          class="form-control form-control-flush mb-3 bg-light" rows="1"
                                                          data-kt-element="input"
                                                          placeholder="Type a message"></textarea>
                                                <!--end::Input-->
                                                <!--begin:Toolbar-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Send-->
                                                    <button id="kirim_pesan" class="btn btn-primary" type="button"
                                                            onclick="setPesan()">Kirim
                                                    </button>
                                                    <!--end::Send-->
                                                </div>
                                                <!--end::Toolbar-->
                                            </div>
                                            <!--end::Card footer-->
                                        </div>
                                        <!--end::Messenger-->
                                    <?php else : ?>
                                        <!--begin::Messenger-->
                                        <div class="card" id="kt_chat_messenger">
                                            <!--begin::Card header-->
                                            <div class="card-header" id="kt_chat_messenger_header">
                                                <!--begin::Title-->
                                                <div class="card-title">
                                                    <!--begin::User-->
                                                    <div class="d-flex justify-content-center flex-column me-3">
                                                        Pilih user untuk memunculkan pesan
                                                        <!--begin::Info-->
                                                        <!-- <div class="mb-0 lh-1">
                                                            <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                                            <span class="fs-7 fw-semibold text-muted">Active</span>
                                                        </div> -->
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::Messenger-->
                                    <?php endif ?>

                                </div>
                                <!--end::Content-->
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
    <!-- start::modal_buat_user -->
    <!--begin::Modal - New Target-->
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" method="post" action="#">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Tambah Kategori</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nama Kategori</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Masukan nama kategori baru">
                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Kategori"
                                   name="kategori" required/>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary me-3" name="buat_kategori">Buat</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target-->
    <!-- end::modal_buat_user -->
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
    <!-- <script src="../theme/Metronic/assets/js/custom/utilities/modals/new-target.js"></script> -->
    <script src="../theme/Metronic/assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php if (isset($_GET['user'])) : ?>
        <script>
            function kirimPesan(pesan) {
                $.ajax({
                    url: 'save_message.php',
                    type: 'POST',
                    data: {
                        pengirim: <?= $_SESSION['id_user'] ?>,
                        penerima: '<?= $data_user['id'] ?>',
                        pesan: pesan
                    },
                    success: function (response) {
                    }
                });
            }

            function setPesan() {
                var isi_pesan = $("#isi_pesan").val().trim();
                console.log(isi_pesan)
                $("#isi_pesan").val('')
                var pesan_baru = `<div class="d-flex justify-content-end mb-10">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column align-items-end">
                        <!--begin::User-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Details-->
                            <div class="me-3">
                                <span class="text-muted fs-7 mb-1">Sekarang</span>
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                            </div>
                            <!--start::Avatar-->
                            <div class="symbol  symbol-35px symbol-circle ">
                            <img alt="Pic" src="../image/user_profile/<?= $_SESSION['url_photo'] ?>">
                            </div>
                            <!--end::Avatar-->                 
                        </div>
                        <!--end::User-->
                        <!--begin::Text-->
                        <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">
                            ${isi_pesan}
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Wrapper-->
                </div>`;

                $("#message-container").append(pesan_baru);
                kirimPesan(isi_pesan);
            }

            var jumlah_pesan = 0;

            function receiveMessages(callback) {
                $.ajax({
                    url: 'isi_pesan.php?user_1=<?= $data_user['id'] ?>&user_2=<?= $_SESSION['id_user'] ?>',
                    type: 'GET',
                    success: function (response) {
                        $('#message-container').empty();
                        $('#message-container').html(response);
                        callback();

                        var jumlah_element = $(response).find('#isiPesan').length;

                        if (jumlah_pesan != jumlah_element) {
                            jumlah_pesan = jumlah_element;
                            scrollToBottom();
                        }
                    }
                });
            }

            // Fungsi callback untuk menjalankan animasi scroll setelah konten pesan dimuat
            function scrollToBottom() {
                var element = $('#message-container');
                var scrollHeight = element.prop("scrollHeight");
                element.animate({
                    scrollTop: scrollHeight
                }, "slow");
            }

            function doNothing() {
            }

            receiveMessages(scrollToBottom); // Memanggil fungsi scrollToBottom saat halaman dibuka
            setInterval(function () {
                receiveMessages(doNothing);
            }, 1000);
        </script>
    <?php endif; ?>
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>