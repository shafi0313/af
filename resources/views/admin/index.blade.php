@extends('admin.layout.app')

@section('content')

        @include('admin.inc.sidebar')

        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <!-- / .main-navbar -->
            <div class="main-content-container container-fluid px-4">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Dashboard</span>
                        <h3 class="page-title">Admin Dashboard Overview
                           <!--  <small style="color: blue; font-weight: 700"> 
                                <a target="_blank" href="{{ route('summary') }}"> Summery Report </a>
                            </small>  -->
                        </h3>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Small Stats Blocks -->
                <style type="text/css">
                    .font_color{
                       color: black;
                    }
                </style>
                Welcome To admin panel            

               
            </div>
            <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('/') }}">Back to website</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>                  
                </ul>
                <span class="copyright ml-auto my-auto mr-2">Copyright {{ date('Y') }}
              <a href="https://designrevision.com" rel="nofollow">{{ $basic_info->website_title }}</a>
            </span>
            </footer>
        </main>


@endsection