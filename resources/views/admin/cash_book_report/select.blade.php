@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Accounts > Entry</h3>
        </div>
        <hr class="my-0">
    </nav>
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-md-12 d-flex justify-content-between">
                    <h3 class="page-title">Accounts > Cash Book Report</h3>
                    {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Centre/office</button> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-heading">
                            <h3></h3>
                        </div> --}}
                        <div class="card-body">
                            <form action="" method="get" autocomplete="off">
                                <div class="row justify-content-center pt-3">
                                    <div class="col form-group">
                                        <select class="form-control" name='office_id'>
                                            <option disabled selected value>Select Cash Centre/Office</option>
                                            @foreach ($offices as $office)
                                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy"
                                            id="start_date" name="start_date" placeholder="Form date" required="">

                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy"
                                            id="end_date" name="end_date" placeholder="To date" required="">

                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary"
                                            style="background:#ff5733 !important; color:white !important; width: 150px">
                                            Report
                                        </button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- @push('script') --}}
    
    {{-- @endpush --}}
@endsection
