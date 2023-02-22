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
                                Medicine Benefit
                            </h1>                           
                            <h4 class="brand-heading font-montserrat text-uppercase color-light alpha5" data-in-effect="fadeInDown"></h4>                           
                        </div>
                    </div>                    
                </div>                
            </div>
        </div>
                
        
        <div class="container">
              <div style="text-align:center">
                <div class="row pt50 pb50">
                    <div class="col-md-12">
                        <h4 class="text-center">
                           Anti Aging Supplement with eye care
                            <small class="heading heading-solid center-block"></small>
                        </h4>
                    </div>
                </div>
                <iframe src="https://docs.google.com/viewer?url={{ asset('pdf/') }}/pdf_one (4).pdf&embedded=true" frameborder="0" height="500px" width="100%"></iframe>
            </div>
        </div>

       <div class="container">
            <div style="text-align:center">
                <div class="row pt50 pb50">
                    <div class="col-md-12">
                        <h4 class="text-center">
                             Men Health Ultimate Protein
                            <small class="heading heading-solid center-block"></small>
                        </h4>
                    </div>
                </div>
                <iframe src="https://docs.google.com/viewer?url={{ asset('pdf/') }}/pdf_one (3).pdf&embedded=true" frameborder="0" height="500px" width="100%">                    
                </iframe>
            </div>
        </div>

        <div class="container">
            <div style="text-align:center">
                <div class="row pt50 pb50">
                    <div class="col-md-12">
                        <h4 class="text-center">
                             Ultimate savior for Eye Care
                            <small class="heading heading-solid center-block"></small>
                        </h4>
                    </div>
                </div>
                <iframe src="https://docs.google.com/viewer?url={{ asset('pdf/') }}/pdf_one (2).pdf&embedded=true" frameborder="0" height="500px" width="100%">                    
                </iframe>
            </div>
        </div>

        <div class="container">
            <div style="text-align:center">
                <div class="row pt50 pb50">
                    <div class="col-md-12">
                        <h4 class="text-center">
                            ORDY MINERAL Benefits
                            <small class="heading heading-solid center-block"></small>
                        </h4>
                    </div>
                </div>
                <iframe src="https://docs.google.com/viewer?url={{ asset('pdf/') }}/pdf_one (1).pdf&embedded=true" frameborder="0" height="500px" width="100%">                    
                </iframe>
            </div>
        </div>
              
             
        
      @endsection