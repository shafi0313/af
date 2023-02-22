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
              <h2 class="title text-white">{{ $name }}</h2>
              <ol class="breadcrumb asdfg white mt-10">
                <li><a class="active text-theme-colored" href="{{ route('/') }}">Home</a></li>

                <li class="active text-theme-colored">{{ $name }}</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>  
    <section>
      <div class="container">             
              <section>
                <div>
                  <div class="section-content">
                    <div class="row" align="center">                      
                    @foreach($niyog as $v)    
                    <h3 align="text-center" align="center">{{ $v->title }}</h3>                 
                        <img alt="project" src="{{ asset('images/'.$v->image) }}" class="img-fullwidth">
                    @endforeach
                 
                </div>
              </section>

            <div class="clearfix"></div>
            <p class="detailss" align="justify"></p>
            <div class="separator separator-rouned">
              <i class="fa fa-cog fa-spin"></i>
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
        