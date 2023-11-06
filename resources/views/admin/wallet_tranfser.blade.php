@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-8 text-center text-sm-left mb-4 mb-sm-0">
                    <span class="text-uppercase page-subtitle">Yearly Fund Request</span>
                </div>
                <div class="col-12 col-sm-4 d-flex align-items-center">
                    <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                        <a id="add-new-event" role="button" href="#" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal">
                            <i class="material-icons">add</i> Request </a>
                    </div>
                </div>
            </div>

            <div class="row">                
                <div class="col">
                    <div class="card card-small mb-4">
                        @if (Session::has('msg'))
                            <p class="alert {{ Session::get('class') }}">{{ Session::get('msg') }}</p>
                        @endif

                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="border-0">No</th>
                                        <th scope="col" class="border-0">Student Name</th>
                                        <th scope="col" class="border-0">Requested Amount</th>
                                        <th scope="col" class="border-0">Approved Amount</th>
                                        <th scope="col" class="border-0">Total Paid</th>
                                        <th scope="col" class="border-0">Year</th>
                                        <th scope="col" class="border-0">Status</th>
                                        <th scope="col" class="border-0">Created</th>
                                        <th scope="col" class="border-0">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    


    <div class="modal fade abc" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel"
        style="padding-right: 17px; display: none;">
        <div class="modal-dialog modal-dialog-centered modal-lg" role=" document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Yearly Fund Request </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $product = DB::table('expenses')
                            ->orderby('id', 'asc')
                            ->get();
                        $users = DB::table('users')
                            ->orderby('id', 'desc')
                            ->get();
                    @endphp
                    <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left"
                        id="loadingId" action="{{ url('admin/approve_amnt_req') }}">
                        @csrf
                        <div style="padding:10px;">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <select name="student_id" class="form-control border rounded float-right select2single"
                                        required id="CategoryId" data-live-search="true" autocomplete="off">
                                        <option value="">Select Student</option>
                                        @foreach ($users as $v)
                                            <option value="{{ $v->id }}" monthly_fee="{{ $v->fee }}"
                                                admission_fee="{{ $v->admission_fee }}"
                                                board_reg_fee="{{ $v->board_reg_fee }}"
                                                book_purchase="{{ $v->book_purchase }}" exm_fee1="{{ $v->exm_fee1 }}"
                                                exm_fee2="{{ $v->exm_fee2 }}" exm_fee3="{{ $v->exm_fee3 }}">
                                                {{ $v->student_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="year" class="form-control border rounded float-right select2single"
                                        required>
                                        <option value="">Select Year</option>
                                        @php
                                            $current_year = date('Y') - 1;
                                        @endphp
                                        @for ($i = $current_year; $i < $current_year + 90; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <table id="customers" style="width: 100%">
                                    <thead>
                                        <tr width="100%">
                                            <td width="80%" align="center">Expense Name</td>
                                            <td width="10%" align="center">Application Amount</td>
                                            <td width="10%" align="center">Recommendation Amount</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($product as $v)
                                            <input type="hidden" name="expense[]" value="{{ $v->id }}" />
                                            <tr>
                                                <td class="serial" align="center" style="color:#0909EC;">
                                                    {{ $v->name }}</td>
                                                <td align="center"><input type="text" readonly
                                                        data-idd="{{ $v->id }}" value="" />
                                                </td>
                                                <td align="center"><input type="text" required
                                                        class="applynow input-sm applynow_{{ $v->id }}"
                                                        name="quantity[]" data-id="{{ $v->id }}"
                                                        id="applynow" /></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td align="right"> Total </td>
                                            <td class="text-left ttl"> </td>
                                            <td class="text-left sub-total"></td>
                                            <input type="hidden" name="grand_total" id="total_amount_pay_amount" />
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Yearly fund request modal --}}
    <div class="modal fade" id="yearlyFundRequestModal" tabindex="-1" role="dialog" aria-labelledby="yearlyFundRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="yearlyFundRequestModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table2">
                <thead>
                    <tr>
                        <th>Request Amount</th>
                        <th>Approved Amount</th>
                    </tr>
                </thead>              
                <tbody></tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    {{-- Yearly fund request modal --}}
    <script>
        $("#CategoryId").on('change', function() {

            let admission_fee = $('#CategoryId option:selected').attr('admission_fee');
            $('input[data-idd="1"]').val(admission_fee);

            let board_reg_fee = $('#CategoryId option:selected').attr('board_reg_fee');
            $('input[data-idd="2"]').val(board_reg_fee);

            let book_purchase = $('#CategoryId option:selected').attr('book_purchase');
            $('input[data-idd="3"]').val(book_purchase);

            let monthly_fee = $('#CategoryId option:selected').attr('monthly_fee');
            $('input[data-idd="4"]').val(monthly_fee);

            let exm_fee1 = $('#CategoryId option:selected').attr('exm_fee1');
            $('input[data-idd="5"]').val(exm_fee1);

            let exm_fee2 = $('#CategoryId option:selected').attr('exm_fee2');
            $('input[data-idd="6"]').val(exm_fee2);

            let exm_fee3 = $('#CategoryId option:selected').attr('exm_fee3');
            $('input[data-idd="7"]').val(exm_fee3);

            let a = parseFloat(admission_fee) + parseFloat(board_reg_fee) + parseFloat(book_purchase) + parseFloat(
                monthly_fee * 12) + parseFloat(exm_fee1) + parseFloat(exm_fee2) + parseFloat(exm_fee3);
            $('.ttl').text(a);
        });

        $(".applynow").on('keyup', function() {
            serialMaintain();
        });

        function serialMaintain(net_amount) {
            var i = 1;
            var subtotal = 0;
            $('.serial').each(function(key, element) {

                var data_id = $(element).parents('tr').find('input[name="quantity[]"]').attr('data-id');
                if (data_id == 4) {
                    var total = $(element).parents('tr').find('input[name="quantity[]"]').val() * 12;
                } else {
                    var total = $(element).parents('tr').find('input[name="quantity[]"]').val();
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
                                    title: 'Wait for admin aproval'
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
                                    'Amount is insufficiant.',
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
                        data: 'accmulative_amnt'
                    },
                    {
                        data: 'year'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
            $('.selectpicker').selectpicker();
        });

        $(document).ready(function() {
            // Attach click event handler to elements with class 'yearlyFundRequest'
            $(document).on('click', '.yearlyFundRequest', function() {
                $('#yearlyFundRequestModal').modal('show');
                // Get the record's ID via attribute
                var id = $(this).attr('data-id');                
                $.ajax({
                    url: "{{ route('admin.agent_with_report.show') }}",
                    type: 'get',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function(res) {
                        console.log(res);
                        let html = '';
                        let reqAmnt = 0;
                        let aprvAmnt = 0;
                         
                        $.each(res, function(key, value) {
                            reqAmnt += value.req_amnt
                            aprvAmnt += value.aprv_amnt
                            html += '<tr">';
                            html += '<td>' + value.req_amnt + '</td>';                            
                            html += '<td>' + value.aprv_amnt + '</td>'; 
                            html += '</tr>';                                                      
                        });
                        html += '<tr>';
                            html += '<td>'  + reqAmnt +'</td>';                          
                            html += '<td>'  + aprvAmnt +'</td>';                          
                        html += '</tr>';                         
                        $('#yearlyFundRequestModal table tbody').html(html);
                    }
                });
            });
        });
    </script>
@endsection
