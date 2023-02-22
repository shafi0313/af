@extends('member.layout.app')

@section('content')

        @include('member.inc.sidebar')

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
              
   <div class="row" style="margin:10px;">
    <div class="col-md-6">  
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Earning Report</h6>
            </div>          
      <div class="card-body">
        <div class="table-responsive">              
          <table class="table table-striped table-hover table-bordered" style="width:100%">
            <thead>
              <tr>
                <td align="left">Details</td>
                <td align="center">Income </td>
                <td align="center">Withdraw </td>
              </tr>
            </thead>
            <tbody>
            
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="#">Referral Earning</a></td>
              <td style="color:#001100;" width="10%" align="center">${{ number_format( $ref_earninggg = $ref_distr/2,2) }}</td>           
              <td style="color:#001100;" width="10%" align="center">-</td>                  
            </tr> 
              
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a  href="#">Downlink Income</a></td>
              <td style="color:#001100;" width="10%" align="center">${{ number_format( $downline_amnt_disttt = $downline_amnt_dist/2,2) }}</td>                    
              <td style="color:#001100;" width="10%" align="center">-</td>                  
            </tr> 
              
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a  href="#">Rank Reward</a></td>
              <td style="color:#001100;" width="10%" align="center">${{ number_format( $renk_rewarddd = $renk_reward/2,2)}}</td>         
              <td style="color:#001100;" width="10%" align="center">-</td>                  
            </tr>         

            <tr>
              <td style="color:#001100;" width="80%" align="left"><a  href="#">Transfer to user</a></td>
              <td style="color:#001100;" width="10%" align="center">-</td>                    
              <td style="color:#001100;" width="10%" align="center">${{ number_format($wallet_transferrrr = $wallet_transfer,2)}}</td>  
            </tr>
                        
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="#">Withdraw to admin</a> </td>
              <td style="color:#001100;" width="10%" align="center">-</td>                    
              <td style="color:#001100;" width="10%" align="center">${{ number_format($withdrawwwww = $withdraw,2)}}</td>                
            </tr>            
                     
            <tr>
              <td style="color:#001100;" width="80%" align="left">Total</td>
              <td style="color:#001100;" width="10%" align="center">${{ number_format($incom = $ref_earninggg + $downline_amnt_disttt + $renk_rewarddd,2)}}</td>                   
              <td style="color:#001100;" width="10%" align="center">${{ number_format($expense = $wallet_transferrrr + $withdrawwwww,2)}}</td>           
            </tr>
            
            <tr>
              <td style="color:#001100;" width="80%" align="left">Balance</td>
              <td colspan="2" style="color:#001100; font-size:16px; color:#008800;" width="10%" align="center">
              ${{ number_format($incom - $expense,2)}}</td>                     
            </tr>
          </tbody>
        </table>
        
              </div>
            </div>   
          </div>
    </div>
    
    
    
    <div class="col-md-6">  
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Credit Report</h6>
            </div>          
      <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" style="width:100%">
            <thead>
              <tr>
                <td align="left">Details</td>
                <td align="center">In</td>
                <td align="center">Out</td>
              </tr>
            </thead>
            <tbody>
                
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="">Received from Admin</a></td>                         
              <td style="color:#001100;" width="10%" align="center">${{ number_format($from_admin = $balance_from_admin,2)}}</td>  
              <td style="color:#001100;" width="10%" align="center">-</td>                  
            </tr>
            
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="">Received from User</a></td>                           
              <td style="color:#001100;" width="10%" align="center">${{ number_format($from_user = $balance_from_user,2)}}</td>  
              <td style="color:#001100;" width="10%" align="center">-</td>                  
            </tr>
            
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="">Convert from point</a></td>   
              <td style="color:#001100;" width="10%" align="center">${{ number_format($point = 0,2)}}</td>  
              <td style="color:#001100;" width="10%" align="center">-</td>                  
            </tr>
                        
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="">Balance Move Charge</a></td>   
              <td style="color:#001100;" width="10%" align="center">-</td>    
              <td style="color:#001100;" width="10%" align="center">${{ number_format($move_charge = $wallet_move_charge,2)}}</td>     
            </tr> 
          
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="">Balance Transfer Charge</a></td>   
              <td style="color:#001100;" width="10%" align="center">-</td>    
              <td style="color:#001100;" width="10%" align="center">${{ number_format($transfer_charge = $wallet_transfer_charge,2)}}</td>                      
            </tr> 

            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="">Balance withdrawel Charge</a></td>   
              <td style="color:#001100;" width="10%" align="center">-</td>    
              <td style="color:#001100;" width="10%" align="center">${{ number_format($with_charge = $withdraw_charge,2)}}</td>                      
            </tr> 
                     
            <tr>
              <td style="color:#001100;" width="80%" align="left"><a href="">Total</a></td>                       
              <td style="color:#001100;" width="10%" align="center">${{ number_format($incomee = $from_admin + $from_user,2)}}</td>
              <td style="color:#001100;" width="10%" align="center">${{ number_format($expenxe = $move_charge + $transfer_charge + $with_charge,2)}}</td>                      
            </tr>   
            
            <tr>
              <td style="color:#001100;" width="80%" align="left">Balance</td>
              <td colspan="2" style="color:#001100; font-size:16px; color:#008800;" width="10%" align="center">
              ${{ number_format($withdrawwwww = $incomee - $expenxe,2)}}</td>                      
            </tr>         
          </tbody>
        </table>
              </div>
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