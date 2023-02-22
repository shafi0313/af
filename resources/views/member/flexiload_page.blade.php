@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
      

        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-4 mb-sm-0">
                <span class="text-uppercase page-subtitle">Mobile Recharge</span>
                <h5 class="" style="font-size: 18px;">Recharge to any mobile number of bangladesh <span style="font-weight: 900; color: green;"> Wallet : ${{ number_format($member_details->s_wallet,2) }} or BDT {{ number_format($member_details->s_wallet * 90,2) }}</span> &nbsp; &nbsp; 

                     </h5>
            </div>
            <div class="col-12 col-sm-4 d-flex align-items-center">
                <div class="d-inline-flex mb-sm-0 mx-auto ml-sm-auto mr-sm-0" role="group" aria-label="Page actions">
                    <a id="add-new-event" role="button" href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="material-icons">add</i> Mobile Recharge </a>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">                       
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">No</th>                                   
                                    <th scope="col" class="border-0">Amount</th>                                    
                                    <th scope="col" class="border-0">Number</th>                    
                                    <th scope="col" class="border-0">Date</th>                 
                                </tr>
                                </thead>    
                                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </main>

    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 17px; display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">               
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mobile Recharge</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                   
                    <div class="modal-body">                     
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                  <select name="preOrpostPaid" id="preOrpostPaid"  class="form-control border" required="required">
                                        <option value="">Select Sim Type</option>
                                        <option value="0">Prepaid</option>
                                        <option value="1">Postpaid</option>
                                    </select>
                            </div>
                            <div class="form-group col-md-6">
                                  <input type="text" required="required" class="form-control border" placeholder="Enter mobile number" aria-label="Add new category" name="number" id="number" aria-describedby="basic-addon2">       
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">                             
                                 <input type="text" class="form-control border" placeholder="Enter Amount (In taka)"  aria-label="Add new category" id="subcategory" aria-describedby="basic-addon2">
                            </div>
                            <div class="form-group col-md-6">
                                 <input type="password" required="required" class="form-control border" placeholder="Enter Transaction password" aria-label="Add new category" name="tran_password" id="tran_password" aria-describedby="basic-addon2">   
                            </div>                   
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="AddSubcategory">Save</button>
                    </div>
                
            </div>
        </div>
    </div>


    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#AddSubcategory').click(function () {
                let user_id = $('#CategoryId').val(), preOrpostPaid = $('#preOrpostPaid').val(), amount = $('#subcategory').val(), number = $('#number').val(), tran_password = $('#tran_password').val();
                if (user_id != '' && amount != '' && tran_password != '' && number != '') {
                     $('#AddSubcategory').prop('disabled',true);
                     $('this').find('i').toggleClass('fa fa-spinner fa-spin');   
                    $.ajax({
                        url: "{{ url('member/flexiload_action') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, amount: amount, user_id: user_id, preOrpostPaid: preOrpostPaid, tran_password: tran_password, number: number},
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
                                    title: 'Mobile recharge is succesfull'
                                })
                                $('#subcategory').val('');
                                $('#number').val('');
                                $('#CategoryId').val('');                                
                                $("#exampleModal").css("display", "none");
                                $('.selectpicker').selectpicker('refresh');
                                $('#AddSubcategory').prop('disabled',false);
                                table.ajax.reload();
                            } else if (response == 2) {
                                Swal.fire(
                                    'Minimum recharge Amount is 10 tk.',
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
                            }else if (response == 4) {
                                Swal.fire(
                                    'Same Entry between 2 mins. Please wait 2 min',
                                    '',
                                    'warning'
                                )
                                table.ajax.reload();                            
                                $('#AddSubcategory').prop('disabled',false);
                                $('#tran_password').val('');
                                $('#CategoryId').val('');
                                $('#subcategory').val('');

                            }else if (response == 3) {
                                Swal.fire(
                                    'Insufficiant balance. Contact with admin',
                                    '',
                                    'warning'
                                )
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
                ajax: "{{ url('member/flexiload_view') }}",
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'amount'},                   
                    {data: 'given_to'},                         
                    {data: 'date'}                 
                ]
            });
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
