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
                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                    <div style="font-size:20px; color:#ff5733;">Cash Book: <span
                                            style="color:green;">{{ $office->name }}</span>
                                        <p style="font-size:16px; color:black; margin:0"><u>{{ $office->address }}</u>
                                        </p>
                                        <strong style="color:black;font-size:18px;">Form Date: {{ bdDate($start_date) }} To Date:
                                            {{ bdDate($end_date) }} </strong>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="color:green; text-align:center; ">Opening Balance </th>
                                                <th style="color:green; text-align:center;">
                                                    $ {{ number_format($open_balance = $openingBl->sum('credit') - $openingBl->sum('debit'), 2) }}
                                                </th>
                                                <th style="color:#ff5733; text-align:center; ">Total Received</th>
                                                <th style="color:#ff5733; text-align:center; ">
                                                    {{ number_format($cashBooks->sum('credit'), 2) }}
                                                </th>
                                                <th style="color:green; text-align:center; ">Total Payment</th>
                                                <th style="color:green; text-align:center; ">
                                                    {{ number_format($cashBooks->sum('debit'), 2) }}
                                                </th>
                                                <th style="color:#ff5733; text-align:center; ">Closing Balance</th>
                                                <th style="color:#ff5733; text-align:center;">
                                                    {{ number_format($open_balance + abs($cashBooks->sum('credit')) - abs($cashBooks->sum('debit')), 2) }}
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table id="" class="table" width="100%" border="1" cellspacing="5" cellpadding="5">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;" width="10%">Date</th>
                                                <th style="text-align:center;" width="20%">Student/Patient</th>
                                                <th style="text-align:center;" width="25%">Narration</th>
                                                <th style="text-align:center;" width="15%">Payment By</th>
                                                <th style="text-align:center;" width="11%">Payment</th>
                                                <th style="text-align:center;" width="11%">Received</th>
                                                <th style="text-align:center;" width="11%">Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $balance = 0; @endphp
                                            @foreach ($cashBooks as $cashBook)
                                                <tr>
                                                    <td align="center">{{ bdDate($cashBook->date) }}</td>
                                                    <td align="center">
                                                        @if ($cashBook->user_type == 1)
                                                            {{ $cashBook->student->student_name }}
                                                        @elseif($cashBook->user_type == 2)
                                                            {{ $cashBook->patient->name }}
                                                        @else
                                                             Received from bank
                                                        @endif
                                                    </td>
                                                    <td align="center">{{ $cashBook->narration }}</td>
                                                    <td align="center">{{ $cashBook->payment_by }}</td>
                                                    <td class="text-right">{{ number_format($cashBook->debit, 2) }}</td>
                                                    <td class="text-right">{{ number_format($cashBook->credit, 2) }}</td>
                                                    {{-- {{ $cashBook->credit }}<br>
                                                    {{ $cashBook->debit }}<br> --}}
                                                    @php
                                                        $sub = $cashBook->credit - $cashBook->debit;
                                                    @endphp
                                                    
                                                    <td class="text-right">{{ number_format($balance += $sub,2) }}</td>
                                                    {{-- <td class="text-right">{{ number_format($cashBook->credit - $cashBook->debit,2) }}</td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                            <tr>
                                                <td colspan="4" class="text-right" style="color:green; font-size:16px;">Total</td>
                                                <td class="text-right" style="color:green; font-size:16px;">
                                                    {{ number_format($cashBooks->sum('debit'), 2) }}
                                                </td>
                                                <td class="text-right" style="color:green; font-size:16px;">
                                                    {{ number_format($cashBooks->sum('credit'), 2) }}
                                                </td>
                                                <td class="text-right" style="color:green; font-size:16px;">
                                                    {{ number_format($cashBooks->sum('credit') - $cashBooks->sum('debit'), 2) }}
                                                </td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(function() {
            $('#data_table').DataTable({
                ordering: true,
                "lengthMenu": [[100, -1], [100, "All"]],
            });
        });
    </script>
@endsection
