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
                    {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Centre/office</button> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-lg-12 text-center">
                                    <div style="font-size:22px; color:#ff5733;">
                                        <u>Cash Book: <span style="color:green;">{{ $office->name }}</span></u>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12" style="display:flex; justify-content: space-between;">
                                    <div style="font-size:15px; color:red;">Date: {{ now()->format('d/m/Y') }}</div>
                                    <div style="font-size:18px; color:red;">Opening Balance: $ {{ $openingBl }}</div>
                                    <div style="visibility:hidden">Opening Balance: $ </div>
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
                                                            <option value="0e">Office Expense</option>
                                                            <option value="0">Received From Bank</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="narration"
                                                            onkeydown="return (event.keyCode!=13);" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="date" name="date" class="form-control"
                                                            value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
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
                                                            onkeydown="return (event.keyCode!=13);" name="payment_by"
                                                            id="payment_by">
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

                                <div class="col-md-12 text-center" style="padding-top:20px;">
                                    {{-- <span>
                                        <button type="button" class="btn btn-primary btn-sm" data-backdrop="static"
                                            data-keyboard="false" data-toggle="modal" data-target="#myModal">NOTE of Cash
                                            Details.
                                        </button>
                                    </span> --}}

                                    {{-- <span style="color:red;">&nbsp;&nbsp;Find your current closing balance please
                                        click save </span> --}}
                                    <span style="color:green; font-size:18px; padding-right:100px;">
                                        Closing Balance: $
                                        {{ number_format($openingBl + $cashBooks->sum('credit') - $cashBooks->sum('debit'), 2) }}
                                    </span>

                                </div>
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-info mr-3" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Note
                                    </button>
                                    <form action="{{ route('admin.cash_book.post') }}" method="post">
                                        @csrf
                                        <input type="submit" value="Post" name="post" class="btn btn-warning"
                                            style="width:150px">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Note of cashbook details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.cash_book.note_store') }}">
                    <div class="modal-body">

                        <textarea name="note" cols="30" rows="10" class="form-control" placeholder="Add your note">{{ $cashbookNote->note ?? '' }}</textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#payment').attr('disabled', 'disabled');
        $('#received').attr('disabled', 'disabled');
        $('#user').on('change', function() {
            var user = $(this).val();
            if (user == 0) {
                $('#payment').attr('disabled', 'disabled');
                $('#received').removeAttr('disabled');
                $('#payment_by').removeAttr('required');
            } else {
                $('#payment_by').attr('required', 'required');
                $('#received').attr('disabled', 'disabled');
                $('#payment').removeAttr('disabled');
            }
        });
    </script>
@endsection
