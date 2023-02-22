@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 text-center text-sm-left mb-0">
                  
                </div>
            </div>


            <style>
                #customers {
                  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
                }

                #customers td, #customers th {
                  border: 1px solid #ddd;
                  padding: 8px;
                }

                #customers tr:nth-child(even){background-color: #f2f2f2;}

                #customers tr:hover {background-color: #ddd;}

                #customers th {
                  padding-top: 12px;
                  padding-bottom: 12px;
                  text-align: center;
                  background-color: #4CAF50;
                  color: white;
                }
                </style>

            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <div class="row">
                                <div class="col-12" align="center">
                                    <h5 class="">Point Convert to dollar</h5>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card-body p-0 text-center ">
                            <table id="customers">
                          <tr>                        
                            <th>Type</th>
                            <th>Points</th>
                            <th>Action</th>                         
                          </tr>
                          <tr>  
                            <td>Provinded Fund</td>                      
                            <td>{{ $member_details->providend_fund_point }}</td>
                            <td>
                                @if($member_details->providend_fund_point  == 10000)
                                <button type="button" class="btn btn-primary providend_fund" id="1"><i class="material-icons">done_outline</i></button>
                                 @endif()
                            </td>  
                           </tr>
                          <tr>  
                            <td>Tour Fund</td>                      
                            <td>{{ $member_details->tour_fund_point }}</td>
                            <td>
                                @if($member_details->tour_fund_point  == 10000)          
                                <button type="button" class="btn btn-primary tour_fund_point" id="2"><i class="material-icons">done_outline</i></button>
                                @endif()
                            </td>  
                           </tr>
                          <tr>  
                            <td>Yearly Incentive Point</td>                      
                            <td>{{ $member_details->yrly_inctv_fund_point }}</td>
                            <td>
                              @if($member_details->yrly_inctv_fund_point  == 10000)
                            <button type="button" class="btn btn-primary tour_fund_point" id="3"><i class="material-icons">done_outline</i></button>
                            @endif()
                            </td>  
                           </tr>
                           <tr>  
                            <td>International Point</td>                      
                            <td>{{ $member_details->int_point_wallet }}</td>
                            <td>
                              @if($member_details->int_point_wallet  == 10000)
                            <button type="button" class="btn btn-primary int_point_wallet" id="4"><i class="material-icons">done_outline</i></button>
                            @endif()
                            </td>  
                           </tr>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#AddSubcategory').click(function () {
                let amount = $('#subcategory').val();
                if (amount != '') {
                    $.ajax({
                        url: "{{ url('member/wallet-move-success') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, amount: amount},
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
                                table.ajax.reload();
                            } else if (response == 2) {
                                Swal.fire(
                                    'Minimum move Amount is $5 & Maximum $50.',
                                    '',
                                    'warning'
                                )
                            } else {
                                Swal.fire(
                                    //response,
                                    'Amount is insufficiant.',
                                    'warning'
                                )
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
                ajax: "{{ url('member/move_trn_bal') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_id'},                   
                    {data: 'email'},
                    {data: 'mobile'},
                    {data: 'amount'},
                    {data: 'date'},                    
                    {data: 'action'}                 
                ]
            });
            $('.selectpicker').selectpicker();
        });



    </script>

@endsection
