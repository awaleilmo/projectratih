<?php
require_once 'functions/general_service.php';

$list_kategori = $db_connect->query("SELECT * FROM jenis_produk");
$list_galery = $db_connect->query("SELECT * FROM galery");
$list_rating_4_keatas = $db_connect->query("SELECT * FROM rating WHERE display = 1");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Wld Project</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="theme/BizLand/assets/img/favicon.png" rel="icon">
    <link href="theme/BizLand/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="theme/BizLand/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="theme/BizLand/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="theme/BizLand/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="theme/BizLand/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="theme/BizLand/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="theme/BizLand/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="theme/BizLand/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: BizLand
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <!-- <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section> -->

    <!-- ======= Header ======= -->
    <?php require_once 'header.php'; ?>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>Welcome to <span>Wld Project</span></h1>
            <h2>From Inspiration to Celebration: Our Expertise, Your Perfect Day</h2>
            <!-- <div class="d-flex">
                <a href="#about" class="btn-get-started scrollto">Get Started</a>
                <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div> -->
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Portfolio</h2>
                    <h3>Check our <span>Portfolio</span></h3>
                    <p>Crafting Love Stories: A Visual Showcase of Our Wedding Expertise</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <?php foreach ($list_kategori as $list) : ?>
                                <li data-filter=".filter-<?= $list['id'] ?>"><?= $list['jenis_produk'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <?php foreach ($list_galery as $galery) : ?>
                        <?php if ($galery['jenis_media'] == 'photo') : ?>
                            <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $galery['jenis_produk'] ?>">
                                <img src="image/galery/<?= $galery['media'] ?>" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4><?= $galery['nama'] ?></h4>
                                    <p><?= $galery['deskripsi'] ?></p>
                                    <a href="image/galery/<?= $galery['media'] ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?= $galery['deskripsi'] ?>"><i class="bx bx-plus"></i></a>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $galery['jenis_produk'] ?>">
                                <video controls class="img-fluid">
                                    <source src="videos/<?= $galery['media'] ?>" type="video/mp4">
                                </video>
                                <div class="portfolio-info">
                                    <h4><?= $galery['nama'] ?></h4>
                                    <p><?= $galery['deskripsi'] ?></p>
                                    <a href="videos/<?= $galery['media'] ?>" data-gallery="youtubevideos" class="portfolio-lightbox preview-link" title="<?= $galery['deskripsi'] ?>"><i class="bx bx-plus"></i></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>
        <!-- End Portfolio Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Pricing</h2>
                    <h3>Check our <span>Pricing</span></h3>
                    <p>Berikut layanan yang kami tawarkan</p>
                </div>

                <div class="row">
                    <?php foreach ($list_kategori as $list) : ?>
                        <?php
                        $id_kategori = $list['id'];
                        $list_produk = $db_connect->query("SELECT * FROM produk WHERE jenis_produk = '$id_kategori'");
                        ?>
                        <div class="col-lg-3 col-md-4 mt-3" data-aos="fade-up" data-aos-delay="100">
                            <div class="box">
                                <?php
                                $sql_rentang_harga = $db_connect->query("SELECT MIN(p.harga) AS harga_terkecil, MAX(p.harga) AS harga_terbesar FROM produk p JOIN jenis_produk jp ON p.jenis_produk = jp.id WHERE jp.id = '$id_kategori';");
                                $data_rentang_harga = $sql_rentang_harga->fetch_assoc();
                                ?>
                                <h3><?= $list['jenis_produk'] ?></h3>
                                <h4><?= formatHarga($data_rentang_harga['harga_terkecil']) . "~" . formatHarga($data_rentang_harga['harga_terbesar'])  ?></h4>
                                <ul>
                                    <?php foreach ($list_produk as $produk) : ?>
                                        <li><?= $produk['nama'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="btn-wrap">
                                    <a href="kategori?kategori=<?= $id_kategori ?>" class="btn-buy">Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>
        <!-- End Pricing Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="zoom-in">

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <?php foreach ($list_rating_4_keatas as $testimoni) : ?>
                            <?php
                            $produk = $db_connect->query("SELECT * FROM produk WHERE id = '" . $testimoni['id_produk'] . "'")->fetch_assoc();
                            $user = $db_connect->query("SELECT * FROM user WHERE id = '" . $testimoni['id_user'] . "'")->fetch_assoc();
                            ?>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="image/user_profile/profile_user_1.jpg" class="testimonial-img" alt="">
                                    <h3><?= $user['nama'] ?></h3>
                                    <h4><?= $produk['nama'] ?></h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        <?= $testimoni['pesan'] ?>
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- End Testimonials Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <h3><span>Contact Us</span></h3>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Our Address</h3>
                            <p>Saruni, Majasari, Pandeglang, Banten 42219, Indonesia</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Email Us</h3>
                            <p>wldproject@gmail.cvom</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>Call Us</h3>
                            <p>+62 822 9999 3475</p>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Wld Project</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bizland-bootstrap-business-template/ -->
                Designed by <a href="">Ratih Project</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="theme/BizLand/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="theme/BizLand/assets/vendor/aos/aos.js"></script>
    <script src="theme/BizLand/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="theme/BizLand/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="theme/BizLand/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="theme/BizLand/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="theme/BizLand/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="theme/BizLand/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="theme/BizLand/assets/js/main.js"></script>

</body>

</html>