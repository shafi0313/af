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
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#createModal">Request</button>
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
                                        {{-- <th>Updated at</th> --}}
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

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-title " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Approved Fund Installment Requetion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="ajaxStore(event, this, 'createModal')"
                    action="{{ route('admin.patient-fund-requetion.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="patient_id">Patient</label>
                                <select name="patient_id" id="patient_id" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control" required>
                            </div>

                            <div class="form-group col-12">
                                <label for="comment">Comment</label>
                                <textarea name="comment" id="" cols="30" rows="10" class="form-control" required></textarea>
                            </div>

                            <div class="form-group col-12">
                                <label for="comment">Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#data_table').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                ordering: true,
                responsive: true,
                scrollY: 400,
                ajax: "{{ route('admin.patient-fund-requetion.index') }}",
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
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ],
                scroller: {
                    loadingIndicator: true
                }
            });
        });

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
