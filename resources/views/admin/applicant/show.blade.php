<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Student/Applicant Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalText">
                <div class="row">
                    <div class="col-md-12">
                        <table width="100%" border="0">
                            <tbody>
                                <tr>
                                    <td>Student Name (ছাত্র/ছাত্রীর নাম) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->student_name }}</td>
                                </tr>
                                <tr>
                                    <td>Father Name(পিতার নাম) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->father_name }}</td>
                                </tr>
                                <tr>
                                    <td>Mother Name(মাতার নাম) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->mother_name }}</td>
                                </tr>
                                <tr>
                                    <td>Village (গ্রাম) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->gram }}</td>
                                </tr>
                                <tr>
                                    <td>Post Office (পোস্টঃ অফিসঃ) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->post_office }}</td>
                                </tr>
                                <tr>
                                    <td>Police Station(থানা) </td>
                                    <td>:</td>
                                    <td>{{$applicant->getThana ? $applicant->getThana->bn_name : $applicant->thana }}</td>
                                </tr>
                                <tr>
                                    <td>Division(বিভাগ) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->division ? $applicant->division->bn_name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>District(জেলা) </td>
                                    <td>:</td>
                                    <td>{{$applicant->district ? $applicant->district->bn_name : $applicant->disctrict }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile No(মোবাইল নাম্বার) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Email(ইমেইল) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->email }}</td>
                                </tr>
                                <tr>
                                    <td>Emergency Mobile No(জরুরী কন্টাক্ট নাম্বার) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->phone2 }}</td>
                                </tr>
                                <tr>
                                    <td>Financial Condition(আর্থিক অবস্থার বর্ণনা) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->finance }}</td>
                                </tr>
                                <tr>
                                    <td>School/Madrasha Name(শিক্ষা প্রতিষ্ঠানের নাম)
                                    </td>
                                    <td>:</td>
                                    <td>{{ $applicant->school }}</td>
                                </tr>
                                <tr>
                                    <td>Year/Class(অধ্যায়ন শ্রেণীর নামঃ) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->class }}</td>
                                </tr>
                                <tr>
                                    <td>School Fee P/M(মাসিক বেতন) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->fee }}</td>
                                </tr>
                                <tr>
                                    <td>Admission Fee(এডমিশন ফিঃ) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->admission_fee }}</td>
                                </tr>
                                <tr>
                                    <td>Board Reg Fee(বোর্ড রেজিস্ট্রেশন ফি) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->board_reg_fee }}</td>
                                </tr>
                                <tr>
                                    <td>Book Purchase(বই পত্র ক্রয়) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->book_purchase }}</td>
                                </tr>
                                <tr>
                                    <td>Exam Fee 1(পরীক্ষার ফি ১) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->exm_fee1 }}</td>
                                </tr>
                                <tr>
                                    <td>Exan Fee 2(পরীক্ষার ফি ২) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->exm_fee2 }}</td>
                                </tr>
                                <tr>
                                    <td>Exam Fee 3(পরীক্ষার ফি ৩) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->exm_fee3 }}</td>
                                </tr>
                                <tr>
                                    <td>Family Member(পরিবারের সদস্য সংখ্যাঃ) </td>
                                    <td>:</td>
                                    <td>{{ $applicant->member }}</td>
                                </tr>
                                <tr>
                                    <td>Total Family Income(পরিবারের সর্বমোট মাসিক আয়)
                                    </td>
                                    <td>:</td>
                                    <td>{{ $applicant->income }}</td>
                                </tr>
                                <tr>
                                    <td>Student Photo(ছাত্র/ছাত্রীর ছবি) </td>
                                    <td>:</td>
                                    <td>
                                        <a class="image-link"
                                            href="{{ asset('documents/' . $applicant->student_image) }}"
                                            target="_blank">
                                            <img src="{{ asset('documents/' . $applicant->student_image) }}"
                                                alt="" height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Student ID Card(ছাত্র/ছাত্রীর আইডি কার্ড) </td>
                                    <td>:</td>
                                    <td>
                                        <a class="image-link"
                                            href="{{ asset('documents/' . $applicant->student_idcard) }}"
                                            target="_blank">
                                            <img src="{{ asset('documents/' . $applicant->student_idcard) }}"
                                                alt="" height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Parents NID(পিতা/মাতার জাতীয় পরিচয় পত্র ) </td>
                                    <td>:</td>
                                    <td>
                                        <a class="image-link"
                                            href="{{ asset('documents/' . $applicant->parent_idcard) }}"
                                            target="_blank">
                                            <img src="{{ asset('documents/' . $applicant->parent_idcard) }}"
                                                alt="" height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Charimen Certificate(চেয়ারম্যান প্রদত্ত
                                        চারিত্রিক সনদ) </td>
                                    <td>:</td>
                                    <td><a class="image-link" href="{{ asset('documents/' . $applicant->charac_cer) }}"
                                            target="_blank">
                                            <img src="{{ asset('documents/' . $applicant->charac_cer) }}"
                                                alt="" height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Last Year Marksheet(বিগত বছরের মার্কশীট) </td>
                                    <td>:</td>
                                    <td><a class="image-link" href="{{ asset('documents/' . $applicant->marksheet) }}"
                                            target="_blank">
                                            <img src="{{ asset('documents/' . $applicant->marksheet) }}" alt=""
                                                height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Principle Certificate(বেতন ও আনুসাঙ্গিক ব্যয়
                                        প্রতিষ্ঠান প্রধানের দ্বারা সত্যায়ন পত্র) </td>
                                    <td>:</td>
                                    <td><a class="image-link" href="{{ asset('documents/' . $applicant->document) }}"
                                            target="_blank">
                                            <img src="{{ asset('documents/' . $applicant->document) }}" alt=""
                                                height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Registration Date </td>
                                    <td>:</td>
                                    <td>undefined</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
