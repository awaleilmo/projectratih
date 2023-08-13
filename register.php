<?php
require_once 'functions/koneksi.php';

if (!isset($_SESSION)) {
    session_start();
}
session_unset();
unset($_SESSION['id_user']);
unset($_SESSION['is_admin']);
unset($_SESSION['url_photo']);
session_destroy();


if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) {
    header('Location: admin');
} else if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == false) {
    header('Location: member');
}


if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($db_connect, $_POST['nama']);
    $username = mysqli_real_escape_string($db_connect, $_POST['username']);
    $password = mysqli_real_escape_string($db_connect, $_POST['password']);
    $repeat_password = mysqli_real_escape_string($db_connect, $_POST['repeat_password']);
    $email = mysqli_real_escape_string($db_connect, $_POST['email']);
    $alamat = mysqli_real_escape_string($db_connect, $_POST['alamat']);
    $jenis_kelamin = mysqli_real_escape_string($db_connect, $_POST['jenis_kelamin']);
    $tgl_lahir = mysqli_real_escape_string($db_connect, $_POST['tgl_lahir']);
    $no_telpon = mysqli_real_escape_string($db_connect, $_POST['no_telpon']);
    $today = new DateTime();
    try {
        $tglLhr = new DateTime($_POST['tgl_lahir']);
    } catch (Exception $e) {
        $tglLhr = $today;
    }

    if ($nama === '') {
        echo "<script>alert('nama tidak boleh kosong');history.back();</script>";
    } else
        if ($username === '') {
            echo "<script>alert('username tidak boleh kosong');history.back();</script>";
        } else
            if ($email === '') {
                echo "<script>alert('email tidak boleh kosong');history.back();</script>";
            } else
                if ($alamat === '') {
                    echo "<script>alert('alamat tidak boleh kosong');history.back();</script>";
                } else
                    if ($jenis_kelamin === '') {
                        echo "<script>alert('jenis kelamin tidak boleh kosong');history.back();</script>";
                    } else
                        if ($tgl_lahir === '') {
                            echo "<script>alert('tgl lahir tidak boleh kosong');history.back();</script>";
                        } else
                            if ($no_telpon === '') {
                                echo "<script>alert('no telpon tidak boleh kosong');history.back();</script>";
                            } else
                                if ($password === '') {
                                    echo "<script>alert('password tidak boleh kosong');history.back();</script>";
                                } else
                                    if ($repeat_password === '') {
                                        echo "<script>alert('repeat password tidak boleh kosong');history.back();</script>";
                                    } else
                                        if ($repeat_password != $password) {
                                            echo "<script>alert('password tidak sama');history.back();</script>";
                                        }else if($tglLhr > $today){
                                            echo "<script>alert('Tanggal lahir tidak benar');history.back();</script>";
                                        } else {
                                            $check = $db_connect->query("SELECT count(*) as count FROM user where username = '" . $username . "'")->fetch_assoc();
                                            if($check['count'] > 0){
                                                echo "<script>alert('username sudah terdaftar');history.back();</script>";
                                            } else {


                                                $id = $db_connect->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'project_ratih' AND TABLE_NAME = 'user'")->fetch_assoc()['AUTO_INCREMENT'];


                                                $sql = $db_connect->query("INSERT INTO user VALUES ('$id','$nama','$username','$password', '$email', '$alamat', '$jenis_kelamin', '$tgl_lahir','$no_telpon','default.jpg','0','0')");

                                                if ($sql) {

                                                    $_SESSION['id_user'] = $id;
                                                    $_SESSION['url_photo'] = 'default.jpg';
                                                    $_SESSION['is_admin'] = '0';

                                                    echo "<script>alert('Berhasil daftar');location.href='member/'</script>";
                                                }
                                            }
                                        }
}

?>


<!DOCTYPE html>

<head>
    <title>Sign Up</title>
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
    <link rel="shortcut icon" href="/image/fav.png"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="theme/Metronic/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="theme/Metronic/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
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
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>
        body {
            background-image: url('./image/background-register.jpeg');
        }

        [data-bs-theme="dark"] body {
            background-image: url('./image/background-register.jpeg');
        }
    </style>
    <!--end::Page bg image-->
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-lg-start flex-column">
                <!--begin::Logo-->
                <!-- <a href="index" class="mb-7">
                    <img alt="Logo" src="theme/Metronic/assets/media/logos/custom-3.svg" />
                </a> -->
                <!--end::Logo-->
                <!--begin::Title-->
                <!-- <h2 class="text-white fw-normal m-0">Branding tools designed for your business</h2> -->
                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
            <!--begin::Card-->
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="#"
                          action="" method="POST">
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">Register</h1>
                            <!--end::Title-->
                            <!--begin::Subtitle-->
                            <!-- <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div> -->
                            <!--end::Subtitle=-->
                        </div>
                        <div class="fv-row mb-8">
                            <!--begin::Nama lengkap-->
                            <input type="text" required placeholder="Nama Lengkap" name="nama" autocomplete="off"
                                   class="form-control bg-transparent"/>
                            <!--end::Nama lengkap-->
                        </div>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" required placeholder="Email" name="email" autocomplete="off"
                                   class="form-control bg-transparent"/>
                            <!--end::Email-->
                        </div>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Alamat-->
                            <textarea required placeholder="Alamat" name="alamat" autocomplete="off"
                                      class="form-control bg-transparent"></textarea>
                            <!--end::Alamat-->
                        </div>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Nomor Telpon-->
                            <input required type="text" placeholder="Nomor Telepon" name="no_telpon" autocomplete="off"
                                   class="form-control bg-transparent"/>
                            <!--end::Nomor Telpon-->
                        </div>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Nomor Telpon-->
                            <input required type="date" placeholder="Tanggal Lahir" name="tgl_lahir" autocomplete="off"
                                   class="form-control bg-transparent"/>
                            <!--end::Nomor Telpon-->
                        </div>
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <select class="form-control bg-transparent" data-control="select2" data-hide-search="true"
                                    data-placeholder="Jenis Kelamin" name="jenis_kelamin" required>
                                <option value="" selected>pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Nomor Telpon-->
                            <input required type="text" placeholder="Username" name="username" autocomplete="off"
                                   class="form-control bg-transparent"/>
                            <!--end::Nomor Telpon-->
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-8">
                            <!--begin::Nomor Telpon-->
                            <input required type="password" placeholder="Password" name="password" autocomplete="off"
                                   class="form-control bg-transparent"/>
                            <!--end::Nomor Telpon-->
                        </div>
                        <!--end::Input group=-->
                        <!--end::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Repeat Password-->
                            <input required placeholder="Repeat Password" name="repeat_password" type="password"
                                   autocomplete="off" class="form-control bg-transparent"/>
                            <!--end::Repeat Password-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary" name="register">
                                Register
                            </button>
                        </div>
                        <!--end::Submit button-->
                        <!--begin::Sign up-->
                        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                            <a href="login">Sign in</a>
                        </div>
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-up-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>
    var hostUrl = "theme/Metronic/assets/";
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="theme/Metronic/assets/plugins/global/plugins.bundle.js"></script>
<script src="theme/Metronic/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="theme/Metronic/assets/js/custom/authentication/sign-up/general.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>