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
                    <h3 class="page-title">Accounts > Entry</h3>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Centre/office</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">                                
                                <div class="col-6 form-group">
                                    <label>Select Cash Centre/Office:</label>
                                    <select class="form-control" onchange="location = this.value;">
                                        <option disabled selected value>Select Cash Centre/Office</option>
                                        @foreach ($offices as $office)
                                            <option value="{{ route('admin.cash_book.entry', $office->id) }}">{{ $office->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Add New Office Modal --}}
    <div class="modal fade add_new_office_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('admin.cash_book.officeStore') }}" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add New Cash Centre/office</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Office Name:* </label>
                            <input type="text" class="form-control" name="name" required placeholder="Office Name">
                        </div>
                        <div class="form-group">
                            <label for="address">Office Address:*</label>
                            <textarea class="form-control" rows="4" name="address" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @push('script') --}}
    
    {{-- @endpush --}}
@endsection
