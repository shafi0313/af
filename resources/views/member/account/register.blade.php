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
          

            <div class="row">
              <div class="col-lg-3">                
              </div>

              <div class="col-lg-6">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Account Details</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                          <form>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feFirstName">First Name</label>
                                <input type="text" class="form-control" id="feFirstName" placeholder="First Name" value="Sierra">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="feLastName">Last Name</label>
                                <input type="text" class="form-control" id="feLastName" placeholder="Last Name" value="Brooks">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">Email</label>
                                <input type="email" class="form-control" id="feEmailAddress" placeholder="Email" value="sierra@example.com">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fePassword">Password</label>
                                <input type="password" class="form-control" id="fePassword" placeholder="Password">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="feInputAddress">Address</label>
                              <input type="text" class="form-control" id="feInputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feInputCity">City</label>
                                <input type="text" class="form-control" id="feInputCity">
                              </div>
                              <div class="form-group col-md-4">
                                <label for="feInputState">State</label>
                                <select id="feInputState" class="form-control">
                                  <option selected="">Choose...</option>
                                  <option>...</option>
                                </select>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="feDescription">Description</label>
                                <textarea class="form-control" name="feDescription" rows="5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eaque, quidem, commodi soluta qui quae minima obcaecati quod dolorum sint alias, possimus illum assumenda eligendi cumque?</textarea>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-accent">Update Account</button>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>

                <div class="col-lg-3">                
              </div>

            </div>
          </div>
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
