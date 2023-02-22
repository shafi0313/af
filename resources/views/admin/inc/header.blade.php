<main class="main-content col-12 p-0 sticky-top">
    <div class="main-navbar sticky-top bg-white">
        <!-- Main Navbar -->
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
            <a class="navbar-brand mr-0 d-sm-none d-md-block d-none d-sm-block" href="{{ url('admin/dashboard') }}"
                style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-height: 50px;"
                        src="{{ asset('images/' . $basic_info->logo) }}" alt="{{ $basic_info->website_title }}">
                    <span class="d-none d-md-inline ml-1"></span>
                </div>
            </a>

            <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">

                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <p class="microsoft marquee">
                                {{ $basic_info->notice }}
                            </p>
                        </div>
                    </div>
                </div>

                <style type="text/css">
                    .marquee {
                        width: 450px;
                        margin: 0 auto;
                        color: black;
                        overflow: hidden;
                        white-space: nowrap;
                        box-sizing: border-box;
                        animation: marquee 20s linear infinite;
                    }

                    .marquee:hover {
                        animation-play-state: paused
                    }


                    @keyframes marquee {
                        0% {
                            text-indent: 30em
                        }

                        100% {
                            text-indent: -105em
                        }
                    }


                    .microsoft {
                        padding-left: 1.5em;
                        position: relative;
                        font: 16px 'Segoe UI', Tahoma, Helvetica, Sans-Serif;
                    }
                </style>

            </form>
            <ul class="navbar-nav border-left flex-row ">

                <li class="nav-item border-right dropdown notifications d-none d-sm-block d-md-none d-block ">
                    <a class="nav-link nav-link-icon text-center" href="{{ url('admin/dashboard') }}">
                        <div class="nav-link-icon__wrapper">
                            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 80px;"
                                src="{{ asset('images/' . $basic_info->logo) }}" alt="{{ $basic_info->website_title }}">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <img id="main-logo" class="d-inline-block align-top mr-1" style="max-height: 50px;"
                            src="{{ asset('images/admin.png') }}" alt="{{ $basic_info->website_title }}">
                    </a>
                    <div class="dropdown-menu dropdown-menu-small">
                        <a class="dropdown-item" href="{{ url('admin/profile') }}">
                            <i class="material-icons">&#xE7FD;</i> Profile</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                            <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                    </div>
                </li>
            </ul>
            <nav class="nav">
                <a href="#"
                    class="nav-link nav-link-icon toggle-sidebar d-sm-inline d-md-none text-center border-left"
                    data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                    aria-controls="header-navbar">
                    <i class="material-icons"></i>
                </a>
            </nav>
        </nav>
    </div>
</main>
