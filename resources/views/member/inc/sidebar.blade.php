

<style type="text/css">
/*.main-sidebar .nav .nav-item.active, .main-sidebar .nav .nav-item .main-sidebar .nav .nav-item:hover, .main-sidebar .nav .nav-item {
    box-shadow: inset 0.1875rem 0 0 
#007bff;
background-color:
#4EC6C2;
color:
    #060606;
}

.main-sidebar .nav .nav-item .nav-link {
    border-bottom: 1px solid 
#e1e5eb;
font-weight: 400;
background-color: #4EC6C2;
color:
    #3D5170;
    padding: 0.9375rem 1.5625rem;
}
*/
</style>



<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">

    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/dashboard') ? 'active' : '' }}" href="{{ url('member/dashboard') }}">
                    <i class="material-icons">account_circle</i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/registration') ? 'active' : '' }}" href="{{ route('member.registration') }}">
                    <i class="material-icons">vertical_split</i>
                    <span>Registration</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/profile') ? 'active' : '' }}" href="{{ route('member.profile') }}">
                    <i class="material-icons">vertical_split</i>
                    <span>Profile Update</span>
                </a>
            </li>
<!-- 
            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/new-member') ? 'active' : '' }}" href="{{route('member.new_member')}}">
                    <i class="material-icons">vertical_split</i>
                    <span>Active New Member</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/refferd-member') ? 'active' : '' }}" href="{{route('member.refferd_member')}}">
                    <i class="material-icons">note_add</i>
                    <span>Referred Member</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/generation-level') ? 'active' : '' }}" href="{{route('member.generation-level')}}">
                    <i class="material-icons">note_add</i>
                    <span>Generation Level</span>
                </a>
            </li>

          <!--  <li class="nav-item">
                <a class="nav-link {{ Request::is('member/downlink-user-list') ? 'active' : '' }}" href="{{route('member.downlink-user-list')}}">
                    <i class="material-icons">note_add</i>
                    <span>Downlink Member</span>
                </a>
            </li> -->

            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/placement-tree') ? 'active' : '' }}
                 {{ Request::is('member/tree-user-search') ? 'active' : '' }}" href="{{route('member.placement-tree')}}">
                    <i class="material-icons">note_add</i>
                    <span>My Tree</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/e-wallet-withdrawel') ? 'active' : '' }}" href="{{route('member.balance-withdrawel')}}">
                    <i class="material-icons">note_add</i>
                    <span>Withdrawel</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/wallet-transfer') ? 'active' : '' }}" href="{{route('member.wallet-transfer')}}">
                    <i class="material-icons">view_module</i>
                    <span>Wallet Transfer</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/flexiload') ? 'active' : '' }}" href="{{route('member.flexiload')}}">
                    <i class="material-icons">view_module</i>
                    <span>Flexiload</span>
                </a>
            </li>
    <!--         <li class="nav-item">
                <a class="nav-link {{ Request::is('member/wallet-convert') ? 'active' : '' }}" href="{{route('member.main-wallet-move')}}">
                    <i class="material-icons">table_chart</i>
                    <span>Wallet Convert</span>
                </a>
            </li>       
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('member/point-convert') ? 'active' : '' }}" href="{{route('member.point-convert')}}">
                    <i class="material-icons">table_chart</i>
                    <span>Point Convert</span>
                </a>
            </li> -->         
           
             <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle
                 {{ Request::is('member/referral-income-report') ? 'active' : '' }}
                 {{ Request::is('member/rank-reward-report') ? 'active' : '' }}
                 {{ Request::is('member/direct-downlink-income-report') ? 'active' : '' }}
                 {{ Request::is('member/balance-receive-report') ? 'active' : '' }}
                 {{ Request::is('member/user-balance-receive-report') ? 'active' : '' }}
                 {{ Request::is('member/generation-income-report') ? 'active' : '' }}
                 {{ Request::is('member/rollup-income-report') ? 'active' : '' }}
                " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <i class="material-icons">pie_chart</i>
                  <span>Reports</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small " style="display:
                {{ Request::is('member/referral-income-report') ? 'block' : '' }}
                {{ Request::is('member/rank-reward-report') ? 'block' : '' }}
                {{ Request::is('member/key-in-bonus') ? 'block' : '' }}
                {{ Request::is('member/balance-receive-report') ? 'block' : '' }}
                {{ Request::is('member/user-balance-receive-report') ? 'block' : '' }}
                {{ Request::is('member/profit-share-return-report') ? 'block' : '' }}
                {{ Request::is('member/generation-income-report') ? 'block' : '' }}
                {{ Request::is('member/rollup-income-report') ? 'block' : '' }}

                ; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-6px, 52px, 0px);" x-placement="bottom-start"> 
                       <a class="nav-link {{ Request::is('member/user-balance-receive-report') ? 'active' : '' }} " href="{{route('member.user-balance-receive-report')}}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>User Balance Received</span>
                       </a>  

                       <a class="nav-link {{ Request::is('member/balance-receive-report') ? 'active' : '' }} " href="{{route('member.balance-receive-report')}}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Admin Balance Received</span>
                       </a>  
                       <a class="nav-link {{ Request::is('member/referral-income-report') ? 'active' : '' }} " href="{{route('member.referral-income-report')}}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Refferel Income</span>
                       </a>

                 

                       <a class="nav-link {{ Request::is('member/generation-income-report') ? 'active' : '' }} " href="{{route('member.generation-income-report')}}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Generation Income</span>
                       </a>  

                 

                       <a class="nav-link {{ Request::is('member/rank-reward-report') ? 'active' : '' }} " href="{{route('member.rank-reward-report')}}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Rank Reward Income</span>
                       </a>

                  <!--      <a class="nav-link {{ Request::is('member/profit-share-return-report') ? 'active' : '' }} " href="{{route('member.profit-share-return-report')}}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Profit Share Income</span>
                       </a>       -->

                       <a class="nav-link {{ Request::is('member/matching-income-report') ? 'active' : '' }} " href="{{route('member.matching-income-report')}}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Matching Income</span>
                       </a>  

                     <!--  <a class="nav-link {{ Request::is('member/rank-report') ? 'active' : '' }} " href="{{route('member.rank-report')}}">
                            <i class="material-icons">insert_chart_outlined</i>
                            <span>Rank Report</span>
                      </a>    -->             

                </div>
              </li>

               <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}">
                    <i class="material-icons">repeat</i>
                    <span>Logout</span>
                </a>
            </li>          
    
        </ul>
    </div>
</aside>
