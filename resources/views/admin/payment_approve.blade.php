@extends('admin.layout.app')

@section('content')

    @include('admin.inc.sidebar')
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">add Request</span>                 
            </div>
        </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                    @if(Session::has('msg'))
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

    <div class="modal fade abc" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 17px; display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">               
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Stipend fund Request </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                   
                    <div class="modal-body">                     
                                                
                    @php
                        $product = DB::table('expenses')->orderby('id','asc')->get();
                        $users = DB::table('users')->orderby('id','desc')->get();
                    @endphp                     
                    <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" id="loadingId" action="{{  url('admin/approve_amnt_req')  }}" /> 
                        @csrf
                            <div style="padding:10px;">
                                <div class="row">
                                <div class="form-group col-md-6">
                                        <select name="student_id" class="selectpicker border rounded float-right" required id="CategoryId" data-live-search="true" autocomplete="off">
                                            <option value="">Select Student</option>     
                                                @foreach($users as $v)                
                                                <option value="{{$v->id}}">{{$v->student_name}}</option>  
                                                @endforeach                       
                                        </select>
                                    </div>

                                <table id="customers">
                                    <thead>
                                    <tr>
                                        <td width="60%" align="center">Expense Name</td>                                      
                                        <td width="40%" align="center">Request Amount</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product as $v)
                                    <input type="hidden" name="expense[]" value="{{ $v->id }}" />
                                    <tr>
                                        <td class="serial" align="center" style="color:#0909EC;">{{ $v->name }}</td>
                                        <td align="center" ><input type="number" required class="applynow input-sm applynow_{{ $v->id }}" name="quantity[]" id="applynow" /></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td align="right">Total </td>
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
    <script>

    $(".applynow").on('keyup', function(){
        serialMaintain();
    });
    
    function serialMaintain(net_amount){
        var i = 1;
        var subtotal = 0;
                $('.serial').each(function(key, element) {                   
                    var total   = $(element).parents('tr').find('input[name="quantity[]"]').val();
                    subtotal    += +total;
                    i++;
                });
            $('.sub-total').html(subtotal);
            $('#total_amount_pay_amount').val(subtotal);
    };
    
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#AddSubcategory').click(function () {
                let user_id = $('#CategoryId').val(), amount = $('#subcategory').val(), wallet_type = $('#wallet_type').val();
                if (user_id != '' && amount != '' &&  wallet_type != '') {
                     $('#AddSubcategory').prop('disabled',true);
                    $.ajax({
                        url: "{{ url('admin/approve_amnt_req') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, amount: amount, user_id: user_id, wallet_type: wallet_type},
                        success: function (response) {
                            if(response == 1) {
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
                                $('#AddSubcategory').prop('disabled',false);
                                table.ajax.reload();
                            } else if (response == 2) {
                                Swal.fire(
                                    'Minimum Transfer Amount is 500 tk.',
                                    '',
                                    'warning'
                                )
                                table.ajax.reload();                            
                                $('#AddSubcategory').prop('disabled',false);
                                $('#tran_password').val('');
                                $('#CategoryId').val('');
                                $('#subcategory').val('');
                            }else if (response == 5) {
                                Swal.fire(
                                    'Transaction password is wrong.',
                                    '',
                                    'warning'
                                )
                                table.ajax.reload();                            
                                $('#AddSubcategory').prop('disabled',false);
                                $('#tran_password').val('');
                                $('#CategoryId').val('');
                                $('#subcategory').val('');
                            }else if (response == 11) {
                               
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
                                $('#AddSubcategory').prop('disabled',false);
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
                                $('#AddSubcategory').prop('disabled',false);
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
            $(function () {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                ajax: "{{ url('admin/agent_with_report2') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'student_name'},
                    {data: 'req_amnt'},                   
                    {data: 'aprv_amnt'},                    
                    {data: 'accmulative_amnt'},                    
                 
                    {data: 'year'},     {data: 'status'},  
                    {data: 'created_at'},
                    {data: 'action'}
                    
                ]
            });
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
