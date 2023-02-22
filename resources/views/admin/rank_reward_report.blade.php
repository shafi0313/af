@extends('admin.layout.app')

@section('content')


    @include('admin.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Rank Reward Report</h3>
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
                                        <th scope="col" class="border-0">Rank Name</th>  
                                        <th scope="col" class="border-0">prize</th>  
                                        <th scope="col" class="border-0">Date</th>                   
                                        <th scope="col" class="border-0">Status</th> 
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
         
            $(function () {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/rank-reward-list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                   {data: 'user_name'},
                   {data: 'rank_name'},
                    {data: 'prize'}, 
                    {data: 'date'},   
                    {data: 'action'}             
              
                ]
            });
            $('.selectpicker').selectpicker();
        });

            
        $(document).on('click', '.edit', function ()  {           
            let id = $(this).attr('id');
             $('.edit').prop('disabled',true);
            $.ajax({
                url: "{{ url('admin/rank-distribute') }}",
                type: 'get',
                data: {id: id,},
                dataType: 'json',
                success: function (data) {
                    if (data == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            type: 'success',
                            title: 'Prize paid successfully'
                        })                              
                        location.reload();                               
                    } else {
                        Swal.fire(
                            response,
                            'Something wrong, please check again.',
                            'error'
                        )
                          $('.edit').prop('disabled',false);
                    }
                }
            });
        });

    </script>

@endsection
