@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Yearly Fund Request > Patient</h3>
        </div>
        <hr class="my-0">    
    </nav>
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 mb-0 d-flex justify-content-between">
                    <h3 class="page-title">Yearly Fund Request > Patient</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Request</button>
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
                        <div class="card-body p-0 text-center ReactTable">
                            <table id="data_table" class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Patient Name</th> 
                                    <th>Requested Amount</th> 
                                    <th>Year</th> 
                                    <th>Status</th> 
                                    <th>Created at</th> 
                                    <th>Updated at</th> 
                                    {{-- <th>Father Name</th> 
                                    <th>Mother Name</th>
                                    <th>Village</th>
                                    <th>Status</th> --}}
                                    {{-- <th>Updated At</th> --}}
                                    {{-- <th>Action</th> --}}
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

    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-title "  role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.patient-fund-request.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="patient_id">Patient</label>
                        <select name="patient_id" id="patient_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option> 
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="year">Year</label>
                        <select name="year" class="form-control" required>
                            <option value="">Select</option>
                            @for ($i = 2023; $i <= 2040; $i++)
                            <option value="{{ $i }}">{{ $i }}</option> 
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Medicine Name</th>
                                    <th>Application Amount</th>
                                    <th>Recommendation Amount</th>
                                </tr>
                            </thead>
                            <tbody id="medicine_tbody"></tbody>
                        </table>
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
                ajax: "{{ route('admin.patient-fund-request.index') }}",
                columns: [
                    {
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

    $("#patient_id").on("change", function() {
        var patient_id = $(this).val();
        $.ajax({
            url: '{{ route('admin.patient_fund_request.getMedicines') }}',
            type: 'GET',
            data: {patient_id: patient_id},
            success: res => {
                var tbody = $("#medicine_tbody");
                tbody.append(res.html);
            },
            error: err => {
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: err.responseJSON.message
                });
            }
        });
    })    
    </script>

@endsection
