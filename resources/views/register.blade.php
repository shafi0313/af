@extends('asset')
@section('content')
    <section class="inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 sec-title colored text-center">
                    <h2>গরীব , দুস্থ, অসহায় ছাত্র/ছাত্রীর শিক্ষা ভাতার আবেদন</h2>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="donation-form-outer">
                <form method="post" action="{{ route('frontend.applicant.store') }}" enctype="multipart/form-data">
                    @csrf @method('post')
                    <!--Form Portlet-->
                    <div class="form-portlet">
                        <div class="row clearfix">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ছাত্র/ছাত্রীর নামঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ছাত্র/ছাত্রীর নামঃ"
                                    value="{{ old('student_name') }}" name="student_name">
                                @if ($errors->has('student_name'))
                                    <div class="alert alert-danger">{{ $errors->first('student_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Student name:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Student name"
                                    value="{{ old('student_name_en') }}" name="student_name_en">
                                @if ($errors->has('student_name_en'))
                                    <div class="alert alert-danger">{{ $errors->first('student_name_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পিতার নামঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="পিতার নামঃ"
                                    value="{{ old('father_name') }}" name="father_name">
                                @if ($errors->has('father_name'))
                                    <div class="alert alert-danger">{{ $errors->first('father_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Father's name:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Father's name"
                                    value="{{ old('father_name_en') }}" name="father_name_en">
                                @if ($errors->has('father_name_en'))
                                    <div class="alert alert-danger">{{ $errors->first('father_name_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">মাতার নামঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="মাতার নামঃ"
                                    value="{{ old('mother_name') }}" name="mother_name">
                                @if ($errors->has('mother_name'))
                                    <div class="alert alert-danger">{{ $errors->first('mother_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Mother's name:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Mother's name"
                                    value="{{ old('mother_name_en') }}" name="mother_name_en">
                                @if ($errors->has('mother_name_en'))
                                    <div class="alert alert-danger">{{ $errors->first('mother_name_en') }}</div>
                                @endif
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
                                <select name="disctrict" id="district" required>
                                    <option value="">নির্বাচন করুন</option>
                                </select>
                                @if ($errors->has('disctrict'))
                                    <div class="alert alert-danger">{{ $errors->first('disctrict') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">থানাঃ <span class="required">*</span></div>
                                <select name="thana" id="thana" required>
                                    <option value="">নির্বাচন করুন</option>
                                </select>
                                @if ($errors->has('thana'))
                                    <div class="alert alert-danger">{{ $errors->first('thana') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">গ্রামঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Village" value="{{ old('gram') }}"
                                    name="gram">
                                @if ($errors->has('gram'))
                                    <div class="alert alert-danger">{{ $errors->first('gram') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Village:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Village" value="{{ old('gram_en') }}"
                                    name="gram_en">
                                @if ($errors->has('gram_en'))
                                    <div class="alert alert-danger">{{ $errors->first('gram_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পোস্টঃ অফিসঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Post office"
                                    value="{{ old('post_office') }}" name="post_office">
                                @if ($errors->has('post_office'))
                                    <div class="alert alert-danger">{{ $errors->first('post_office') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Post office:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Post office"
                                    value="{{ old('post_office_en') }}" name="post_office_en">
                                @if ($errors->has('post_office_en'))
                                    <div class="alert alert-danger">{{ $errors->first('post_office_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">মোবাইল নাম্বারঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Mobile number"
                                    value="{{ old('phone') }}" name="phone">
                                @if ($errors->has('phone'))
                                    <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Mobile Number(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Mobile number"
                                    value="{{ old('phone_en') }}" name="phone_en">
                                @if ($errors->has('phone_en'))
                                    <div class="alert alert-danger">{{ $errors->first('phone_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">জরুরী কন্টাক্ট নাম্বারঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Important contact number"
                                    value="{{ old('phone2') }}" name="phone2">
                                @if ($errors->has('phone2'))
                                    <div class="alert alert-danger">{{ $errors->first('phone2') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Emergency Contact Number(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Important contact number"
                                    value="{{ old('phone2_en') }}" name="phone2_en">
                                @if ($errors->has('phone2_en'))
                                    <div class="alert alert-danger">{{ $errors->first('phone2_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ইমেইলঃ </div>
                                <input type="text" placeholder="Email" value="{{ old('email') }}" name="email">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">আর্থিক অবস্থার বর্ণনাঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Description of financial position"
                                    value="{{ old('finance') }}" name="finance">
                                @if ($errors->has('finance'))
                                    <div class="alert alert-danger">{{ $errors->first('finance') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Description of financial position:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Description of financial position"
                                    value="{{ old('finance_en') }}" name="finance_en">
                                @if ($errors->has('finance_en'))
                                    <div class="alert alert-danger">{{ $errors->first('finance_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">শিক্ষা প্রতিষ্ঠানের নামঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Name of educational institution"
                                    value="{{ old('school') }}" name="school">
                                @if ($errors->has('school'))
                                    <div class="alert alert-danger">{{ $errors->first('school') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Name of educational institution(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Name of educational institution"
                                    value="{{ old('school_en') }}" name="school_en">
                                @if ($errors->has('school_en'))
                                    <div class="alert alert-danger">{{ $errors->first('school_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">অধ্যায়ন শ্রেণীর নামঃ(বাংলা) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Study Class Name"
                                    value="{{ old('class') }}" name="class">
                                @if ($errors->has('class'))
                                    <div class="alert alert-danger">{{ $errors->first('class') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Study Class Name:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Study Class Name"
                                    value="{{ old('class_en') }}" name="class_en">
                                @if ($errors->has('class_en'))
                                    <div class="alert alert-danger">{{ $errors->first('class_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">এডমিশন ফিঃ(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Admission fee"
                                    value="{{ old('admission_fee') }}" name="admission_fee" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('admission_fee'))
                                    <div class="alert alert-danger">{{ $errors->first('admission_fee') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Admission fee:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Admission fee"
                                    value="{{ old('admission_fee_en') }}" name="admission_fee_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('admission_fee_en'))
                                    <div class="alert alert-danger">{{ $errors->first('admission_fee_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">বোর্ড রেজিস্ট্রেশন ফিঃ(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Board registration fee"
                                    value="{{ old('board_reg_fee') }}" name="board_reg_fee" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('board_reg_fee'))
                                    <div class="alert alert-danger">{{ $errors->first('board_reg_fee') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Board registration fee:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Board registration fee"
                                    value="{{ old('board_reg_fee_en') }}" name="board_reg_fee_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('board_reg_fee_en'))
                                    <div class="alert alert-danger">{{ $errors->first('board_reg_fee_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">বই পত্র ক্রয়ঃ(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Purchase of books"
                                    value="{{ old('book_purchase') }}" name="book_purchase" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('book_purchase'))
                                    <div class="alert alert-danger">{{ $errors->first('book_purchase') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Purchase of books:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Purchase of books"
                                    value="{{ old('book_purchase_en') }}" name="book_purchase_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('book_purchase_en'))
                                    <div class="alert alert-danger">{{ $errors->first('book_purchase_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">মাসিক বেতনঃ(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Monthly salary"
                                    value="{{ old('fee') }}" name="fee" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('fee'))
                                    <div class="alert alert-danger">{{ $errors->first('fee') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Monthly salary:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Monthly salary"
                                    value="{{ old('fee_en') }}" name="fee_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('fee_en'))
                                    <div class="alert alert-danger">{{ $errors->first('fee_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পরীক্ষার ফি ১ঃ(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Examination fee 1"
                                    value="{{ old('exm_fee1') }}" name="exm_fee1" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('exm_fee1'))
                                    <div class="alert alert-danger">{{ $errors->first('exm_fee1') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Examination fee 1:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Examination fee 1"
                                    value="{{ old('exm_fee1_en') }}" name="exm_fee1_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('exm_fee1_en'))
                                    <div class="alert alert-danger">{{ $errors->first('exm_fee1_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পরীক্ষার ফি ২ঃ(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Examination fee 2"
                                    value="{{ old('exm_fee2') }}" name="exm_fee2" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('exm_fee2'))
                                    <div class="alert alert-danger">{{ $errors->first('exm_fee2') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Examination fee 2(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Examination fee 2"
                                    value="{{ old('exm_fee2_en') }}" name="exm_fee2_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('exm_fee2_en'))
                                    <div class="alert alert-danger">{{ $errors->first('exm_fee2_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পরীক্ষার ফি ৩(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Examination fee 3"
                                    value="{{ old('exm_fee3') }}" name="exm_fee3" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('exm_fee3'))
                                    <div class="alert alert-danger">{{ $errors->first('exm_fee3') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Examination fee 3:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Examination fee 3"
                                    value="{{ old('exm_fee3_en') }}" name="exm_fee3_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('exm_fee3_en'))
                                    <div class="alert alert-danger">{{ $errors->first('exm_fee3_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পরিবারের সদস্য সংখ্যাঃ(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Number of family members"
                                    value="{{ old('member') }}" name="member" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('member'))
                                    <div class="alert alert-danger">{{ $errors->first('member') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Number of family members:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Number of family members"
                                    value="{{ old('member_en') }}" name="member_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('member_en'))
                                    <div class="alert alert-danger">{{ $errors->first('member_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পরিবারের সর্বমোট মাসিক আয়ঃ(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Total monthly income of the family"
                                    value="{{ old('income') }}" name="income" onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('income'))
                                    <div class="alert alert-danger">{{ $errors->first('income') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">Total monthly income of the family:(English) <span class="required">*</span></div>
                                <input type="text" required="" placeholder="Total monthly income of the family"
                                    value="{{ old('income_en') }}" name="income_en"
                                    onInput="this.value = this.value.replace(/[^\d]/g,'');">
                                @if ($errors->has('income_en'))
                                    <div class="alert alert-danger">{{ $errors->first('income_en') }}</div>
                                @endif
                            </div> --}}

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">ছাত্র/ছাত্রীর ছবিঃ <span class="required">*</span></div>
                                <input type="file" required="" name="student_image">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label"> ছাত্র/ছাত্রীর আইডি কার্ড/রেজিস্ট্রেশন কার্ড </div>
                                <input type="file" name="student_idcard">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">পিতা/মাতার জাতীয় পরিচয় পত্র : <span class="required">*</span>
                                </div>
                                <input type="file" required="" name="parent_idcard">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">চেয়ারম্যান প্রদত্ত চারিত্রিক সনদঃ <span class="required">*</span>
                                </div>
                                <input type="file" required="" name="charac_cer">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label">বিগত বছরের মার্কশীটঃ <span class="required">*</span></div>
                                <input type="file" required="" name="marksheet">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <div class="field-label"> বেতন ও আনুসাঙ্গিক ব্যয় প্রতিষ্ঠান প্রধানের দ্বারা সত্যায়ন পত্রঃ
                                    <span class="required">*</span>
                                </div>
                                <input type="file" required="" name="document">
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                <p class="text-danger">সতর্কীকরণঃ</p>
                                <p class="text-danger"><b style="color: red; font-size:16px;"> ০১. আবেদন পত্র দাখিল করার
                                        পূর্বে অবশ্যই প্রদত্ত তথ্যের সঠিকতা যাচাই করুন অন্যথায় আবেদন পত্রটি বাতিল হিসেবে
                                        গন্য করা হবে। </b></p>
                                <p class="text-danger" style="color: red;"> ০২.যদি কোন ছাত্র/ছাত্রী যে কোন কারনে উল্লেখিত
                                    শিক্ষা প্রতিষ্ঠান হতে প্রস্থান গ্রহন করেন, অবশ্যই শিক্ষা প্রতিষ্ঠান প্রধান এবং আবেদনকারী
                                    দাতা প্রতিষ্ঠান কে অবহিত করতে বাধ্য থাকিবে। </p>
                                <p class="text-danger" style="color: red;"> ০৩.প্রতিষ্ঠানের প্রধান অবশ্যই বেতন ও
                                    আনুসাঙ্গিক খরচ এর সত্যতা যাচাই করে স্বাক্ষর করবেন। </p>
                                <p class="text-danger" style="color: red;"> ০৪.সকল প্রকার তথ্যাদি ও সংযুক্তি প্রদান না
                                    করলে ফরম গ্রহনযোগ্য হবে না।</p>
                                <hr>
                            </div>
                            <div class="text-center"><button class="thm-btn mt_30 mb_30" type="submit">আবেদন
                                    করুন</button></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            $("form").on('submit', function(e) {
                $(this).find('button[type="submit"]').attr('disabled', 'disabled');
                $(this).find('input[type="submit"]').attr('disabled', 'disabled');
            });
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
            })
        </script>
    @endpush
@endsection
