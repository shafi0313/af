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
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card card-small mb-4">
                                <div class="card-body p-3">
                                    <form action="{{ route('admin.period_lock.update') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="field-label">A/c's Period Lock <span
                                                        class="text-danger">*</span></div>
                                                <input name="date" type="date"
                                                    value="{{ $period_lock->date ?? old('date') }}" required
                                                    class="form-control">
                                                @if ($errors->has('date'))
                                                    <div class="alert alert-danger">{{ $errors->first('date') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
