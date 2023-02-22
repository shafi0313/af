@extends('asset')

@section('content')

    <body  id="page-top" data-spy="scroll" data-target=".navbar" data-offset="100">        
        <!-- Page Loader===================================== -->
        <div id="pageloader" class="bg-grad-animation-1">
            <div class="loader-item">
                <img src="{{ 'front_end/' }}assets/img/other/oval.svg" alt="page loader">
            </div>
        </div>
        
        <a href="#page-top" class="go-to-top">
            <i class="fa fa-long-arrow-up"></i>
        </a>

        @include('header_menu')
        
        <!-- Search Modal Dialog Box
        ===================================== -->
        <div id="searchModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title text-center"><i class="fa fa-search fa-fw"></i> Search here</h5>
                    </div>
                    <div class="modal-body">                        
                        <form action="#" class="inline-form">
                            <input type="text" class="modal-search-input" autofocus>
                        </form>
                    </div>
                    <div class="modal-footer bg-gray">
                        <span class="text-center"><a href="#" class="color-dark">Advanced Search</a></span>
                    </div>
                </div>

            </div>
        </div>        
        
        
        <!-- Intro Area
        ===================================== -->
              
        <!-- Search Modal Dialog Box
        ===================================== -->
        <div id="searchModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title text-center"><i class="fa fa-search fa-fw"></i> Search here</h5>
                    </div>
                    <div class="modal-body">                        
                        <form action="#" class="inline-form">
                            <input type="text" class="modal-search-input" autofocus>
                        </form>
                    </div>
                    <div class="modal-footer bg-gray">
                        <span class="text-center"><a href="#" class="color-dark">Advanced Search</a></span>
                    </div>
                </div>
            </div>
        </div>     

        <!-- Sub Header
        ===================================== -->
        <div class="pt100 pb100 parallax-window-2" data-parallax="scroll" data-speed="0.5" data-image-src="{{ 'front_end/' }}assets/img/bg/bg-parallax-5.jpg" data-positionY="1000">
            <div class="intro-body text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 pt50">
                            <h1 class="brand-heading font-montserrat text-uppercase color-light" data-in-effect="fadeInDown">
                               Our Product
                            </h1>                           
                            <h4 class="brand-heading font-montserrat text-uppercase color-light alpha5" data-in-effect="fadeInDown"></h4>                           
                        </div>
                    </div>                    
                </div>                
            </div>
        </div>
                
<style type="text/css">
.portfolio .portfolio-item a {
    position: absolute;
    background-color: 
    rgba(1,1,1,.7);
    width: 100%;
    height: 100%;
    display: block;
    vertical-align: middle;
    float: left;
    text-align: center;
    color:#fff;
    padding-top: 30%;
    opacity: 0;
    font-size: 25px;
    z-index: 1;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
    }
</style>
            <div class="container bg-gray pt30">                
                <div class="container">
                    <div class="">                     
                        <h4 class="text-center">                            
                         Our Products
                            <small class="heading heading-double center-block"></small>
                        </h4>           
                        <div class="portfolio center-block">

                            <div class="portfolio-item col-md-3 col-sm-3 col-xs-3 wordpress woocommerce" data-category="">
                                <a href="{{ asset('images') }}/1.jpg" class="magnific-popup">
                                    <span class="glyphicon glyphicon-search hover-bounce-out"></span>
                                </a>
                                <img src="{{ asset('images') }}/1.jpg" alt="portfolio woocommerce" class="img-responsive animated" data-animation="zoomIn" data-animation-delay="100">
                           </div>
                            
                            <div class="portfolio-item col-md-3 col-sm-3 col-xs-3 joomla html">
                                <a href="{{ asset('images') }}//2.jpg" class="magnific-popup">
                                    <span class="glyphicon glyphicon-search hover-bounce-out"></span>
                                </a>
                                <img src="{{ asset('images') }}/2.jpg" alt="portfolio woocommerce" class="img-responsive animated" data-animation="zoomIn" data-animation-delay="200">
                            </div>
                            
                            <div class="portfolio-item col-md-3 col-sm-3 col-xs-3 wordpress joomla">
                                <a href="{{ asset('images') }}/3.jpg" class="magnific-popup">
                                    <span class="glyphicon glyphicon-search hover-bounce-out"></span>
                                </a>
                                <img src="{{ asset('images') }}//3.jpg" alt="portfolio woocommerce" class="img-responsive animated" data-animation="zoomIn" data-animation-delay="300">
                            </div>
                            
                            <div class="portfolio-item col-md-3 col-sm-3 col-xs-3 html wordpress">
                                <a href="{{ asset('images') }}/4.jpg" class="magnific-popup">
                                    <span class="glyphicon glyphicon-search hover-bounce-out"></span>
                                </a>
                                <img src="{{ asset('images') }}/4.jpg" alt="portfolio woocommerce" class="img-responsive animated" data-animation="zoomIn" data-animation-delay="400">
                            </div>
                                    
                            <div class="portfolio-item col-md-3 col-sm-3 col-xs-3 html wordpress">
                                <a href="{{ asset('images') }}/101579694643.jpg" class="magnific-popup">
                                    <span class="glyphicon glyphicon-search hover-bounce-out"></span>
                                </a>
                                <img src="{{ asset('images') }}/101579694643.jpg" alt="portfolio woocommerce" class="img-responsive animated" data-animation="zoomIn" data-animation-delay="400">
                            </div>

                            <div class="portfolio-item col-md-3 col-sm-3 col-xs-3 html wordpress">
                                <a href="{{ asset('images') }}/171579691218.jpg" class="magnific-popup">
                                    <span class="glyphicon glyphicon-search hover-bounce-out"></span>
                                </a>
                                <img src="{{ asset('images') }}/171579691218.jpg" alt="portfolio woocommerce" class="img-responsive animated" data-animation="zoomIn" data-animation-delay="400">
                            </div>
                    
                            <div class="portfolio-item col-md-3 col-sm-3 col-xs-3 html wordpress">
                               <a href="{{ asset('images') }}/761579692247.jpg" class="magnific-popup">
                                    <span class="glyphicon glyphicon-search hover-bounce-out"></span>
                                </a>
                                <img src="{{ asset('images') }}/761579692247.jpg" alt="portfolio woocommerce" class="img-responsive animated" data-animation="zoomIn" data-animation-delay="400">
                            </div>
                            
       
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>    
           
              
             
        
      @endsection