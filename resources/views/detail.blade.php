@extends('asset')
@section('content')

@section('styles')
<!-- Favicon and Touch Icons -->
<link href="images/favicon.png" rel="shortcut icon" type="image/png">
<link href="images/apple-touch-icon.png" rel="apple-touch-icon">
<link href="images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

<!-- Stylesheet -->
<link href="{{ asset('front_end') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('front_end') }}/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('front_end') }}/css/animate.css" rel="stylesheet" type="text/css">
<link href="{{ asset('front_end') }}/css/css-plugin-collections.css" rel="stylesheet"/>
<!-- CSS | menuzord megamenu skins -->
<link id="menuzord-menu-skins" href="{{ asset('front_end') }}/css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
<!-- CSS | Main style file -->
<link href="{{ asset('front_end') }}/css/style-main.css" rel="stylesheet" type="text/css">
<!-- CSS | Preloader Styles -->
<link href="{{ asset('front_end') }}/css/preloader.css" rel="stylesheet" type="text/css">
<!-- CSS | Custom Margin Padding Collection -->
<link href="{{ asset('front_end') }}/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<!-- CSS | Responsive media queries -->
<link href="{{ asset('front_end') }}/css/responsive.css" rel="stylesheet" type="text/css">

<link href="{{ asset('front_end') }}/css/colors/theme-skin-blue.css" rel="stylesheet" type="text/css">
<!-- external javascripts -->
<script src="{{ asset('front_end') }}/js/jquery-2.2.4.min.js"></script>
<script src="{{ asset('front_end') }}/js/jquery-ui.min.js"></script>
<script src="{{ asset('front_end') }}/js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="{{ asset('front_end') }}/js/jquery-plugin-collection.js"></script>

@endsection

<div class="main-content"> 
    <section class="inner-header divider parallax layer-overlay overlay-dark-6" data-bg-img="{{ asset('front_end') }}/images/bg/bg5.jpg?{{ time() }}">
      <div class="container pt-60 pb-60">      
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title text-white">{{  $slide_detils->title }}</h2>
              <ol class="breadcrumb asdfg white mt-10">
                <li><a class="active text-theme-colored" href="{{ route('/') }}">Home</a></li>
                <li><a class="active text-theme-colored" href="#">{{ $name }}</a></li>
                <li class="active text-theme-colored">{{  $slide_detils->title }}</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>  
    <section>
      <div class="container">  
        <small>Date : {{ date('h:i:s a m/d/Y', strtotime($slide_detils->created_at) ) }}</small>
        <div class="row">

          <div class="col-md-12">
            <style type="text/css">

             .detailss {
                  border-top: solid 1px #000 !important;  
                  border-bottom: solid 1px #000 !important;  
                  text-align: justify !important;
                  text-justify: inter-word !important;
                  font-size: 50px;
                }

                img {
                  float: left;
                  display: inline-block;
                  padding-right: 10px;
                  padding-top: 10px;
                }
            </style>
          <img  class="capimg" style="max-height: 300px;" class="pull-left flip mr-15 thumbnail" src="{{ asset('images/'.$slide_detils->image) }}" alt="">
           <p class="detailss" align="justify" >             
                 @php echo $slide_detils->long_details  @endphp
            </p>
          
            <div class="clearfix"></div>
            <p class="detailss" align="justify" >   
            </p>
            <div class="separator separator-rouned">
              <i class="fa fa-cog fa-spin"></i>
            </div>
       
   
        
          </div>
        </div>
      </div>
    </section>
    
    
    <section>
      <div class="container-fluid pb-0">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
            
              <!-- Portfolio Gallery Grid -->
              <div id="grid" class="gallery-isotope grid-4 gutter clearfix" style="position: relative; height: 903.327px;">
                @foreach($news_man_list as $v)
                <!-- Portfolio Item Start -->
                <div class="gallery-item photography" style="position: absolute; left: 0px; top: 0px;">
                  <div class="thumb">
                    <img class="img-fullwidth" src="{{ asset('images/'.$v->image) }}" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a data-lightbox="image" href="{{ asset('images/'.$v->image) }}"><i class="fa fa-plus"></i></a>
                          <a href="{{ url('news-details/'.$v->id) }}"><i class="fa fa-link"></i></a>
                        </div>
                      </div>
                    </div>
                    <a class="hover-link" data-lightbox="image" href="{{ url('news-details/'.$v->id) }}">View more</a>
                  </div>
                  <h5 class="text-center mt-15 mb-40">{{  $slide_detils->title }}</h5>
                </div>
                <!-- Portfolio Item End -->
                @endforeach
            
            
              </div>
              <!-- End Portfolio Gallery Grid -->
                          
            </div>
          </div>
        </div>
      </div>
    </section>
    
    
    
    
  </div>
  @section('scripts')
      <script src="{{ asset('front_end') }}/js/custom.js"></script>
  @endsection
@endsection
        