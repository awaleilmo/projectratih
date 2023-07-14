<?php

// Mendapatkan URL saat ini
$currentURL = $_SERVER['REQUEST_URI'];

// Mendapatkan path dari URL
$path = parse_url($currentURL, PHP_URL_PATH);

// Mendapatkan bagian terakhir dari path sebagai 'pelanggan'
$page = basename($path);

?>
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="#">
            <img alt="Logo" src="../image/logo.png" class="h-50px app-sidebar-logo-default"/>
            <img alt="Logo" src="../image/fav.png" class="h-40px app-sidebar-logo-minimize"/>
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <!--begin::Minimized sidebar setup:
            if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") {
                1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
            }
        -->
        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
             data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                 data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion <?= $page == 'index' || $page == 'admin' ? 'show here' : '' ?>">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-11 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dashboards</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item ">
                            <!--begin:Menu link-->
                            <a class="menu-link <?= $page == 'index' || $page == 'admin' ? 'active' : '' ?>"
                               href="index">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <!-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= $page == 'administrator' ? 'show here' : '' ?>"> -->
                <!--begin:Menu link-->
                <!-- <span class="menu-link"> -->
                <!-- <span class="menu-icon"> -->
                <!-- <i class="ki-duotone ki-element-plus fs-2"> -->
                <!-- <span class="path1"></span> -->
                <!-- <span class="path2"></span> -->
                <!-- <s/pan class="path3"></span> -->
                <!-- <span class="path4"></span> -->
                <!-- <span class="path5"></span> -->
                <!-- </i> -->
                <!-- </span> -->
                <!-- <span class="menu-title">Administrator</span>
                        <span class="menu-arrow"></span>
                    </span> -->
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <!-- <div class="menu-sub menu-sub-accordion"> -->
                <!--begin:Menu item-->
                <!-- <div class="menu-item"> -->
                <!-- begin:Menu link -->
                <!-- <a class="menu-link <?= $page == 'administrator' ? 'active' : '' ?>" href="administrator">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Administrators</span>
                            </a> -->
                <!--end:Menu link-->
                <!-- </div> -->
                <!--end:Menu item-->
                <!-- </div> -->
                <!--end:Menu sub-->
                <!-- </div> -->
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <?php if ($_SESSION['role'] == 1) { ?>
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion <?= $page == 'pelanggan' ? 'here show' : '' ?>">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-plus fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Pelanggan</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link <?= $page == 'pelanggan' ? 'active' : '' ?>" href="pelanggan">
                                <span class="menu-bullet ">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Data Pelanggan</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                <?php } ?>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion <?= $page == 'data_paket' || $page == 'kategori_paket' ? 'show here' : '' ?>">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-plus fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Paket</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion <?= $page == 'kategori_paket' || $page == 'edit_kategori' || $page == 'detail_produk' ? 'here show' : '' ?>">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link <?= $page == 'data_paket' || $page == 'detail_produk' ? 'active' : '' ?>"
                               href="data_paket">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Data Paket</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link <?= $page == 'kategori_paket' || $page == 'edit_kategori' ? 'active' : '' ?>"
                               href="kategori_paket">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Kategori Paket</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion <?= $page == 'galeri_foto' || $page == 'galeri_video' || $page == 'edit_foto' || $page == 'edit_video' ? 'here show' : '' ?>">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-plus fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Galeri</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link <?= $page == 'galeri_foto' || $page == 'edit_foto' ? 'active' : '' ?>"
                               href="galeri_foto">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Foto</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link <?= $page == 'galeri_video' || $page == 'edit_video' ? 'active' : '' ?>"
                               href="galeri_video">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Video</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <?php if ($_SESSION['role'] == 2) { ?>
                    <div class="menu-item menu-accordion">
                        <a class="menu-link <?= $page == 'pesan' ? 'active' : '' ?>" href="pesan">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-plus fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                            <span class="menu-title">Pesan</span>
                        </a>
                    </div>
                <?php } else if ($_SESSION['role'] == 1) { ?>
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion <?= $page == 'pesan' || $page == 'pesan_owner' ? 'here show' : '' ?>">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-plus fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pesan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link <?= $page == 'pesan_owner' ? 'active' : '' ?>" href="pesan_owner">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Pesan Owner</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link <?= $page == 'pesan' ? 'active' : '' ?>" href="pesan">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Pesan Pelanggan</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                <?php } ?>

                <div class="menu-item menu-accordion">
                    <a class="menu-link <?= $page == 'ulasan' || $page == 'detail_ulasan_produk' ? 'active' : '' ?>"
                       href="ulasan">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-plus fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Ulasan & Rating</span>
                    </a>
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion <?= $page == 'booking' || $page == 'reschedule' ? 'here show' : '' ?>">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-plus fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Booking</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link <?= $page == 'booking' ? 'active' : '' ?>" href="booking">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Booking</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link <?= $page == 'reschedule' ? 'active' : '' ?>" href="reschedule">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Reschedule</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion <?= $page == 'komplain' || $page == 'detail_komplain' ? 'here show' : '' ?>">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-plus fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Komplain</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link <?= $page == 'komplain' ? 'active' : '' ?>" href="komplain">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Komplain</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="../index"
           class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="Home">
            <span class="btn-label">Homepage</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--end::Footer-->
</div>