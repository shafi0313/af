@extends('admin.layout.app')

@section('content')


    @include('admin.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                    <h3 class="page-title">Distribution</h3>
                </div>
            </div>
         
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                         <div class="card-body p-0 text-center ReactTable">
                            <table class="table table-bordered table-striped">
                                    <tr>
                                        <th >SL</th>
                                        <th >Name</th>
                                        <th >Amount</th>
                                        <th >Action</th>                                     
                                    </tr> 
                                    <tr>
                                        <th >1</th>
                                        <th>Enter Amount Distribution</th>
                                       @if($ref_dist->date != $today)
                                        <th>
                                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter distribute amount" required="required">
                                        </th>
                                       <th>                                         
                                        <a href="#"  id="button_1" class="btn btn-primary" >
                                            Distribute
                                        </a>                             
                                        </th>
                                        @endif
                                    </tr>   

                                 <!--     <tr>
                                        <th >2</th>
                                        <th >Refferrel Income Distribution (01:00 PM)</th>
                                        <th >
                                            @if($ref_dist->date != $today)   
                                            <a id="button_2" href="#" class="btn btn-primary" >Distribute</a>
                                             @endif
                                        </th>          
                                                
                                    </tr> 
                                    
                                     <tr>
                                        <th >3</th>
                                        <th >Downlink Income Store (02:00 PM)</th>
                                         <th >
                                              @if($rank_distr->date != $today)   
                                            <a id="button_3" href="#" class="btn btn-primary" >Income Store</a>
                                             @endif
                                        </th>                                          
                                     </tr> 

                                     <tr>
                                        <th>4</th>
                                        <th>Downlink Income Distribution (03:00 PM)</th>
                                        <th>
                                             @if($inc_distr->date != $today)   
                                            <a id="button_4" href="#" class="btn btn-primary" >Distribute</a>
                                             @endif
                                        </th>                                            
                                     </tr>  -->
                                                                                         
                            </table>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function () {    

                  $('#button_1').click(function () {             
                     var amount =  $('#amount').val();
                     if(amount < 0){
                        Swal.fire({
                            icon:'warning',
                            type:'error',
                            text:'Amount can not be less than zero',
                        })                      
                        return false;
                     }  
                     if(!amount){                   
                        Swal.fire({
                          icon: 'warning',
                          type:'error',                         
                          text: 'Amount can not be empty!',                        
                        })
                        return false;
                     }  

                     $('#button_1').prop('hidden',true);
                     $("#loader").css('display', 'block');                
                    $.ajax({
                        url: "{{ url('admin/profit-return') }}",                       
                        data: {amount:amount, _token: CSRF_TOKEN},
                        success: function (response) {
                            if (response == '') {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'successfully amount distributed'
                                })                             
                                 $("#loader").css('display', 'none');           
                                $('#button_1').prop('disabled',false);
                                ajax.reload();
                            } 
                        }
                    });               
                });   

                $('#button_2').click(function () {              
                    $('#button_2').prop('hidden',true);
                     $("#loader").css('display', 'block');                
                    $.ajax({
                        url: "{{ url('refferrel_amount_distribution_second_crone') }}",
                       
                        data: {_token: CSRF_TOKEN},
                        success: function (response) {
                            if (response == '') {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'successfully'
                                })                             
                                 $("#loader").css('display', 'none');           
                                $('#button_2').prop('disabled',false);
                                ajax.reload();
                            } 
                        }
                    });               
                });    


                   $('#button_3').click(function () {              
                    $('#button_3').prop('hidden',true);
                     $("#loader").css('display', 'block');                
                    $.ajax({
                        url: "{{ url('direct_downlink_amount_store_third_crone') }}",
                       
                        data: {_token: CSRF_TOKEN},
                        success: function (response) {
                            if (response == '') {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'successfully'
                                })                             
                                 $("#loader").css('display', 'none');           
                                $('#button_3').prop('disabled',false);
                                ajax.reload();
                            } 
                        }
                    });               
                });


                $('#button_4').click(function () {              
                    $('#button_4').prop('hidden',true);
                     $("#loader").css('display', 'block');                
                    $.ajax({
                        url: "{{ url('direct_downlink_amount_distribute_fourth_crone') }}",
                       
                        data: {_token: CSRF_TOKEN},
                        success: function (response) {
                            if (response == '') {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'successfully'
                                })                             
                                 $("#loader").css('display', 'none');           
                                $('#button_4').prop('disabled',false);
                                ajax.reload();
                            } 
                        }
                    });               
                });


            $(function () {
                table.ajax.reload();
            });
 
        });



    </script>

@endsection
