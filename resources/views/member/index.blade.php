@extends('member.layout.app')

@section('content')

        @include('member.inc.sidebar')

        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <!-- / .main-navbar -->
            <div class="main-content-container container-fluid px-4">
                <!-- Page Header -->
                <div class="page-header row no-gutters py-4">
                    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                        <span class="text-uppercase page-subtitle">Dashboard</span>
                        <h3 class="page-title">Dashboard Overview </h3>
                    </div>
                     <div class="col-12 col-sm-8 text-center text-sm-left mb-0" style="padding-top: 20px;">               
                    <!--   @if(empty($member_details->active_date))
                       <span style="font-size: 20px; padding-top: 20px; color: red;">
                         Donation BTC Wallet:  
                       </span>  
                        <input type="" name="" value="{{ $basic_info->btc_wallet }}" id="copy-text" readonly>                      
                        <span id="copy_text" style="color: green;"></span>
                        <span style="font-size: 20px; padding-top: 20px; color: red;">
                           Amount:  
                       </span>  
                        <input id="copy-text-2" type="" name="" value="{{ $member_details->btc_amount }}" readonly="readonly">
                        <span id="copy_text_2" style="color: green;"></span>
                        @endif -->
                    </div>
                        <h5 style="color: blue; font-weight: 700"> 
                           <!--  <a target="_blank" href="{{ route('member.summary') }}">View Summary Report →</a> -->
                        </h5> 
                </div>                
                <style type="text/css">
                    .font_color{
                       color: black;
                    }
                    .modal-body {                       
                        padding: 0px;
                    }
                </style>
                <script type="text/javascript">                   
                    document.getElementById("copy-text").onclick = function() {
                      this.select();
                      document.execCommand('copy');
                      $('#copy_text').text('Wallet copied');
                      $('#copy_text_2').text('');
                    } 

                    document.getElementById("copy-text-2").onclick = function() {
                      this.select();
                      document.execCommand('copy');
                      $('#copy_text_2').text('Amount copied');
                      $('#copy_text').text('');
                    }
                     $(document).ready(function(){    
                        $("#add-new-event").trigger('click');
                        //alert('ok');
                    });
                </script>

         <a id="add-new-event" style="display: none;" role="button" href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"></a>          

                <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">                
                            <div class="modal-body">
                               <img class="img-fluid" src="{{asset('images/'. $basic_info->promo_image )}}">
                            </div>                 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg col-md-6 col-sm-6 mb-4">
                        <div class="stats-small stats-small--1 card card-small" style="background: rgb(224,176,135);
background: -moz-linear-gradient(180deg, rgba(224,176,135,1) 0%, rgba(236,217,201,1) 100%);
background: -webkit-linear-gradient(180deg, rgba(224,176,135,1) 0%, rgba(236,217,201,1) 100%);
background: linear-gradient(180deg, rgba(224,176,135,1) 0%, rgba(236,217,201,1) 100%);">
                            <div class="card-body p-0 d-flex">
                                <div class="d-flex flex-column m-auto">
                                    <div class="stats-small__data text-center">
                                        <span class="stats-small__label text-uppercase font_color">Wallet</span>
                                        <h6 class="stats-small__value count my-3" style="font-size: 20px;">
                                            {{ $basic_info->currency }}
                                         {{ number_format($member_details->e_wallet,2) }}</h6>
                                    </div>
                                    <div class="stats-small__data">
                                       
                                    </div>
                                </div>
                                <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-md-6 col-sm-6 mb-4">
                        <div class="stats-small stats-small--1 card card-small" style="background: rgb(135,174,224);
background: -moz-linear-gradient(180deg, rgba(135,174,224,1) 0%, rgba(163,185,213,1) 100%);
background: -webkit-linear-gradient(180deg, rgba(135,174,224,1) 0%, rgba(163,185,213,1) 100%);
background: linear-gradient(180deg, rgba(135,174,224,1) 0%, rgba(163,185,213,1) 100%);">
                            <div class="card-body p-0 d-flex">
                                <div class="d-flex flex-column m-auto">
                                    <div class="stats-small__data text-center">
                                        <span class="stats-small__label text-uppercase font_color">Referrel Income</span>
                                        <h6 class="stats-small__value count my-3" style="font-size: 20px;"> {{ $basic_info->currency }} 
                                        {{ number_format($total_reff_income,2) }}</h6>
                                    </div>
                                    <div class="stats-small__data">
                                        
                                    </div>
                                </div>
                                <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                            </div>
                        </div>
                    </div>

                   <div class="col-lg col-md-4 col-sm-6 mb-4">
                        <div class="stats-small stats-small--1 card card-small" style="background: rgb(86,207,101);
background: -moz-linear-gradient(180deg, rgba(86,207,101,1) 0%, rgba(184,233,110,1) 100%);
background: -webkit-linear-gradient(180deg, rgba(86,207,101,1) 0%, rgba(184,233,110,1) 100%);
background: linear-gradient(180deg, rgba(86,207,101,1) 0%, rgba(184,233,110,1) 100%);">
                            <div class="card-body p-0 d-flex">
                                <div class="d-flex flex-column m-auto">
                                    <div class="stats-small__data text-center">
                                        <span class="stats-small__label text-uppercase font_color">Generation Income</span>
                                        <h6 class="stats-small__value count my-3" style="font-size: 20px;">
                                             {{ $basic_info->currency }}  {{ number_format($gen_income,2) }}
                                         </h6>
                                    </div>
                                    <div class="stats-small__data">
                                        
                                    </div>
                                </div>
                                <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                            </div>
                        </div>
                    </div>

                   <div class="col-lg col-md-4 col-sm-6 mb-4">
                        <div class="stats-small stats-small--1 card card-small" style="background: rgb(254,149,104);
background: -moz-linear-gradient(180deg, rgba(254,149,104,1) 0%, rgba(254,182,151,1) 100%);
background: -webkit-linear-gradient(180deg, rgba(254,149,104,1) 0%, rgba(254,182,151,1) 100%);
background: linear-gradient(180deg, rgba(254,149,104,1) 0%, rgba(254,182,151,1) 100%);">
                            <div class="card-body p-0 d-flex">
                                <div class="d-flex flex-column m-auto">
                                    <div class="stats-small__data text-center">
                                        <span class="stats-small__label text-uppercase font_color">Total Withdraw</span>
                                        <h6 class="stats-small__value count my-3" style="font-size: 20px; ">  {{ $basic_info->currency }} 
                                            {{ number_format($total_with_sum,2) }}
                                       </h6>
                                    </div>
                                    <div class="stats-small__data">
                                       
                                    </div>
                                </div>
                                <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                            </div>
                        </div>
                    </div>            

                    <div class="col-lg col-md-4 col-sm-12 mb-4">
                        <div class="stats-small stats-small--1 card card-small"  style="background: linear-gradient(180deg, rgba(201,77,163,1) 8%, rgba(191,44,99,1) 85%);">
                            <div class="card-body p-0 d-flex">
                                 <div class="d-flex flex-column m-auto">
                                    <div class="stats-small__data text-center">
                                        <span class="stats-small__label text-uppercase font_color">Total Transfer</span>
                                        <h6 class="stats-small__value count my-3" style="font-size: 20px;">  
                                         {{ $basic_info->currency }}   {{ number_format($total_sum,2) }}</h6>
                                    </div>
                                    <div class="stats-small__data">                                       
                                    </div>
                                </div>
                                <canvas height="120" class="blog-overview-stats-small-5"></canvas>
                            </div>
                        </div>
                    </div>   

        
                    
                   

                </div>

                    
                
                <!-- End Small Stats Blocks -->          
            </div>
            <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
              <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('/') }}">Back to website</a>
                    </li>
                  <!--   <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li> -->
                </ul>
                <span class="copyright ml-auto my-auto mr-2">Copyright © {{ date('Y') }}
              <a href="#" rel="nofollow">{{ $basic_info->website_title }}</a>
            </span>
            </footer>
        </main>

    <div align="center" class="loading" id="loader" style="display:none;">
       <img src="{{ asset('loading.gif') }}" height="200"/>
    </div>     


   <style>
    .loading {                                                                         
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);     
      z-index:1000000000;                 
    }       
  </style>
  
<div class="modal fade bd-example-modal-lg " id="exampleModal_2">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document ">
            <div class="modal-content">
               
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

            <div class="row">
              <div class="col-sm-12 col-lg-2">
                <!-- User Details Card -->                      
              </div>
            
             <div class="col-lg-8">
                <div class="">
                  <div class="card-header border-bottom">
                    <h5 class="m-0 text-center">Update Your Package</h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                          <form method="post" id="upload_form" enctype="multipart/form-data">
                             @csrf                                   
                            <div class="form-row">                  
                             <div class="form-group col-md-6">
                                <label for="fePassword">Package</label>
                                 <select name="package" id="package" class="form-control" required="">
                                    <option value="">Select Package</option>                                   
                                    @foreach($products as $v)
                                      @if($v->id > $member_details->package)
                                    <option value="{{ $v->id }}">{{ $v->product_name }} @ ${{ $v->price }} @ {{ $v->delivery_quantity }} Pcs</option>
                                      @endif
                                    @endforeach                                                         
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fePassword">Payment</label>
                                 <select name="payment" id="payment" class="form-control" required="">
                                    <option value="">Select Payment</option>
                                     <option value="first">S-Wallet (100%)</option>     
                                     <option value="second">S-Wallet (50%) + R-Wallet (25%) + PS-Wallet (25%)</option>
                                 </select>
                                  <span class="messege3" style="color: green;"></span>
                              </div>
                            </div>  

                           <div class="form-row"> 
                              <div class="form-group col-md-6">
                                  <label class="radio-inline">
                                    <input type="radio" name="pro_yes_no" id="pro_yes" value="1" required="required"> Product Yes
                                  </label>
                              </div> 
                             <div class="form-group col-md-6">
                                  <label class="radio-inline">
                                    <input type="radio" name="pro_yes_no" id="pro_no" value="2" required="required"> Product No
                                  </label>
                              </div> 
                          </div>
                           
                           <div class="form-row"> 
                              <div class="form-group col-md-3">
                              Ordy Ivsion
                             <input type="text" class="form-control" name="ordy_ivsion" id="ordy_ivsion" placeholder="Enter Quantity" required="required" value="">
                              </div>  <div class="form-group col-md-3">
                              Ordy Ten
                             <input type="text" class="form-control" name="ordy_ten" id="ordy_ten" placeholder="Enter Quantity" required="required" value="">
                              </div>  <div class="form-group col-md-3">
                              Ordy Mineral
                             <input type="text" class="form-control" name="ordy_mineral" id="ordy_mineral" placeholder="Enter Quantity" required="required" value="">
                              </div>  <div class="form-group col-md-3">
                              Ordy Combe  <input type="text" class="form-control" name="ordy_combe" id="ordy_combe" placeholder="Enter Quantity" required="required" value="">                         
                              </div>
                            </div>

                             <button type="submit" class="btn btn-accent btn-block sned">Create Account 
                              <i id="icon_class" class="" style="font-size: 20px;"></i></button>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>                
                </div>
              </div>              
            </div>                    
           </div>              
          </div>
        </div>
      </div>

    <script type="text/javascript">

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $("#pro_no").on('click', function(){           
             $('#ordy_ivsion').prop("disabled",true);
             $('#ordy_ten').prop("disabled",true);
             $('#ordy_mineral').prop("disabled",true);
             $('#ordy_combe').prop("disabled",true);
        });

        $("#pro_yes").on('click', function(){           
             $('#ordy_ivsion').prop("disabled",false);
             $('#ordy_ten').prop("disabled",false);
             $('#ordy_mineral').prop("disabled",false);
             $('#ordy_combe').prop("disabled",false);
        });

        $(document).ready(function() {
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $("#loader").css('display', 'block');  
                $(".sned").prop('disabled', true);                 
                $(this).find('i').toggleClass('fa fa-spinner fa-spin');              
                $.ajax({
                    url: "{{ url('member/member-account-update') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        if(data == 1){
                             $("#loader").css('display', 'none');  
                            Swal.fire(
                                'Success!',
                                'Package has been updated successfully!',
                                'success'
                            )
                             window.location.href = "{{ url('member/dashboard')}}";
                            
                        }else if(data == 2){
                               $("#loader").css('display', 'none');  
                               $(this).find('i').toggleClass('');
                               Swal.fire(
                                'Error!',
                                'This user id is taken please try another',
                                'error'                             
                           )      
                        } else if(data == 3){
                               $("#loader").css('display', 'none');  
                               Swal.fire(
                                'Error!',
                                'This sponser id is wrong please try another',
                                'error'                             
                           )      
                        }else if(data == 4){
                               $("#loader").css('display', 'none');  
                               $(".sned").prop('disabled', false);  
                               jQuery('#icon_class').removeClass('fa fa-spinner fa-spin');
                               Swal.fire(
                                'Error!',
                                'You do not have sufficiant balance',
                                'error'                             
                           )      
                        } else if(data == 5){
                               $("#loader").css('display', 'none');  
                               Swal.fire(
                                'Error!',
                                'Left position is not empty',
                                'error'                             
                           )      
                        } else if(data == 6){
                               $("#loader").css('display', 'none');  
                               Swal.fire(
                                'Error!',
                                'Right position is not empty',
                                'error'                             
                           )      
                        } else if(data == 7){
                               $("#loader").css('display', 'none');  
                               Swal.fire(
                                'Error!',
                                'Placement is wrong',
                                'error'                             
                           )      
                        } 
                     }
                  })
              });
            });        

            $(document).ready(function(){    
                //$("#add-new-event").trigger('click');
            });
    </script>

@endsection