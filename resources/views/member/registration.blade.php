@extends('member.layout.app')

@section('content')

        @include('member.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title"></h3>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-lg-3">
                <!-- User Details Card -->                      
              </div>
      
              <div class="col-lg-6">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h5 class="m-0 text-center">New Registration</h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                          <form method="post" id="upload_form" enctype="multipart/form-data">
                             {{csrf_field()}}           

                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feFirstName">First Name</label>
                                <input type="text" class="form-control" name="f_name" id="f_name" placeholder="First Name" required="required" value="">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="feLastName">Last Name</label>
                                <input type="text" class="form-control"  name="l_name" id="l_name" placeholder="Last Name" required="required" value="">
                              </div>
                            </div>


                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">Email</label>
                                <input type="email" class="form-control" name="email"  id="email" placeholder="Email" required="required" value="">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fePassword">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required="required"  placeholder="Enter Phone number"
                                value="" >
                              </div>
                            </div>                      

                            <div class="form-row">                         
                              <div class="form-group col-md-6">
                                <label for="fePassword">User Name</label>
                                <input type="text" class="form-control" id="username" name="username" required="required"  placeholder="Enter Username"
                                value="" >
                                <span class="messege" style="color: green;"></span>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">Sponser</label>
                                <input type="text" class="form-control" name="sponser"  id="sponser" placeholder="Enter Sponser User Id" required="required" value="">
                                <span class="messege2" style="color: green;"></span>
                              </div>
                            </div>   


                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">Plecement Id</label>
                                <input type="text" class="form-control" name="placement_id"  id="placement_id" placeholder="Enter placement id" required="required" value="">                               
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fePassword">Placement</label>
                                 <select name="placement" id="placement" class="form-control" required="">
                                    <option value="">Select Placement</option>
                                    <option value="L">left</option>
                                    <option value="R">Right</option>
                                </select>
                              </div>
                            </div>                                            
                                    
                            <div class="form-row">                  
                             <div class="form-group col-md-6">
                                <label for="fePassword">Package</label>
                                 <select name="package" id="package" class="form-control" required="">
                                    <option value="">Select Package</option>
                                    @foreach($product_manages as $v)
                                        <option value="{{ $v->id }}">{{ $v->product_name}} @  {{ $basic_info->currency }}{{ $v->price}} @ 1 Pc</option>
                                    @endforeach                              
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fePassword">Payment</label>
                                 <select name="payment" id="payment" class="form-control" required="">
                                    <option value="">Select Payment</option>
                                     <option value="first">Wallet</option>                                             
                                  </select>
                                  <span class="messege3" style="color: green;"></span>
                              </div>
                            </div>  
   

                            <div class="form-row"> 
                              <div class="form-group col-md-12">
                                <label for="fePassword">Country</label>
                                    <select name="counrty" id="counrty" class="selectpicker border rounded form-control" required="" data-live-search="true" required="required">
                                            <option value="">Select Country</option>
                                            @foreach($countryList as $v)
                                                <option value="{{ $v->id }}"
                                                    <?php if( $member_details->country == $v->id) { ?>
                                                    selected="selected"
                                                    <?php } ?>                                         
                                                    > {{ $v->country_name}} </option>
                                            @endforeach                                               
                                    </select>
                                 </div>
                            </div>

                  

                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">password</label>
                                <input type="password" class="form-control w-100" name="password" id="password"  placeholder="Enter new Password"  >
                              </div>

                              <div class="form-group col-md-6">
                                <label for="fePassword">Confirm Password</label>
                                <input type="password" class="form-control w-100" name="confirm_password" id="confirm_password"  placeholder="Enter Confirm Password" >
                              </div>
                              <span class="meg" style="color: red;"></span>
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
         <div align="center" class="loading" id="loader" style="display:none;">
       <img src="{{ asset('loading.gif') }}" height="200"/>
    </div>     
   </div>
  </main>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

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

    <script>
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


         $(document).ready(function () {
            $('#sponser').on('blur', function () {
                event.preventDefault();             
                var sponser        = $('#sponser').val();                         
                var _token          = $('#_token').val();    
                if(sponser == ""){                 
                  return false;
                }          
                $("#loader").css('display', 'block');                
                $.ajax({             
                    url: "{{ url('member/sponser_search') }}",
                    type: 'post',                    
                    dataType: 'json',
                    data: { sponser: sponser, _token: CSRF_TOKEN,},
                    success: function (data) {
                        if(data == 1){    
                               $("#loader").css('display', 'none');     
                               $(".sned").prop('disabled',false);     
                               $(".messege2").text('Your sponser is matched');
                               $(".messege2").show().delay(5000).fadeOut();                   
                               /*Swal.fire(
                                'Congratulations!',
                                'We have found the sponser',
                                'succes'                              
                               )    */                                 
                        } else if(data == 2){      
                               $("#loader").css('display', 'none');                             
                               $(".sned").prop('disabled', true);   
                               $(".messege2").text('Your sponser is matched');                 
                               Swal.fire(
                                'Sorry!',
                                'This sponser is not exist',
                                'error'                             
                               )                              
                        }                      
                    }
                })
            });
         });


         $(document).ready(function () {
            $('#username').on('blur', function () {
                event.preventDefault();             
                var username        = $('#username').val();                         
                var _token          = $('#_token').val();     
                if(username == ""){                 
                  return false;
                }        
                $("#loader").css('display', 'block');                
                $.ajax({             
                    url: "{{ url('member/username_search') }}",
                    type: 'post',                    
                    dataType: 'json',
                    data: { username: username, _token: CSRF_TOKEN,},
                    success: function (data) {
                        if(data == 1){    
                               $("#loader").css('display', 'none');     
                               $(".sned").prop('disabled',false);                        
                               $(".messege").text('This user name is available');
                               $(".messege").show().delay(5000).fadeOut();
                              
                              /* Swal.fire(
                                'Congratulations!',
                                'This username is available',
                                'succes'                              
                               ) */                                    
                        } else if(data == 2){      
                               $("#loader").css('display', 'none');                             
                               $(".sned").prop('disabled', true);       
                               $(".messege").text('');             
                               Swal.fire(
                                'Sorry!',
                                'This username is not available',
                                'error'                             
                               )                              
                        }                      
                    }
                })
            });
         });


         $(document).ready(function () {
            $('#placement').on('change', function () {
                event.preventDefault();             
                var placement_id        = $('#placement_id').val();                      
                var placement           = $('#placement option:selected').val();                  
                var _token              = $('#_token').val();             
                $("#loader").css('display', 'block');       
                if(placement_id == ''){
                     $("#loader").css('display', 'none');   
                   
                      return false;
                }
                if(placement == ''){
                     $("#loader").css('display', 'none');   
                 
                      return false;
                }
                $.ajax({             
                    url: "{{ url('member/placement_search') }}",
                    type: 'post',                    
                    dataType: 'json',
                    data: { placement_id: placement_id, placement: placement , _token: CSRF_TOKEN,},
                    success: function (data) {
                        if(data == 1){    
                               $("#loader").css('display', 'none');     
                               $(".sned").prop('disabled',false);                        
                               Swal.fire(
                                'Succes!',
                                'This position is empty',
                                'succes'                              
                               )                                     
                        } else if(data == 2){      
                               $("#loader").css('display', 'none');                             
                               $(".sned").prop('disabled', true);                    
                               Swal.fire(
                                'Sorry!',
                                'This position is not empty',
                                'error'                             
                               )                          
                           
                        } else if(data == 3){      
                               $("#loader").css('display', 'none');                             
                               $(".sned").prop('disabled', false);                    
                               Swal.fire(
                                'Succes!',
                                'Both position is empty',
                                'succes'                             
                               )                          
                           
                        }  else if(data == 4){    
                             $(".sned").prop('disabled',true);            
                             $("#loader").css('display', 'none');                
                               Swal.fire(
                                'Sorry!',
                                'This placement id is not exist',
                                'error'
                              )      
                        }                        
                    }
                })
            });
         });

         $(document).ready(function () {
            $('#placement_id').on('blur', function () {
                event.preventDefault();             
                var placement_id        = $('#placement_id').val();                      
                var placement           = $('#placement option:selected').val();                  
                var _token              = $('#_token').val();             
                $("#loader").css('display', 'block');       
                if(placement == ''){
                     $("#loader").css('display', 'none');   
                   
                      return false;
                }

                if(placement_id == ''){
                     $("#loader").css('display', 'none');   
                     Swal.fire(
                      'Empty field!',
                      'Please select placement id!',
                      'error'
                    )
                      return false;
                }
                $.ajax({             
                    url: "{{ url('member/placement_search') }}",
                    type: 'post',                    
                    dataType: 'json',
                    data: { placement_id: placement_id, placement: placement , _token: CSRF_TOKEN,},
                    success: function (data) {
                        if(data == 1){    
                               $("#loader").css('display', 'none');     
                               $(".sned").prop('disabled',false);                        
                               Swal.fire(
                                'Succes!',
                                'This position is empty',
                                'succes'                              
                               )                                     
                        } else if(data == 2){      
                               $("#loader").css('display', 'none');                             
                               $(".sned").prop('disabled', true);                    
                               Swal.fire(
                                'Sorry!',
                                'This position is not empty',
                                'error'                             
                               )                          
                           
                        } else if(data == 3){      
                               $("#loader").css('display', 'none');                             
                               $(".sned").prop('disabled', false);                    
                               Swal.fire(
                                'Succes!',
                                'Both position is empty',
                                'succes'                             
                               )                          
                           
                        }  else if(data == 4){    
                             $(".sned").prop('disabled',true);            
                             $("#loader").css('display', 'none');                
                               Swal.fire(
                                'Sorry!',
                                'This placement id is not exist',
                                'error'
                              )      
                        }                       
                    }
                })
            });
         });

         $(document).ready(function () {
            $('#package, #payment').on('change', function () {
                event.preventDefault();                                       
                var payment           = $('#payment option:selected').val();                  
                var package           = $('#package option:selected').val();                  
                var _token              = $('#_token').val();             
                $("#loader").css('display', 'block');       
                if(payment == ''){
                     $("#loader").css('display', 'none');   
                    /*Swal.fire(
                      'Empty field!',
                      'Please select payment!',
                      'error'
                    )*/
                      return false;
                }

                if(package == ''){
                     $("#loader").css('display', 'none');   
                    /*Swal.fire(
                      'Empty field!',
                      'Please select package!',
                      'error'
                    )*/
                      return false;
                }
                $.ajax({             
                    url: "{{ url('member/balance_search') }}",
                    type: 'post',                    
                    dataType: 'json',
                    data: { payment: payment, package: package , _token: CSRF_TOKEN,},
                    success: function (data) {
                        if(data == 1){    
                               $("#loader").css('display', 'none');     
                               $(".sned").prop('disabled',false);                        
                               $(".messege3").text('Your balance is available');
                               $(".messege3").show().delay(5000).fadeOut();
                              /* Swal.fire(
                                'Succes!',
                                'Your balance is sufficiant',
                                'succes'                              
                               ) */                                    
                        } else if(data == 2){      
                               $("#loader").css('display', 'none');                             
                               $(".sned").prop('disabled', true);       
                               $(".messege3").text('');             
                               Swal.fire(
                                'Sorry!',
                                'Your balance is not sufficiant',
                                'error'                             
                               )                             
                        }                    
                    }
                })
            });
         });

        $("#password, #confirm_password").on('keyup', function(){
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();            
            if(confirmPassword == ""){
                      $(".meg").text("");            
                } else {                
                    if(password == confirmPassword){
                        $(".meg").text("");
                        $(".sned").removeAttr('disabled', 'disabled');
                    } else {
                        $(".meg").text("Password and Confirm Password Do not match!");
                        $(".sned").attr('disabled', 'disabled');
                        return false;
                    }
              }
        });

        $(document).ready(function () {
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $("#loader").css('display', 'block');  
                $(".sned").prop('disabled', true);                 
                $(this).find('i').toggleClass('fa fa-spinner fa-spin');              
                $.ajax({
                    url: "{{ url('member/member-account-active') }}",
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
                                'User has been created successfully!',
                                'success'
                            )
                             window.location.href = "{{ url('member/refferd-member')}}";
                            
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

        


     

    </script>


@endsection
