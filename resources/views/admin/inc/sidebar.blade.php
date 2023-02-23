<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.index') }}">
                    <i class="material-icons">account_circle</i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->id == 1)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('basic-info-manage') ? 'active' : '' }}"
                        href="{{ route('admin.basic-info-manage') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Basic Info Manage</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ Request::is('news-manage') ? 'active' : '' }}"
                        href="{{ route('admin.product-manage') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Our Products</span>
                    </a>
                </li>
                <!--
            <li class="nav-item">
                <a class="nav-link {{ Request::is('home-product-manage') ? 'active' : '' }}" href="{{ route('admin.home-product-manage') }}">
                    <i class="material-icons">account_circle</i>
                    <span>Home Manage</span>
                </a>
            </li> -->

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('content-manage') ? 'active' : '' }}"
                        href="{{ route('admin.slide-manage') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Content Manage</span>
                    </a>
                </li>
                <!--
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/content-manage') ? 'active' : '' }}" href="{{ route('admin.fund_add') }}">
                    <i class="material-icons">account_circle</i>
                    <span>slide Manage</span>
                </a>
            </li> -->

                <!--    -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/category-add') ? 'active' : '' }}"
                        href="{{ route('admin.agent_add') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Social Icon Manage</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/newsletter') ? 'active' : '' }}"
                        href="{{ route('admin.member_activation') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Newsletter</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin.registration') ? 'active' : '' }}"
                        href="{{ route('admin.registration') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Registration</span>
                    </a>
                </li> --}}

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="true">
                        <i class="material-icons"></i>
                        <span>Registration</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small " x-placement="bottom-start">
                        <a class="dropdown-item " href="{{ route('admin.applicant.index') }}">Students</a>
                        <a class="dropdown-item " href="{{ route('admin.patient.index') }}">Patients</a>
                    </div>
                </li>

                <li class="nav-item {{ Request::is('admin/payment-approve') ? 'active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/payment-approve') ? 'active' : '' }} "
                        href="{{ url('admin/payment-approve') }}">
                        <i class="material-icons">view_module</i>
                        <span>Yearly Fund Approval</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('all-manage2') ? 'active' : '' }}"
                        href="{{ route('admin.menu-manage2') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Requested Payment Approval</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('menu-manage') ? 'active' : '' }}"
                        href="{{ route('admin.logout') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Log Out</span>
                    </a>
                </li>                
            @else
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="true">
                        <i class="material-icons"></i>
                        <span>Applicant List</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small " x-placement="bottom-start">
                        <a class="dropdown-item " href="{{ route('admin.applicant.index') }}">Students</a>
                        <a class="dropdown-item " href="{{ route('admin.patient.index') }}">Patients</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/agent-wallet-withdraw') ? 'active' : '' }} "
                        href="{{ route('admin.agent-wallet-transfer') }}">
                        <i class="material-icons">view_module</i>
                        <span>Yearly Fund Request</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('all-manage') ? 'active' : '' }}"
                        href="{{ route('admin.menu-manage') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Approved Fund Installment Requetion</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}">
                        <i class="material-icons">repeat</i>
                        <span>Log Out</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
