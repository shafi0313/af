@extends('member.layout.app')

@section('content')

   @include('member.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Profile Details</h3>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-lg-4">
                <!-- User Details Card -->
                <div class="card card-small user-details mb-4">
                  <div class="card-header p-0">
                    <div class="user-details__bg">
                      @if(!empty($member_details->country))
                       @php
                       $countryflag =  DB::table('countries')->where('id', $member_details->country)->first();
                       @endphp 
                      @endif
                     
                       <?php /// 
                     // <img src="{{ asset('flags-medium/'.$countryflag->flag_name.'.png') }}" alt="User Details Background Image"> 
                      ///  ?>

                      <img src="{{ asset('images/user-background.jpg') }}" alt="User Details Background Image">
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="user-details__avatar mx-auto">                     

                        @if(!$member_details->image)
                        <img  src="{{ asset('images/user.png') }}" alt="User Avatar">
                        @else
                        <img  src="{{ asset('storage/product/'.$member_details->image) }}" alt="User Avatar">
                        @endIf
                        
                    </div>
                    <h4 class="text-center m-0 mt-2">{{ $member_details->first_name }} {{ $member_details->last_name }}</h4>
                    <p class="text-center text-light m-0 mb-2">User Name : {{ $member_details->user_id }} || Rank  :  {{ $member_details->rank }}</p>
                    <p class="text-center text-light m-0 mb-2">Join Date : {{ $member_details->joining_date }}<!--  || Active Date  :  {{ $member_details->active_date }} --></p>


                    <ul class="user-details__social user-details__social--primary d-table mx-auto mb-4">
                      <li class="mx-1"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li class="mx-1"><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li class="mx-1"><a href="#"><i class="fab fa-github"></i></a></li>
                      <li class="mx-1"><a href="#"><i class="fab fa-slack"></i></a></li>
                    </ul>
                    <div class="user-details__user-data border-top border-bottom p-4">
                      <div class="row mb-3">
                        <div class="col w-50">
                          <span>Email</span>
                          <span>{{ $member_details->email }} </span>
                        </div>                       
                      </div>

                      <div class="row mb-3">
                        <div class="col w-50">
                          <span>Phone</span>
                          <span>{{ $member_details->mobile }} </span>
                        </div>                       
                      </div>

                     <div class="row mb-3">
                        <div class="col w-50">
                          <span>Address</span>
                          <span>{{ $member_details->address }} </span>
                        </div>                       
                      </div>

                     <div class="row mb-3">
                        <div class="col w-50">
                          <span>Country</span>
                          <span> @if($member_details->country) {{ $countryflag->country_name }} @endif </span>
                        </div>                       
                      </div>

                      <div class="row mb-3">
                        <div class="col w-50">
                          <span>Wallet Address</span>
                          <span>{{ $member_details->withdraw_account }} </span>
                        </div>                       
                      </div>
                      
                    </div>
                    <div class="user-details__tags p-4">                     
                    </div>
                  </div>
                </div>
        
              </div>





              <div class="col-lg-8">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Account Details</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                          <form method="post" id="upload_form" enctype="multipart/form-data">
                             {{csrf_field()}}
                          
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feFirstName"> User Image</label>
                                
                                     <div class="col-6 pl-0">
                                            <div class="image w-100 text-center" onclick="chooseFile()" id="previewImage">
                                                 <div class="mt-5">
                                             <i class="fas fa-cloud-upload-alt fs-25"></i><br>
                                            Add a Profile Image
                                                 </div>
                                             </div>

                                             <input type="file" name="ProductPic" class="ImageUpload d-none">
                                             <input type="text" id="itemId" name="itemId" class="d-none">
                                        </div>



                              </div>
                              <div class="form-group col-md-6">                                
                              </div>
                            </div>    

                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feFirstName">First Name</label>
                                <input type="text" class="form-control" name="f_name" id="f_name" placeholder="First Name" required="required" value="{{ $member_details->first_name }}">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="feLastName">Last Name</label>
                                <input type="text" class="form-control"  name="l_name" id="l_name" placeholder="Last Name" required="required" value="{{ $member_details->last_name }}">
                              </div>
                            </div>


                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">Email</label>
                                <input type="email" class="form-control" name="email"  id="email" placeholder="Email" required="required" value="{{ $member_details->email }}" readonly="readonly">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fePassword">User Name</label>
                                <input type="text" class="form-control" id="username" name="username" required="required"  placeholder="username"
                                value="{{ $member_details->user_id }}" readonly="">
                              </div>
                            </div>

                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">Phone</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Your Mobile number" required="required" value="{{ $member_details->mobile }}">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="fePassword">Gender</label>
                                 <select name="gender" id="gender" class="form-control" required="">
                                    <option value="">Select Gender</option>
                                    <option value="m" <?php if($member_details->gender == 'm') {?>  selected="selected" <?php } ?>>Male</option>
                                    <option  value="f"<?php if($member_details->gender == 'f') {?>  selected="selected" <?php } ?>>Female</option>
                                </select>
                              </div>
                            </div>  

                          <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">Birthdate</label>
                                <div id="blog-overview-date-range" class="input-daterange">        
                                                <input required="required" type="text" class="form-control w-100" name="birthday" placeholder="Enter Birthdate" id="blog-overview-date-range-1" value="{{ $member_details->birth_date  }}">      
                                            </div>
                              </div>
                              <div class="form-group col-md-6">
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

                            <div class="form-group">
                              <label for="feInputAddress">Address</label>
                              <input type="text" required="required" class="form-control" name="address" id="address" placeholder="Enter Address" value="{{ $member_details->address}}">
                            </div>

                            <div class="form-group">
                              <label for="feInputAddress">Wallet Address</label>
                              <input type="text" required="required" class="form-control" id="withdraw_account" name="withdraw_account" placeholder="Withdraw Wallet Address" value="{{ $member_details->withdraw_account  }}">
                            </div>
                           
                            <button type="submit" class="btn btn-accent">Update Account</button>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>                
                </div>
              </div>
            </div>




            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                       <h5 align="center">Password Update</h5>
                        @if ($errors->any())
                        <div class="alert alert-secondary rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <div class="card-body p-0 text-center ReactTable">
                           <form method="post" id="update_form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                 <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                <div class="p-3 h-100 overflow-auto">
                                   <input type="hidden" id="user_id" name="user_id" value="{{ $member_details->id }}">
                                    <div class="row px-0 mx-0 my-2">
                                        <div class="col-6 pl-0">
                                            <div class="form-group mb-2">
                                                <label for="inputCategory" class="sr-only"></label>
                                                <input type="Password" class="form-control w-100" name="old_password" id="old_password"  placeholder="Enter Old Password"  >
                                            </div>
                                        </div>
                                        <div class="col-6 pr-0">                                    
                                        </div>
                                    </div>
                                   <div class="row px-0 mx-0 my-2">
                                        <div class="col-6 pl-0">
                                            <div class="form-group mb-2">
                                                <label for="inputCategory" class="sr-only"></label>
                                                <input type="Password" class="form-control w-100" name="password" id="password"  placeholder="Enter new Password"  >
                                            </div>
                                        </div>
                                        <div class="col-6 pr-0">
                                            <input type="Password" class="form-control w-100" name="new_password" id="new_password"  placeholder="Enter Confirm Password" >
                                        </div>
                                    </div>                   
                                    <div class="row border-top" id="InputButton">
                                        <button type="submit" class="btn btn-primary w-50 mx-auto mt-4 addProduct">Update</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          @if(empty($member_details->transaction_password))
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                       <h5 align="center">Transaction Password Create</h5>
                        @if ($errors->any())
                         <div class="alert alert-secondary rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                         </div>
                        @endif

                        <div class="card-body p-0 text-center ReactTable">
                           <form method="post" id="transaction_form_update" enctype="multipart/form-data">
                                {{csrf_field()}}
                                 <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                <div class="p-3 h-100 overflow-auto">
                                   <input type="hidden" id="user_id" name="user_id" value="{{ $member_details->id }}">                                  
                                   <div class="row px-0 mx-0 my-2">
                                        <div class="col-6 pl-0">
                                            <div class="form-group mb-2">
                                                <label for="inputCategory" class="sr-only"></label>
                                                <input type="Password" class="form-control w-100" name="tran_password" id="tran_password"  placeholder="Enter new Transaction Password"  autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-6 pr-0">
                                            <input type="Password" class="form-control w-100" name="tran_new_password" id="tran_new_password"  placeholder="Enter Confirm Transaction Password"  autocomplete="off">
                                        </div>
                                    </div>                   
                                    <div class="row border-top" id="InputButton">
                                        <button type="submit" class="btn btn-primary w-50 mx-auto mt-4 addProduct">Create</button>
                                    </div>
                                </div>                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                       <h5 align="center">Transaction Password Update</h5>
                        @if ($errors->any())
                         <div class="alert alert-secondary rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                         </div>
                        @endif

                        <div class="card-body p-0 text-center ReactTable">
                           <form method="post" id="update_old_tran" enctype="multipart/form-data">
                                {{csrf_field()}}
                                 <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                <div class="p-3 h-100 overflow-auto">
                                   <input type="hidden" id="user_id" name="user_id" value="{{ $member_details->id }}">

                                   <div class="row px-0 mx-0 my-2">
                                        <div class="col-6 pl-0">
                                            <div class="form-group mb-2">
                                                <label for="inputCategory" class="sr-only"></label>
                                                <input autocomplete="off" type="Password" class="form-control w-100" name="old_tran_password" id="old_tran_password"  placeholder="Enter Old Transaction Password"  >
                                            </div>
                                        </div>
                                        <div class="col-6 pr-0">
                                           
                                        </div>
                                    </div>
                                    <div class="row px-0 mx-0 my-2">
                                        <div class="col-6 pl-0">
                                            <div class="form-group mb-2">
                                                <label for="inputCategory" class="sr-only"></label>
                                                <input  autocomplete="off" type="Password" class="form-control w-100" name="tran_password" id="tran_password"  placeholder="Enter new Transaction Password"  >
                                            </div>
                                        </div>
                                        <div class="col-6 pr-0">
                                            <input  autocomplete="off" type="Password" class="form-control w-100" name="tran_new_password" id="tran_new_password"  placeholder="Enter Confirm Transaction Password" >
                                        </div>
                                    </div>                   
                                    <div class="row border-top" id="InputButton">
                                        <button type="submit" class="btn btn-primary w-50 mx-auto mt-4 addProduct">Create</button>
                                    </div>
                                </div>                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </main>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function chooseFile() {
            $(".ImageUpload").click();
        }

        $(function () {
            $(".ImageUpload").change(function () {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    alert("only jpeg, jpg and png Images type allowed");
                    return false;
                } else {
                    $('#previewImage').html('<img src="" class="img-thumbnail h-100 mx-auto"  style="max-height: 100px;"  id="previewLogo">');
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $('#previewLogo').attr('src', e.target.result);
        }

        $('#CategoryId').change(function () {
            let id = $(this).val();
            $.ajax({
                url: "{{ url('subcategory-select') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN, id: id},
                dataType: 'json',
                success: function (data) {
                    $('#SubcategoryId').html('');
                    data.forEach(function (element) {
                        $('#SubcategoryId').append($('<option>', {value: element.id, text: element.subcategory_name}));
                    });
                    $('.selectpicker').selectpicker('refresh');
                }
            });
        });


        $(document).ready(function () {
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $.ajax({
                    url: "{{ url('member/profile-update') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        if(data == 1){
                            Swal.fire(
                                'Update!',
                                'Profile Successfully Updated',
                                'success'
                            )
                             location.reload();
                        }else{
                            Swal.fire({
                                title: 'Profile Image cant be larger than 200kb !',
                                html: data,
                            })
                        }                     
                     }
                })
            });
         });

         $(document).ready(function () {
            $('#update_form').on('submit', function () {
                event.preventDefault();
                var old_password   = $('#old_password').val();                  
                var password       = $('#password').val();                           
                var new_password   = $('#new_password').val();                  
                var _token         = $('#_token').val();              
                $.ajax({             
                    url: "{{ url('member/passwordupdate') }}",
                    type: 'post',                    
                    dataType: 'json',
                    data: {old_password: old_password, new_password: new_password, password: password , _token: CSRF_TOKEN,},
                    success: function (data) {
                        if(data == 1){
                            Swal.fire(
                                'Update!',
                                'Password Successfully Updated',
                                'success'                              
                            )
                            location.reload();
                        }else if(data == 2){
                            Swal.fire({
                                title: 'Old password is wrong !',                                
                            })
                        }else if(data == 3){
                            Swal.fire({
                                title: 'Current Password and old password is same!',
                                
                            })
                        } else if(data == 4){
                            Swal.fire({
                                title: 'New Password and confirm password is not matched!',
                               
                            })
                        }  else if(data == 5){
                            Swal.fire({
                                title: 'Minimum six character',
                               
                            })
                        } else {
                            Swal.fire({
                                title: 'Something is wrong',
                               
                            })
                        }
                       
                    }

                })
            });
         });


         $(document).ready(function () {
            $('#transaction_form_update').on('submit', function () {
                event.preventDefault();             
                var tran_password       = $('#tran_password').val();                           
                var tran_new_password   = $('#tran_new_password').val();                  
                var _token              = $('#_token').val();              
                $.ajax({             
                    url: "{{ url('member/tranpasswordupdate') }}",
                    type: 'post',                    
                    dataType: 'json',
                    data: { tran_password: tran_password, tran_new_password: tran_new_password , _token: CSRF_TOKEN,},
                    success: function (data) {
                        if(data == 1){                         
                               Swal.fire(
                                'success!',
                                'Transaction password Successfully created',
                                'success'                              
                               )
                            location.reload();
                        }else if(data == 2){
                            Swal.fire({
                                title: 'Old password is wrong !',                                
                            })
                        }else if(data == 3){
                            Swal.fire({
                                title: 'Current Password and old password is same!',
                                
                            })
                        } else if(data == 4){
                            Swal.fire({
                                title: 'New Password and confirm password is not matched!',
                               
                            })
                        }  else if(data == 5){
                            Swal.fire({
                                title: 'Minimum six character',
                               
                            })
                        } else {
                            Swal.fire({
                                title: 'Something is wrong',
                               
                            })
                        }
                       
                    }

                })
            });
         });


        $(document).ready(function () {
            $('#update_old_tran').on('submit', function () {
                event.preventDefault();
                var old_tran_password   = $('#old_tran_password').val();                  
                var tran_password       = $('#tran_password').val();                           
                var tran_new_password   = $('#tran_new_password').val();                   
                var _token         = $('#_token').val();              
                $.ajax({             
                    url: "{{ url('member/tranpasswordexistupdate') }}",
                    type: 'post',                    
                    dataType: 'json',
                    data: {old_tran_password: old_tran_password, tran_password: tran_password, tran_new_password: tran_new_password , _token: CSRF_TOKEN,},
                    success: function (data) {
                        if(data == 1){
                            Swal.fire(
                                'Update!',
                                'Password Successfully Updated',
                                'success'                              
                            )
                            location.reload();
                        }else if(data == 2){
                            Swal.fire({
                                title: 'Old Transaction password is wrong !',                                
                            })
                        }else if(data == 3){
                            Swal.fire({
                                title: 'Current Transaction Password and old Transaction password is same!',
                                
                            })
                        } else if(data == 4){
                            Swal.fire({
                                title: 'New Transaction Password and confirm Transaction password is not matched!',
                               
                            })
                        }  else if(data == 5){
                            Swal.fire({
                                title: 'Minimum six character',
                               
                            })
                        } else {
                            Swal.fire({
                                title: 'Something is wrong',                               
                            })
                        }                       
                    }
                })
            });
         });


    </script>


@endsection
