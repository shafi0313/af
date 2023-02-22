@extends('admin.layout.app')

@section('content')

    @include('admin.inc.sidebar')
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">Wallet Transfer</span>
                <h5 class="" style="font-size: 18px;">Agent Wallet withdraw <small style="color: red;"> </small> <span style="font-weight: 900; color: green;"> </span>
                </h5>
            </div>
            <div class="col-12 col-sm-4 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    
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
                                    <th scope="col" class="border-0">Amount</th>
                                    <th scope="col" class="border-0">Type</th>
                                    <th scope="col" class="border-0">User id</th>
                                    <th scope="col" class="border-0">Type</th>
                                    <th scope="col" class="border-0">Created</th>                    
                                    <th scope="col" class="border-0">Updated</th>                 
                                </tr>
                                </thead>    
                                            
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
                                    <option value="">Select Admin</option>                            
                                        <option value="1">admin</option>                  
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
                let user_id = $('#CategoryId').val(), amount = $('#subcategory').val(), wallet_type = $('#wallet_type').val();
                if (user_id != '' && amount != '' &&  wallet_type != '') {
                     $('#AddSubcategory').prop('disabled',true);
                    $.ajax({
                        url: "{{ url('admin/agent_wallet_transfer_success') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, amount: amount, user_id: user_id, wallet_type: wallet_type},
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
                                    'Minimum Transfer Amount is 500 tk.',
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
                ajax: "{{ url('admin/agent_with_report_all') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'date'},                   
                    {data: 'amount'},
                    {data: 'purpose'},                   
                    {data: 'user_id'},                    
                    {data: 'purpose'},  
                    {data: 'created_at'},
                    {data: 'updated_at'},               
                ]
            });
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
