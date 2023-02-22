@extends('admin.layout.app')

@section('content')


    @include('admin.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">All User List</h3>
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
                                    <th scope="col" class="border-0">Name</th>
                                    <th scope="col" class="border-0">User Name</th>
                                    <th scope="col" class="border-0">Moblile</th>
                                    <th scope="col" class="border-0">Joined</th>
                                    <th scope="col" class="border-0">S-Wallet</th>                
                                    <th scope="col" class="border-0">E-Reg Wallet</th>
                                    <th scope="col" class="border-0">R-Reg Wallet</th>
                                    <th scope="col" class="border-0">M-Reg Wallet</th>
                                    <th scope="col" class="border-0">PS-Reg Wallet</th>
                                    <th scope="col" class="border-0">Total Reff</th>               
                                    <th scope="col" class="border-0">Panel</th>             
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
                let user_id = $('#CategoryId').val(), amount = $('#subcategory').val();
                if (user_id != '' && amount != '') {
                    $.ajax({
                        url: "{{ url('wallet-move-success') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, amount: amount, user_id: user_id},
                        success: function (response) {
                            if (response == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'Wallet sold successfully'
                                })
                                $('#subcategory').val('');
                                $('#CategoryId').val('');
                                $('.selectpicker').selectpicker('refresh');
                                table.ajax.reload();
                            } else if (response == 0) {
                                Swal.fire(
                                    'Given amount is wrong.',
                                    '',
                                    'warning'
                                )
                            } else {
                                Swal.fire(
                                    //response,
                                    'Admin wallet is insufficiant.',
                                    'error'
                                )
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
                ajax: "{{ url('admin/all-user-show') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'first_name'},                   
                    {data: 'user_id'},
                    {data: 'mobile'},
                    {data: 'joining_date'},
                    {data: 's_wallet'},                    
                    {data: 'e_wallet'},                    
                    {data: 'r_wallet'},                    
                    {data: 'm_wallet'},                    
                    {data: 'ps_wallet'},                    
                    {data: 'sponser_count'},           
                    {data: 'panel'},                   
                    {data: 'action'}      
                ]
            });
            $('.selectpicker').selectpicker();
        });
    </script>

@endsection
