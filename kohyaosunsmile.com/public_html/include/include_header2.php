<?php  
include("libs/config.php");  
// echo $_SESSION['front_session_sys_language'];
if($_SESSION['front_session_sys_language']=="thai"){
    include("libs/language_thai.php");
}else{
    include("libs/language_eng.php");   
} 
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>HOME - <?php echo $core_name_title ?></title>
        <meta name="description" content="kohyaosunsmile">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" sizes="48x48" href="https://kohyaosunsmile.com/assets/img/favicon.png">
        <link rel="shortcut icon" href="https://kohyaosunsmile.com/assets/img/favicon.png">

        <meta property="og:image" content="https://kohyaosunsmile.com/assets/img/logo/logo.png">
        <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "Organization",
            "url": "https://kohyaosunsmile.com",
            "logo": "https://kohyaosunsmile.com/assets/img/logo/logo.png"
            }
        </script>

		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <!-- Place favicon.ico in the root directory -->

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17795735192"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-17795735192');
        </script>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W6PNXSWQ');</script>
        <!-- End Google Tag Manager -->
        
        <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="assets/css/odometer.css">
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/default.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">

        <script id="pixel-chaty" async="true" src="https://cdn.chaty.app/pixel.js?id=vhEGyTOq"></script>
    </head>
    <body>

        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
                <div class="loader">
                    <div class="loader-outter"></div>
                    <div class="loader-inner"></div>
                </div>
            </div>
        </div>
        <!-- preloader-end -->

		<!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->

        <!-- header-area -->
        <header>
            <div class="header-top">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="header-top-left">
                                <a href="mailto:<?php echo htmlspecialchars($Row_info['sys_info_email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"><img src="assets/img/icon/mail.png" style="width:25px;" alt=""><?php echo htmlspecialchars($Row_info['sys_info_email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></a>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="header-top-right">
                                <ul> 
                                    <li><a href="tel: <?php echo  $Row_info['sys_info_tel'] ?>">tel: <?php echo  $Row_info['sys_info_tel'] ?></a></li>
                                    <li><a href="https://www.facebook.com/Kohyaobookingferry" target="_blank"><img src="images/facebook.png" style="width:25px;" alt=""> Facebook</a></li>
                                    <li><a href="http://line.me/ti/p/~0994791410" target="_blank"><img src="images/line.png" style="width:25px;" alt=""> Line</a></li>
                                    <li><a href="https://wa.me/<?php echo  $Row_info['sys_info_tel'] ?>"><img src="images/whatapp.png" style="width:25px;" alt=""> Whatapp</a></li> 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            //    echo  $_SERVER['REQUEST_URI'];
            ?>
            <div id="sticky-header" class="menu-area transparent-header">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                            <div class="menu-wrap">
                                <nav class="menu-nav">
                                    <div class="logo"><a href="index.php"><img src="assets/img/logo/logo.png" style="width:65px;" alt=""></a></div>
                                    <div class="navbar-wrap main-menu d-none d-lg-flex">
                                        <ul class="navigation">
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/index.php') ? 'active' : '' ?>"><a href="index.php">HOME</a></li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/about.php') ? 'active' : '' ?>"><a href="about.php">ABOUT</a></li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/booking.php') ? 'active' : '' ?>"><a href="booking.php">BOOK NOW</a> </li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/timetable.php') ? 'active' : '' ?>"><a href="timetable.php">TIME TABLE</a>  </li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/checkin.php') ? 'active' : '' ?>"><a href="checkin.php">CHECK IN</a>  </li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/review.php') ? 'active' : '' ?>"><a href="review.php">REVIEW</a>  </li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/gallery.php') ? 'active' : '' ?>"><a href="gallery.php">GALLERY</a>  </li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/blog.php') ? 'active' : '' ?>"><a href="blog.php">BLOG</a>  </li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/faq.php') ? 'active' : '' ?>"><a href="faq.php">FAQ</a>  </li>
                                            <li class="<?php echo  ($_SERVER['REQUEST_URI']=='/contact.php') ? 'active' : '' ?>"><a href="contact.php">CONTACT</a></li>
                                        </ul>
                                    </div>
                                    <div class="header-action d-none d-md-block">
                                        <div class="navbar-wrap main-menu ">
                                            <ul class=""> 
                                                <!-- <li class="question"><a href="contact.html">?</a></li>  -->
                                                <li class="menu-item-has-children">
                                                    <a href="#">
                                                        <?php if($_SESSION['front_session_sys_language'] == 'eng'){ ?>
                                                            <img src="assets/img/icon/united-states.png" alt=""> 
                                                        <?php }else{ ?>
                                                            <img src="assets/img/icon/thailand.png" alt=""> 
                                                        <?php } ?> 
                                                    </a>
                                                    <ul class="submenu" style="min-width: 80px;">
                                                        <li><a href="#" onclick="modChangelanguage('eng','<?php echo $_SERVER['REQUEST_URI'] ?>')"><img src="assets/img/icon/united-states.png" alt=""></a></li> 
                                                        <li><a href="#" onclick="modChangelanguage('thai','<?php echo $_SERVER['REQUEST_URI'] ?>')"><img src="assets/img/icon/thailand.png" alt=""></a></li> 
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                            <!-- Mobile Menu  -->
                            <div class="mobile-menu">
                                <nav class="menu-box">
                                    <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
                                    <div class="nav-logo"><a href="index.html"><img src="assets/img/logo/logo_02.png" alt="" title=""></a>
                                    </div>
                                    <div class="menu-outer">
                                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                    </div>
                                    <div class="social-links">
                                        <ul class="clearfix">
                                            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                            <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                            <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                            <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                            <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="menu-backdrop"></div>
                            <!-- End Mobile Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header-area-end -->
 
