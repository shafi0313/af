@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Approved Fund Installment Requetion > Patient</h3>
        </div>
        <hr class="my-0">
    </nav>
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 mb-0 d-flex justify-content-between">
                    <h3 class="page-title">Approved Fund Installment Requetion > Patient</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Request</button>
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
                                        <th>Comment</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Recept View</th>
                                        <th>Created at</th>
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
                ajax: "{{ route('admin.patient-payment-approval.index') }}",
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
                        data: 'comment',
                        name: 'comment'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    // {
                    //     data: 'updated_at',
                    //     name: 'updated_at'
                    // },
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

        function accept(id){
        swal({
            title: "Are you sure?",
            text: "This action will accept this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((accept) => {
            if (accept) {
                $.ajax({
                    url: '{{ route('admin.patient_payment_approval.accept') }}',
                    type: 'POST',
                    data: { id: id },
                    success: res => {
                        swal({
                            icon: 'success',
                            title: 'Success',
                            text: res.message
                        }).then((confirm) => {
                            if (confirm) {
                                $('.table').DataTable().ajax.reload();
                            }
                        });
                    },
                    error: err => {
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: err.responseJSON.message
                        });
                    }
                });
            }
        })
    }

    $("form").on('submit', function(e) {
            $(this).find('button[type="submit"]').attr('disabled', true);
            $(this).find('input[type="submit"]').attr('disabled', true);
        });
        $("button[type='button']").on('click', function(e) {
            $('button[type="submit"]').attr('disabled', false);
            $('input[type="submit"]').attr('disabled', false);
        });
    </script>

@endsection
