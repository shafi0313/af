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
                                <div class="col-lg-12 text-center">
                                    <div style="font-size:22px; color:#ff5733;"> <u>Cash Book :
                                            {{-- <span style="color:green;">{{$office->name}}</span></u> --}}
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-4" align="left">
                                    <strong style="font-size:16px; color:red;">Date: {{ now()->format('d/m/Y') }}</strong>
                                </div>
                                <div class="col-md-12">
                                    <table width="100%" border="1" cellspacing="5" cellpadding="5">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;" width="20%">Student & Patient</th>
                                                <th style="text-align:center;" width="20%">Narration and
                                                    Note</th>
                                                <th style="text-align:center;" width="6%">P/R Date</th>
                                                <th style="text-align:center;" width="11%">Payment</th>
                                                <th style="text-align:center;" width="11%">Received</th>
                                                <th style="text-align:center;" width="11%">Payment  by</th>
                                                {{-- <th style="text-align:center;" width="11%">RL</th> --}}
                                                <th style="text-align:center;" width="2%">Action</th>
                                            </tr>
                                        </thead>
                                        <form id="entrydata" action="{{ route('admin.cash_book.store') }}" method="post"
                                            autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="cash_office_id" id="cash_office_id"
                                                value="{{ $office }}">
                                            <tbody>
                                                <tr>
                                                    <td style="width:12%">
                                                        <select class="form-control" id="account_name" name="chart_id" required>
                                                            @foreach ($students as $id => $student_name)
                                                                <option value="{{ $id }}">{{ $student_name }}</option>
                                                            @endforeach
                                                            @foreach ($patients as $id => $name)
                                                                <option value="{{ $id }}">{{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="narration"
                                                            onkeydown="return (event.keyCode!=13);" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" onkeydown="return (event.keyCode!=13);">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control price" id="payment"
                                                            onkeydown="return (event.keyCode!=13);" name="payment"
                                                            onfocusout="gstCal(this.value)" min="0" step="any">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="recevied"
                                                            onkeydown="return (event.keyCode!=13);" name="recevied"
                                                            disabled="disabled" onfocusout="gstCal(this.value)"
                                                            min="0" step="any">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="inventory"
                                                            onkeydown="return (event.keyCode!=13);" name="inventory">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </form>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    {{-- @push('script') --}}

    {{-- @endpush --}}
@endsection
