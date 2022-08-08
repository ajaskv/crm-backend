@php
$logo = asset(Storage::url('uploads/logo/'));
$company_favicon = Utility::getValByName('company_favicon');
$image_path = asset(Storage::url('uploads/custom_landing_page_image/'));
$SITE_RTL = Cookie::get('SITE_RTL');

@endphp
<!DOCTYPE html>
<html lang="en" dir="{{ $SITE_RTL == 'on' ? 'rtl' : '' }}">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'ERPGO') }}
    </title>
    <link rel="icon"
        href="{{ $logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"
        type="image" sizes="16x16">

    <!--External CSS-->

    <!--required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!--twitter og-->
    <meta name="twitter:site" content="@themetags">
    <meta name="twitter:creator" content="@themetags">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Quiety - Creative SAAS Technology & IT Solutions Bootstrap 5 HTML Template">
    <meta name="twitter:description"
        content="Quiety creative Saas, software technology, Saas agency & business Bootstrap 5 Html template. It is best and famous software company and Saas website template.">
    <meta name="twitter:image" content="#">

    <!--facebook og-->
    <meta property="og:url" content="#">
    <meta name="twitter:title" content="Quiety - Creative SAAS Technology & IT Solutions Bootstrap 5 HTML Template">
    <meta property="og:description"
        content="Quiety creative Saas, software technology, Saas agency & business Bootstrap 5 Html template. It is best and famous software company and Saas website template.">
    <meta property="og:image" content="#">
    <meta property="og:image:secure_url" content="#">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!--meta-->
    <meta name="description"
        content="Quiety creative Saas, software technology, Saas agency & business Bootstrap 5 Html template. It is best and famous software company and Saas website template.">
    <meta name="author" content="ThemeTags">

    <!--favicon icon-->
    {{-- <link rel="icon" href="{{ asset('public/land-assets/img/favicon.png') }}" type="image/png" sizes="16x16"> --}}

    <!--title-->
    <title>Zphere.io ERP Solutions For Banking, Schools, & Other Industries</title>

    <!--google fonts-->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!--build:css-->
    <link rel="stylesheet" href="{{ asset('public/land-assets/css/main.css') }}">
    <!-- endbuild -->

    <!--custom css start-->
    <link rel="stylesheet" href="{{ asset('public/land-assets/css/custom.css') }}">
    <!--custom css end-->

</head>

<body>

    <!--preloader start-->
    <div id="preloader">
        <div class="preloader-wrap">
            <img src="{{ asset('public/land-assets/img/blk.png') }}" alt="logo" class="img-fluid preloader-icon" />
            <div class="loading-bar"></div>
        </div>
    </div>
    <!--preloader end-->
    <!--main content wrapper start-->
    <div class="main-wrapper">

        <!--header section start-->
        <header class="main-header w-100">
            <nav class="navbar navbar-expand-xl navbar-light sticky-header">
                <div class="container d-flex align-items-center justify-content-lg-between position-relative">
                    <a href="#" class="navbar-brand d-flex align-items-center mb-md-0 text-decoration-none">
                        <img src="{{ asset('public/land-assets/img/blk.png') }}" style="height: 41px;" alt="logo"
                            class="img-fluid logo-white" />
                        <img src="{{ asset('public/land-assets/img/blk.png') }}" style="height: 41px;" alt="logo"
                            class="img-fluid logo-color" />
                    </a>

                    <a class="navbar-toggler position-absolute right-0 border-0" href="#offcanvasWithBackdrop"
                        role="button">
                        <span class="far fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop"
                            aria-controls="offcanvasWithBackdrop"></span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse navbar-collapse justify-content-center">
                        <ul class="nav col-12 col-md-auto justify-content-center main-menu">
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Home
                                </a>

                            </li> --}}
                            {{-- <li><a href="#" class="nav-link">Services</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">Resources</a>

                            </li>
                            <li><a href="#" class="nav-link">Pricing</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">Company</a>

                            </li> --}}
                        </ul>
                    </div>

                    <div class="action-btns text-end me-5 me-lg-0 d-none d-md-block d-lg-block">
                        <a href="{{ route('login') }}" class="btn btn-link text-decoration-none me-2">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    </div>

                    <!--offcanvas menu start-->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWithBackdrop">
                        <div class="offcanvas-header d-flex align-items-center mt-4">
                            <a href="#" class="d-flex align-items-center mb-md-0 text-decoration-none">
                                <img src="{{ asset('public/land-assets/img/logo-color.png') }}" alt="logo"
                                    class="img-fluid ps-2" />
                            </a>
                            <button type="button" class="close-btn text-danger" data-bs-dismiss="offcanvas"
                                aria-label="Close">
                                <i class="far fa-close"></i>
                            </button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="nav col-12 col-md-auto justify-content-center main-menu">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Home
                                    </a>

                                </li>
                                {{-- <li><a href="#" class="nav-link">Services</a></li> --}}
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">Resources</a>

                                </li>
                                <li><a href="#" class="nav-link">Pricing</a></li> --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">Company</a>

                                </li>
                            </ul>
                            <div class="action-btns mt-4 ps-3">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Sign In</a>
                                <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <!--offcanvas menu end-->
                </div>
            </nav>
        </header>
        <!--header section end-->

        <!--hero section start-->
        <section class="hero-section ptb-120 position-relative overflow-hidden"
            style="background: url('land-assets/img/shape/color-particles-2.svg')no-repeat center top">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-xl-8 col-lg-10 mb-5">
                        <div class="hero-content-wrap">
                            <h1 class="fw-bold display-5" data-aos="fade-up">Single Dashboard for ALL your Business
                                Needs</h1>
                            <p class="lead" data-aos="fade-up" data-aos-delay="50">Unique and powerful suite
                                of software to run your entire business, brought to you by a company with the long term
                                vision to transform the way you work.
                                expertise.</p>
                            <div class="action-btns text-center pt-4" data-aos="fade-up" data-aos-delay="100">
                                <a href="tel:0522746880" class="btn btn-primary me-lg-3 me-sm-3">Start Now</a>
                                <a href="tel:0522746880" class="btn btn-outline-primary">Talk to Sales</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="position-relative" data-aos="fade-up" data-aos-delay="200">
                            <ul class="position-absolute animate-element parallax-element widget-img-wrap z-2">
                                <li class="layer" data-depth="0.04">
                                    <img src="{{ asset('public/land-assets/img/screen/widget-3.png') }}"
                                        alt="widget-img"
                                        class="img-fluid widget-img-1 position-absolute shadow-lg rounded-custom">
                                </li>
                                <li class="layer" data-depth="0.02">
                                    <img src="{{ asset('public/land-assets/img/screen/widget-4.png') }}"
                                        alt="widget-img"
                                        class="img-fluid widget-img-3 position-absolute shadow-lg rounded-custom">
                                </li>
                            </ul>
                            <img src="{{ asset('public/land-assets/img/dashboard-img.png') }}" alt="dashboard image"
                                class="img-fluid position-relative rounded-custom mt-lg-5">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-dark position-absolute bottom-0 h-25 bottom-0 left-0 right-0 z--1 py-5"></div>
        </section>
        <!--hero section end-->

        <!--top review section start-->
        <section class="customer-review pb-120 bg-dark">
            <div class="container">
                <div class="row">
                    <div class="section-heading text-center">
                        <h2 class="fw-medium h4">Rated 5 out of 5 stars by our customers</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="review-info-wrap text-center rounded-custom d-flex flex-column h-100 p-lg-5 p-4">
                            <img src="{{ asset('public/land-assets/img/fb-logo-w.svg') }}" width="130" alt="facebook"
                                class="img-fluid m-auto">
                            <div class="review-info-content mt-2">
                                <p class="mb-4">4.9 out of 5 stars maintainable disseminate parallel team
                                    effective standards communities.</p>
                            </div>
                            <!--       <a href="client-review.html" class="link-with-icon p-0 mt-auto text-decoration-none text-warning">Read Reviews <i
                                    class="far fa-arrow-right"></i></a> -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="review-info-wrap text-center rounded-custom d-flex flex-column h-100 p-lg-5 p-4">
                            <img src="{{ asset('public/land-assets/img/g-logo-w.svg') }}" width="130" alt="google"
                                class="img-fluid m-auto">
                            <div class="review-info-content mt-2">
                                <p class="mb-4">2k+ five star reviews excellent convergence without
                                    professional methods of empowerment. </p>
                            </div>
                            <!--   <a href="client-review.html" class="link-with-icon p-0 mt-auto text-decoration-none text-warning">Read Reviews <i
                                    class="far fa-arrow-right"></i></a> -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="review-info-wrap text-center rounded-custom d-flex flex-column h-100 p-lg-5 p-4">
                            <img src="{{ asset('public/land-assets/img/li-logo-w.svg') }}" width="130" alt="linkedIn"
                                class="img-fluid m-auto">
                            <div class="review-info-content mt-2">
                                <p class="mb-4">4.9 out of 5 stars maintainable disseminate parallel team
                                    effective standards communities.</p>
                            </div>
                            <!--     <a href="client-review.html" class="link-with-icon p-0 mt-auto text-decoration-none text-warning">Read Reviews <i
                                    class="far fa-arrow-right"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--top review section end-->
        <section class="promo-section pt-120 ">
            <div class="container">


                <div class="customer-section ">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-12">
                                <p class="text-center pb-60 h6">Trusted By More than 1200 Companies In The UAE</p>
                                <div class="customer-logos-grid text-center">
                                    <img src="{{ asset('public/land-assets/img/logo01.png') }}" width="150"
                                        alt="clients logo" class="img-fluid p-1 px-md-2 p-lg-3 m-auto">
                                    <img src="{{ asset('public/land-assets/img/logo02.png') }}" width="150"
                                        alt="clients logo" class="img-fluid p-1 px-md-2 p-lg-3 m-auto">
                                    <img src="{{ asset('public/land-assets/img/logo05.png') }}" width="150"
                                        alt="clients logo" class="img-fluid p-1 px-md-2 p-lg-3 m-auto">
                                    <img src="{{ asset('public/land-assets/img/logo10.png') }}" width="150"
                                        alt="clients logo" class="img-fluid p-1 px-md-2 p-lg-3 m-auto">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--feature section start-->
        <section class="image-feature ptb-120">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5 col-12">
                        <div class="feature-img-content">
                            <div class="section-heading" data-aos="fade-up">
                                <h2>Innovative Solutions To Move Your Business Forward</h2>
                                <!--   <p>Energistically underwhelm progressive metrics via value-added impact magnetic world-class paradigms portals. Pontificate
                                    reliable metrics with enabled maintain clicks-and-mortar manufactured.</p> -->
                            </div>
                            <ul class="list-unstyled d-flex flex-wrap list-two-col mb-0" data-aos="fade-up"
                                data-aos-delay="50">
                                <li>
                                    <div class="icon-box">
                                        <i class="fas fa-users text-white bg-primary rounded"></i>
                                    </div>
                                    <h3 class="h5">Risk Reduction </h3>
                                    <p>Reduce business risks by receiving accurate forecasts and stats about business
                                        growth.</p>
                                </li>
                                <li>
                                    <div class="icon-box">
                                        <i class="fas fa-fingerprint text-white bg-danger rounded"></i>
                                    </div>
                                    <h3 class="h5">Real Time Metrics</h3>
                                    <p>Make the best decisions by allowing you access to the latest records and data.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="feature-img-holder p-lg-5 pt-3">
                            <div
                                class="p-lg-5 p-3 bg-danger-soft position-relative rounded-custom d-block feature-img-wrap">
                                <div class="z-10 position-relative">
                                    <img src="{{ asset('public/land-assets/img/screen/widget-5.png') }}"
                                        class="img-fluid rounded-custom position-relative" alt="feature-image"
                                        data-aos="fade-up" data-aos-delay="50">
                                    <img src="{{ asset('public/land-assets/img/screen/widget-3.png') }}"
                                        class="img-fluid rounded-custom shadow position-absolute bottom--100 right--100 hide-medium"
                                        alt="feature-image" data-aos="fade-up" data-aos-delay="100">
                                </div>
                                <div
                                    class="position-absolute bg-dark-soft z--1 dot-mask dm-size-12 dm-wh-250 top-left">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="image-feature pt-60 pb-120">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5 col-12 order-lg-1">
                        <div class="feature-img-content">
                            <div class="section-heading" data-aos="fade-up">
                                <h2>Your Problem. Our Solutions. For a Better Growth.</h2>
                                <!--      <p>Reliable metrics with enabled infomediaries. Holisticly maintain clicks-and-mortar
                                    manufactured products empower viral customer service through resource
                                    supply pandemic collaboration. </p> -->
                            </div>
                            <ul class="list-unstyled d-flex flex-wrap list-two-col mb-0" data-aos="fade-up"
                                data-aos-delay="50">
                                <li>
                                    <div class="icon-box">
                                        <i class="fas fa-dollar-sign text-white bg-success rounded"></i>
                                    </div>
                                    <h3 class="h5">Data Migration</h3>
                                    <p>We help you import data from your old environment to our advanced solutions.</p>
                                </li>
                                <li>
                                    <div class="icon-box">
                                        <i class="fas fa-headset text-white bg-dark rounded"></i>
                                    </div>
                                    <h3 class="h5">2 Factor Authentication</h3>
                                    <p>We keep your information private by providing server only for you.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 order-lg-0">
                        <div class="feature-img-holder p-lg-5 pt-3">
                            <div
                                class="bg-primary-soft p-lg-5 p-3 rounded-custom position-relative d-block feature-img-wrap">
                                <div class="z-10 position-relative">
                                    <img src="{{ asset('public/land-assets/img/screen/widget-8.png') }}"
                                        class="img-fluid rounded-custom position-relative" alt="feature-image"
                                        data-aos="fade-up" data-aos-delay="50">
                                    <img src="{{ asset('public/land-assets/img/screen/widget-6.png') }}"
                                        class="img-fluid rounded-custom shadow position-absolute top--100 left--100 hide-medium"
                                        alt="feature-image" data-aos="fade-up" data-aos-delay="100">
                                </div>
                                <div
                                    class="position-absolute bg-dark-soft z--1 dot-mask dm-size-12 dm-wh-250 bottom-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--feature section end-->

        <!--feature service grid section start-->
        <section class="video-promo-with-icon">
            <div class="container">
                <div class="video-bg-with-icon"
                    style="background: url('land-assets/img/video-bg.jpg')no-repeat center center / cover">
                    <a href="http://www.youtube.com/watch?v=hAP2QF--2Dg" class="popup-youtube"><i
                            class="fas fa-play"></i></a>
                </div>
            </div>
            <div class="video-promo-icon-wrapper bg-light pt-80 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-xl-3 col-md-6 mt-4 mt-md-4 mt-lg-0">
                            <div class="single-icon-box p-0 p-lg-4">
                                <i class="far fa-chart-pie-alt icon-one"></i>
                                <h5 class="h6">Automate Task</h5>
                                <p>Easily create by drag and drop any workflow and the system performs it automatically.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-6 mt-4 mt-md-4 mt-lg-0">
                            <div class="single-icon-box p-0 p-lg-4">
                                <i class="far fa-pen-nib icon-two"></i>
                                <h5 class="h6">24/7 Support</h5>
                                <p>Our team gives you 24/7 support inhouse and a complete documentation on each module.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-6 mt-4 mt-md-4 mt-lg-0">
                            <div class="single-icon-box p-0 p-lg-4">
                                <i class="far fa-chart-network icon-three"></i>
                                <h5 class="h6">Mobile Friendly</h5>
                                <p>No matter where you are and what device you are in! you can access it anytime.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-6 mt-4 mt-md-4 mt-lg-0">
                            <div class="single-icon-box p-0 p-lg-4">
                                <i class="far fa-bezier-curve icon-four"></i>
                                <h5 class="h6">Easy to customize</h5>
                                <p>Providing further additions or customisation to meet your requirements.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--feature service grid section end-->

        <!--our work process start-->
        <section class="work-process ptb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6">
                        <div class="section-heading text-center">
                            <!-- <h4 class="h5 text-primary">Process</h4> -->
                            <h2>We just stand out from others!</h2>
                            <!-- <p>Conveniently mesh cooperative services via magnetic outsourcing whereas accurate e-commerce scalable outsourcing quality vectors.</p> -->
                        </div>
                    </div>
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card-two text-center px-4 py-5 rounded-custom shadow-hover mt-4">
                            <div class="process-icon border-light border border-2 rounded-custom p-3">
                                <i class="fad fa-folder-tree fa-2x"></i>
                            </div>
                            <h3 class="h5">Security</h3>
                            <p class="mb-0">High security for your data, from real world.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card-two text-center px-4 py-5 rounded-custom shadow-hover mt-4">
                            <div class="process-icon border-light border border-2 rounded-custom p-3">
                                <i class="fad fa-bezier-curve fa-2x"></i>
                            </div>
                            <h3 class="h5">Free Training</h3>
                            <p class="mb-0">We provide training to your entire team to use.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card-two text-center px-4 py-5 rounded-custom shadow-hover mt-4">
                            <div class="process-icon border-light border border-2 rounded-custom p-3">
                                <i class="fad fa-layer-group fa-2x"></i>
                            </div>
                            <h3 class="h5">Data Migration</h3>
                            <p class="mb-0">With our data migration program, its hassle and safe to move from
                                your old software</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card-two text-center px-4 py-5 rounded-custom shadow-hover mt-4">
                            <div class="process-icon border-light border border-2 rounded-custom p-3">
                                <i class="fad fa-truck fa-2x"></i>
                            </div>
                            <h3 class="h5">User & Role Based</h3>
                            <p class="mb-0">Separate dashboard for all user and permissions can be set.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--our work process end-->

        <!--customer review tab section start-->
        <section class="customer-review-tab ptb-120  bg-light position-relative z-2">
            <div class="container">
                <div class="row justify-content-center align-content-center">
                    <div class="col-md-10 col-lg-6">
                        <div class="section-heading text-center" data-aos="fade-up">
                            <!-- <h4 class="h5  text-primary">Testimonial</h4> -->
                            <h2>End-to-end products to run
                                the core of your business</h2>
                            <!-- <p>Uniquely promote adaptive quality vectors rather than stand-alone e-markets. pontificate alternative architectures whereas iterate.</p> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="margin-bottom: 32px;">
                        <ul class="nav nav-pills testimonial-tab-menu mt-60" id="testimonial" role="tablist"
                            data-aos="fade-up" data-aos-delay="100">
                            <li class="nav-item" role="presentation">
                                <div class="nav-link d-flex align-items-center rounded-custom border border-light border-2 testimonial-tab-link active"
                                    data-bs-toggle="pill" data-bs-target="#testimonial-tab-1" role="tab"
                                    aria-selected="false">
                                    <div class="testimonial-thumb me-3">
                                        <img src="{{ asset('public/land-assets/img/testimonial/3.jpg') }}" width="50"
                                            class="rounded-circle" alt="testimonial thumb">
                                    </div>
                                    <div class="author-info">
                                        <h6 class="mb-0">CRM</h6>
                                        <span>Client Relation</span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <div class="nav-link d-flex align-items-center rounded-custom border border-light border-2 testimonial-tab-link"
                                    data-bs-toggle="pill" data-bs-target="#testimonial-tab-2" role="tab"
                                    aria-selected="false">
                                    <div class="testimonial-thumb me-3">
                                        <img src="{{ asset('public/land-assets/img/testimonial/1.jpg') }}" width="50"
                                            class="rounded-circle" alt="testimonial thumb">
                                    </div>
                                    <div class="author-info">
                                        <h6 class="mb-0">Projects</h6>
                                        <span>Know Projects</span>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item" role="presentation">
                                <div class="nav-link d-flex align-items-center rounded-custom border border-light border-2 testimonial-tab-link"
                                    data-bs-toggle="pill" data-bs-target="#testimonial-tab-3" role="tab"
                                    aria-selected="false">
                                    <div class="testimonial-thumb me-3">
                                        <img src="{{ asset('public/land-assets/img/testimonial/2.jpg') }}" width="50"
                                            class="rounded-circle" alt="testimonial thumb">
                                    </div>
                                    <div class="author-info">
                                        <h6 class="mb-0">HR</h6>
                                        <span>Human Resource</span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <div class="nav-link d-flex align-items-center rounded-custom border border-light border-2 testimonial-tab-link"
                                    data-bs-toggle="pill" data-bs-target="#testimonial-tab-4" role="tab"
                                    aria-selected="false">
                                    <div class="testimonial-thumb me-3">
                                        <img src="{{ asset('public/land-assets/img/testimonial/4.jpg') }}" width="50"
                                            class="rounded-circle" alt="testimonial thumb">
                                    </div>
                                    <div class="author-info">
                                        <h6 class="mb-0">Accounting</h6>
                                        <span>Accounting</span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <div class="nav-link d-flex align-items-center rounded-custom border border-light border-2 testimonial-tab-link"
                                    data-bs-toggle="pill" data-bs-target="#testimonial-tab-5" role="tab"
                                    aria-selected="true">
                                    <div class="testimonial-thumb me-3">
                                        <img src="{{ asset('public/land-assets/img/testimonial/5.jpg') }}" width="50"
                                            class="rounded-circle" alt="testimonial thumb">
                                    </div>
                                    <div class="author-info">
                                        <h6 class="mb-0">Automate </h6>
                                        <span>Workflow </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="testimonial-tabContent" data-aos="fade-up"
                            data-aos-delay="100">
                            <div class="tab-pane fade active show" id="testimonial-tab-1" role="tabpanel">
                                <div class="row align-items-center justify-content-between">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="author-img-wrap pt-5 ps-5-">
                                            <div class="testimonial-video-wrapper position-relative">
                                                <img src="{{ asset('public/land-assets/img/dash.png') }}"
                                                    class="img-fluid rounded-custom shadow-lg"
                                                    alt="testimonial author">
                                                <div class="customer-info text-white d-flex align-items-center">
                                                    <a href="http://www.youtube.com/watch?v=hAP2QF--2Dg"
                                                        class="video-icon popup-youtube text-decoration-none"><i
                                                            class="fas fa-play"></i> <span
                                                            class="text-white ms-2 small"> Watch Video</span></a>
                                                </div>
                                                <div
                                                    class="position-absolute bg-primary-dark z--1 dot-mask dm-size-16 dm-wh-350 top--40 left--40 top-left">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="testimonial-tab-2" role="tabpanel">
                                <div class="row align-items-center justify-content-between">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="author-img-wrap pt-5 ps-5-">
                                            <div class="testimonial-video-wrapper position-relative">
                                                <img src="{{ asset('public/land-assets/img/dash.png') }}"
                                                    class="img-fluid rounded-custom shadow-lg"
                                                    alt="testimonial author">
                                                <div class="customer-info text-white d-flex align-items-center">
                                                    <a href="http://www.youtube.com/watch?v=hAP2QF--2Dg"
                                                        class="video-icon popup-youtube text-decoration-none"><i
                                                            class="fas fa-play"></i> <span
                                                            class="text-white ms-2 small"> Watch Video</span></a>
                                                </div>
                                                <div
                                                    class="position-absolute bg-primary-dark z--1 dot-mask dm-size-16 dm-wh-350 top--40 left--40 top-left">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="testimonial-tab-3" role="tabpanel">
                                <div class="row align-items-center justify-content-between">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="author-img-wrap pt-5 ps-5-">
                                            <div class="testimonial-video-wrapper position-relative">
                                                <img src="{{ asset('public/land-assets/img/dash.png') }}"
                                                    class="img-fluid rounded-custom shadow-lg"
                                                    alt="testimonial author">
                                                <div class="customer-info text-white d-flex align-items-center">
                                                    <a href="http://www.youtube.com/watch?v=hAP2QF--2Dg"
                                                        class="video-icon popup-youtube text-decoration-none"><i
                                                            class="fas fa-play"></i> <span
                                                            class="text-white ms-2 small"> Watch Video</span></a>
                                                </div>
                                                <div
                                                    class="position-absolute bg-primary-dark z--1 dot-mask dm-size-16 dm-wh-350 top--40 left--40 top-left">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="testimonial-tab-4" role="tabpanel">
                                <div class="row align-items-center justify-content-between">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="author-img-wrap pt-5 ps-5-">
                                            <div class="testimonial-video-wrapper position-relative">
                                                <img src="{{ asset('public/land-assets/img/dash.png') }}"
                                                    class="img-fluid rounded-custom shadow-lg"
                                                    alt="testimonial author">
                                                <div class="customer-info text-white d-flex align-items-center">
                                                    <a href="http://www.youtube.com/watch?v=hAP2QF--2Dg"
                                                        class="video-icon popup-youtube text-decoration-none"><i
                                                            class="fas fa-play"></i> <span
                                                            class="text-white ms-2 small"> Watch Video</span></a>
                                                </div>
                                                <div
                                                    class="position-absolute bg-primary-dark z--1 dot-mask dm-size-16 dm-wh-350 top--40 left--40 top-left">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="testimonial-tab-5" role="tabpanel">
                                <div class="row align-items-center justify-content-between">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="author-img-wrap pt-5 ps-5-">
                                            <div class="testimonial-video-wrapper position-relative">
                                                <img src="{{ asset('public/land-assets/img/dash.png') }}"
                                                    class="img-fluid rounded-custom shadow-lg"
                                                    alt="testimonial author">
                                                <div class="customer-info text-white d-flex align-items-center">
                                                    <a href="http://www.youtube.com/watch?v=hAP2QF--2Dg"
                                                        class="video-icon popup-youtube text-decoration-none"><i
                                                            class="fas fa-play"></i> <span
                                                            class="text-white ms-2 small"> Watch Video</span></a>
                                                </div>
                                                <div
                                                    class="position-absolute bg-primary-dark z--1 dot-mask dm-size-16 dm-wh-350 top--40 left--40 top-left">
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
        <!--customer review tab section end-->

        <!--integration section start-->
        <section class="integration-section ptb-120">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-3">
                        <div class="integration-list-wrap">
                            <a href="integration-single.html" class="integration-1" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Slack">
                                <img src="{{ asset('public/land-assets/img/integations/1.png') }}" alt="integration"
                                    class="img-fluid rounded-circle">
                            </a>
                            <a href="integration-single.html" class="integration-2" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Twilio">
                                <img src="{{ asset('public/land-assets/img/integations/2.png') }}" alt="integration"
                                    class="img-fluid rounded-circle">
                            </a>
                            <a href="integration-single.html" class="integration-3" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Mailchimp">
                                <img src="{{ asset('public/land-assets/img/integations/3.png') }}" alt="integration"
                                    class="img-fluid rounded-circle">
                            </a>

                            <a href="integration-single.html" class="integration-4" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Telegram">
                                <img src="{{ asset('public/land-assets/img/integations/4.png') }}" alt="integration"
                                    class="img-fluid rounded-circle">
                            </a>
                            <a href="integration-single.html" class="integration-5" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Zoom">
                                <img src="{{ asset('public/land-assets/img/integations/5.png') }}" alt="integration"
                                    class="img-fluid rounded-circle">
                            </a>
                            <!--     <a href="integration-single.html" class="integration-6" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Brand Name">
                                <img src="{{ asset('public/land-assets/img/integations/6.png') }}" alt="integration" class="img-fluid rounded-circle">
                            </a> -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="section-heading text-center my-5 my-lg-0 my-xl-0" data-aos="fade-up">
                            <!-- <h4 class="text-primary h5">Integration</h4> -->
                            <h2>Everything you need for any workflow</h2>
                            <!-- <a href="integrations.html" class="mt-4 btn btn-primary">View all Integration</a> -->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="col-lg-4">
                            <div class="integration-list-wrap">
                                <a href="integration-single.html" class="integration-7" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Stripe">
                                    <img src="{{ asset('public/land-assets/img/integations/7.png') }}"
                                        alt="integration" class="img-fluid rounded-circle">
                                </a>
                                <a href="integration-single.html" class="integration-8" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Paypal">
                                    <img src="{{ asset('public/land-assets/img/integations/8.png') }}"
                                        alt="integration" class="img-fluid rounded-circle">
                                </a>
                                <a href="integration-single.html" class="integration-9" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Pusher">
                                    <img src="{{ asset('public/land-assets/img/integations/9.png') }}"
                                        alt="integration" class="img-fluid rounded-circle">
                                </a>

                                <a href="integration-single.html" class="integration-10" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Whatsapp">
                                    <img src="{{ asset('public/land-assets/img/integations/10.png') }}"
                                        alt="integration" class="img-fluid rounded-circle">
                                </a>
                                <a href="integration-single.html" class="integration-11" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Skrill">
                                    <img src="{{ asset('public/land-assets/img/integations/11.png') }}"
                                        alt="integration" class="img-fluid rounded-circle">
                                </a>
                                <!--     <a href="integration-single.html" class="integration-12" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Brand Name">
                                    <img src="{{ asset('public/land-assets/img/integations/12.png') }}" alt="integration" class="img-fluid rounded-circle">
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row justify-content-center mt-100">
                    <div class="col-lg-5 col-md-12">
                        <a href="integration-single.html" class="mb-4 mb-lg-0 mb-xl-0 position-relative text-decoration-none connected-app-single border border-light border-2 rounded-custom d-block overflow-hidden p-5" data-aos="fade-up" data-aos-delay="100">
                            <div class="position-relative connected-app-content">
                                <div class="integration-logo bg-custom-light rounded-circle p-2 d-inline-block">
                                    <img src="{{ asset('public/land-assets/img/integations/4.png') }}" width="40" alt="integration" class="img-fluid">
                                </div>
                                <h5>Google Drive</h5>
                                <p class="mb-0 text-body">Competently generate unique e-services and client-based models.
                                    Globally engage tactical niche</p>
                            </div>
                            <span class="position-absolute integration-badge badge px-3 py-2 bg-primary-soft text-primary">Connect</span>
                        </a>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <a href="integration-single.html" class="position-relative text-decoration-none connected-app-single border border-light border-2 rounded-custom d-block overflow-hidden p-5" data-aos="fade-up" data-aos-delay="150">
                            <div class="position-relative connected-app-content">
                                <div class="integration-logo bg-custom-light rounded-circle p-2 d-inline-block">
                                    <img src="{{ asset('public/land-assets/img/integations/9.png') }}" width="40" alt="integration" class="img-fluid">
                                </div>
                                <h5>Google Drive</h5>
                                <p class="mb-0 text-body">Globally engage tactical niche markets rather than client-based
                                    competently generate services</p>
                            </div>
                            <span class="position-absolute integration-badge badge px-3 py-2 bg-danger-soft text-danger">Connected</span>
                        </a>
                    </div>
                </div> -->
            </div>
        </section>
        <!--integration section end-->

        <section class="pricing-section pt-60 pb-120  position-relative z-2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="section-heading text-center">
                            <!-- <h4 class="h5 text-primary">Pricing</h4> -->
                            <h2>Pricing</h2>
                            <!-- <p>Conveniently mesh cooperative services via magnetic outsourcing. Dynamically grow value whereas accurate e-commerce vectors. </p> -->
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-4">
                        <div class="media d-flex align-items-center py-2 p-sm-2">
                            <div class="icon-box mb-0 bg-primary-soft rounded-circle d-block me-3">
                                <i class="fal fa-credit-card text-primary"></i>
                            </div>
                            <div class="media-body fw-medium h6 mb-0">
                                No credit card required
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="media d-flex align-items-center py-2 p-sm-2">
                            <div class="icon-box mb-0 bg-success-soft rounded-circle d-block me-3">
                                <i class="fal fa-calendar-check text-success"></i>
                            </div>
                            <div class="media-body fw-medium h6 mb-0">
                                Get 30 day free trial
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4">
                        <div class="media d-flex align-items-center py-2 p-sm-2">
                            <div class="icon-box mb-0 bg-danger-soft rounded-circle d-block me-3">
                                <i class="fal fa-calendar-times text-danger"></i>
                            </div>
                            <div class="media-body fw-medium h6 mb-0">
                                Cancel anytime
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    @foreach ($plans as $plan)
                        <div class="col-lg-4 col-md-6">
                            <div
                                class="position-relative single-pricing-wrap rounded-custom bg-white custom-shadow p-5 mb-4 mb-lg-0">
                                <div class="pricing-header mb-32">
                                    <h3 class="package-name text-primary d-block">{{ $plan->name }}</h3>
                                    <h4 class="display-6 fw-semi-bold">{{ $plan->price }} Aed<span>
                                            @isset($plan->duration)
                                                /{{ $plan->duration }}
                                            @endisset
                                        </span></h4>
                                </div>
                                <div class="pricing-info mb-4">
                                    <ul class="pricing-feature-list list-unstyled">
                                        <li><i class="fas fa-circle fa-2xs text-primary me-2"></i>
                                            {{ $plan->max_users }} User</li>
                                        <li><i class="fas fa-circle fa-2xs text-primary me-2"></i>
                                            {{ $plan->max_customers }} Customer</li>
                                        <li><i class="fas fa-circle fa-2xs text-primary me-2"></i>
                                            {{ $plan->max_venders }} Venders</li>
                                        <li><i class="fas fa-circle fa-2xs text-primary me-2"></i>
                                            {{ $plan->max_clients }} Clients</li>
                                        @if ($plan->account)
                                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> Accounting</li>
                                        @endif
                                        @if ($plan->crm)
                                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> CRM</li>
                                        @endif
                                        @if ($plan->hrm)
                                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> HR</li>
                                        @endif
                                        @if ($plan->project)
                                            <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> Projects</li>
                                        @endif
                                        <!-- <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> Automated Updated Features</li> -->
                                        <!-- <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> 24/7 Life time Support</li> -->
                                    </ul>
                                </div>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary mt-2">Start Now</a>

                                <!--pattern start-->
                                <div class="dot-shape-bg position-absolute z--1 left--40 bottom--40">
                                    <img src="{{ asset('public/land-assets/img/shape/dot-big-square.svg') }}"
                                        alt="shape">
                                </div>
                                <!--pattern end-->
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="col-lg-4 col-md-6">
                        <div
                            class="position-relative single-pricing-wrap rounded-custom bg-gradient text-white p-5 mb-4 mb-lg-0">
                            <div class="pricing-header mb-32">
                                <h3 class="package-name text-warning d-block">Advanced</h3>
                                <h4 class="display-6 fw-semi-bold">2500 Aed<span>/Year</span></h4>
                            </div>
                            <div class="pricing-info mb-4">
                                <ul class="pricing-feature-list list-unstyled">
                                    <li><i class="fas fa-circle fa-2xs text-warning me-2"></i> 1 User</li>
                                    <li><i class="fas fa-circle fa-2xs text-warning me-2"></i> 5 Customer</li>
                                    <li><i class="fas fa-circle fa-2xs text-warning me-2"></i> 1 Module</li>
                                    <li><i class="fas fa-circle fa-2xs text-warning me-2"></i> Free updates</li>
                                    <li><i class="fas fa-circle fa-2xs text-warning me-2"></i> 5 Gb Storage</li>
                                    <!-- <li><i class="fas fa-circle fa-2xs text-warning me-2"></i> Team Collaboration Tools</li> -->
                                    <!-- <li><i class="fas fa-circle fa-2xs text-warning me-2"></i> Automated Updated Features</li> -->
                                    <li><i class="fas fa-circle fa-2xs text-warning me-2"></i> 24/7 Support</li>
                                </ul>
                            </div>
                            <a href="request-demo.html" class="btn btn-primary mt-2">Start Now</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div
                            class="position-relative single-pricing-wrap rounded-custom bg-white custom-shadow p-5 mb-4 mb-lg-0">
                            <div class="pricing-header mb-32">
                                <h3 class="package-name text-primary d-block">Enterprise</h3>
                                <h4 class="display-6 fw-semi-bold">Contact Sales<span></span></h4>
                            </div>
                            <div class="pricing-info mb-4">
                                <ul class="pricing-feature-list list-unstyled">
                                    <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> 10+ Users</li>
                                    <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> 50+ Customers</li>

                                    <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> 4 Modules</li>

                                    <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> Advanced Security</li>
                                    <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> Automation</li>
                                    <li><i class="fas fa-circle fa-2xs text-primary me-2"></i> 24/7 Support</li>
                                </ul>
                            </div>
                            <a href="request-demo.html" class="btn btn-outline-primary mt-2">Start Now</a>

                            <!--pattern start-->
                            <div class="dot-shape-bg position-absolute z--1 right--40 top--40">
                                <img src="{{ asset('public/land-assets/img/shape/dot-big-square.svg') }}" alt="shape">
                            </div>
                            <!--pattern end-->
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

        <section class="testimonial-section ptb-60">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="position-relative w-100">
                            <div
                                class="swiper-container testimonialSwiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                                <div class="swiper-wrapper" id="swiper-wrapper-7aa29910c1ede3101a" aria-live="polite"
                                    style="transform: translate3d(-3978px, 0px, 0px); transition-duration: 0ms;">
                                    <div class="swiper-slide border border-2 p-5 rounded-custom position-relative swiper-slide-duplicate swiper-slide-duplicate-prev"
                                        data-swiper-slide-index="3" role="group" aria-label="1 / 9"
                                        style="width: 633px; margin-right: 30px;">
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}"
                                            alt="quotes" width="100"
                                            class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                        <div class="d-flex mb-32 align-items-center">
                                            <img src="{{ asset('public/land-assets/img/testimonial/4.jpg') }}"
                                                class="img-fluid me-3 rounded" width="60" alt="user">
                                            <div class="author-info">
                                                <h6 class="mb-0">Joan Dho</h6>
                                                <small>Founder and CTO</small>
                                            </div>
                                        </div>
                                        <blockquote>
                                            <h6>Best Template for SAAS Company!</h6>
                                            Dynamically create innovative core competencies with effective best
                                            practices promote innovative infrastructures.
                                        </blockquote>
                                        <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        </ul>
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}"
                                            alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                    </div>
                                    <!--    <div class="swiper-slide border border-2 p-5 rounded-custom position-relative swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="4" role="group" aria-label="2 / 9" style="width: 633px; margin-right: 30px;">
                                            <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}" alt="quotes" width="100" class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                            <div class="d-flex mb-32 align-items-center">
                                                <img src="{{ asset('public/land-assets/img/testimonial/5.jpg') }}" class="img-fluid me-3 rounded" width="60" alt="user">
                                                <div class="author-info">
                                                    <h6 class="mb-0">Ranu Mondal</h6>
                                                    <small>Lead Developer</small>
                                                </div>
                                            </div>
                                            <blockquote>
                                                <h6>It is undeniably good!</h6>
                                                Rapidiously supply client-centric e-markets and maintainable processes
                                                progressively engineer
                                            </blockquote>
                                            <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            </ul>
                                            <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}" alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                        </div> -->
                                    <!--      <div class="swiper-slide border border-2 p-5 rounded-custom position-relative swiper-slide-duplicate-next" data-swiper-slide-index="0" role="group" aria-label="3 / 9" style="width: 633px; margin-right: 30px;">
                                            <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}" alt="quotes" width="100" class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                            <div class="d-flex mb-32 align-items-center">
                                                <img src="{{ asset('public/land-assets/img/testimonial/1.jpg') }}" class="img-fluid me-3 rounded" width="60" alt="user">
                                                <div class="author-info">
                                                    <h6 class="mb-0">Mr.Rupan Oberoi</h6>
                                                    <small>Founder and CEO at Amaara Herbs</small>
                                                </div>
                                            </div>
                                            <blockquote>
                                                <h6>The Best Template You Got to Have it!</h6>
                                                Globally network long-term high-impact schemas vis-a-vis distinctive
                                                e-commerce
                                                cross-media infrastructures rather than ethical
                                            </blockquote>
                                            <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            </ul>
                                            <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}" alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                        </div> -->
                                    <div class="swiper-slide border border-2 p-5 rounded-custom position-relative"
                                        data-swiper-slide-index="1" role="group" aria-label="4 / 9"
                                        style="width: 633px; margin-right: 30px;">
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}"
                                            alt="quotes" width="100"
                                            class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                        <div class="d-flex mb-32 align-items-center">
                                            <img src="{{ asset('public/land-assets/img/testimonial/j.jpeg') }}"
                                                class="img-fluid me-3 rounded" width="60" alt="user">
                                            <div class="author-info">
                                                <h6 class="mb-0">Jijin</h6>
                                                <small>Manager At Gear Up</small>
                                            </div>
                                        </div>
                                        <blockquote>
                                            <h6>Best ERP solution for our company</h6>
                                            ZPHERE.IO has really helped us focus in on where we had some inconsistencies
                                            and bottlenecks, enabling us to alleviate them while saving money in the
                                            process.
                                        </blockquote>
                                        <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        </ul>
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}"
                                            alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                    </div>
                                    <div class="swiper-slide border border-2 p-5 rounded-custom position-relative"
                                        data-swiper-slide-index="2" role="group" aria-label="5 / 9"
                                        style="width: 633px; margin-right: 30px;">
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}"
                                            alt="quotes" width="100"
                                            class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                        <div class="d-flex mb-32 align-items-center">
                                            <img src="{{ asset('public/land-assets/img/testimonial/k.jpeg') }}"
                                                class="img-fluid me-3 rounded" width="60" alt="user">
                                            <div class="author-info">
                                                <h6 class="mb-0">Mihaira </h6>
                                                <small>CEO at Kunooz Projects </small>
                                            </div>
                                        </div>
                                        <blockquote>
                                            <h6>Amazing system for my team!</h6>
                                            Dynamically create innovative core competencies with effective best
                                            practices promote innovative infrastructures.
                                        </blockquote>
                                        <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        </ul>
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}"
                                            alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                    </div>
                                    <div class="swiper-slide border border-2 p-5 rounded-custom position-relative swiper-slide-prev"
                                        data-swiper-slide-index="3" role="group" aria-label="6 / 9"
                                        style="width: 633px; margin-right: 30px;">
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}"
                                            alt="quotes" width="100"
                                            class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                        <div class="d-flex mb-32 align-items-center">
                                            <img src="{{ asset('public/land-assets/img/testimonial/a.jpeg') }}"
                                                class="img-fluid me-3 rounded" width="60" alt="user">
                                            <div class="author-info">
                                                <h6 class="mb-0">Agin</h6>
                                                <small>CTO Millennium Hotels</small>
                                            </div>
                                        </div>
                                        <blockquote>
                                            <h6>Now i can get complete reports easily </h6>
                                            The ‘openness’ of the software lets our company create custom reports that
                                            ‘slice and dice’ the information the way I want to see it, unlike some
                                            software systems which just generate standard, unreadable reports.
                                        </blockquote>
                                        <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        </ul>
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}"
                                            alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                    </div>
                                    <div class="swiper-slide border border-2 p-5 rounded-custom position-relative swiper-slide-active"
                                        data-swiper-slide-index="4" role="group" aria-label="7 / 9"
                                        style="width: 633px; margin-right: 30px;">
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}"
                                            alt="quotes" width="100"
                                            class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                        <div class="d-flex mb-32 align-items-center">
                                            <img src="{{ asset('public/land-assets/img/testimonial/k.png') }}"
                                                class="img-fluid me-3 rounded" width="60" alt="user">
                                            <div class="author-info">
                                                <h6 class="mb-0">Dr Kingsly</h6>
                                                <small>CEO </small>
                                            </div>
                                        </div>
                                        <blockquote>
                                            <h6>It is undeniably good!</h6>
                                            “We appreciate the software’s flexibility. It enables us to grow with
                                            efficiency.”
                                        </blockquote>
                                        <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        </ul>
                                        <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}"
                                            alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                    </div>
                                    <!--          <div class="swiper-slide border border-2 p-5 rounded-custom position-relative swiper-slide-duplicate swiper-slide-next" data-swiper-slide-index="0" role="group" aria-label="8 / 9" style="width: 633px; margin-right: 30px;">
                                            <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}" alt="quotes" width="100" class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                            <div class="d-flex mb-32 align-items-center">
                                                <img src="{{ asset('public/land-assets/img/testimonial/1.jpg') }}" class="img-fluid me-3 rounded" width="60" alt="user">
                                                <div class="author-info">
                                                    <h6 class="mb-0">Mr.Rupan Oberoi</h6>
                                                    <small>Founder and CEO at Amaara Herbs</small>
                                                </div>
                                            </div>
                                            <blockquote>
                                                <h6>The Best Template You Got to Have it!</h6>
                                             ZPHERE.IO has really helped us focus in on where we had some inconsistencies and bottlenecks, enabling us to alleviate them while saving money in the process.
                                            </blockquote>
                                            <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            </ul>
                                            <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}" alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                        </div> -->
                                    <!-- <div class="swiper-slide border border-2 p-5 rounded-custom position-relative swiper-slide-duplicate" data-swiper-slide-index="1" role="group" aria-label="9 / 9" style="width: 633px; margin-right: 30px;">
                                            <img src="{{ asset('public/land-assets/img/testimonial/quotes-dot.svg') }}" alt="quotes" width="100" class="img-fluid position-absolute left-0 top-0 z--1 p-3">
                                            <div class="d-flex mb-32 align-items-center">
                                                <img src="{{ asset('public/land-assets/img/testimonial/3.jpg') }}" class="img-fluid me-3 rounded" width="60" alt="user">
                                                <div class="author-info">
                                                    <h6 class="mb-0">Oberoi R.</h6>
                                                    <small>CEO at Herbs</small>
                                                </div>
                                            </div>
                                            <blockquote>
                                                <h6>Embarrassed by the First Version.</h6>
                                               Most importantly, the system’s pricing was competitive. ZPHERE.IO was simply the best value for the fit
                                            </blockquote>
                                            <ul class="review-rate mb-0 mt-2 list-unstyled list-inline">
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                                <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                            </ul>
                                            <img src="{{ asset('public/land-assets/img/testimonial/quotes.svg') }}" alt="quotes" class="position-absolute right-0 bottom-0 z--1 pe-4 pb-4">
                                        </div> -->
                                </div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                            </div>
                            <span class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                                aria-controls="swiper-wrapper-7aa29910c1ede3101a"></span>
                            <span class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                                aria-controls="swiper-wrapper-7aa29910c1ede3101a"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-us ptb-120 position-relative overflow-hidden">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-12">
                        <div class="section-heading">
                            <h4 class="h5 text-primary">Quick Support</h4>
                            <h2>Get in Touch Today!</h2>
                            <!--    <p>Proactively deliver seamless core competencies with scalable. Completely fabricate transparent
                                paradigms. </p> -->
                        </div>
                        <div class="row justify-content-between pb-5">
                            <div class="col-sm-6 mb-4 mb-md-0 mb-lg-0">
                                <div class="icon-box d-inline-block rounded-circle bg-primary-soft">
                                    <i class="fas fa-phone fa-2x text-primary"></i>
                                </div>
                                <div class="contact-info">
                                    <h5>Call Us</h5>
                                    <p>Questions about our product or pricing? Call for support</p>
                                    <a href="tel:052274880" class="read-more-link text-decoration-none"><i
                                            class="far fa-phone me-2"></i> 05 2274 6880</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="icon-box d-inline-block rounded-circle bg-danger-soft">
                                    <i class="fas fa-comment-alt-lines fa-2x text-danger"></i>
                                </div>
                                <div class="contact-info">
                                    <h5>Chat Us</h5>
                                    <p>Our support will help you from
                                        <strong>9am to 5pm.</strong>
                                    </p>
                                    <a href="https://api.whatsapp.com/send?phone=+971522746880&amp;text=Hey There Kindly Send me more information Regarding Your Services.Thankyou !"
                                        class="read-more-link text-decoration-none"><i
                                            class="far fa-comment-alt-dots me-2"></i> Live Chat Now</a>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-7 col-md-12">
                        <div class="register-wrap p-5 bg-white shadow rounded-custom position-relative">
                            <form action="#" class="register-form position-relative z-5">
                                <h3 class="mb-5 fw-medium">Fill out the form and we'll be in touch as soon as
                                    possible.</h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Name"
                                                aria-label="name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Phone"
                                                aria-label="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Company website"
                                                aria-label="company-website">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" placeholder="Work email"
                                                aria-label="work-Email">
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <select class="form-control form-select" name="budget" id="budget" required="" data-msg="Please select your budget.">
                                                <option value="" selected="" disabled="">Budget</option>
                                                <option value="budget1">None, just getting started</option>
                                                <option value="budget1">Less than $20,000</option>
                                                <option value="budget1">$20,000 to $50,000</option>
                                                <option value="budget1">$50,000 to $100,000</option>
                                                <option value="budget2">$100,000 to $500,000</option>
                                                <option value="budget3">More than $500,000</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <!--    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <select class="form-control form-select" name="country" id="country" required="" data-msg="Please select your country.">
                                                <option value="" selected="" disabled="">Country</option>
                                              
                                                <option value="AE">United Arab Emirates</option>
                                                
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" placeholder="Tell us more about your project, needs and budget"
                                                style="height: 70px"></textarea>
                                        </div>
                                    </div>
                                    <!--       <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                            <label class="form-check-label small" for="flexCheckChecked">
                                                Yes, I'd like to receive occasional marketing emails from us. I have the
                                                right to opt out at any time.
                                                <a href="#"> View privacy policy</a>.
                                            </label>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-4 d-block w-100">Get Started
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--    <div class="bg-gradient position-absolute bottom-0 h-25 bottom-0 left-0 right-0 z--1 py-5" style="background: url('land-assets/img/shape/dot-dot-wave-shape.svg')no-repeat center top">
                <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light left-5"></div>
                <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-warning right-5"></div>
            </div> -->
        </section>


        <section class="cta-subscribe bg-dark ptb-120 position-relative overflow-hidden">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <div class="subscribe-info-wrap text-center position-relative z-2">
                            <div class="section-heading">
                                <h4 class="h5 text-warning">Let's Get Your Team Into Zphere.io</h4>
                                <h2>Start Now!</h2>
                                <p>We can help you to create your dream website for better business revenue.</p>
                            </div>
                            <div class="form-block-banner mw-60 m-auto mt-5">
                                <form id="email-form2" name="email-form" class="subscribe-form d-flex">
                                    <input type="email" class="form-control me-2" name="Email" data-name="Email"
                                        placeholder="Your email" id="Email2" required="">
                                    <input type="submit" value="Join!" data-wait="Please wait..."
                                        class="btn btn-primary">
                                </form>
                            </div>
                            <ul class="nav justify-content-center subscribe-feature-list mt-3">
                                <li class="nav-item">
                                    <span><i class="fad fa-dot-circle text-primary me-2"></i>Trial Available</span>
                                </li>
                                <li class="nav-item">
                                    <span><i class="fad fa-dot-circle text-primary me-2"></i>UAE Build</span>
                                </li>
                                <li class="nav-item">
                                    <span><i class="fad fa-dot-circle text-primary me-2"></i>Support 24/7</span>
                                </li>
                                <li class="nav-item">
                                    <span><i class="fad fa-dot-circle text-primary me-2"></i>Advanced Technology</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-circle rounded-circle circle-shape-3 position-absolute bg-dark-light left-5"></div>
                <div class="bg-circle rounded-circle circle-shape-1 position-absolute bg-warning right-5"></div>
            </div>
        </section>

        <!--footer section start-->
        <footer class="footer-section">
            <!--footer top start-->
            <!--for light footer add .footer-light class and for dark footer add .bg-dark .text-white class-->
            <div class="footer-top footer-light ptb-120">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-8 col-lg-4 mb-md-4 mb-lg-0">
                            <div class="footer-single-col">
                                <div class="footer-single-col mb-4">
                                    <img src="{{ asset('public/land-assets/img/blk.png') }}" style="height: 43px;"
                                        alt="logo" class="img-fluid logo-white">
                                    <img src="{{ asset('public/land-assets/img/blk.png') }}" style="height: 43px;"
                                        alt="logo" class="img-fluid logo-color">
                                </div>
                                <p>Our latest news, articles, and resources, we will sent to
                                    your inbox weekly.</p>

                                <form class="newsletter-form position-relative d-block d-lg-flex d-md-flex">
                                    <input type="text" class="input-newsletter form-control me-2"
                                        placeholder="Enter your email" name="email" required="" autocomplete="off">
                                    <input type="submit" value="Subscribe" data-wait="Please wait..."
                                        class="btn btn-primary mt-3 mt-lg-0 mt-md-0">
                                </form>
                                <div class="ratting-wrap mt-4">
                                    <h6 class="mb-0">9/10 Overall rating</h6>
                                    <ul class="list-unstyled rating-list list-inline mb-0">
                                        <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item"><i class="fas fa-star text-warning"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-7 mt-4 mt-md-0 mt-lg-0">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 mt-4 mt-md-0 mt-lg-0">
                                    <div class="footer-single-col">
                                        <h3>Products</h3>
                                        <ul class="list-unstyled footer-nav-list mb-lg-0">
                                            <li><a href="zphere.io" class="text-decoration-none">CRM</a></li>
                                            <li><a href="zphere.io" class="text-decoration-none">Accounting</a></li>
                                            <li><a href="zphere.io" class="text-decoration-none">Human Resource</a>
                                            </li>
                                            <li><a href="zphere.io" class="text-decoration-none">Project Management</a>
                                            </li>
                                            <li><a href="zphere.io" class="text-decoration-none">Automation</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 mt-4 mt-md-0 mt-lg-0">
                                    <div class="footer-single-col">
                                        <h3>Contact</h3>
                                        <ul class="list-unstyled footer-nav-list mb-lg-0">
                                            <li><a href="tel:0522746880" class="text-decoration-none">05 2274 6880</a>
                                            </li>
                                            <li><a href="mailto:hello@zphere.io"
                                                    class="text-decoration-none">hello@zphere.io</a></li>
                                            <li><a href="#" class="text-decoration-none">Abu Dhabi </a></li>
                                            <li><a href="#" class="text-decoration-none">UAE</a></li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--footer top end-->

            <!--footer bottom start-->
            <div class="footer-bottom footer-light py-4">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-7 col-lg-7">
                            <div class="copyright-text">
                                <p class="mb-lg-0 mb-md-0">&copy; 2016 - 2022 All Rights Reserved. Made with passion &
                                    love by <a href="https://zphere.io/" class="text-decoration-none">Zphere.io In
                                        UAE</a></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="footer-single-col text-start text-lg-end text-md-end">
                                <ul class="list-unstyled list-inline footer-social-list mb-0">
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer bottom end-->
        </footer>
        <!--footer section end-->

    </div>



    <!--build:js-->
    <script src="{{ asset('public/land-assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/land-assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/land-assets/js/vendors/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/land-assets/js/vendors/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('public/land-assets/js/vendors/parallax.min.js') }}"></script>
    <script src="{{ asset('public/land-assets/js/vendors/aos.js') }}"></script>
    <script src="{{ asset('public/land-assets/js/app.js') }}"></script>
    <!--endbuild-->
</body>

</html>
