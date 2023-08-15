<?php
require_once '../functions/member_service.php';
require_once '../functions/general_service.php';

if (!isset($_GET['id'])) {
    header('location: pesanan');
}
$list_item = $db_connect->query("SELECT * FROM keranjang WHERE id_user = '" . $_SESSION['id_user'] . "'");
$list_item_2 = $db_connect->query("SELECT * FROM keranjang WHERE id_user = '" . $_SESSION['id_user'] . "'");
$grand_total = 0;
$list_acara = $db_connect->query("SELECT * FROM detail_penjualan");
$tanggal_disable = [];

foreach ($list_acara as $acara) {
    array_push($tanggal_disable, $acara['tgl_acara']);
}

if (isset($_POST['save'])) {
    $query = $db_connect->query("INSERT INTO reschedule (`detail_penjualan`, `tgl_asal`, `tgl_pengajuan`, `keterangan`, `status`) VALUES ('" . $_POST['id'] . "', '" . $_POST['jadwal_asal'] . "', '" . $_POST['jadwal_pengganti'] . "', '" . $_POST['keterangan'] . "', 'pending')");

    if ($query) {
        echo "<script>alert('berhasil mengajukan form');location.href='info_pesanan?pesanan=" . $_POST['nomor_invoice'] . "'</script>";
    }
}

$data_jadwal = $db_connect->query("SELECT * FROM detail_penjualan WHERE id = '" . $_GET['id'] . "'")->fetch_assoc();
$data_pengajuan = $db_connect->query("SELECT * FROM reschedule WHERE detail_penjualan = '" . $_GET['id'] . "'");

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
    <title>Wld Project | Rescheduler</title>
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
    <script>
        const compareDate = (value) => {
            let today = new Date();
            let dateComp = new Date(value);

            return today > dateComp;
        }
        const mydate = (value1, value2) => {
            let today = new Date(value1);
            let dateComp = new Date(value2);
            return today.getTime() === dateComp.getTime();
        }

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
                            title: mydate( '<?= $data_jadwal['tgl_acara'] ?>', '<?= $acara['tgl_acara'] ?>') ? 'Acara Saya' : !compareDate('<?= $acara['tgl_acara']; ?>') ? 'Sudah dibooking' : 'Selesai',
                            color: mydate( '<?= $data_jadwal['tgl_acara'] ?>', '<?= $acara['tgl_acara'] ?>') ? 'deeppink': !compareDate('<?= $acara['tgl_acara']; ?>') ? '#3788d8' : 'limegreen'
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Reschedul Jadwal</h1>
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
                                        <li class="breadcrumb-item text-muted">Ubah Tanggal Acara</li>
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
                                <div class="card">
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
                                <div class="container mt-5 <?= $data_pengajuan->num_rows > 0 ? 'd-none' : '' ?>">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="card shadow-sm">
                                            <div class="card-header">
                                                <h3 class="card-title">Form pengajuan ganti jadwal</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-5">
                                                    <label class="required form-label">Jadwal Asal</label>
                                                    <input type="hidden" name="nomor_invoice" class="form-control form-control-solid" value="<?= $data_jadwal['nomor_invoice'] ?>" required readonly />
                                                    <input type="hidden" name="id" class="form-control form-control-solid" value="<?= $data_jadwal['id'] ?>" required readonly />
                                                    <input type="date" name="jadwal_asal" class="form-control form-control-solid" value="<?= $data_jadwal['tgl_acara'] ?>" required readonly />
                                                </div>
                                                <div class="mb-5">
                                                    <label class="required form-label">Jadwal Pengganti</label>
                                                    <input type="date" name="jadwal_pengganti" class="form-control form-control-solid date-input" required />
                                                </div>
                                                <div class="mb-5">
                                                    <label class="required form-label">Keterangan</label>
                                                    <textarea name="keterangan" class="form-control form-control-solid" placeholder="Masukan informasi terkait pergantian jadwal" required /></textarea>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-primary btn-sm" name="save">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="container mt-5 <?= !$data_pengajuan->num_rows > 0 ? 'd-none' : '' ?>">
                                    <div class="card shadow-lg mt-5">
                                        <div class="card-header">
                                            <h3 class="card-title">Pengajuan</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive border-bottom mb-9">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <thead>
                                                        <tr class="border-bottom ">
                                                            <th>Tgl Sebelum</th>
                                                            <th>Tgl Pengajuan</th>
                                                            <th>Keterangan</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600 text-muted">
                                                        <?php foreach ($data_pengajuan as $data) : ?>
                                                            <tr>
                                                                <td><?= $data['tgl_asal'] ?></td>
                                                                <td><?= $data['tgl_pengajuan'] ?></td>
                                                                <td><?= $data['keterangan'] ?></td>
                                                                <td class="text-capitalize"><?= $data['status'] ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
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

        <script>
            // Mendapatkan elemen input dengan id 'nominal'
            var inputNominal = document.getElementById('nominal');

            // Mendefinisikan fungsi untuk memeriksa nilai input
            function checkValue() {
                var nominal = parseFloat(inputNominal.value);

                // Memeriksa apakah nilai input melebihi nilai maksimum atau kurang dari nilai minimum
                if (nominal > <?= $grand_total ?>) {
                    alert('Nominal tidak boleh melebihi total yang harus dibayarkan');
                    inputNominal.value = ''; // Mengosongkan nilai input
                } else if (nominal < <?= ($grand_total * 0.5) ?>) {
                    alert('Nominal pembayaran minimal 50% dari total yang harus dibayarkan');
                    inputNominal.value = ''; // Mengosongkan nilai input
                }
            }

            // Menambahkan event listener untuk memanggil fungsi checkValue saat nilai input berubah
            inputNominal.addEventListener('change', checkValue);
        </script>

        <!--end::Custom Javascript-->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var dateInputs = document.getElementsByClassName("date-input");

                for (var i = 0; i < dateInputs.length; i++) {
                    var input = dateInputs[i];
                    var currentDate = new Date();
                    var minDate = currentDate.toISOString().split("T")[0];
                    let someDate = new Date();
                    let numberOfDaysToAdd = 7;
                    let result = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
                    let minDateF = new Date(result);
                    input.min = minDateF.toISOString().split("T")[0];
                    // input.addEventListener("input", disableSpecificDates);
                }
            });

            function disableSpecificDates(event) {
                var input = event.target;
                var selectedDate = new Date(input.value);

                // Tanggal-tanggal yang ingin dinonaktifkan
                var disabledDates = [<?php foreach ($tanggal_disable as $tanggal => $number) {
                                            echo "'" . $number . "',";
                                        } ?>]

                var minDate = new Date(); // Tanggal minimum yang diizinkan adalah tanggal saat ini
                var maxDate = new Date("2100-12-31"); // Tanggal maksimum yang diizinkan

                // Mengubah tanggal minimum menjadi tanggal saat ini
                var minDateISO = minDate.toISOString().split("T")[0];

                // Cek apakah tanggal yang dipilih ada dalam daftar tanggal yang dinonaktifkan
                var selectedDateString = input.value;
                if (disabledDates.includes(selectedDateString)) {
                    input.value = ""; // Reset nilai input jika tanggal dinonaktifkan dipilih
                    alert("Tanggal tersebut sudah di-booking. Silakan pilih tanggal lain.");
                }

                // Menonaktifkan tanggal yang kurang dari tanggal saat ini
                var allDates = input.parentNode.querySelectorAll("input[type='date']");
                for (var i = 0; i < allDates.length; i++) {
                    var date = allDates[i];
                    if (date.value < minDateISO) {
                        date.value = "";
                    }
                }

                // Atur nilai minimum dan maksimum berdasarkan batasan yang diinginkan
                input.min = minDateISO;
                input.max = maxDate.toISOString().split("T")[0];
            }
        </script>
        <!--end::Javascript-->
</body>
<!--end::Body-->

</html>