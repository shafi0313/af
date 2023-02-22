@extends('member.layout.app')

@section('content')

        @include('member.inc.sidebar')



    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Referral Link</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                 
                            <div class="card shadow mb-4">
                            <div class="card-header py-3">
                              <h6 class="m-0 font-weight-bold text-primary">Copy Referral Link</h6>
                            </div>
                            <div class="card-body">             
                             <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-md-10 mb-2">
                            <input class="form-control" id="txt" type="text" readonly="readonly" value="https://ordypremier.net/registration/ref/{{ $member_details->user_id }}" tabindex="8">         
                        
                            </div>
                            <div class="col-md-2 mb-2">          
                            <input class="btn btn-info btn-block" type="submit" value="copy link" onclick="copyText()">
                            </div>                      
                            
                          </div>             
                            </div>
                          </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

       function copyText() {
          var input1 = document.getElementById('txt');
          input1.select();
          document.execCommand('copy')
        }                               
                                
    </script>


@endsection
