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
                        <h3 class="page-title">Summary Report  </h3>
                    </div>
                </div>
              
                      <div class="row">
              <div class="col">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                
                  </div>
                  <div class="card-body p-0 pb-3 text-left">
                    <table class="table mb-0">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">In</th>
                          <th scope="col" class="border-0">Amount</th>
                          <th scope="col" class="border-0">Out</th>
                          <th scope="col" class="border-0">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Wallet move Charge</td>
                          <td>${{ number_format($in_one =  $wallet_move, 2)}}</td>
                          <td>Referral Commission</td>
                          <td>$ {{ number_format($out_one = $ref_distr, 2)}}</td>
                        </tr>
                        <tr>
                          <td>Withdraw amount Charge</td>
                          <td>${{ number_format($in_two = $withdraw, 2) }}</td>
                          <td>Downlink Commission</td>
                          <td>${{ number_format($out_two = $downline_amnt_dist, 2) }}</td>
                         
                        </tr>                   
                        <tr>
                          <td>Wallet Transfer Charge</td>
                          <td>${{ number_format($in_three = $wallet_transfer, 2)}}</td>
                          <td>Rankreward Commission</td>
                          <td>${{ number_format($out_three = $renk_reward, 2) }}</td>
                        </tr>
                      

                        <tr>
                          <td>Active by User</td>
                          <td>${{ number_format($in_six = $user_active, 2) }}</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>

                        <tr>
                          <td>Active by admin</td>
                          <td>${{ number_format($in_five = $admin_active, 2) }}</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        
                        <tr>
                          <td>Overflow Amount</td>
                          <td>${{ number_format($in_four = $renk_reward, 2) }}</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>

                        <tr>
                          <td><span style="font-weight: 800">Total</span></td>
                          <td><span style="font-weight: 800">$ {{ number_format($income = $in_one + $in_two + $in_three + $in_four + $in_five + $in_six,2)}}</span></td>
                          <td><span style="font-weight: 800">Total</span></td>
                          <td><span style="font-weight: 800">${{ number_format($expense = $out_one + $out_two + $out_three,2)}}</span></td>                          
                        </tr>                  
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

     
              
                
            </div>
            <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>                  
                </ul>
                <span class="copyright ml-auto my-auto mr-2">Copyright <?php echo date('Y');?>
              <a href="https://designrevision.com" rel="nofollow">Donate Thy Self</a>
            </span>
            </footer>
        </main>


@endsection