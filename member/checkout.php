<?php

global $db_connect;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

require_once '../functions/member_service.php';
require_once '../functions/general_service.php';
require_once '../functions/email.php';


$list_item = $db_connect->query("SELECT * FROM keranjang WHERE id_user = '" . $_SESSION['id_user'] . "'");
$list_item_2 = $db_connect->query("SELECT * FROM keranjang WHERE id_user = '" . $_SESSION['id_user'] . "'");
$emain = $db_connect->query('SELECT * FROM user WHERE is_admin = "1"');
$grand_total = 0;
$list_acara = $db_connect->query("SELECT * FROM detail_penjualan");
$tanggal_disable = [];


foreach ($list_acara as $acara) {
    array_push($tanggal_disable, $acara['tgl_acara']);
}

if (isset($_POST['submit_pembayaran'])) {

    $nomor_invoice = "INV" . date('YmdHis');

    $bukti_transfer = $_FILES['bukti_transfer'];

    $fileName = basename($bukti_transfer['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = $nomor_invoice . '.' . $fileExtension;
    $targetDir = '../image/payment_proof/';
    $targetPath = $targetDir . $newFileName;
    $status = 'pending';

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = false;;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'mail.wldproject.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'system@wldproject.com';                     //SMTP username
        $mail->Password = 'system1721';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //pengirim
        $mail->setFrom('system@wldproject.com', 'WLD Project');
        $mail->addAddress('admin@wldproject.com', 'Admin');      //Add a recipient
        foreach ($emain as $email) {
            $mail->addAddress($email['email'], $email['nama']);
        }
//        $mail->addAddress('ratihbwln@gmail.com', 'Ratih');

        //Content
        $mail->AddCustomHeader('X-MSMail-Priority', 'High');
        $mail->AddCustomHeader('Importance', 'High');
        $mail->AddCustomHeader('X-MSMail-Priority', 'High');
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Booking WLD Project #' . $nomor_invoice;
        $mail->Body = sendEmailToAdmin();
        $mail->AltBody = '';
        //$mail->AddEmbeddedImage('gambar/logo.png', 'logo'); //abaikan jika tidak ada logo
        //$mail->addAttachment('');

        $mail->send();
        $db_connect->query("DELETE FROM keranjang WHERE id_user = '" . $_SESSION['id_user'] . "'");

        // proses insert data penjualan
        $db_connect->query("INSERT INTO penjualan VALUES ('$nomor_invoice', '" . $_SESSION['id_user'] . "', '" . date('Y-m-d H:i:s') . "','null','0','" . $_POST['total_harga'] . "','" . $_POST['total_harga'] . "')");

        // proses insert detail produk pernjualan beserta tanggal nya
        for ($i = 0; $i < count($_POST['tgl_booking_product']); $i++) {
            $db_connect->query("INSERT INTO detail_penjualan (`nomor_invoice`, `id_produk`, `tgl_acara`) VALUES ('$nomor_invoice', '" . $_POST['id_product'][$i] . "', '" . $_POST['tgl_booking_product'][$i] . "')");
        }

        // proses insert payment penjualan
        $db_connect->query("INSERT INTO payment_penjualan VALUES ('','$nomor_invoice', '" . $_POST['nominal'] . "', '" . $_POST['bank'] . "', '$newFileName','" . $_POST['nama_pengirim'] . "','$status', '" . date('Y-m-d H:i:s') . "')");

        move_uploaded_file($bukti_transfer['tmp_name'], $targetPath);
        // return to pesanan page
        echo "<script>alert('Pesanan berhasil dibuat');location.href='pesanan'</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
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
    <base href=""/>
    <title>Wld Project | Checkout</title>
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
    <script src="../theme/Metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script>
        const gantidp = (value) => {
            let slt = document.getElementById('changeDP')
            let result = document.getElementById('nominal');
            const total = value * slt.value / 100;
            result.value = total
        }

        const compareDate = (value) => {
            let today = new Date();
            let dateComp = new Date(value);

            return today > dateComp;
        }

        const SaveFn = () => {
            let result = document.getElementById('kt_modal_2')
            result.classList.add('d-block')
        }

        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('kt_calendar_app');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 650,
                events: [
                    <?php foreach ($list_acara as $acara) : ?> {
                        id: '<?= $acara['id']; ?>',
                        start: '<?= $acara['tgl_acara']; ?>',
                        end: '<?= $acara['tgl_acara']; ?>',
                        title: !compareDate('<?= $acara['tgl_acara']; ?>') ? 'Sudah dibooking' : 'Selesai',
                        color: !compareDate('<?= $acara['tgl_acara']; ?>') ? '#3788d8' : 'limegreen'
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

<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true"
      data-kt-app-toolbar-enabled="true" class="app-default">
<!--begin::Theme mode setup on page load-->
<script>
    let defaultThemeMode = "light";
    let themeMode;
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
                                    Checkout</h1>
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
                                    <li class="breadcrumb-item text-muted">Checkout</li>
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
                                    <div id="kt_calendar_app"
                                         class="fc fc-media-screen fc-direction-ltr fc-theme-standard">

                                    </div>
                                    <!--end::Calendar-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <div class="container">
                                <div class="row mt-5">
                                    <div class="col-lg-6">
                                        <div class="card shadow-sm ">
                                            <div class="card-body pt-3">
                                                <!--begin::Table container-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                        <tr class="border-0">
                                                            <th>Nama Produk</th>
                                                            <th>Harga</th>
                                                        </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                        <?php foreach ($list_item as $item) : ?>
                                                            <?php
                                                            $id_produk = $item['id_produk'];
                                                            $data_produk = $db_connect->query("SELECT * FROM produk WHERE id = '$id_produk'")->fetch_assoc();
                                                            $id_kategori = $data_produk['jenis_produk'];
                                                            $kategori_produk = $db_connect->query("SELECT * FROM jenis_produk WHERE id = '$id_kategori'")->fetch_assoc()['jenis_produk'];
                                                            $grand_total += $data_produk['harga'];
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class=" d-flex align-items-center">
                                                                        <!--begin::Name-->
                                                                        <div class="d-flex justify-content-start flex-column">
                                                                            <a href="#"
                                                                               class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= $data_produk['nama'] ?></a>
                                                                            <a href="#"
                                                                               class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
                                                                                <span class="text-dark">Kategori</span>: <?= $kategori_produk ?>
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Name-->
                                                                    </div>
                                                                </td>
                                                                <td class="fw-semibold">
                                                                    Rp <?= number_format($data_produk['harga']); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <tr>
                                                            <th>Total Harga :</th>
                                                            <th>Rp <?= number_format($grand_total) ?></th>
                                                        </tr>
                                                        </tbody>
                                                        <!--end::Table body-->
                                                        <!--end::Table footer-->
                                                        <tfooter>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h3>Pembayaran dilakukan dengan transfer ke rekening
                                                                        BCA : 882982310, atas nama : Ucup Marucup</h3>
                                                                </td>
                                                            </tr>
                                                        </tfooter>
                                                        <!--begin::Table footer-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table container-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-sm-5">
                                        <form action="" method="POST" enctype="multipart/form-data" onsubmit="SaveFn()">
                                            <div class="card shadow-sm">
                                                <div class="card-header">
                                                    <h3 class="card-title">Pembayaran</h3>
                                                </div>
                                                <div class="card-body">
                                                    <?php foreach ($list_item_2 as $item) : ?>
                                                        <?php
                                                        $produk = $db_connect->query("SELECT * FROM produk WHERE id = '" . $item['id_produk'] . "'")->fetch_assoc();
                                                        ?>
                                                        <div class="mb-5">
                                                            <label class="required form-label">Tanggal Booking
                                                                Paket <?= $produk['nama'] ?></label>
                                                            <input id="dateID" type="date" name="tgl_booking_product[]"
                                                                   class="form-control form-control-solid date-input"
                                                                   placeholder="tanggal booking" required/>
                                                            <input type="hidden" name="id_product[]"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="ID Produk" value="<?= $produk['id'] ?>"
                                                                   required/>
                                                            <input type="hidden" name="total_harga"
                                                                   class="form-control form-control-solid"
                                                                   placeholder="ID Produk" value="<?= $grand_total ?>"
                                                                   required/>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="mb-5">
                                                        <label class="form-label">DP</label>
                                                        <select id="changeDP" class="form-select" onchange="gantidp(<?= $grand_total ?>)" aria-label="Select example">
                                                            <option value="0">0 %</option>
                                                            <option value="50">50 %</option>
                                                            <option value="70">70 %</option>
                                                            <option value="100">100 %</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="required form-label">Nominal Pembayaran</label>
                                                        <input type="number" id="nominal" name="nominal"
                                                               class="form-control form-control-solid"
                                                               placeholder="Nominal" max="<?= $grand_total ?>"
                                                               min="<?= ($grand_total * 0.5) ?>" required/>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="required form-label">Bank</label>
                                                        <input type="text" name="bank"
                                                               class="form-control form-control-solid"
                                                               placeholder="Nama Bank" required/>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="required form-label">Atas Nama</label>
                                                        <input type="text" name="nama_pengirim"
                                                               class="form-control form-control-solid"
                                                               placeholder="Nama Pengirim" required/>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="required form-label">Bukti Transfer</label>
                                                        <input type="file" accept=".jpg, .jpeg, .png"
                                                               name="bukti_transfer"
                                                               class="form-control form-control-solid"
                                                               placeholder="Bukti Transfer" required/>
                                                        <span class="form-text text-muted">*tipe file hanya <strong>JPG, JPEG, PNG</strong></span>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="required form-label">Alamat</label>
                                                        <textarea name="alamat" class="form-control form-control-solid"
                                                                  placeholder="Alamat" required/></textarea>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-primary btn-sm" name="submit_pembayaran">
                                                        Bayar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal bg-body" tabindex="-1" id="kt_modal_2">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content shadow-none">

                                    <div class="modal-body d-flex align-items-center justify-content-center">
                                        <span class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </span>
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
        let hostUrl = "../theme/Metronic/assets/";
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
        let inputNominal = document.getElementById('nominal');

        // Mendefinisikan fungsi untuk memeriksa nilai input
        function checkValue() {
            let nominal = parseFloat(inputNominal.value);

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
        document.addEventListener("DOMContentLoaded", function () {
            let dateInputs = document.getElementsByClassName("date-input");

            for (let i = 0; i < dateInputs.length; i++) {
                let input = dateInputs[i];
                let currentDate = new Date();
                let minDate = currentDate.toISOString().split("T")[0];
                let someDate = new Date(minDate);
                let numberOfDaysToAdd = 6;
                let result = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
                let minDateF = new Date(result);
                input.min = minDateF.toISOString().split("T")[0];
                input.addEventListener("input", disableSpecificDates);
            }
        });

        function disableSpecificDates(event) {
            let input = event.target;
            let selectedDate = new Date(input.value);

            // Tanggal-tanggal yang ingin dinonaktifkan
            let disabledDates = [<?php foreach ($tanggal_disable as $tanggal => $number) {
                echo "'" . $number . "',";
            } ?>]

            let someDate = new Date();
            let numberOfDaysToAdd = 6;
            let result = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
            let minDate = new Date(result); // Tanggal minimum yang diizinkan adalah tanggal saat ini
            let maxDate = new Date("2100-12-31"); // Tanggal maksimum yang diizinkan

            // Mengubah tanggal minimum menjadi tanggal saat ini
            let minDateISO = minDate.toISOString().split("T")[0];

            // Cek apakah tanggal yang dipilih ada dalam daftar tanggal yang dinonaktifkan
            let selectedDateString = input.value;
            if (disabledDates.includes(selectedDateString)) {
                input.value = ""; // Reset nilai input jika tanggal dinonaktifkan dipilih
                alert("Tanggal tersebut sudah di-booking. Silakan pilih tanggal lain.");
            }

            // Menonaktifkan tanggal yang kurang dari tanggal saat ini
            let allDates = input.parentNode.querySelectorAll("input[type='date']");
            for (let i = 0; i < allDates.length; i++) {
                let date = allDates[i];
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