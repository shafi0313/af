@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                     <h5 class="" style="font-size: 18px;">Rank Report</h5>
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
                                    <th scope="col" class="border-0">Rank Name</th>  
                                    <th scope="col" class="border-0">prize</th>  
                                    <th scope="col" class="border-0">Date</th>                    
                                    <th scope="col" class="border-0">Status</th>
                                 </tr>
                                </thead>      
                                <tfoot>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"> </th> 
                                     <th scope="col" class="border-0"> </th> 
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                </tfoot>                         
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
                ajax: "{{ url('member/rank-report-show') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'rank_name'},
                    {data: 'prize'}, 
                    {data: 'rank_date'},   
                    {data: 'action'}
                 ]
            });           
        });



    </script>

@endsection
