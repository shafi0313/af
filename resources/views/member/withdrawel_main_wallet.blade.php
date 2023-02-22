@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">Wallet Withdraw</span>
                <h5 class="" style="font-size: 18px;">Wallet Withdraw<small style="color: red;"> (Withdraw charge is {{  $basic_info->withdraw_charge }}%)</small>
                    <span style="font-weight: 900; color: green;"> Wallet : 
 {{ $basic_info->currency }}
 {{ number_format($member_details->e_wallet,2) }}</span>
                </h5>
            </div>
            <div class="col-12 col-sm-4 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a id="add-new-event" role="button" href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="material-icons">add</i> Wallet Withdraw </a>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">                        
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">No</th>                       
                                    <th scope="col" class="border-0">Date</th>
                                    <th scope="col" class="border-0">Amount {{ $basic_info->currency }}</th>
                                    <th scope="col" class="border-0">Net Amount {{ $basic_info->currency }}</th>
                                    <th scope="col" class="border-0">Status</th>                   
                                    <th scope="col" class="border-0">Action</th>                         
                                </tr>
                                </thead>        
                                <tfoot>
                                  <tr>
                                    <th scope="col" class="border-0"></th>                   
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>                                  
                                    <th scope="col" class="border-0">Total: {{ $basic_info->currency }} {{ number_format($total_sum,2) }}</th>
                                    <th scope="col" class="border-0"></th>                   
                                    <th scope="col" class="border-0"></th>                   
                                  </tr>
                               </tfoot>                    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade abc" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 17px; display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">               
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Wallet Withdraw </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                   
                    <div class="modal-body">                     
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                   <input type="text" class="form-control border" placeholder="Enter Amount" aria-label="Add new category" id="subcategory"aria-describedby="basic-addon2"> 
                            </div>
                            <div class="form-group col-md-6">                                  
                                   <input type="text" class="form-control border" placeholder="Withdrawel Net amount" id="net_amount"aria-describedby="basic-addon2" readonly="readonly">  
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                 <select name="method"  class="form-control" id="method" required="required">
                                     <option value="">Select Payment Method</option>
                                     <option value="bKash">bKash</option>
                                     <option value="Nogod">Nogod</option>
                                     <option value="Rocket">Rocket</option>
                                 </select>
                            </div>    
                            <div class="form-group col-md-6">                             
                                <input type="text" required="required" class="form-control border" placeholder="Enter Account number" >        
                            </div>
                                           
                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-6">                             
                                <input type="password" required="required" class="form-control border" placeholder="Enter Transaction password" aria-label="Add new category" name="tran_password" id="tran_password"aria-describedby="basic-addon2">        
                            </div>
                            <div class="form-group col-md-6">                                
                            </div>      
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="AddSubcategory">Save</button>
                    </div>
                
            </div>
        </div>
    </div>



    <script>
       

         $('#subcategory').keyup(function () {
            var input_amount = $(this).val();
            var net_amount   = (input_amount * {{ $basic_info->withdraw_charge }})/100;
            var net_amount   = input_amount - net_amount;          
            $('#net_amount').val(net_amount);           
         });

          
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

          $(document).on('click', '.edit', function ()  {
                event.preventDefault();
                let id = $(this).attr('id');
                //alert(id);
                $.ajax({
                    url: "{{ url('member/withdrawel_cancel') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {_token: CSRF_TOKEN, id: id,},                   
                    success: function (data) {
                        if(data == 1){                        
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            Toast.fire({
                                type: 'success',
                                title: 'Withdrawal is canceled successfully'
                            })                             
                            location.reload();
                        }else{
                            Swal.fire({
                                title: 'something is wrong !',
                                html: data,
                            })
                        }                    
                    }

                })
            });


        $(document).ready(function () {
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#AddSubcategory').click(function () {
                let amount        = $('#subcategory').val();
                let tran_password = $('#tran_password').val();
                let net_amount    = $('#net_amount').val();
                let method        = $('#method').val();
              
                if (amount != '' && tran_password != '' && method != '') {
                      $('#AddSubcategory').prop('disabled',true);
                    $.ajax({
                        url: "{{ url('member/balance-withdrawel-success') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, amount: amount, method: method, net_amount: net_amount, tran_password: tran_password},
                        success: function (response) {
                            if(response == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'Wait for admin aproval'
                                })
                                $('#subcategory').val('');
                                $('#CategoryId').val('');
                                $('.selectpicker').selectpicker('refresh');
                                table.ajax.reload();
                            } else if (response == 2) {
                                Swal.fire(
                                    'Minimum Withdrawal Amount is 500 TK.',
                                    '',
                                    'warning'
                                )
                                $('#AddSubcategory').prop('disabled',false);
                            }else if (response == 5) {
                                Swal.fire(
                                    'Transaction password is wrong.',
                                    '',
                                    'warning'
                                )
                                $('#AddSubcategory').prop('disabled',false);
                            } else if (response == 6) {
                                Swal.fire(
                                    'Per day only one withdrawel is accepted',
                                    '',
                                    'warning'
                                )
                                $('#AddSubcategory').prop('disabled',false);
                            } else {
                                Swal.fire(
                                    //response,
                                    'Amount is insufficiant.',
                                    'warning'
                                )
                                $('#AddSubcategory').prop('disabled',false);
                            }
                        }
                    });
                } else {
                    Swal.fire('Input field empty')
                }
            });
            $(function () {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('member/balance-withdrawel-view') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},                   
                    {data: 'date'},  
                    {data: 'amount'},                  
                    {data: 'net_amount'},                  
                    {data: 'status'},                  
                    {data: 'action'}                 
                ]
            });
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
