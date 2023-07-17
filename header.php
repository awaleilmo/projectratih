<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="index.php"><img alt="Logo" src="image/logo.png" class=" h-60px w-60px" /></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="theme/BizLand/assets/img/logo.png" alt=""></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
                <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
                <li><a class="nav-link scrollto " href="#pricing">Pricing</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                <li><a class="nav-link scrollto" href="<?= isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true ? 'admin/' : (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == false ? 'member/' : 'login') ?>">
                        <?php
                        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true && $_SESSION['role'] == 1){
                            echo 'Admin';
                        } else if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == false){
                            echo 'Member Area';
                        } else if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true && $_SESSION['role'] == 2){
                            echo 'Owner';
                        } else {
                            echo 'Login';
                        }
                        ?>
                    </a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>