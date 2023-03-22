@extends('admin.layout.app')

@section('content')
    @include('admin.inc.sidebar')
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-8 text-center text-sm-left mb-4 mb-sm-0">
                    <span class="text-uppercase page-subtitle">Approve Amount</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        @if (Session::has('msg'))
                            <p class="alert {{ Session::get('class') }}">{{ Session::get('msg') }}</p>
                        @endif
                        <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left"
                            id="loadingId" action="{{ url('admin/approve_amnt_req2') }}" >
                        @csrf
                        <input type="hidden" value="{{ $order->id }}" name="id">
                        <div style="padding:10px;">
                            <h4> Student Name : {{ $student->student_name }}</h4>
                            <h4> Attendence Year : {{ $order->year }}</h4>
                            <div class="row">
                                <table id="customers">
                                    <thead>
                                        <tr>
                                            <td width="60%" align="center">Expense Name</td>
                                            <td width="40%" align="center">Request Amount</td>
                                            <td width="40%" align="center">Approve Amount</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total =0;  @endphp
                                        @foreach ($order_d as $v)
                                            @php
                                                $product = DB::table('expenses')
                                                    ->where('id', $v->ex_id)
                                                    ->first(); 
                                                    $monthlyFee = $order_d->where('ex_id',4)->sum('req_amnt') * 12;
                                                    $total = $order_d->where('ex_id','!=',4)->sum('req_amnt') + $monthlyFee;
                                            @endphp
                                            @if ($v->id != 32)
                                                @php   $total = $total + $v->req_amnt;  @endphp
                                            @else
                                                @php   $total = $total + $v->req_amnt * 12;  @endphp
                                            @endif
                                            <input type="hidden" name="expense[]" value="{{ $v->id }}" />
                                            <tr>
                                                <td class="serial" align="center" style="color:#0909EC;">{{ $product->name }}</td>
                                                <td align="center">
                                                    <input type="number" readonly required class="input-sm" value="{{ $v->req_amnt }}" name="quantity[]" id="applynow" />
                                                </td>
                                                <td align="center">
                                                    <input type="number" required class="applynow input-sm applynow_{{ $v->id }}"
                                                        data-id="{{ $v->ex_id }}" name="approve[]" id="approve" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td align="left">Total </td>
                                            <td align="left">{{ $total }} </td>
                                            <td align="left" class="sub-total"></td>
                                            <input type="hidden" name="grand_total" id="total_amount_pay_amount" />
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div> <button type="submit" class="btn btn-primary" id="">Save</button>
                    </div>
                    </form>
                </div>

                <script>
                    $(".applynow").on('keyup', function() {
                        serialMaintain();
                    });

                    function serialMaintain(net_amount) {
                        var i = 1;
                        var subtotal = 0;
                        $('.serial').each(function(key, element) {
                            var data_id = $(element).parents('tr').find('input[name="approve[]"]').attr('data-id');
                            if (data_id == 4) {
                                var total = $(element).parents('tr').find('input[name="approve[]"]').val() * 12;
                            } else {
                                var total = $(element).parents('tr').find('input[name="approve[]"]').val();
                            }
                            subtotal += +total;
                            i++;
                        });
                        $('.sub-total').html(subtotal);
                        $('#total_amount_pay_amount').val(subtotal);
                    };

                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $(document).ready(function() {
                        $(document).on('click', '.closer', function() {
                            $('.collapse').collapse('hide');
                        });
                        $('#AddSubcategory').click(function() {
                            let user_id = $('#CategoryId').val(),
                                amount = $('#subcategory').val(),
                                wallet_type = $('#wallet_type').val();
                            if (user_id != '' && amount != '' && wallet_type != '') {
                                $('#AddSubcategory').prop('disabled', true);
                                $.ajax({
                                    url: "{{ url('admin/approve_amnt_req') }}",
                                    type: 'post',
                                    data: {
                                        _token: CSRF_TOKEN,
                                        amount: amount,
                                        user_id: user_id,
                                        wallet_type: wallet_type
                                    },
                                    success: function(response) {
                                        if (response == 1) {
                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'top-end',
                                                showConfirmButton: false,
                                                timer: 3000
                                            });

                                            Toast.fire({
                                                type: 'success',
                                                title: 'Wait for admin approval'
                                            })
                                            $('#subcategory').val('');
                                            $('#CategoryId').val('');
                                            $('.selectpicker').selectpicker('refresh');
                                            $('#AddSubcategory').prop('disabled', false);
                                            table.ajax.reload();
                                        } else if (response == 2) {
                                            Swal.fire(
                                                'Minimum Transfer Amount is 500 tk.',
                                                '',
                                                'warning'
                                            )
                                            table.ajax.reload();
                                            $('#AddSubcategory').prop('disabled', false);
                                            $('#tran_password').val('');
                                            $('#CategoryId').val('');
                                            $('#subcategory').val('');
                                        } else if (response == 5) {
                                            Swal.fire(
                                                'Transaction password is wrong.',
                                                '',
                                                'warning'
                                            )
                                            table.ajax.reload();
                                            $('#AddSubcategory').prop('disabled', false);
                                            $('#tran_password').val('');
                                            $('#CategoryId').val('');
                                            $('#subcategory').val('');
                                        } else if (response == 11) {

                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'top-end',
                                                showConfirmButton: false,
                                                timer: 3000
                                            });

                                            Toast.fire({
                                                type: 'success',
                                                title: 'Fund Inserted successfully'
                                            })
                                            table.ajax.reload();
                                            $('#AddSubcategory').prop('disabled', false);
                                            $('#tran_password').val('');
                                            $('#CategoryId').val('');
                                            $('#subcategory').val('');

                                        } else {
                                            Swal.fire(
                                                //response,
                                                'Amount is insufficient.',
                                                'warning'
                                            )
                                            table.ajax.reload();
                                            $('#AddSubcategory').prop('disabled', false);
                                            $('#tran_password').val('');
                                            $('#CategoryId').val('');
                                            $('#subcategory').val('');
                                        }
                                    }
                                });
                            } else {
                                Swal.fire('Input field empty')
                            }
                        });
                        $(function() {
                            table.ajax.reload();
                        });
                        let table = $('.table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ url('admin/agent_with_report') }}",
                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex'
                                },
                                {
                                    data: 'student_name'
                                },
                                {
                                    data: 'req_amnt'
                                },
                                {
                                    data: 'aprv_amnt'
                                },
                                {
                                    data: 'status'
                                },
                                {
                                    data: 'created_at'
                                },
                                {
                                    data: 'updated_at'
                                }
                            ]
                        });
                        $('.selectpicker').selectpicker();
                    });
                </script>
            @endsection
