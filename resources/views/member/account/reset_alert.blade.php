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
                       <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif                                             
              
                </div>
            </div>
            <div class="auth-form__meta d-flex mt-4"><a class="mx-auto" href="{{route('login')}}">Take me back to login.</a></div>
        </div>
    </div>

@endsection