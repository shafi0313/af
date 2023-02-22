@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">Wallet Transfer</span>
                <h5 class="" style="font-size: 18px;">Wallet Transfer to member<small style="color: red;"> (Transfer charge is {{  $basic_info->profit_share_charge }}%)</small> <span style="font-weight: 900; color: green;"> Wallet : 
 {{ $basic_info->currency }}
 {{ number_format($member_details->e_wallet,2) }}</span>
                </h5>
            </div>
            <div class="col-12 col-sm-4 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a id="add-new-event" role="button" href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="material-icons">add</i> Wallet Transfer </a>
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
                                    <th scope="col" class="border-0">User Name</th>
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">Moblile</th>
                                    <th scope="col" class="border-0">Amount</th>
                                    <th scope="col" class="border-0">Wallet Type</th>
                                    <th scope="col" class="border-0">Date</th>                    
                                    <th scope="col" class="border-0">Action</th>                 
                                </tr>
                                </thead>    
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td><strong>{{ $total_sum }}</strong></td>
                                        <td></td>
                                        <td></td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Wallet Transfer </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                   
                    <div class="modal-body">                     
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                 <select class="selectpicker border rounded float-right" id="CategoryId" data-live-search="true" autocomplete="off">
                                        <option value="">Select User</option>
                                          @foreach($user_list as $v)                                  
                                        
                                     <option value="{{ $v->id }}">{{ $v->user_id}}</option>
                                         
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-6">
                                  <select class="form-control" id="wallet_type">                                     
                                        <option selected="" value="e_wallet">Wallet</option>
                                    </select>   
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                  <input type="text" class="form-control border" placeholder="Enter Amount" aria-label="Add new category" id="subcategory" aria-describedby="basic-addon2">
                            </div>    
                            <div class="form-group col-md-6">                             
                                <input type="password" required="required" class="form-control border" placeholder="Enter Transaction password" aria-label="Add new category" name="tran_password" id="tran_password"aria-describedby="basic-addon2">        
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
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#AddSubcategory').click(function () {
                let user_id = $('#CategoryId').val(), amount = $('#subcategory').val(), wallet_type = $('#wallet_type').val(), tran_password = $('#tran_password').val();
                if (user_id != '' && amount != '' && tran_password != '' && wallet_type != '') {
                     $('#AddSubcategory').prop('disabled',true);
                    $.ajax({
                        url: "{{ url('member/member-wallet-transfer') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, amount: amount, user_id: user_id, tran_password: tran_password, wallet_type: wallet_type},
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
                                $('#AddSubcategory').prop('disabled',false);
                                table.ajax.reload();
                            } else if (response == 2) {
                                Swal.fire(
                                    'Minimum Transfer Amount is 5 tk.',
                                    '',
                                    'warning'
                                )
                                table.ajax.reload();                            
                                $('#AddSubcategory').prop('disabled',false);
                                $('#tran_password').val('');
                                $('#CategoryId').val('');
                                $('#subcategory').val('');
                            }else if (response == 5) {
                                Swal.fire(
                                    'Transaction password is wrong.',
                                    '',
                                    'warning'
                                )
                                table.ajax.reload();                            
                                $('#AddSubcategory').prop('disabled',false);
                                $('#tran_password').val('');
                                $('#CategoryId').val('');
                                $('#subcategory').val('');
                            }else if (response == 11) {
                               
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'Fund Inserted successfully'
                                })
                                table.ajax.reload();                            
                                $('#AddSubcategory').prop('disabled',false);
                                $('#tran_password').val('');
                                $('#CategoryId').val('');
                                $('#subcategory').val('');

                            } else {
                                Swal.fire(
                                    //response,
                                    'Amount is insufficiant.',
                                    'warning'
                                )
                                table.ajax.reload();                            
                                $('#AddSubcategory').prop('disabled',false);
                                $('#tran_password').val('');
                                $('#CategoryId').val('');
                                $('#subcategory').val('');
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
                ajax: "{{ url('member/hold_wallt_transfer') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_id'},                   
                    {data: 'email'},
                    {data: 'mobile'},
                    {data: 'amount'},
                    {data: 'tran_type'},
                    {data: 'date'},                    
                    {data: 'action'}                 
                ]
            });
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
