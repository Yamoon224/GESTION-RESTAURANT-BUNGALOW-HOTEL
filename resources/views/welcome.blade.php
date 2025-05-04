<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Barlow:100,200,300,400,700">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.welcome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fonts.welcome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.welcome.css') }}">
        <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
    </head>
    <body>
        <div class="ie-panel"><a href="https://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
        
        <!-- Page-->
        <div class="page bg-image novi-background">
            <div class="preloader">
                <div class="preloader-body">
                    <div class="cssload-container">
                        <div class="cssload-speeding-wheel"></div>
                    </div>
                    <p>{{ config('app.name', 'Laravel') }}</p>
                </div>
            </div>
            <a class="section section-banner d-none d-xl-flex" href="{{ route('login') }}" style="background-image: url(images/banner/background-04-1920x60.jpg); background-image: -webkit-image-set( url(images/banner/background-04-1920x60.jpg) 1x, url(images/banner/background-04-3840x120.jpg) 2x )"><img src="images/banner/foreground-04-1600x60.png" srcset="images/banner/foreground-04-1600x60.png 1x, images/banner/foreground-04-3200x120.png 2x" alt="" width="1600" height="310"></a>
            <!-- Page Header-->
            <header class="section page-header">
            <div class="container">
                <div class="row justify-content-between align-items-end row-30">
                <div class="col-12 col-md-6"><a class="brand-logo" href="./"><img src="images/logo-default-346x62.png" alt="" width="346" height="62"/></a></div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="head-title">
                    <p>I am a professional specializing <br class="d-none d-md-inline-block">in lifestyle photography.</p>
                    </div>
                </div>
                </div>
            </div>
            </header>
            <section class="section section-xs">
                <div class="container">
                    <!-- Bootstrap tabs-->
                    <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-1">
                        <!-- Nav tabs-->
                        <ul class="nav nav-tabs">
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-1" data-toggle="tab"><span class="nav-link-main">gallery</span></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-2" data-toggle="tab"><span class="nav-link-main">about me</span></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-3" data-toggle="tab"><span class="nav-link-main">services</span></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-4" data-toggle="tab"><span class="nav-link-main">contacts</span></a></li>
                        </ul>
                        <!-- Tab panes-->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-1-1">
                                <div class="tabs-custom tabs-horizontal tabs-gallery hide-on-modal" id="tabs-galery">
                                    <!-- Nav tabs-->
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-gallery-1" data-toggle="tab"><img src="images/gallery-01-180x180.jpg" alt="" width="180" height="180"/><span>Lifestyle</span></a></li>
                                        <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-gallery-2" data-toggle="tab"><img src="images/gallery-02-180x180.jpg" alt="" width="180" height="180"/><span>Portrait</span></a></li>
                                        <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-gallery-3" data-toggle="tab"><img src="images/gallery-03-180x180.jpg" alt="" width="180" height="180"/><span>Fashion</span></a></li>
                                        <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-gallery-4" data-toggle="tab"><img src="images/gallery-04-180x180.jpg" alt="" width="180" height="180"/><span>Nature</span></a></li>
                                        <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-gallery-5" data-toggle="tab"><img src="images/gallery-05-180x180.jpg" alt="" width="180" height="180"/><span>City Life</span></a></li>
                                    </ul>
                                    <!-- Tab panes-->
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="tabs-gallery-1">
                                            <div class="gallery-wrap">
                                            <div class="gallery-wrap-inner">
                                                <h4>Lifestyle</h4>
                                                <div class="dots-custom-lifestyle"></div><a class="back-to-gallery button-link button-link-icon" href="#"><span class="novi-icon icon icon-primary fa fa-angle-left"></span><span>back to gallery</span></a>
                                            </div>
                                            <div class="gallery-wrap-inner">
                                                <!-- Owl Carousel-->
                                                <div class="owl-carousel owl-gallery" data-items="1" data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false" data-margin="0" data-mouse-drag="false" data-lightgallery="group" data-pagination-class=".dots-custom-lifestyle"><a class="gallery-item" href="images/gallery-lifestyle-07-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-lifestyle-07-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-lifestyle-01-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-lifestyle-01-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-lifestyle-02-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-lifestyle-02-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-lifestyle-03-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-lifestyle-03-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-lifestyle-04-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-lifestyle-04-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-lifestyle-05-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-lifestyle-05-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-lifestyle-06-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-lifestyle-06-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-lifestyle-08-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-lifestyle-08-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!--Portrait-->
                                        <div class="tab-pane fade" id="tabs-gallery-2">
                                            <div class="gallery-wrap">
                                            <div class="gallery-wrap-inner">
                                                <h4>Portrait</h4>
                                                <div class="dots-custom-portrait"></div><a class="back-to-gallery button-link button-link-icon" href="#"><span class="novi-icon icon icon-primary fa fa-angle-left"></span><span>back to gallery</span></a>
                                            </div>
                                            <div class="gallery-wrap-inner">
                                                <!-- Owl Carousel-->
                                                <div class="owl-carousel owl-gallery" data-items="1" data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false" data-margin="0" data-mouse-drag="false" data-lightgallery="group" data-pagination-class=".dots-custom-portrait"><a class="gallery-item" href="images/gallery-portrait-02-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-portrait-02-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-portrait-01-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-portrait-01-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-portrait-03-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-portrait-03-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-portrait-04-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-portrait-04-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-portrait-05-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-portrait-05-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-portrait-06-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-portrait-06-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-portrait-07-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-portrait-07-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-portrait-08-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-portrait-08-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!--Fashion-->
                                        <div class="tab-pane fade" id="tabs-gallery-3">
                                            <div class="gallery-wrap">
                                            <div class="gallery-wrap-inner">
                                                <h4>Fashion</h4>
                                                <div class="dots-custom-fashion"></div><a class="back-to-gallery button-link button-link-icon" href="#"><span class="novi-icon icon icon-primary fa fa-angle-left"></span><span>back to gallery</span></a>
                                            </div>
                                            <div class="gallery-wrap-inner">
                                                <!-- Owl Carousel-->
                                                <div class="owl-carousel owl-gallery" data-items="1" data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false" data-margin="0" data-mouse-drag="false" data-lightgallery="group" data-pagination-class=".dots-custom-fashion"><a class="gallery-item" href="images/gallery-fashion-03-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-fashion-03-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-fashion-01-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-fashion-01-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-fashion-02-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-fashion-02-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-fashion-04-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-fashion-04-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-fashion-05-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-fashion-05-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-fashion-06-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-fashion-06-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-fashion-07-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-fashion-07-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-fashion-08-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-fashion-08-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!--nature-->
                                        <div class="tab-pane fade" id="tabs-gallery-4">
                                            <div class="gallery-wrap">
                                            <div class="gallery-wrap-inner">
                                                <h4>Nature</h4>
                                                <div class="dots-custom-nature"></div><a class="back-to-gallery button-link button-link-icon" href="#"><span class="novi-icon icon icon-primary fa fa-angle-left"></span><span>back to gallery</span></a>
                                            </div>
                                            <div class="gallery-wrap-inner">
                                                <!-- Owl Carousel-->
                                                <div class="owl-carousel owl-gallery" data-items="1" data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false" data-margin="0" data-mouse-drag="false" data-lightgallery="group" data-pagination-class=".dots-custom-nature"><a class="gallery-item" href="images/gallery-nature-07-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-nature-07-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-nature-01-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-nature-01-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-nature-02-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-nature-02-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-nature-03-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-nature-03-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-nature-04-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-nature-04-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-nature-05-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-nature-05-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-nature-06-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-nature-06-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-nature-08-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-nature-08-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!--city-->
                                        <div class="tab-pane fade" id="tabs-gallery-5">
                                            <div class="gallery-wrap">
                                            <div class="gallery-wrap-inner">
                                                <h4>Citylife</h4>
                                                <div class="dots-custom-city"></div><a class="back-to-gallery button-link button-link-icon" href="#"><span class="novi-icon icon icon-primary fa fa-angle-left"></span><span>back to gallery</span></a>
                                            </div>
                                            <div class="gallery-wrap-inner">
                                                <!-- Owl Carousel-->
                                                <div class="owl-carousel owl-gallery" data-items="1" data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false" data-margin="0" data-mouse-drag="false" data-lightgallery="group" data-pagination-class=".dots-custom-city"><a class="gallery-item" href="images/gallery-city-02-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-city-02-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-city-01-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-city-01-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-city-03-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-city-03-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-city-04-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-city-04-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-city-05-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-city-05-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-city-06-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-city-06-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a><a class="gallery-item" href="images/gallery-city-07-970x524.jpg" data-lightgallery="item">
                                                    <figure><img src="images/gallery-city-07-970x524.jpg" alt="" width="970" height="524"/>
                                                    </figure>
                                                    <div class="caption"><span class="icon novi-icon fa-expand"></span></div></a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-1-2">
                                <div class="content-box hide-on-modal">
                                    <div class="content-box-inner">
                                    <div class="row align-items-center row-30 row-md-30">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <figure><x-app-logo :width="400" :height="150"></x-app-logo></figure>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h3>Who Are We</h3>
                                            <p class="subtitle">{{ config('app.name', 'Laravel') }}</p>
                                            <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incidunt ut labore et dolore magnam. Naliquam quaerat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur.</p>
                                        </div>
                                    </div>
                                    </div><a class="close-content-box" href="#">x</a>
                                </div>
                                <div class="modal slideUp" id="modal-about-us" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="content-box">
                                        <div class="content-box-inner">
                                            <div class="row">
                                            <div class="col-12">
                                                <h3>A Few Words About Me</h3>
                                                <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae.</p>
                                                <p>Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempo. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea</p>
                                            </div>
                                            </div>
                                        </div><a class="close-modal-content-box" href="#" data-dismiss="modal">x</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-1-3">
                                <div class="content-box hide-on-modal">
                                    <div class="content-box-inner row-30">
                                    <h3>Services Overview</h3>
                                    <div class="row align-items-center row-30">
                                        <div class="col-12 col-md-6">
                                        <div class="unit service-box">
                                            <div class="unit-left"><span class="novi-icon icon icon-lg fa-clock-o"></span></div>
                                            <div class="unit-body"><a class="subtitle" href="#" data-toggle="modal" data-target="#modal-service-1">bermodi tempora incidunt ut labore et dolore magna maliquam</a>
                                            <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore et dolore magnam. Naliquam quae.</p>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                        <div class="unit service-box">
                                            <div class="unit-left"><span class="novi-icon icon icon-lg fa-cloud"></span></div>
                                            <div class="unit-body"><a class="subtitle" href="#" data-toggle="modal" data-target="#modal-service-2">cidunt ut labore t dolore magna maliqua mquaerat voleneni.</a>
                                            <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore et dolore magnam. Naliquam quae.</p>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                        <div class="unit service-box">
                                            <div class="unit-left"><span class="novi-icon icon icon-lg fa-bell"></span></div>
                                            <div class="unit-body"><a class="subtitle" href="#" data-toggle="modal" data-target="#modal-service-3">empora incidunt ut labore et dolore magna maliquam lroep oirta.</a>
                                            <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore et dolore magnam. Naliquam quae.</p>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                        <div class="unit service-box">
                                            <div class="unit-left"><span class="novi-icon icon icon-lg fa-image"></span></div>
                                            <div class="unit-body"><a class="subtitle" href="#" data-toggle="modal" data-target="#modal-service-4">dunt ut labore et dolore magna aliquam lroep oirta lreo prota.</a>
                                            <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore et dolore magnam. Naliquam quae.</p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div><a class="close-content-box" href="#">x</a>
                                </div>
                                <div class="modal slideUp" id="modal-service-1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="content-box">
                                        <div class="content-box-inner">
                                            <div class="row">
                                            <div class="col-12">
                                                <h3>bermodi tempora incidunt ut labore et dolore magna maliquam</h3>
                                                <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae.</p>
                                                <p>Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempo. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea</p>
                                            </div>
                                            </div>
                                        </div><a class="close-modal-content-box" href="#" data-dismiss="modal">x</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal slideUp" id="modal-service-2" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="content-box">
                                        <div class="content-box-inner">
                                            <div class="row">
                                            <div class="col-12">
                                                <h3>cidunt ut labore t dolore magna maliqua mquaerat voleneni.</h3>
                                                <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae.</p>
                                                <p>Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempo. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea</p>
                                            </div>
                                            </div>
                                        </div><a class="close-modal-content-box" href="#" data-dismiss="modal">x</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal slideUp" id="modal-service-3" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="content-box">
                                        <div class="content-box-inner">
                                            <div class="row">
                                            <div class="col-12">
                                                <h3>empora incidunt ut labore et dolore magna maliquam lroep oirta.</h3>
                                                <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae.</p>
                                                <p>Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempo. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea</p>
                                            </div>
                                            </div>
                                        </div><a class="close-modal-content-box" href="#" data-dismiss="modal">x</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal slideUp" id="modal-service-4" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="content-box">
                                        <div class="content-box-inner">
                                            <div class="row">
                                            <div class="col-12">
                                                <h3>dunt ut labore et dolore magna aliquam lroep oirta lreo prota.</h3>
                                                <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae.</p>
                                                <p>Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempo. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea</p>
                                            </div>
                                            </div>
                                        </div><a class="close-modal-content-box" href="#" data-dismiss="modal">x</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-1-4">
                                <div class="content-box hide-on-modal">
                                    <div class="row row-30 justify-content-center align-items-center">
                                    <div class="col-12 col-md-7">
                                        <!--RD Mailform-->
                                        <form class="rd-mailform text-left" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
                                            <div class="row row-14 gutters-14">
                                                <div class="col-12">
                                                    <div class="form-wrap">
                                                        <label class="form-label" for="contact-email">E-Mail</label>
                                                        <input class="form-input" id="contact-email" type="email" name="email" required>
                                                    </div>

                                                    <div class="form-wrap">
                                                        <label class="form-label" for="contact-message">Message</label>
                                                        <textarea class="form-input" id="contact-message" name="message" rows="3" style="resize: none" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 align-self-end">
                                                    <div class="form-button">
                                                        <button class="button button-lg button-block button-primary" type="submit">Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <h3>Contact Info</h3>
                                        <address class="subtitle">Yamoussoukro, Côte d'Ivoire.</address>
                                        <ul class="contact-info">
                                            <li><span>Freephone:</span><a href="tel:#">2730610871</a></li>
                                            <li><span>Telephone:</span><a href="tel:#">2730610871</a></li>
                                            <li><span>FAX:</span><a href="tel:#">2730610871</a></li>
                                            <li><span>E-mail:</span><a href="mailto:#">direction@bungalowshotel.net</a></li>
                                        </ul>
                                    </div>
                                    </div><a class="close-content-box" href="#">x</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Page Footer-->
            <footer class="section footer-classic context-dark novi-background">
                <div class="container">
                    <div class="footer-group">
                        <ul class="list-inline list-inline-xs">
                            <li><a class="novi-icon icon-xxs fa-facebook icon" href="#"></a></li>
                            <li><a class="novi-icon icon-xxs fa-instagram icon" href="#"></a></li>
                        </ul>
                        <!-- Rights-->
                        <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span>.&nbsp;</span><a href="#" data-toggle="modal" data-target="#privacy">Privacy Policy</a>. Design&nbsp;by&nbsp;<a href="https://www.yk.jss-gn.com/">Yamoon</a></p>
                    </div>
                </div>
            </footer>
    
            <div class="modal modal-centered slideUp" id="privacy" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="content-box">
                    <div class="content-box-inner">
                    <div class="row">
                        <div class="col-12">
                        <h3>Privacy Policy</h3>
                        <p>Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae.</p>
                        <p>Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea commodi consequatur. Aquis autem vel eum iure reprehenderit, muytasas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempo. Asas dresasaser. Esse, quam nihil molestiae consequatur, vel illum. Dastqui dolorem ipsumquia dolsitmet conse tequam eius. Asmodi tempora incid. Dent ut labore t dolore magnam. Naliquam quae. Rat voleneni ullam corporis suscipit labasic ut aliquidea</p>
                        </div>
                    </div>
                    </div><a class="close-modal-content-box" href="#" data-dismiss="modal">x</a>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Global Mailform Output-->
        <div class="snackbars" id="form-output-global"></div>
        <!-- Javascript-->
        <script src="{{ asset('js/core.welcome.min.js') }}"></script>
        <script src="{{ asset('js/script.welcome.js') }}"></script>
        <!-- coded by ragnar-->
            
        <!--LIVEDEMO_00 -->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-7078796-5']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'https://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
            
        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-P9FT69" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-P9FT69');</script><!-- End Google Tag Manager --></body>
    </body>
</html>
