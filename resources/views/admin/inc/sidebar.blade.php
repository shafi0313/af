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
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin.registration') ? 'active' : '' }}"
                        href="{{ route('admin.registration') }}">
                        <i class="material-icons">account_circle</i>
                        <span>Registration</span>
                    </a>
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


                <!--
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/all-user-list') ? 'active' : '' }} " href="{{ route('admin.all-user-list') }}">
                    <i class="material-icons">face</i>
                    <span>All Member</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/withdraw-wallet-aprrove') ? 'active' : '' }} " href="{{ route('admin.withdraw-wallet-aprrove') }}">
                    <i class="material-icons">view_module</i>
                    <span>Withdraw Approve</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/wallet-move-approve') ? 'active' : '' }}" href="{{ route('admin.wallet-move-approve') }}">
                    <i class="material-icons">table_chart</i>
                    <span>Wallet Move Approve</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/amount-distribution') ? 'active' : '' }}" href="{{ route('admin.amount-distribution') }}">
                    <i class="material-icons">table_chart</i>
                    <span>Profit Amount Distribution</span>
                </a>
            </li>

         <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/agent-wallet-withdraw-all') ? 'active' : '' }} "
                href="{{ route('admin.agent-wallet-transfer-all') }}">
                    <i class="material-icons">view_module</i>
                    <span>Agent Wallet Withdraw Report</span>
                </a>
            </li>

            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle
                 {{ Request::is('admin/user-activation-by-admin') ? 'active' : '' }}
                 {{ Request::is('admin/user-rank-reward') ? 'active' : '' }}
                 {{ Request::is('admin/refferral-amount-report') ? 'active' : '' }}
                 {{ Request::is('admin/downlink-amount-distribute') ? 'active' : '' }}
                " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <i class="material-icons">dns</i>
                  <span>Reports</span>
                </a>

                <div class="dropdown-menu dropdown-menu-small " style="display:
                {{ Request::is('admin/user-activation-by-admin') ? 'block' : '' }}
                {{ Request::is('admin/user-rank-reward') ? 'block' : '' }}
                {{ Request::is('admin/downlink-amount-distribute') ? 'block' : '' }}
                {{ Request::is('admin/refferral-amount-report') ? 'block' : '' }}; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-6px, 52px, 0px);" x-placement="bottom-start">
                       <a class="nav-link {{ Request::is('admin/user-activation-by-admin') ? 'active' : '' }} " href="{{ route('admin.user-activation-by-admin') }}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>User Activation by admin</span>
                       </a>
                      
                        <a class="nav-link {{ Request::is('admin/refferral-amount-report') ? 'active' : '' }} " href="{{ route('admin.refferral-amount-report') }}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Referrel Amount Distribute</span>
                       </a>

                       <a class="nav-link {{ Request::is('admin/downlink-amount-distribute') ? 'active' : '' }} " href="{{ route('admin.downlink-amount-distribute') }}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Downlink Amount Distribute</span>
                       </a>

                       <a class="nav-link {{ Request::is('admin/user-rank-reward') ? 'active' : '' }} " href="{{ route('admin.user-rank-reward') }}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Rank Reward</span>
                       </a>
                </div>
              </li>

               <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                    <i class="material-icons">repeat</i>
                    <span>Log Out</span>
                </a>
               </li>
           -->
            @else
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="true">
                        <i class="material-icons"></i>
                        <span>Applicant List</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small " x-placement="bottom-start">
                        <a class="dropdown-item " href="{{ route('admin.applicant.index') }}">Students</a>
                        <a class="dropdown-item " href="user-profile-lite.html">Patients</a>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/applicants') ? 'active' : '' }} "
                        href="{{ route('admin.applicant.index') }}">
                        <i class="material-icons">view_module</i>
                        <span>Applicant List</span>
                    </a>
                </li> --}}

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
