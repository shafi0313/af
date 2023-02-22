@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 text-center text-sm-left mb-0">
                    <h5 class="">E wallet convert to R wallet <small style="color: red;"> (Transfer charge is {{ $basic_info->wall_move_charge }}%)</small></h5>
                </div>
            </div>
 
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <div class="row">
                                <div class="col-3">                                         
                                   <span style="font-weight: 900; color: green;"> E-Wallet : {{ number_format($member_details->e_wallet,2) }}</span> 
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                         <input type="text" class="form-control border" placeholder="Enter Amount"
                                               aria-label="Add new category" id="subcategory"
                                               aria-describedby="basic-addon2">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                         <input type="password" required="required" class="form-control border" placeholder="Enter Transaction password"
                                               aria-label="Add new category" name="tran_password" id="tran_password"
                                               aria-describedby="basic-addon2">                          
                                        <div class="input-group-append">
                                            <button class="btn btn-primary shadow-none px-2" id="AddSubcategory"
                                                    type="submit">
                                                <i class="material-icons">done_outline</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">No</th>
                                    <th scope="col" class="border-0">User Name</th>
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">Moblile</th>
                                    <th scope="col" class="border-0">Amount</th>
                                    <th scope="col" class="border-0">Date</th>                     
                                    <th scope="col" class="border-0">Action</th>                              
                                </tr>
                                </thead>                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#AddSubcategory').click(function () {
                let amount = $('#subcategory').val(), tran_password = $('#tran_password').val();
                if (amount != '', tran_password != '') {
                    $('#AddSubcategory').prop('disabled',true);
                    $.ajax({
                        url: "{{ url('member/wallet-move-success') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, amount: amount, tran_password: tran_password},
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
                                    title: 'Wallet is converted successfulyy.'
                                })
                                $('#AddSubcategory').prop('disabled',false);
                                $('#subcategory').val('');
                                $('#CategoryId').val('');
                                $('.selectpicker').selectpicker('refresh');
                                table.ajax.reload();
                            } else if (response == 2) {
                                Swal.fire(
                                    'Minimum convert Amount is $5 & Maximum $50.',
                                    '',
                                    'warning'
                                )
                                $('#AddSubcategory').prop('disabled',false);
                            }else if (response == 4) {
                                Swal.fire(
                                    'Transaction password is wrong',
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
                ajax: "{{ url('member/move_trn_bal') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_id'},                   
                    {data: 'email'},
                    {data: 'mobile'},
                    {data: 'amount'},
                    {data: 'date'},                    
                    {data: 'action'}                 
                ]
            });
            $('.selectpicker').selectpicker();
        });



    </script>

@endsection
