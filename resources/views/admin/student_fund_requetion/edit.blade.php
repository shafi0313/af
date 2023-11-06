@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Approved Fund Installment Requetion > Student > Edit</h3>
        </div>
        <hr class="my-0">
    </nav>
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 mb-0 d-flex justify-content-between">
                    <h3 class="page-title">Approved Fund Installment Requetion > Student > Edit</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="card">
                        <form action="{{ route('admin.student-fund-requetion.update',$student->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="long_details">Comment</label>
                                        <input type="text" name="long_details" class="form-control" value="{!! $student->long_details !!}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title">Amount</label>
                                        <input type="text" name="title" class="form-control" value="{{ $student->title }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title">Receipt Date</label>
                                        <input type="date" name="recept_date" class="form-control" value="{{ $student->recept_date }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title">Month Name</label>
                                        <input type="text" name="month" class="form-control" value="{{ $student->month }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title">Monthly Fee Amount</label>
                                        <input type="text" name="monthly_fee_amount" class="form-control" value="{{ $student->monthly_fee_amount }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title">Year</label>
                                        <input type="text" name="year" class="form-control" value="{{ $student->year }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="long_details">Receipt View</label>
                                        <img src="{{ asset('images/'.$student->image) }}" alt="" height="80px">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="image">Receipt</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>                                
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
