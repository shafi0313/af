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
    <div class="h-100 no-gutters row">
        <div class="auth-form mx-auto mt-3 col-md-5 col-lg-3">
            <div class="card">
           <div class="card-body">
                    <img style="min-width: 100%" class="auth-form__logo d-table mx-auto mb-3"
                                            src="{{ asset('images/'.$basic_info->logo) }}"
                                            alt="Shards Dashboards - Register Template"><h5
                            class="auth-form__title text-center mb-4">Reset Password</h5>   

                      @if (Session::has('message'))
                           <div class="alert alert-danger">{{ Session::get('message') }}</div>
                        @endif
                                             
                    <form method="post" class="needs-validation" action="{{url('password-reset')}}">
                        {{ csrf_field() }}
                        <div class="form-group"><label for="exampleInputEmail1">User Nama</label>
                            <input type="text" id="user_name" name="user_name" placeholder="Enter user name" autocomplete="email" class="form-control" required="required">
                            <small class=" text-center" style="color: black;">You will receive an email with a unique
                                token.
                            </small>
                        </div>
                        <button type="submit" class="d-table mx-auto btn btn-accent btn-pill">Reset Password</button>
                    </form>
                </div>
            </div>
            <div class="auth-form__meta d-flex mt-4"><a class="mx-auto" href="{{route('login')}}">Take me back to login.</a></div>
        </div>
    </div>

@endsection