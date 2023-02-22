@extends('member.account.layout.app')
@section('content')

<style type="text/css">
      // .card {
      //  background-color:#55ebfb;       
    //}
    //body {
      //  background: #1c7d59;       
   // }
   .card-footer {    
       background-color:#007BFF;   
    } 

    .auth-form__meta a{    
       color:black !important;   
    }
</style>
    <main class="main-content col">
          <div class="main-content-container container-fluid px-4 my-auto h-100">
            <div class="row no-gutters h-100">
              <div class="col-lg-3 col-md-5 auth-form mx-auto my-auto">
                <div class="card">
                  <div class="card-body">
                   <a href="{{ route('/') }}">
                    <img style="min-width: 100%" class="auth-form__logo d-table mx-auto mb-3" src="{{ asset('images/'.$basic_info->logo)}}" alt="{{ $basic_info->website_title }}- Register">
                  </a>
                    <h5 class="auth-form__title text-center mb-4">Create New Transaction Password</h5>
               <form method="post" class="needs-validation" action="{{url('transaction-password-reset-confirmation-success')}}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="key" value="{{ $key }}">


                     @if ($errors->any())
                        <div class="alert alert-secondary rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::get('danger'))
                        <div class="alert alert-danger">
                           <strong>{{ Session::get('danger') }}</strong>
                        </div>
                    @endif

                      @if (Session::has('message'))
                           <div class="alert alert-danger">{{ Session::get('message') }}</div>
                        @endif 


                      <div class="form-group">
                        <label for="exampleInputPassword1">Transaction Password</label>
                          <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="confirm_password" id="confirm_password" placeholder="Enter Transaction Password">
                                    <span class="input-group-append">
                              <span class="input-group-text">
                                <i class="material-icons">lock</i>
                              </span>
                            </span>
                                </div>
                            </div>
                      </div>
                    
                     <div class="form-group">
                        <label for="exampleInputPassword1">Transaction Confirm Password</label>
                           <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Enter Transaction Confirm Password">
                                    <span class="input-group-append">
                              <span class="input-group-text">
                                <i class="material-icons">lock</i>
                              </span>
                            </span>
                                </div>
                                <span class="meg" style="color: red;"></span>
                          </div>
                      </div>

        
                      <button type="submit" class="btn btn-pill btn-accent d-table mx-auto but-disable but-disable-2 but-disable-3 sned">Change Password</button>
                    </form>
                  </div>
                  <div class="card-footer border-top">
                    <ul class="auth-form__social-icons d-table mx-auto">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-github"></i></a></li>
                      <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                    </ul>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
        </main>
    



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
        $(document).on('click', '.submit', function () {

        });

        $(document).ready(function () {       
              $('#sponser').on('blur',function(e){      
                e.preventDefault();     
                var _token      = $('#_token').val();
                var sponser = $('#sponser').val();                  
                $("#loader").css('display', 'block');                
                $.ajax({
                    type: 'post',   
                  //  dataType: 'json',   
                    url: "{{ route('sponser_id_check') }}",                 
                    data: {sponser: sponser, _token: _token},
                    success: function(data){                              
                       if (data == 'ok'){                                
                            $('#alert_text3').text(' ');
                            $('.but-disable').removeAttr('disabled','disabled');
                            $("#loader").css('display', 'none');                                   
                       } else {                             
                            $('#alert_text3').text('There is no sponser exist!');        
                            $('.but-disable').attr('disabled','disabled');                            
                            $("#loader").css('display', 'none');                   
                               
                       }
                    } 
                });
              });
            });  

/*
            $(document).ready(function () {       
              $('#email').on('blur',function(e){      
                e.preventDefault();     
                var _token      = $('#_token').val();
                var email = $('#email').val();                  
                $("#loader").css('display', 'block');                
                $.ajax({
                    type: 'post',                   
                    url: "{{ route('email_address_check') }}",                 
                    data: {email: email, _token: _token},
                    success: function(data){                              
                       if (data == 'ok'){                                
                            $('#alert_text2').text('This email address is already exist!');        
                            $('.but-disable-2').attr('disabled','disabled');                            
                            $("#loader").css('display', 'none'); 

                       } else {                        
                           
                            $('#alert_text2').text(' ');
                            $('.but-disable-2').removeAttr('disabled','disabled');
                            $("#loader").css('display', 'none');                    
                               
                       }
                    } 
                });
              });
            });  
*/

           $(document).ready(function () {       
		  
             
                var _token      = $('#_token').val();
                var sponser = $('#sponser').val();                  
                $("#loader").css('display', 'block');                
                $.ajax({
                    type: 'post',   
                  //  dataType: 'json',   
                    url: "{{ route('sponser_id_check') }}",                 
                    data: {sponser: sponser, _token: _token},
                    success: function(data){                              
                       if (data == 'ok'){                                
                            $('#alert_text3').text(' ');
                            $('.but-disable').removeAttr('disabled','disabled');
                            $("#loader").css('display', 'none');                                   
                       } else {                             
                            $('#alert_text3').text('There is no sponser exist!');        
                            $('.but-disable').attr('disabled','disabled');                            
                            $("#loader").css('display', 'none');                   
                               
                       }
                    } 
                });
              
            });     

             $(document).ready(function () {       
              $('#user_name').on('blur',function(e){      
                e.preventDefault();     
                var _token      = $('#_token').val();
                var user_name = $('#user_name').val();                  
                $("#loader").css('display', 'block');                
                $.ajax({
                    type: 'post',                     
                    url: "{{ route('user_id_check') }}",                 
                    data: {user_name: user_name, _token: _token},
                    success: function(data){                              
                       if (data == 'ok'){                                
                            $('#alert_text').text(' ');
                            $('.but-disable-3').removeAttr('disabled','disabled');
                            $("#loader").css('display', 'none');                                   
                       } else {                             
                            $('#alert_text').text('This user is already exist');        
                            $('.but-disable-3').attr('disabled','disabled');                            
                            $("#loader").css('display', 'none');                                               
                       }
                    } 
                });
              });
            });     
    
            $("#password").on('keyup', function(){
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
         
    </script>


@endsection
