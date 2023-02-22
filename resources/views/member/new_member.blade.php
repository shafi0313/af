@extends('member.layout.app')

@section('content')

        @include('member.inc.sidebar')



    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">New Member List</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">                       
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">SL</th>
                                    <th scope="col" class="border-0">First Name</th>
                                    <th scope="col" class="border-0">Last Name</th>
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">Phone</th>
                                    <th scope="col" class="border-0">User Name</th>
                                    <th scope="col" class="border-0">Joining Date</th>
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
            $(document).on('click', '.edit', function ()  {
                event.preventDefault();
                let id = $(this).attr('id');
                $('#AddSubcategory').prop('disabled',true);
                $.ajax({
                    url: "{{ url('member/member-account-active') }}",
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
                                title: 'Please wait for admin approval'
                            })            
                            $('#AddSubcategory').prop('disabled',false);                 
                            table.ajax.reload();
                        }else{
                            Swal.fire({
                                title: 'You dont have sufficiant balance !',
                                html: data,
                            })
                            $('#AddSubcategory').prop('disabled',false);
                        }                    
                    }

                })
            });

            $(function () {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('member/view-unit') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'email'},
                    {data: 'mobile'},
                    {data: 'user_id'},
                    {data: 'joining_date'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });          
         
        });
    </script>


@endsection
