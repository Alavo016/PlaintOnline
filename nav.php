<?php
// Récupération du nom du fichier de la page actuelle
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--=== MeanMenu CSS ===-->
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <!--Owl carousel-->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!--Owl Theme-->
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <!--=== Magnific Popup Min CSS ===-->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!--Flaticon-->
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!--Remixicon-->
    <link rel="stylesheet" href="assets/css/remixicon.css">
    <!--Odometer-->
    <link rel="stylesheet" href="assets/css/odometer.min.css">
    <!--Aos css-->
    <link rel="stylesheet" href="assets/css/aos.css">
    <!--Style css-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--Dark css-->
    <link rel="stylesheet" href="assets/css/dark.css">
    <!--Responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <style>
        /* Style général du logo */
        .navbar-brand img,
        .mobile-responsive-menu .logo img {
            width: 170px;
            /* Taille maximale */
            height: auto; ;
            /* Garde les proportions */
        }

    </style>
    <!--=== Title ===-->
    <title>Sanu - College University HTML Template</title>
    <link rel="icon" type="image/png" href="DALL·E-2025-03-16-16.53.47-A-simple-and-modern-text-based-logo-for-_PlaintOnline_.png">
</head>

<body>
    <!-- Start Preloader Area -->
    <div class="preloader-area">
        <div class="spinner">
            <div class="inner">
                <div class="disc"></div>
                <div class="disc"></div>
                <div class="disc"></div>
            </div>
        </div>
    </div>
    <!-- Start Navbar Area -->
    <div class="navbar-area nav-bg-1">
        <div class="mobile-responsive-nav">
            <div class="container">
                <div class="mobile-responsive-menu">
                    <div class="logo">
                        <a href="index.php">
                            <img src="DALL·E-2025-03-16-16.53.47-A-simple-and-modern-text-based-logo-for-_PlaintOnline_.png" class="main-logo" alt="logo">
                            <img src="DALL·E-2025-03-16-16.53.47-A-simple-and-modern-text-based-logo-for-_PlaintOnline_.png" class="white-logo" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="desktop-nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="index.php">
                        <img src="DALL·E-2025-03-16-16.53.47-A-simple-and-modern-text-based-logo-for-_PlaintOnline_.png" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link <?= ($currentPage == 'index.php') ? 'active' : '' ?>">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a href="faq.php" class="nav-link <?= ($currentPage == 'faq.php') ? 'active' : '' ?>">FAQS</a>
                            </li>
                            <li class="nav-item">
                                <a href="register.php" class="nav-link <?= ($currentPage == 'register.php') ? 'active' : '' ?>">Inscription</a>
                            </li>
                            <li class="nav-item">
                                <a href="login.php" class="nav-link <?= ($currentPage == 'login.php') ? 'active' : '' ?>">Connexion</a>
                            </li>
                        </ul>

                        <div class="others-options">
                            <div class="icon">
                                <i class="ri-menu-3-fill" data-bs-toggle="modal" data-bs-target="#sidebarModal"></i>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="others-option-for-responsive">
            <div class="container">
                <div class="dot-menu">
                    <div class="inner">
                        <div class="icon">
                            <i class="ri-menu-3-fill" data-bs-toggle="modal" data-bs-target="#sidebarModal"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->