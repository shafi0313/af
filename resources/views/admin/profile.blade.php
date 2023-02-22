@extends('admin.layout.app')

@section('content')

   @include('admin.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Password Update</h3>
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
                           <form method="post" id="update_old_tran" enctype="multipart/form-data">
                                {{csrf_field()}}
                                 <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                <div class="p-3 h-100 overflow-auto">
                                   <input type="hidden" id="user_id" name="user_id" value="">

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


        </div>


    </main>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


         $(document).ready(function () {
            $('#update_form').on('submit', function () {

                event.preventDefault();
                var old_password   = $('#old_password').val();                  
                var password       = $('#password').val();                           
                var new_password   = $('#new_password').val();                  
                var _token         = $('#_token').val();              
                $.ajax({             
                    url: "",
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
            $('#update_old_tran').on('submit', function () {
                event.preventDefault();
                var old_tran_password   = $('#old_tran_password').val();                  
                var tran_password       = $('#tran_password').val();                           
                var tran_new_password   = $('#tran_new_password').val();                   
                var _token         = $('#_token').val();              
                $.ajax({             
                    url: "{{ url('admin/passwordupdate') }}",
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
