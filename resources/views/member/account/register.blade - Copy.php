@extends('member.account.layout.app')
@section('content')

    <div class="row ">
        <div class="card card-small mx-auto my-4 ">
            <div class="card-header border-bottom ">
               
                <div style="padding-left: 70px; ">
                    <h5 class="m-0">Member Registration</h5>
                </div>
               
            </div>
            <form method="post" class="needs-validation" action="{{url('Register')}}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <div class="card-body">
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

                    <ul class="list-group list-group-flush" style="width: 350px;">
                        <li class="list-group-item px-3">
                          
                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">person</i>
                              </span>
                            </span>
                                    <input type="text"
                                           class="form-control {{ $errors->has('f_name') ? ' is-invalid' : '' }}"
                                           id="f_name" name="f_name" placeholder="First Name" autocomplete="off">
                                </div>
                            </div>

                           <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">person</i>
                              </span>
                            </span>
                                    <input type="text"
                                           class="form-control {{ $errors->has('l_name') ? ' is-invalid' : '' }}"
                                           id="l_name" name="l_name" placeholder="Last Name" autocomplete="off">
                                </div>
                            </div>


                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">person</i>
                              </span>
                            </span>
                                    <input type="text" class="form-control {{ $errors->has('user_name') ? ' is-invalid' : '' }}" id="user_name" name="user_name" placeholder="Username" autocomplete="off">
                                </div>
                                 <span id="alert_text" style="color: red;"></span>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                @
                              </span>
                            </span>
                                    <input type="text"
                                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" id="email" placeholder="Email" autocomplete="off">
                                </div>
                                <span id="alert_text2" style="color: red;"></span>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">person</i>
                              </span>
                            </span>
                                    <input type="text" class="form-control {{ $errors->has('sponser') ? ' is-invalid' : '' }}" name="sponser" id="sponser" placeholder="Sponser Name" autocomplete="off">
                                </div>
                                <span id="alert_text3" style="color: red;"></span>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="confirm_password" id="confirm_password" placeholder="Password">
                                    <span class="input-group-append">
                              <span class="input-group-text">
                                <i class="material-icons">lock</i>
                              </span>
                            </span>
                                </div>
                            </div>


                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Confirm Password">
                                    <span class="input-group-append">
                              <span class="input-group-text">
                                <i class="material-icons">lock</i>
                              </span>
                            </span>
                                </div>
                                <span class="meg" style="color: red;"></span>
                            </div>

                       
                        </li>
                    </ul>
                </div>
                <div class="card-footer border-top py-3">
                    <button type="submit" class="ml-auto d-table mr-3 btn btn-accent btn-sm submit but-disable but-disable-2 but-disable-3 sned">Submit</button>
                </div>
            </form>
        </div>        
    </div>

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
