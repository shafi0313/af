<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $basic_info->website_title }}</title>
    {{-- <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png"> --}}
    <link rel="icon" type="image/png" href="{{ asset('backend/images/logo/af_nav.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../../ms-icon-144x144.html">
    <meta name="theme-color" content="#ffffff">
    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- master stylesheet -->
    <link rel="stylesheet" href="{{ asset('front_end') }}/css/style.css?{{ time() }}">
    <!-- responsive stylesheet -->
    <link rel="stylesheet" href="{{ asset('front_end') }}/css/responsive.css">
    <style>
        .header {
            padding: 0px;
        }
    </style>
</head>

<body class="page-wrapper">
    <section class="top-bar">
        <div class="container">
            <div class="social-icons pull-right">
                <ul>
                    <li><a href="{{ $fb->name }}"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{ $twitter->name }}"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="{{ $linkdin->name }}"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div> <!-- /.social-icons -->
        </div>
    </section> <!-- /.top-bar -->

    <header class="header">
        <div class="container">
            <div class="logo pull-left">
                <a href="{{ route('/') }}">
                    <img style="max-height: 60px;" src="{{ asset('images/' . $basic_info->logo) }}"
                        alt="{{ $basic_info->website_title }}" />
                </a>
            </div>
            <div class="header-right-info pull-right clearfix">
                <div class="single-header-info">
                    <div class="icon-box">
                        <div class="inner-box">
                            <i class="flaticon-interface-2"></i>
                        </div>
                    </div>
                    <div class="content">
                        <h3>EMAIL</h3>
                        <p>{{ $basic_info->email }}</p>
                    </div>
                </div>
                <div class="single-header-info">
                    <div class="icon-box">
                        <div class="inner-box">
                            <i class="flaticon-telephone"></i>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Call Now</h3>
                        <p><b>{{ $basic_info->mobile }}</b></p>
                    </div>
                </div>
                <div class="single-header-info">
                    <a class="thm-btn" href="{{ url('donate') }}">Donate Now</a>
                </div>
            </div>
        </div>
    </header> <!-- /.header -->

    @include('frontend.layouts.includes.navigation')


    @yield('content')

    <footer class="footer sec-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <a href="#">
                            <img style="max-height: 60px;" src="{{ asset('images/' . $basic_info->logo) }}"
                                alt="{{ $basic_info->website_title }}" />
                        </a>
                        <p>{{ $basic_info->notice }}</p>
                        <ul class="contact">
                            <li><i class="fa fa-map-marker"></i> <span>{{ $basic_info->address }}</span></li>
                            <li><i class="fa fa-phone"></i> <span>{{ $basic_info->mobile }}</span></li>
                            <li><i class="fa fa-envelope-o"></i> <span>{{ $basic_info->email }}</span></li>
                        </ul>
                        <ul class="social">
                            <li><a href="{{ $fb->name }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ $twitter->name }}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ $linkdin->name }}"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="footer-widget quick-links">
                        <h3 class="title">Pages</h3>
                        <ul>
                            <li><a href="{{ url('about-us') }}">About Us</a></li>
                            <li><a href="#">Causes</a></li>
                            <li><a href="#">Events</a></li>
                            <li><a href="#">Faq</a></li>
                            <li><a href="{{ url('login') }}">Login</a></li>
                            <li><a href="{{ url('contact-us') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 latest-post col-sm-6">
                    <div class="footer-widget latest-post">
                        <h3 class="title">Latest News</h3>
                        <ul>
                            <li>
                                <span class="border"></span>
                                <div class="content">
                                    <a href="blog-details.html">If you need a crown or lorem an implant you will pay it
                                    </a>
                                    <span>July 2, 2014</span>
                                </div>
                            </li>
                            <li>
                                <span class="border"></span>
                                <div class="content">
                                    <a href="blog-details.html">If you need a crown or lorem an implant you will pay it
                                    </a>
                                    <span>July 2, 2014</span>
                                </div>
                            </li>
                            <li>
                                <span class="border"></span>
                                <div class="content">
                                    <a href="blog-details.html">If you need a crown or lorem an implant you will pay it
                                    </a>
                                    <span>July 2, 2014</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="footer-widget contact-widget">
                        <h3 class="title">Contact Form</h3>
                        <form action="#" class="contact-form" id="footer-cf">
                            <input type="text" name="name" placeholder="Full Name">
                            <input type="text" name="email" placeholder="Email Address">
                            <textarea name="message" placeholder="Your Message"></textarea>
                            <button type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <section class="footer-bottom">
        <div class="container text-center">
            <p><a href="{{ url('/') }}">{{ $basic_info->developedby }} - {{ date('Y') }}</a></p>
        </div>
    </section>

    <!--Scroll to top-->
    <div class="scroll-to-top"><span class="fa fa-arrow-up"></span></div>
    <!-- main jQuery -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="{{ asset('front_end') }}/js/jquery-1.11.1.min.js"></script>
    <!-- bootstrap -->
    <script src="{{ asset('front_end') }}/js/bootstrap.min.js"></script>
    <!-- bx slider -->
    <script src="{{ asset('front_end') }}/js/jquery.bxslider.min.js"></script>
    <!-- owl carousel -->
    <script src="{{ asset('front_end') }}/js/owl.carousel.min.js"></script>
    <!-- validate -->
    <script src="{{ asset('front_end') }}/js/jquery-parallax.js"></script>
    <!-- validate -->
    <script src="{{ asset('front_end') }}/js/validate.js"></script>
    <!-- mixit up -->
    <script src="{{ asset('front_end') }}/js/jquery.mixitup.min.js"></script>
    <!-- fancybox -->
    <script src="{{ asset('front_end') }}/js/jquery.fancybox.pack.js"></script>
    <!-- easing -->
    <script src="{{ asset('front_end') }}/js/jquery.easing.min.js"></script>
    <!-- circle progress -->
    <script src="{{ asset('front_end') }}/js/circle-progress.js"></script>
    <!-- appear js -->
    <script src="{{ asset('front_end') }}/js/jquery.appear.js"></script>
    <!-- count to -->
    <script src="{{ asset('front_end') }}/js/jquery.countTo.js"></script>
    <!-- isotope script -->
    <script src="{{ asset('front_end') }}/js/isotope.pkgd.min.js"></script>
    <!-- jQuery ui js -->
    <script src="{{ asset('front_end') }}/js/jquery-ui-1.11.4/jquery-ui.js"></script>
    <!-- revolution scripts -->
    <script src="{{ asset('front_end') }}/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="{{ asset('front_end') }}/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('front_end') }}/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <!-- thm custom script -->
    <script src="{{ asset('front_end') }}/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('backend/js/plugins-init.js') }}"></script>
    @include('sweetalert::alert')
    @stack('script')
</body>

</html>
