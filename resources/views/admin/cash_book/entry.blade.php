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
                                    <div style="font-size:22px; color:#ff5733;">
                                        <u>Cash Book: <span style="color:green;">{{ $office->name }}</span></u>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-4" align="left">
                                    <strong style="font-size:16px; color:red;">Date: {{ now()->format('d/m/Y') }}</strong>
                                </div>
                                <div class="col-md-12">
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <table width="100%" border="1" cellspacing="5" cellpadding="5">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;" width="20%">Student & Patient</th>
                                                <th style="text-align:center;" width="20%">Narration and
                                                    Note</th>
                                                <th style="text-align:center;" width="6%">P/R Date</th>
                                                <th style="text-align:center;" width="11%">Payment</th>
                                                <th style="text-align:center;" width="11%">Received</th>
                                                <th style="text-align:center;" width="11%">Payment by</th>
                                                {{-- <th style="text-align:center;" width="11%">RL</th> --}}
                                                <th style="text-align:center;" width="2%">Action</th>
                                            </tr>
                                        </thead>
                                        <form id="entrydata" action="{{ route('admin.cash_book.store') }}" method="post"
                                            autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="cash_book_office_id" value="{{ $office->id }}">
                                            <tbody>
                                                <tr>
                                                    <td style="width:12%">
                                                        <select class="form-control" id="user" name="user" required>
                                                            @foreach ($students as $id => $student_name)
                                                                <option value="{{ $id }}s">{{ $student_name }}
                                                                </option>
                                                            @endforeach
                                                            @foreach ($patients as $id => $name)
                                                                <option value="{{ $id }}p">{{ $name }}
                                                                </option>
                                                            @endforeach
                                                            <option value="0">Received From Bank</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="narration"
                                                            onkeydown="return (event.keyCode!=13);" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="date" name="date" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            onkeydown="return (event.keyCode!=13);">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="payment"
                                                            onkeydown="return (event.keyCode!=13);" name="debit"
                                                            min="0" step="any">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="received"
                                                            onkeydown="return (event.keyCode!=13);" name="credit"
                                                            min="0" step="any">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            onkeydown="return (event.keyCode!=13);" name="payment_by">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                    </td>
                                                </tr>
                                                @foreach ($cashBooks as $cashBook)
                                                    <tr>
                                                        <td>{{ $cashBook->user_type == 1 ? $cashBook->student->student_name : $cashBook->patient->name ?? 'Received from bank' }}
                                                        </td>
                                                        <td>{{ $cashBook->narration }}</td>
                                                        <td>{{ bdDate($cashBook->date) }}</td>
                                                        <td>{{ $cashBook->debit }}</td>
                                                        <td>{{ $cashBook->credit }}</td>
                                                        <td>{{ $cashBook->payment_by }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('admin.cash_book.destroy', $cashBook->id) }}"
                                                                class="text-danger">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </form>
                                    </table>
                                </div>
                                
                                <div align="right" style="padding-top:20px;">
                                    <span>
                                        <button type="button" class="btn btn-primary btn-sm" data-backdrop="static"
                                            data-keyboard="false" data-toggle="modal" data-target="#myModal">NOTE of Cash
                                            Details.
                                        </button>
                                    </span>

                                    <span style="color:red;">&nbsp;&nbsp;Find your current closing balance please
                                        click save </span>
                                    <span style="color:green; font-size:18px; padding-right:100px;">
                                        Closing Balance: $
                                        {{ number_format($closingBl + $cashBooks->sum('debit') - $cashBooks->sum('credit'), 2) }}
                                    </span>
                                    <form action="{{ route('admin.cash_book.post') }}" method="post">
                                        @csrf
                                        @foreach ($cashBooks as $cashBook)
                                            {{-- <input type="hidden" name="user_id[]" value="{{ $cashBook->user_id }}">
                                            <input type="hidden" name="user_type[]" value="{{ $cashBook->user_type }}">
                                            <input type="hidden" name="debit[]" value="{{ $cashBook->debit }}">
                                            <input type="hidden" name="credit[]" value="{{ $cashBook->credit }}"> --}}
                                            
                                        @endforeach
                                        <input type="submit" value="Post" name="post" class="btn btn-primary">
                                    </form>
                                    {{-- <input type="submit" value="Save" name="save" class="btn btn-primary"> --}}
                                    
                                </div>
                                {{-- <div class="col-md-12">
                                    <table class="table">
                                        <tr>
                                            <th>Student & Patient</th>
                                            <th>Narration and Note</th>
                                            <th>P/R Date</th>
                                            <th>Payment</th>
                                            <th>Received</th>
                                            <th>Payment by</th>
                                            <th>Action</th>
                                        </tr>

                                    </table>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $('#payment').attr('disabled', 'disabled');
        $('#received').attr('disabled', 'disabled');
        $('#user').on('change', function() {
            var user = $(this).val();
            if (user == 0) {
                $('#payment').attr('disabled', 'disabled');
                $('#received').removeAttr('disabled');
            } else {
                $('#received').attr('disabled', 'disabled');
                $('#payment').removeAttr('disabled');
            }
        });
    </script>
    {{-- @push('script') --}}

    {{-- @endpush --}}
@endsection
