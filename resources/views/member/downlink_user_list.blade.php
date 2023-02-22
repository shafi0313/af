@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                     <h5 class="" style="font-size: 18px;">Downlink Member List</h5>
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
                                    <th scope="col" class="border-0">Country Name</th>
                                    <th scope="col" class="border-0">Join Date</th>    
                                    <th scope="col" class="border-0">Active Date</th>  
                                    <th scope="col" class="border-0">Flag</th>  
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
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('member/downlink_user_show') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_id'},                  
                    {data: 'country_name'},                    
                    {data: 'joining_date'},
                    {data: 'active_date'},                  
                    {
                        data: "flag_name",
                        "render": function(data, type, row) {
                            var imgsrc = "{{ asset('flags-medium')}}"+ "/" + data + '.png';
                            return '<img src="'+imgsrc+'" height="30px" />';
                        }
                    }
                 ]
            });           
        });
    </script>

@endsection
