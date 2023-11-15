@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>


    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Requested Payment Approval</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.request-payment-approval.update',$RPApproval->id) }}" method="post" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <input type="hidden" name="id" id="id" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Students</label>
                                        <select name="type" class="form-control select2single" required="required">
                                            <option value="">Select Students</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}" @selected($RPApproval->type == $student->id)>{{ $student->student_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Total Approved Amount</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ $RPApproval->title }}" placeholder="Enter Amount" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Recept Date</label>
                                        <input type="date" class="form-control" name="recept_date"
                                            value="{{ $RPApproval->recept_date }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Month</label>
                                        <input type="text" class="form-control" name="month"
                                            value="{{ $RPApproval->month }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Monthly Fee Amount</label>
                                        <input type="text" class="form-control" name="monthly_fee_amount"
                                            value="{{ $RPApproval->monthly_fee_amount }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Year</label>
                                        <input type="text" class="form-control" name="year" id="year"
                                            value="{{ $RPApproval->year }}" required>
                                    </div>
                                    <div class="col-md-6 my-3">
                                        <a href="{{ asset('images/' . $RPApproval->image) }}" target="_blank">
                                            <img src="{{ asset('images/' . $RPApproval->image) }}" alt="Image" width="100px">
                                        </a>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="col-md-12 py-2">
                                        <label for="" class="form-control-label">Description</label>
                                        <textarea class="emptydetails form-control" name="long_details" id="summernote" placeholder="Description">{!! $RPApproval->long_details !!}</textarea>
                                    </div>                                    
                                </div>                                
                                <div class="text-center border-top" >
                                    <button type="submit" class="btn btn-primary w-25 mt-4 addProduct">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $('#summernote').summernote({
            placeholder: 'Enter your details',
            tabsize: 3,
            height: 200
        });
    </script>
@endsection
