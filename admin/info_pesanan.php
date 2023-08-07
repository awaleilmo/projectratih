<?php
require_once '../functions/admin_service.php';

if (!isset($_GET['pesanan'])) {
    header('location: booking');
}

$data_pesanan = $db_connect->query("SELECT * FROM penjualan WHERE nomor_invoice = '" . $_GET['pesanan'] . "'")->fetch_assoc();
$data_pembayaran = $db_connect->query("SELECT * FROM payment_penjualan WHERE nomor_invoice = '" . $_GET['pesanan'] . "'");
$data_produk = $db_connect->query("SELECT detail_penjualan.nomor_invoice, produk.id, produk.nama, produk.harga, produk.photo, detail_penjualan.tgl_acara, jenis_produk.jenis_produk FROM detail_penjualan JOIN produk ON detail_penjualan.id_produk = produk.id JOIN jenis_produk ON produk.jenis_produk = jenis_produk.id WHERE detail_penjualan.nomor_invoice = '" . $_GET['pesanan'] . "'");


if ($data_pesanan['sisa'] == "0") {
    $status = 'Lunas';
} elseif ($data_pesanan['sisa'] == $data_pesanan['total']) {
    $status = $status = 'Pending';
} else {
    $status = $status = 'Dibayar sebagian';
}


if (isset($_GET['terima_pembayaran'])) {
    $id = $_GET['terima_pembayaran'];
    $nomor_invoice = $_GET['pesanan'];

    if (terima_pembayaran($id)) {
        echo "<script>alert('berhasil');location.href='info_pesanan?pesanan=$nomor_invoice'</script>";
    }
}

if (isset($_GET['tolak_pembayaran'])) {
    $id = $_GET['tolak_pembayaran'];
    $nomor_invoice = $_GET['pesanan'];

    if (tolak_pembayaran($id)) {
        echo "<script>alert('berhasil');location.href='info_pesanan?pesanan=$nomor_invoice'</script>";
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
    <title>Wld Project | Daftar Booking</title>
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
        async function printFunction() {
            await document.getElementById('btnPrint').classList.add('d-none');
            let printContents = document.getElementById('print').innerHTML;
            let originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            document.getElementById('btnPrint').classList.remove('d-none');
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Booking</h1>
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
                                        <li class="breadcrumb-item text-muted">Booking</li>
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
                                <div id="print" class="card-body">
                                    <!-- begin::Wrapper-->
                                    <div class="">
                                        <!-- begin::Header-->
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="pb-12">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column gap-7 gap-md-10">
                                                <!--begin::Message-->
                                                <div class="fw-bold fs-2">Pesanan #<?= $data_pesanan['nomor_invoice'] ?>
                                                    <a href="#" id="btnPrint" class="btn float-end btn-sm fw-bold btn-primary" onclick="printFunction()"><i class="ki-duotone ki-print fs-2"></i>Print</a>
                                                </div>
                                                <!--begin::Message-->
                                                <!--begin::Separator-->
                                                <div class="separator"></div>
                                                <!--begin::Separator-->
                                                <!--begin::Order details-->
                                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                                    <div class="flex-root d-flex flex-column">
                                                        <span class="text-muted">Nomor Pesanan</span>
                                                        <span class="fs-5">#<?= $data_pesanan['nomor_invoice'] ?></span>
                                                    </div>
                                                    <div class="flex-root d-flex flex-column">
                                                        <span class="text-muted">Tanggal & Waktu Transaksi</span>
                                                        <span class="fs-5"><?= $data_pesanan['tgl_transaksi'] ?></span>
                                                    </div>
                                                    <div class="flex-root d-flex flex-column">
                                                        <span class="text-muted">Pembayaran</span>
                                                        <span class="fs-5">Rp <?= number_format($data_pesanan['total']) ?></span>
                                                    </div>
                                                    <div class="flex-root d-flex flex-column">
                                                        <span class="text-muted">Status Pembayaran</span>
                                                        <span class="fs-5 text-capitalize"><?= $status ?></span>
                                                    </div>
                                                </div>
                                                <!--end::Order details-->
                                                <!--begin:Order summary-->
                                                <div class="d-flex justify-content-between flex-column">
                                                    <!--begin::Table-->
                                                    <div class="table-responsive border-bottom mb-9">
                                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                            <thead>
                                                                <tr class="border-bottom fs-6 fw-bold text-muted">
                                                                    <th class="min-w-175px pb-2">Nama Produk</th>
                                                                    <th class="min-w-175px pb-2">Tanggal Acara</th>
                                                                    <th class="min-w-100px text-end pb-2">Harga Produk</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fw-semibold text-gray-600">
                                                                <?php foreach ($data_produk as $produk) : ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <!--begin::Thumbnail-->
                                                                                <a href="#" class="symbol symbol-50px">
                                                                                    <span class="symbol-label" style="background-image:url(../image/galery/<?= $produk['photo'] ?>);"></span>
                                                                                </a>
                                                                                <!--end::Thumbnail-->
                                                                                <!--begin::Title-->
                                                                                <div class="ms-5">
                                                                                    <div class="fw-bold"><?= $produk['nama'] ?></div>
                                                                                    <div class="fs-7 text-muted"><?= $produk['jenis_produk'] ?></div>
                                                                                </div>
                                                                                <!--end::Title-->
                                                                            </div>
                                                                        </td>
                                                                        <td><?= $produk['tgl_acara'] ?></td>
                                                                        <td class="text-end">Rp <?= number_format($produk['harga']) ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                <tr>
                                                                    <td colspan="2" class="text-end">Sub Total</td>
                                                                    <td class="text-end">Rp <?= number_format($data_pesanan['total'])  ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-end">Sudah Dibayarkan</td>
                                                                    <td class="text-end">Rp <?= number_format(($data_pesanan['total'] -  $data_pesanan['sisa']))  ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-end">Sisa Tagihan</td>
                                                                    <td class="text-end">Rp <?= number_format($data_pesanan['sisa'])  ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="fs-3 text-dark fw-bold text-end">Total</td>
                                                                    <td class="text-dark fs-3 fw-bolder text-end">Rp <?= number_format($data_pesanan['sisa'])  ?> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end:Order summary-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Body-->
                                        <!-- begin::Footer-->
                                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                                            <!-- begin::Actions-->
                                            <div class="my-1 me-5">
                                                <!-- begin::Pint-->
                                                <!-- <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Invoice</button> -->
                                                <!-- end::Pint-->
                                                <!-- begin::Download-->
                                                <!-- <button type="button" class="btn btn-light-success my-1">Download</button> -->
                                                <!-- end::Download-->
                                            </div>
                                            <!-- end::Actions-->
                                            <!-- begin::Action-->
                                            <!-- end::Action-->
                                        </div>
                                        <!-- end::Footer-->
                                    </div>
                                    <!-- end::Wrapper-->
                                </div>
                                <div class="card shadow-lg">
                                    <div class="card-header">
                                        <h3 class="card-title">Pembayaran</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive border-bottom mb-9">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <thead>
                                                    <tr class="border-bottom fs-6 fw-bold">
                                                        <th>ID</th>
                                                        <th>Waktu</th>
                                                        <th>Nominal</th>
                                                        <th>Bank</th>
                                                        <th>Pengirim</th>
                                                        <th>Status</th>
                                                        <th>Bukti transfer</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-600 text-muted">
                                                    <?php foreach ($data_pembayaran as $payment) : ?>
                                                        <tr>
                                                            <td><?= $payment['id'] ?></td>
                                                            <td><?= $payment['created_at'] ?></td>
                                                            <td>Rp <?= number_format($payment['pembayaran']) ?></td>
                                                            <td><?= $payment['jenis_pembayaran'] ?></td>
                                                            <td><?= $payment['nama_pembayar'] ?></td>
                                                            <td class="text-capitalize"><?= $payment['status'] ?></td>
                                                            <td><a href="../image/payment_proof/<?= $payment['bukti_pembayaran'] ?>" target="_blank">Lihat bukti transfer</a></td>
                                                            <td class="<?= $payment['status'] != 'pending' ? 'd-none' : '' ?>">
                                                                <?php if($_SESSION['role'] == 1){ ?>
                                                                <a href="info_pesanan?pesanan=<?= $payment['nomor_invoice'] ?>&terima_pembayaran=<?= $payment['id'] ?>" class="btn btn-sm btn-primary">Terima</a>
                                                                <a href="info_pesanan?pesanan=<?= $payment['nomor_invoice'] ?>&tolak_pembayaran=<?= $payment['id'] ?>" class="btn btn-sm btn-danger">Tolak</a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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