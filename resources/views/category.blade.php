@extends('asset')
@section('content')
    <body>
    <!-- search modal -->
    <div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="widget widget_search">
            <form method="get" class="searchform search-form" action="#">
                <div class="form-group">
                    <input type="text" value="" name="search" class="form-control" placeholder="Search keyword" id="modal-search-input">
                </div>
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
    </div>

    <!-- Unyson messages modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
        <div class="fw-messages-wrap ls p-normal">
        </div>
    </div>
    <div id="canvas">
        <div id="box_wrapper">

            <section class="page_topline ds ms s-borderbottom c-my-10 d-lg-none">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-8 text-left">
                            <span class="social-icons">

                                <a href="#" class="fa fa-facebook " title="facebook"></a>
                                <a href="#" class="fa fa-twitter " title="twitter"></a>
                                <a href="#" class="fa fa-google " title="google"></a>

                            </span>
                        </div>
                        <div class="col-4 text-right">
                            <!--modal search-->
                            <span>
                                <a href="#" class="search_modal_button">
                                    <i class="fa fa-search"></i>
                                </a>
                            </span>

                        </div>
                    </div>
                </div>
            </section>
            <!--eof topline-->
           
            @include('header_menu') 
            <section class="page_title ds s-parallax s-overlay s-py-5">
                <div class="container">
                    <div class="row">
                        <div class="divider-45"></div>
                        <div class="col-md-12 text-center">
                            <h1 class="bold">{{ strtoupper($slug) }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">{{ $slug }}</a>
                                </li>                               
                            </ol>
                        </div>
                        <div class="divider-50"></div>
                    </div>
                </div>
            </section>

            <section class="ds s-pt-60 s-pb-30 s-py-md-90 c-gutter-30 c-mb-30 programs">
                <div class="container">
                    <div class="row">
                        <div class="d-none d-lg-block divider-70"></div>
                          @foreach($category as $v)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="vertical-item text-center">
                                    <div class="item-media">
                                        <img width="370" height="230" src="{{ asset('images/'.$v->image ) }}" alt="">
                                        <div class="media-links">
                                            <a class="abs-link" title="" href="{{ url('detail/'.$v->slug.'/'.$v->id) }}"></a>
                                        </div>
                                    </div>
                                    <a href="{{ url('detail/'.$v->slug.'/'.$v->id) }}" class="services-icon">
                                        <i class="fa fa-calendar"></i>
                                    </a>
                                    <div class="item-content">
                                        <h5>
                                            <a href="{{ url('detail/'.$v->slug.'/'.$v->id) }}">{{ $v->title }}</a>
                                        </h5>
                                        <span>{{ $v->created_at }}</span>
                                        <p>
                                           {{ $v->short_details }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                         @endforeach
                        
                        <div class="d-none d-lg-block divider-40"></div>
                    </div>
                </div>
            </section>

              @endsection
        