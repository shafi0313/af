@extends('asset')
@section('content')
    <section class="inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 sec-title colored text-center">
                    <h2>চিকিৎসা ভাতার আবেদন</h2>
                    <ul class="breadcumb">
                        <li><a href="index.html">Home</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><span>আবেদন ফরম</span></li>
                    </ul>
                    <span class="decor"><span class="inner"></span></span>
                </div>
            </div>
        </div>
    </section>
    <section class="donation-section">
        <div class="container">
            <h2 class="text-thm" align="center">আবেদন ফরম</h2>
            <div class="donation-form-outer">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('frontend.patient.store') }}" enctype="multipart/form-data">
                    @csrf @method('POST')
                    <!--Form Portlet-->
                    <div class="form-portlet">
                        <div class="row clearfix">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">রোগীর নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="রোগীর নামঃ" value="{{ old('name') }}"
                                    name="name">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পিতার নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="পিতার নাম" value="{{ old('f_name') }}"
                                    name="f_name">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">মাতার নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="মাতার নাম" value="{{ old('m_name') }}"
                                    name="m_name">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">বিভাগ <span class="required">*</span></div>
                                <select name="division_id" id="division_id" required>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('division_id'))
                                    <div class="alert alert-danger">{{ $errors->first('division_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">জেলাঃ <span class="required">*</span></div>
                                <select name="district_id" id="district" required>
                                    <option value="{{ old('name') }}">নির্বাচন করুন</option>
                                </select>
                                @if ($errors->has('district_id'))
                                    <div class="alert alert-danger">{{ $errors->first('district_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">থানাঃ <span class="required">*</span></div>
                                <select name="upazila_id" id="thana" required>
                                    <option value="">নির্বাচন করুন</option>
                                </select>
                                @if ($errors->has('upazila_id'))
                                    <div class="alert alert-danger">{{ $errors->first('upazila_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">গ্রামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="গ্রাম" value="{{ old('village') }}"
                                    name="village">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পোস্টঃ অফিসঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="পোস্ট অফিস" value="{{ old('post') }}"
                                    name="post">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">মোবাইল নাম্বারঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Mobile number"
                                    value="{{ old('phone') }}" name="phone">
                                @if ($errors->has('phone'))
                                    <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">জরুরী কন্টাক্ট নাম্বারঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Important contact number"
                                    value="{{ old('e_phone') }}" name="e_phone">
                                @if ($errors->has('e_phone'))
                                    <div class="alert alert-danger">{{ $errors->first('e_phone') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">আর্থিক অবস্থার বর্ণনাঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="আর্থিক অবস্থার বর্ণনা"
                                    value="{{ old('finance') }}" name="finance">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">হাসপাতালের নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="হাসপাতালের নাম"
                                    value="{{ old('hospital') }}" name="hospital">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ডাক্তারের নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ডাক্তারের নাম"
                                    value="{{ old('doctor') }}" name="doctor">
                            </div>
                        </div>

                        <div class="row mx-auto">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ওষুধের নাম <span class="t_r">*</span></th>
                                            <th>মূল্য <span class="t_r">*</span></th>
                                            <th style="width: 20px;text-align:center;font-size:25px">
                                                <a href="javascript:;">
                                                    <i class="fas fa-mouse"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td><input type="text" id="medicine" data-type="product"
                                                class="form-control" style="" placeholder="Medicine name" /></td>
                                        <td><input type="text" id="price" data-type="price" class="form-control"
                                                style="" placeholder="Price" /></td>
                                        <td><button class="btn btn-success btn-sm add_btn" type="button">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-bordered table-hover product_table ">
                                    <thead class="text-center" style="font-size: 15px;">
                                        <tr>
                                            <th width="10px">SN</th>
                                            <th>ঔষধের নাম:</th>
                                            <th>মূল্য:</th>
                                            <th width="30px"><a href="#"><i class="fa-solid fa-eraser"></i></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <style>
                                        tfoot tr td {
                                            text-align: right;
                                            font-size: 16px;
                                            font-weight: bold
                                        }
                                    </style>
                                    <tfoot id="totalamount">
                                        <tr>
                                            <th colspan="2" class="text-right">Total:</th>
                                            <th class="text-right sub-total">0.00 </th>
                                            <th><input type="hidden" name="total_amt" id="total_amount"></th>
                                        </tr>
                                        {{-- <tr>
                                            <td colspan="6">Discount:</td>
                                            <td colspan="2"><input required type="number" id="discountAmt" step="any" name="discount" class="form-control form-control-sm" style="width:50%; display:inline-block"><input style="width:50%;display:inline-block" type="number" name="discount_amt" id="discountTk" step="any" class="form-control form-control-sm"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Net Payable:</td>
                                            <td colspan="2"><input type="number" id="net_amt" step="any" name="net_amt" class="form-control form-control-sm" readonly><span id="credit_limit_m" class="text-danger"></span></td>
                                        </tr> --}}
                                    </tfoot>
                                </table>
                            </div>
                        </div>



                        <div class="row">
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ঔষধের মূল্য ১ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ১" value="{{ old('name') }}"
                                    name="admission_fee">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ঔষধের মূল্য ২ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ২" value="{{ old('name') }}"
                                    name="board_reg_fee">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ঔষধের মূল্য ৩ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৩" value="{{ old('name') }}"
                                    name="book_purchase">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ঔষধের মূল্য ৪ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৪" value="{{ old('name') }}"
                                    name="fee">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ঔষধের মূল্য ৫ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৫" value="{{ old('name') }}"
                                    name="exm_fee1">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ঔষধের মূল্য ৬ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৬" value="{{ old('name') }}"
                                    name="exm_fee2">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ঔষধের মূল্য ৭ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৭" value="{{ old('name') }}"
                                    name="exm_fee3">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ঔষধের মূল্য ৮ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৮" value="{{ old('name') }}"
                                    name="member">
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পরিবারের সর্বমোট মাসিক আয়ঃ <span class="required">*</span></div>
                                <input type="number" required="" placeholder="পরিবারের সর্বমোট মাসিক আয়"
                                    value="{{ old('total_income') }}" name="total_income">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">রোগীর ছবিঃ <span class="required">*</span></div>
                                <input type="file" required="" name="patient_img">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ভোটার আইডি কার্ড </div>
                                <input type="file" name="nid">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ডাক্তার প্রদত্ত চিকিৎসা পত্র : <span class="required">*</span>
                                </div>
                                <input type="file" required="" name="prescription">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">চেয়ারম্যান প্রদত্ত চারিত্রিক সনদঃ <span class="required">*</span>
                                </div>
                                <input type="file" required="" name="sonod">
                            </div>


                            <p class="text-danger">সতর্কীকরণঃ</p>
                            <p class="text-danger"><b style="color: red; font-size:16px;"> ০১. আবেদন পত্র দাখিল করার
                                    পূর্বে অবশ্যই প্রদত্ত তথ্যের সঠিকতা যাচাই করুন অন্যথায় আবেদন পত্রটি বাতিল হিসেবে গন্য
                                    করা হবে। </b></p>
                            <p class="text-danger" style="color: red;"> ০২.রোগী সুস্থতা লাভ করার পর অবশ্যই কতৃপক্ষকে অবহিত
                                করতে বাধ্য থাকিবেন, অন্যথায় কতৃপক্ষ যে সিদ্ধান্ত নিবে সেই সিদ্ধান্তই মেনে নিতে হবে। </p>
                            <p class="text-danger" style="color: red;"> ০৩.যদি প্রতিষ্ঠান মনে করে ডাক্তার প্রদত্ত চিকিৎসা
                                পত্ররের সঠিকতা যাচাই করার প্রয়োজন, এই মর্মে
                                ডাক্তারের আপত্তি প্রতিষ্ঠানের কাছে গ্রহন যোগ্য নয়।
                            </p>
                            <p class="text-danger" style="color: red;"> ০৪.সকল প্রকার তথ্যাদি ও সংযুক্তি প্রদান না করলে
                                ফরম গ্রহনযোগ্য হবে না।</p>
                            <hr>
                            <div class="text-center"><button class="thm-btn mt_30 mb_30" type="submit">আবেদন
                                    করুন</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('script')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            function toast(status, header, msg) {
                Command: toastr[status](header, msg)
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        </script>
        <script>
            $("form").on('submit', function(e) {
                $(this).find('button[type="submit"]').attr('disabled', 'disabled');
                $(this).find('input[type="submit"]').attr('disabled', 'disabled');
            });
            $(document).ready(function() {

                $('.add_btn').on('click', function() {
                    let medicine = $('#medicine').val();
                    let price = $('#price').val();
                    // var checkStock = $('#msg').text()
                    // Validation
                    if (price == '') {
                        toast('warning', 'মূল্য লিখুন');
                        $('#price').focus();
                        return false;
                    }

                    var html = '<tr>';
                    html += '<tr class="trData"><td class="serial text-center"></td><td>' + medicine +
                        '</td><td>' + price + '</td><td align="center">';
                    html += '<input type="hidden" name="medicine[]" value="' + medicine + '" />';
                    html += '<input type="hidden" name="price[]" value="' + price + '" />';
                    html += '<a class="product_delete" href="#"><i class="fas fa-trash"></i></a></td></tr>';
                    toast('success', 'ঔষধ যোগ করা হয়েছে');

                    // Value reset
                    $('.product_table tbody').append(html);
                    $('#medicine').val('');
                    $('#price').val('');
                    $('#subtotal').val('');
                    serialMaintain();
                });

                // Delete
                $('.product_table').on('click', '.product_delete', function(e) {
                    var element = $(this).parents('tr');
                    element.remove();
                    toast('warning', 'Product Removed!');
                    e.preventDefault();
                    serialMaintain();
                });

                // Subtotal
                function serialMaintain() {
                    var i = 1;
                    var subtotal = 0;
                    $('.serial').each(function(key, element) {
                        $(element).html(i);
                        var total = $(element).parents('tr').find('input[name="amt[]"]').val();
                        subtotal += +parseFloat(total);
                        i++;
                    });

                    $('.sub-total').html(subtotal.toFixed(2));
                    $('#total_amount').val(subtotal);
                    $('#net_amt').val(subtotal);
                };
            })
        </script>
        <script>
            $(document).ready(function() {
                $("#division_id").on("change", function() {
                    let division_id = $(this).val();
                    $.ajax({
                        url: '{{ route('frontend.getDistrict') }}',
                        method: 'get',
                        data: {
                            division_id: division_id,
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                $('#district').html(res.html);
                            }
                        }
                    });
                })
                $("#district").on("change", function() {
                    let district_id = $(this).val();
                    $.ajax({
                        url: '{{ route('frontend.getUpazila') }}',
                        method: 'get',
                        data: {
                            district_id: district_id,
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                $('#thana').html(res.html);
                            }
                        }
                    });
                })

                // $("#upazila").on("change", function() {
                //     let upazila_id = $("#upazila_id").val();
                //     $.ajax({
                //         url: '{{ route('frontend.getUnion') }}',
                //         method: 'get',
                //         data: {
                //             upazila_id: upazila_id,
                //         },
                //         success: function(res) {
                //             if (res.status == 'success') {
                //                 $('#union').html(res.html);
                //             }
                //         }
                //     });
                // })

            })
        </script>
    @endpush
@endsection
