<?php
require_once '../functions/admin_service.php';

$jumlah_payment_pending = $db_connect->query("SELECT * FROM `payment_penjualan` WHERE status = 'pending'");
$jumlah_reschedule_pending = $db_connect->query("SELECT * FROM `reschedule` WHERE status = 'pending'");
$jumlah_acara_bulan_ini = $db_connect->query("SELECT * FROM detail_penjualan WHERE MONTH(tgl_acara) = MONTH(CURRENT_DATE()) AND YEAR(tgl_acara) = YEAR(CURRENT_DATE())");
$jumlah_pendapatan_bulanan = $db_connect->query("SELECT SUM(pembayaran) AS total_pembayaran FROM payment_penjualan WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND status = 'diterima'")->fetch_assoc();
$tanggal_disable = [];
$rating1 = $db_connect->query("select count(*) as rating from rating where rating = '1'")->fetch_assoc();
$rating2 = $db_connect->query("select count(*) as rating from rating where rating = '2'")->fetch_assoc();
$rating3 = $db_connect->query("select count(*) as rating from rating where rating = '3'")->fetch_assoc();
$rating4 = $db_connect->query("select count(*) as rating from rating where rating = '4'")->fetch_assoc();
$rating5 = $db_connect->query("select count(*) as rating from rating where rating = '5'")->fetch_assoc();
$list_acara = $db_connect->query("SELECT * FROM detail_penjualan");

foreach ($list_acara as $acara) {
    array_push($tanggal_disable, $acara['tgl_acara']);
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
    <title>Wld Project | Halaman Dashboard</title>
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

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('kt_calendar_app');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 650,
                events: [
                    <?php foreach ($list_acara as $acara) : ?> {
                            id: '<?= $acara['id']; ?>',
                            start: '<?= $acara['tgl_acara']; ?>',
                            end: '<?= $acara['tgl_acara']; ?>',
                            title: '<?= 'sudah dibooking' ?>'
                        },
                    <?php endforeach; ?>
                ]
            });

            console.log(calendar);

            calendar.render();
        });
    </script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
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
                                        <li class="breadcrumb-item text-muted">Dashboard</li>
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
                                <div class="row mb-5">

                                    <!-- Payment Pending -->
                                    <div class="col-xl-3">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment Pending</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_payment_pending->num_rows > 0 ? $jumlah_payment_pending->num_rows . ' Payment request approval' : 'Nothing' ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="ki-duotone ki-handcart fs-2x">
                                                        </i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reschedule Requests -->
                                    <div class="col-xl-3">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Reschedule Requests </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_reschedule_pending->num_rows > 0 ? $jumlah_reschedule_pending->num_rows . ' Reschedule request approval' : 'Nothing' ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="ki-outline ki-calendar fs-2x"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reschedule Requests -->
                                    <div class="col-xl-3">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Acara Bulan Ini</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_acara_bulan_ini->num_rows > 0 ? $jumlah_acara_bulan_ini->num_rows . ' Acara' : 'Nothing' ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="ki-outline ki-calendar fs-2x"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pembayaran masuk perbulan -->
                                    <div class="col-xl-3">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Pendapatan masuk perbulan</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($jumlah_pendapatan_bulanan['total_pembayaran']) ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="ki-outline ki-calendar fs-2x"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="card shadow-lg py-2">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <h2 class="card-title fw-bold">Kalender</h2>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body">
                                            <!--begin::Calendar-->
                                            <div id="kt_calendar_app" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">

                                            </div>
                                            <!--end::Calendar-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <!--begin::Charts Widget 1-->
                                        <div class="card card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Chart-->
                                                <div id="grafik_batang" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                                <!-- Script untuk membuat grafik batang -->
                                                <script type="text/javascript">

                                                    Highcharts.chart('grafik_batang', {
                                                        chart: {
                                                            type: 'column'
                                                        },
                                                        title: {
                                                            text: 'Grafik Statistik Rating'
                                                        },
                                                        subtitle: {
                                                            text: '3 Tahun Terakhir'
                                                        },
                                                        xAxis: {
                                                            categories: [
                                                                'Rating'
                                                            ],
                                                            crosshair: true
                                                        },
                                                        yAxis: {
                                                            min: 0,
                                                            title: {
                                                                text: 'Jumlah'
                                                            }
                                                        },
                                                        tooltip: {
                                                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b> {point.y:1f}</tr>',
                                                            footerFormat: '</table>',
                                                            shared: true,
                                                            useHTML: true
                                                        },
                                                        plotOptions: {
                                                            column: {
                                                                pointPadding: 0.2,
                                                                borderWidth: 0
                                                            }
                                                        },
                                                        series: [{
                                                            name: 'Rating 1',
                                                            data: [<?php echo $rating1['rating'] ?>]

                                                        }, {
                                                            name: 'Rating 2',
                                                            data: [<?php echo $rating2['rating'] ?>]

                                                        }, {
                                                            name: 'Rating 3',
                                                            data: [<?php  echo $rating3['rating'] ?>]

                                                        }, {
                                                            name: 'Rating 4',
                                                            data: [<?php echo $rating4['rating'] ?>]

                                                        },  {
                                                            name: 'Rating 5',
                                                            data: [<?php echo $rating5['rating'] ?>]

                                                        }]
                                                    });
                                                </script>
                                                <!--end::Chart-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Charts Widget 1-->
                                    </div>
                                    <div class="col-xl-6">
                                        <!--begin::Charts Widget 2-->
                                        <!--end::Charts Widget 2-->
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