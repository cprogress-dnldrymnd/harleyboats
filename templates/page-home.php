<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Homepage 
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header(); ?>
<?php
$SVG = new SVG;
$DisplayData = new DisplayData;
$GetData = new GetData;
?>
<section class="hero-banner background-primary" id="hero-banner">
    <div class="header-content position-relative">
        <div class="container large-container text-center position-relative d-flex align-items-center justify-content-center">
            <div class="container-inner content-margin">
                <div class="heading-box big-heading">
                    <h2>
                        <span class="fw-light white-color">Leading Commercial</span> <br>
                        <strong>Drone Experts</strong>
                    </h2>
                </div>
                <div class="button-box button-accent">
                    <a href="#">OUR SERVICES</a>
                </div>

                <div class="left-images d-inline-flex">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/11/dji-gold.png" alt="">
                    </div>
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/11/Gold-Reseller.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="animated-image animated-image-1 photo-modal">
        <img src="<?= content_url() ?>/uploads/2022/12/hero-drone-1.png" alt="">
    </div>
    <div class="animated-image animated-image-2 ">
        <img src="<?= content_url() ?>/uploads/2022/12/hero-drone-2.png" alt="">
    </div>
    <div class="video-box background-primary background-box">
        <video autoplay muted loop preload="metadata" playsinline>
            <source src="<?= content_url() ?>/uploads/2022/11/coptrz-hero-video.mp4">
        </video>
    </div>
</section>
<section class="tabs-center-content background-secondary lg-padding">
    <div class="container  text-center">
        <div class="heading-box small-width mb-6 section-heading ms-auto me-auto">
            <span class="prefix">COMPLETE 360° DRONE SOLUTIONS</span>
            <h2>
                Revolutionalising Organisations Using Drones
            </h2>
        </div>
        <div class="row gy-3 av-tabs align-items-center" id="tab-center">
            <div class="col-12 col-lg col-left">
                <div class="column-holder py-5">
                    <div class="nav nav-tabs" role="tablist">
                        <button class="nav-link text-start active" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-1" aria-selected="true">
                            <div class="icon-box mb-4">
                                <?= $SVG->public_safety ?>
                            </div>
                            <div class="heading-box mb-2">
                                <h4>
                                    Public Safety
                                </h4>
                            </div>
                            <div class="description-box">
                                <p>
                                    Studying with Coptrz Academy gives you access to the largest number of flight test centres across the UK.
                                </p>
                            </div>
                        </button>
                        <button class="nav-link text-start" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-2" aria-selected="false">
                            <div class="icon-box mb-4">
                                <?= $SVG->education ?>
                            </div>
                            <div class="heading-box mb-2">
                                <h4>
                                    Education & research
                                </h4>
                            </div>
                            <div class="description-box">
                                <p>
                                    The drone industry is advancing every single day. Find out how you can get yourself airborne.
                                </p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-center">
                <div class="column-holder">
                    <div class="tab-content" id="tab-center-tabContent">
                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                            <div class="image-box">
                                <img src="<?= content_url() ?>/uploads/2022/11/windmill-1.png" alt="">
                                <img src="<?= content_url() ?>/uploads/2022/11/drone-image.png" alt="" class="drone-image">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
                            <div class="image-box">
                                <img src="<?= content_url() ?>/uploads/2022/11/windmill-1.png" alt="">
                                <img src="<?= content_url() ?>/uploads/2022/11/drone-image.png" alt="" class="drone-image">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
                            <div class="image-box">
                                <img src="<?= content_url() ?>/uploads/2022/11/windmill-1.png" alt="">
                                <img src="<?= content_url() ?>/uploads/2022/11/drone-image.png" alt="" class="drone-image">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">
                            <div class="image-box">
                                <img src="<?= content_url() ?>/uploads/2022/11/windmill-1.png" alt="">
                                <img src="<?= content_url() ?>/uploads/2022/11/drone-image.png" alt="" class="drone-image">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg col-right">
                <div class="column-holder py-5">
                    <div class="nav nav-tabs" role="tablist">
                        <button class="nav-link text-start" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab" aria-controls="nav-3" aria-selected="false">
                            <div class="icon-box mb-4">
                                <?= $SVG->inspection ?>
                            </div>
                            <div class="heading-box mb-2">
                                <h4>
                                    Inspection
                                </h4>
                            </div>
                            <div class="description-box">
                                <p>
                                    Reduce risk, lower costs and save time by using an integrated drone solution in your organisation.
                                </p>
                            </div>
                        </button>
                        <button class="nav-link text-start" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button" role="tab" aria-controls="nav-4" aria-selected="false">
                            <div class="icon-box mb-4">
                                <?= $SVG->surveying ?>
                            </div>
                            <div class="heading-box mb-2">
                                <h4>
                                    Surveying & construction
                                </h4>
                            </div>
                            <div class="description-box">
                                <p>
                                    Drones are helping surveyors to carry out operations faster, safer and more cost effective.
                                </p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<section class="logo-slider background-secondary">
    <div class="container ">
        <div class="slider-title white-color line-title d-flex align-items-center fw-medium">
            <span class="text">
                REVOLUTIONALISING OVER 1,000 ORGANISATIONS
            </span>
            <span class="line"></span>
        </div>
    </div>
    <div class="logo-slider-box md-padding">
        <div class="swiper mySwiper-logoSwiper">
            <div class="swiper-wrapper text-center align-items-center">
                <div class="swiper-slide">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/12/g4s-white.png" alt="">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/12/Openreach-Logo-white.png" alt="">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/12/NR_Logo_90D_White.png" alt="">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/12/uoo-white.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured-product-slider lg-padding background-black">
    <div class="container-fluid p-0">
        <div class="featured-product-slider-box">
            <div class="swiper mySwiper-FeaturedProducts">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="row gy-4">
                                <div class="col-lg-7">
                                    <div class="column-holder">
                                        <div class="image-box">
                                            <img src="<?= content_url() ?>/uploads/2022/12/DJI-Mavic-3-Thermal.png" alt="">
                                            <img src="<?= content_url() ?>/uploads/2022/12/dji-icon.png" class="image-icon" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="column-holder content-margin extra-small-width">
                                        <div class="heading-box small-width small-heading">
                                            <span class="prefix white-color">FEATURED PRODUCT</span>
                                            <h2>
                                                DJI Mavic 3 Thermal
                                            </h2>
                                        </div>
                                        <div class="description-box content-margin">
                                            <p>
                                                Image above everything! The Mavic 3 is finally here, set to be the ultimate compact drone for high-end photography and videography.
                                            </p>
                                            <ul>
                                                <li>
                                                    20 Megapixel, 4/3 CMOS Sensor
                                                </li>
                                                <li>
                                                    100 Megapixel Panorama mode
                                                </li>
                                                <li>
                                                    4K video up to 120 fps or 5.1K up to 50 fps
                                                </li>
                                                <li>
                                                    200Mbps H.264 or 140Mbps H.265 video recording
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="button-box button-accent">
                                            <a href="#">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="logo-slider background-black">
    <div class="container">
        <div class="slider-title white-color line-title d-flex align-items-center fw-medium">
            <span class="text">
                REVOLUTIONALISING OVER 1,000 ORGANISATIONS
            </span>
            <span class="line"></span>
        </div>
    </div>
    <div class="logo-slider-box md-padding">
        <div class="swiper mySwiper-logoSwiper">
            <div class="swiper-wrapper text-center align-items-center">
                <div class="swiper-slide">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/12/DJI_Enterprise_logo_white.png" alt="">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/12/wingtra-logo-rgb72dpi-tranparent-white.png" alt="">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/12/pix4d.png" alt="">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="image-box">
                        <img src="<?= content_url() ?>/uploads/2022/12/emesent.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="parallax-image background-white">
    <div class="container">
        <div class="image-box text-center">
            <img src="<?= content_url() ?>/uploads/2022/12/coptrz-image.png" alt="" data-type="background" data-speed="3">
        </div>
    </div>
</section>

<section class="two-colums background-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 d-flex align-items-end justify-content-center">
                <div class="column-holder">
                    <div class="image-box text-center">
                        <img src="<?= content_url() ?>/uploads/2022/12/person-standing.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="column-holder content-margin lg-padding small-width">
                    <div class="heading-box ">
                        <span class="prefix">WORLD-CLASS DRONE TRAINING</span>
                        <h2>
                            <strong> Enroll for free with the UK's <span>leading CAA drone training</span> provider</strong>
                        </h2>
                    </div>
                    <div class="description-box">
                        <p>
                            Studying with us gives you the qualifications, tools and continual <br>development you need to be the best drone operator in your industry.
                        </p>
                        <p>
                            Enrol now for <strong>FREE</strong> and get access to over 450 online courses.
                        </p>
                    </div>
                    <div class="button-box button-accent">
                        <a href="#">ENROLL NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="scrolling-section background-secondary">
    <div class="container-fluid gx-0">
        <div class="row gx-0">
            <div class="col-lg-6 col-left">
                <div class="col-inner background-secondary">
                    <div class="column-holder ms-auto content-margin">
                        <div class="line-title-bottom fw-medium d-flex flex-column white-color">
                            <span class="text">
                                FEATURED POSTS
                            </span>
                            <span class="line"></span>
                        </div>
                        <div class="featured-posts-box">
                            <ul class="list-unstyled">
                                <li class="active transition-300 featured-post" id="featured-post-1">
                                    <a href="" class="content-margin d-flex d-lg-block align-items-center">
                                        <div class="image-box d-block d-lg-none">
                                            <img src="<?= content_url() ?>/uploads/2022/12/dark-bg.png" alt="">
                                        </div>
                                        <div class="content-box ms-4 ms-lg-0">
                                            <h3>
                                                How to Flyability ELIOS 3 for Internal Mapping & Inspection
                                            </h3>
                                            <p>
                                                The Flyability ELIOS 3‘s capacity to map tight places in three dimensions is transforming the inspector’s work process; the following examples illustrate real-world applications.
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li class="transition-300 featured-post" id="featured-post-2">
                                    <a href="" class="content-margin d-flex d-lg-block align-items-center">
                                        <div class="image-box d-block d-lg-none">
                                            <img src="<?= content_url() ?>/uploads/2022/12/dark-bg.png" alt="">
                                        </div>
                                        <div class="content-box ms-4 ms-lg-0">
                                            <h3>
                                                Everything you NEED to know about thermal drones
                                            </h3>
                                            <p>
                                                We take a deep dive into how thermal imaging technology combined with drone manoeuvrability can empower your business. The list of use cases for unmanned aerial vehicles (UAVs) is constantly growing.
                                            </p>

                                        </div>
                                    </a>
                                </li>
                                <li class="transition-300 featured-post" id="featured-post-3">
                                    <a href="" class="content-margin d-flex d-lg-block align-items-center">
                                        <div class="image-box d-block d-lg-none">
                                            <img src="<?= content_url() ?>/uploads/2022/12/dark-bg.png" alt="">
                                        </div>
                                        <div class="content-box ms-4 ms-lg-0">
                                            <h3>
                                                DJI Mavic 3 Thermal v DJI Mavic 2 Enterprise Advanced
                                            </h3>
                                            <p>
                                                DJI recently launched the brand-new Mavic 3 Series, boasting 2 powerful yet portable quadcopters, built to help you meet the demands of your environment. Leading on from the progress made with the Mavic 2 Enterprise Advanced...
                                            </p>

                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-right d-none d-lg-block">
                <div class="column-holder h-100">
                    <div class="images-box h-100">
                        <div class="image-box featured-post-image" data-target="#featured-post-1">
                            <img src="<?= content_url() ?>/uploads/2022/12/dark-bg.png" alt="">
                        </div>
                        <div class="image-box featured-post-image" data-target="#featured-post-2" style="opacity: 0.5">
                            <img src="<?= content_url() ?>/uploads/2022/12/dark-bg.png" alt="">
                        </div>
                        <div class="image-box featured-post-image" data-target="#featured-post-3">
                            <img src="<?= content_url() ?>/uploads/2022/12/dark-bg.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>