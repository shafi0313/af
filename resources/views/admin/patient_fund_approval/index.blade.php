@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Yearly Fund Approval > Patient</h3>
        </div>
        <hr class="my-0">
    </nav>
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 mb-0 d-flex justify-content-between">
                    <h3 class="page-title">Yearly Fund Approval > Patient</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="card card-small mb-4">
                        <div class="card-body p-0 text-center">
                            <table id="data_table" class="table mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Patient Name</th>
                                        <th>Requested Amount(Yearly)</th>
                                        <th>Approved Amount(Yearly)</th>
                                        <th>Year</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
                ajax: "{{ route('admin.patient-fund-approval.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'patient.name',
                        name: 'patient.name'
                    },
                    {
                        data: 'requested_amt',
                        name: 'requested_amt'
                    },
                    {
                        data: 'approved_amt',
                        name: 'approved_amt'
                    },
                    {
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
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
