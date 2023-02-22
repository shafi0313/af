<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Student/Applicant Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalText">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" onsubmit="ajaxStore(event, this, 'editModal')"
                            action="{{ route('admin.applicant.update', $applicant->id) }}"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <!--Form Portlet-->
                            {{-- <input type="hidden" value="{{ $applicant->disctrict }}" id="applicantDisctrict"> --}}
                            <div class="form-portlet">
                                <div class="row clearfix">
                                    <div class="form-group col-md-6">
                                        <div class="field-label">ছাত্র/ছাত্রীর নামঃ <span class="required">*</span>
                                        </div>
                                        <input type="text" required="" placeholder="Student name"
                                            value="{{ $applicant->student_name }}" name="student_name"
                                            class="form-control">
                                        @if ($errors->has('student_name'))
                                            <div class="alert alert-danger">{{ $errors->first('student_name') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">পিতার নামঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Father's name"
                                            value="{{ $applicant->father_name }}" name="father_name"
                                            class="form-control">
                                        @if ($errors->has('father_name'))
                                            <div class="alert alert-danger">{{ $errors->first('father_name') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">মাতার নামঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Mother's name"
                                            value="{{ $applicant->mother_name }}" name="mother_name"
                                            class="form-control">
                                        @if ($errors->has('mother_name'))
                                            <div class="alert alert-danger">{{ $errors->first('mother_name') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">বিভাগ <span class="required">*</span></div>
                                        <select name="division_id" id="division_id" required class="form-control">
                                            <option value="">নির্বাচন করুন</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    {{ $division->id == $applicant->division_id ? 'selected' : '' }}>
                                                    {{ $division->bn_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('division_id'))
                                            <div class="alert alert-danger">{{ $errors->first('division_id') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">জেলাঃ <span class="required">*</span></div>
                                        <select name="disctrict" id="district" required class="form-control">
                                        </select>
                                        @if ($errors->has('disctrict'))
                                            <div class="alert alert-danger">{{ $errors->first('disctrict') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">থানাঃ <span class="required">*</span></div>
                                        <select name="thana" id="thana" required class="form-control">
                                        </select>
                                        @if ($errors->has('thana'))
                                            <div class="alert alert-danger">{{ $errors->first('thana') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">গ্রামঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Village"
                                            value="{{ $applicant->gram }}" name="gram" class="form-control">
                                        @if ($errors->has('gram'))
                                            <div class="alert alert-danger">{{ $errors->first('gram') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">পোস্টঃ অফিসঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Post office"
                                            value="{{ $applicant->post_office }}" name="post_office"
                                            class="form-control">
                                        @if ($errors->has('post_office'))
                                            <div class="alert alert-danger">{{ $errors->first('post_office') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">মোবাইল নাম্বারঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Mobile number"
                                            value="{{ $applicant->phone }}" name="phone" class="form-control">
                                        @if ($errors->has('phone'))
                                            <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">জরুরী কন্টাক্ট নাম্বারঃ <span
                                                class="required">*</span></div>
                                        <input type="text" required="" placeholder="Important contact number"
                                            value="{{ $applicant->phone2 }}" name="phone2" class="form-control">
                                        @if ($errors->has('phone2'))
                                            <div class="alert alert-danger">{{ $errors->first('phone2') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">ইমেইলঃ <span class="required">*</span></div>
                                        <input type="text" placeholder="Email" value="{{ $applicant->email }}"
                                            name="email" class="form-control">
                                        @if ($errors->has('email'))
                                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">আর্থিক অবস্থার বর্ণনাঃ <span
                                                class="required">*</span></div>
                                        <input type="text" required=""
                                            placeholder="Description of financial position"
                                            value="{{ $applicant->finance }}" name="finance" class="form-control">
                                        @if ($errors->has('finance'))
                                            <div class="alert alert-danger">{{ $errors->first('finance') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">শিক্ষা প্রতিষ্ঠানের নামঃ <span
                                                class="required">*</span></div>
                                        <input type="text" required=""
                                            placeholder="Name of educational institution"
                                            value="{{ $applicant->school }}" name="school" class="form-control">
                                        @if ($errors->has('school'))
                                            <div class="alert alert-danger">{{ $errors->first('school') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">অধ্যায়ন শ্রেণীর নামঃ <span class="required">*</span>
                                        </div>
                                        <input type="text" required="" placeholder="Study Class Name"
                                            value="{{ $applicant->class }}" name="class" class="form-control">
                                        @if ($errors->has('class'))
                                            <div class="alert alert-danger">{{ $errors->first('class') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">এডমিশন ফিঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Admission fee"
                                            value="{{ $applicant->admission_fee }}" name="admission_fee"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('admission_fee'))
                                            <div class="alert alert-danger">{{ $errors->first('admission_fee') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label">বোর্ড রেজিস্ট্রেশন ফিঃ <span
                                                class="required">*</span></div>
                                        <input type="text" required="" placeholder="Board registration fee"
                                            value="{{ $applicant->board_reg_fee }}" name="board_reg_fee"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('board_reg_fee'))
                                            <div class="alert alert-danger">{{ $errors->first('board_reg_fee') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">বই পত্র ক্রয়ঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Purchase of books"
                                            value="{{ $applicant->book_purchase }}" name="book_purchase"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('book_purchase'))
                                            <div class="alert alert-danger">{{ $errors->first('book_purchase') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label">মাসিক বেতনঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Monthly salary"
                                            value="{{ $applicant->fee }}" name="fee"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('fee'))
                                            <div class="alert alert-danger">{{ $errors->first('fee') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label">পরীক্ষার ফি ১ঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Examination fee 1"
                                            value="{{ $applicant->exm_fee1 }}" name="exm_fee1"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('exm_fee1'))
                                            <div class="alert alert-danger">{{ $errors->first('exm_fee1') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label">পরীক্ষার ফি ২ঃ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Examination fee 2"
                                            value="{{ $applicant->exm_fee2 }}" name="exm_fee2"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('exm_fee2'))
                                            <div class="alert alert-danger">{{ $errors->first('exm_fee2') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label">পরীক্ষার ফি ৩ <span class="required">*</span></div>
                                        <input type="text" required="" placeholder="Examination fee 3"
                                            value="{{ $applicant->exm_fee3 }}" name="exm_fee3"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('exm_fee3'))
                                            <div class="alert alert-danger">{{ $errors->first('exm_fee3') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">পরিবারের সদস্য সংখ্যাঃ <span
                                                class="required">*</span></div>
                                        <input type="text" required="" placeholder="Number of family members"
                                            value="{{ $applicant->member }}" name="member"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('member'))
                                            <div class="alert alert-danger">{{ $errors->first('member') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">পরিবারের সর্বমোট মাসিক আয়ঃ <span
                                                class="required">*</span></div>
                                        <input type="text" required=""
                                            placeholder="Total monthly income of the family"
                                            value="{{ $applicant->income }}" name="income"
                                            onInput="this.value = this.value.replace(/[^\d]/g,'');"
                                            class="form-control">
                                        @if ($errors->has('income'))
                                            <div class="alert alert-danger">{{ $errors->first('income') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6"></div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">ছাত্র/ছাত্রীর ছবিঃ <span class="required">*</span>
                                        </div>
                                        <img src="{{ asset('documents/' . $applicant->student_image) }}"
                                            width="80px" alt="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">ছাত্র/ছাত্রীর ছবিঃ <span class="required">*</span>
                                        </div>
                                        <input type="file" name="student_image" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label"> ছাত্র/ছাত্রীর আইডি কার্ড/রেজিস্ট্রেশন কার্ড </div>
                                        <img src="{{ asset('documents/' . $applicant->student_idcard) }}"
                                            width="80px" alt="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label"> ছাত্র/ছাত্রীর আইডি কার্ড/রেজিস্ট্রেশন কার্ড </div>
                                        <input type="file" name="student_idcard">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">পিতা/মাতার জাতীয় পরিচয় পত্র : <span
                                                class="required">*</span>
                                        </div>
                                        <img src="{{ asset('documents/' . $applicant->parent_idcard) }}"
                                            width="80px" alt="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">পিতা/মাতার জাতীয় পরিচয় পত্র : <span
                                                class="required">*</span>
                                        </div>
                                        <input type="file" name="parent_idcard" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">চেয়ারম্যান প্রদত্ত চারিত্রিক সনদঃ <span
                                                class="required">*</span>
                                        </div>
                                        <img src="{{ asset('documents/' . $applicant->charac_cer) }}" width="80px"
                                            alt="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="field-label">চেয়ারম্যান প্রদত্ত চারিত্রিক সনদঃ <span
                                                class="required">*</span>
                                        </div>
                                        <input type="file" name="charac_cer" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label">বিগত বছরের মার্কশীটঃ <span class="required">*</span>
                                        </div>
                                        <img src="{{ asset('documents/' . $applicant->marksheet) }}" width="80px"
                                            alt="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label">বিগত বছরের মার্কশীটঃ <span class="required">*</span>
                                        </div>
                                        <input type="file" name="marksheet" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label"> বেতন ও আনুসাঙ্গিক ব্যয় প্রতিষ্ঠান প্রধানের দ্বারা
                                            সত্যায়ন পত্রঃ
                                            <span class="required">*</span>
                                        </div>
                                        <img src="{{ asset('documents/' . $applicant->document) }}" width="80px"
                                            alt="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field-label"> বেতন ও আনুসাঙ্গিক ব্যয় প্রতিষ্ঠান প্রধানের দ্বারা
                                            সত্যায়ন পত্রঃ
                                            <span class="required">*</span>
                                        </div>
                                        <input type="file" name="document" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12">
                                        <p class="text-danger">সতর্কীকরণঃ</p>
                                        <p class="text-danger"><b style="color: red; font-size:16px;"> ০১. আবেদন পত্র
                                                দাখিল করার
                                                পূর্বে অবশ্যই প্রদত্ত তথ্যের সঠিকতা যাচাই করুন অন্যথায় আবেদন পত্রটি
                                                বাতিল হিসেবে
                                                গন্য করা হবে। </b></p>
                                        <p class="text-danger" style="color: red;"> ০২.যদি কোন ছাত্র/ছাত্রী যে কোন
                                            কারনে উল্লেখিত
                                            শিক্ষা প্রতিষ্ঠান হতে প্রস্থান গ্রহন করেন, অবশ্যই শিক্ষা প্রতিষ্ঠান প্রধান
                                            এবং আবেদনকারী
                                            দাতা প্রতিষ্ঠান কে অবহিত করতে বাধ্য থাকিবে। </p>
                                        <p class="text-danger" style="color: red;"> ০৩.প্রতিষ্ঠানের প্রধান অবশ্যই বেতন
                                            ও
                                            আনুসাঙ্গিক খরচ এর সত্যতা যাচাই করে স্বাক্ষর করবেন। </p>
                                        <p class="text-danger" style="color: red;"> ০৪.সকল প্রকার তথ্যাদি ও সংযুক্তি
                                            প্রদান না
                                            করলে ফরম গ্রহনযোগ্য হবে না।</p>
                                        <hr>
                                    </div>
                                    <div class="text-center"><button class="btn btn-primary mt_30 mb_30"
                                            type="submit">Update</button></div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var applicantDisctrict = '{{ $applicant->disctrict }}';
        var applicantThana = '{{ $applicant->thana }}';
        let division_id = '{{ $applicant->division_id }}';
        $.ajax({
            url: '{{ route('frontend.getDistrict') }}',
            method: 'get',
            data: {
                division_id: division_id,
                applicantDisctrict: applicantDisctrict,
            },
            success: function(res) {
                if (res.status == 'success') {
                    $('#district').html(res.html);
                }
            }
        });

        let district_id = applicantDisctrict;
        $.ajax({
            url: '{{ route('frontend.getUpazila') }}',
            method: 'get',
            data: {
                district_id: district_id,
                applicantThana: applicantThana,
            },
            success: function(res) {
                if (res.status == 'success') {
                    $('#thana').html(res.html);
                }
            }
        });

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
