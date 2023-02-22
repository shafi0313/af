@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Applicant List > Student</h3>
        </div>
        <hr class="my-0">    
    </nav>
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Applicant List > Student</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">                    
                        <div class="card-body p-0 text-center ReactTable">
                            <table id="data_table" class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Student Name</th> 
                                    <th>Father Name</th> 
                                    <th>Mother Name</th>
                                    <th>Village</th>
                                    <th>Status</th>
                                    {{-- <th>Updated At</th> --}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
        
    <script>
        $(function() {
            $('#data_table').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                ordering: true,
                responsive: true,
                scrollY: 400,
                ajax: "{{ route('admin.applicant.index') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'student_name',
                        name: 'student_name'
                    },
                    {
                        data: 'father_name',
                        name: 'father_name'
                    },
                    {
                        data: 'mother_name',
                        name: 'mother_name'
                    },
                    {
                        data: 'gram',
                        name: 'gram'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                scroller: {
                    loadingIndicator: true
                }
            });
        });
    </script>

@endsection
