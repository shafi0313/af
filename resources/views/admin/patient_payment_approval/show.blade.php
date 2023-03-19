<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Patient/Applicant Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalText">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>রোগীর নামঃ</td>
                                    <td>:</td>
                                    <td>{{ $patient->name }}</td>
                                </tr>
                                <tr>
                                    <td>পিতার নামঃ</td>
                                    <td>:</td>
                                    <td>{{ $patient->f_name }}</td>
                                </tr>
                                <tr>
                                    <td>মাতার নামঃ</td>
                                    <td>:</td>
                                    <td>{{ $patient->m_name }}</td>
                                </tr>
                                <tr>
                                    <td>বিভাগ</td>
                                    <td>:</td>
                                    <td>{{ $patient->division->bn_name }}</td>
                                </tr>
                                <tr>
                                    <td>জেলা</td>
                                    <td>:</td>
                                    <td>{{ $patient->district->bn_name }}</td>
                                </tr>
                                <tr>
                                    <td>থানা</td>
                                    <td>:</td>
                                    <td>{{ $patient->getThana->bn_name }}</td>
                                </tr>
                                <tr>
                                    <td>পোস্টঃ অফিসঃ</td>
                                    <td>:</td>
                                    <td>{{ $patient->post }}</td>
                                </tr>
                                <tr>
                                    <td>গ্রাম</td>
                                    <td>:</td>
                                    <td>{{ $patient->village }}</td>
                                </tr>
                                <tr>
                                    <td>মোবাইল নাম্বার</td>
                                    <td>:</td>
                                    <td>{{ $patient->phone }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Email(ইমেইল) </td>
                                    <td>:</td>
                                    <td>{{ $patient->email }}</td>
                                </tr> --}}
                                
                                <tr>
                                    <td>জরুরী কন্টাক্ট নাম্বার</td>
                                    <td>:</td>
                                    <td>{{ $patient->e_phone }}</td>
                                </tr>
                                <tr>
                                    <td>আর্থিক অবস্থার বর্ণনাঃ</td>
                                    <td>:</td>
                                    <td>{{ $patient->finance }}</td>
                                </tr>
                                <tr>
                                    <td>হাসপাতালের নামঃ</td>
                                    <td>:</td>
                                    <td>{{ $patient->hospital }}</td>
                                </tr>
                                <tr>
                                    <td>ডাক্তারের নামঃ</td>
                                    <td>:</td>
                                    <td>{{ $patient->doctor }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Year/Class(অধ্যায়ন শ্রেণীর নামঃ) </td>
                                    <td>:</td>
                                    <td>{{ $patient->class }}</td>
                                </tr>
                                <tr>
                                    <td>School Fee P/M(মাসিক বেতন) </td>
                                    <td>:</td>
                                    <td>{{ $patient->fee }}</td>
                                </tr>
                                <tr>
                                    <td>Admission Fee(এডমিশন ফিঃ) </td>
                                    <td>:</td>
                                    <td>{{ $patient->admission_fee }}</td>
                                </tr>
                                <tr>
                                    <td>Board Reg Fee(বোর্ড রেজিস্ট্রেশন ফি) </td>
                                    <td>:</td>
                                    <td>{{ $patient->board_reg_fee }}</td>
                                </tr>
                                <tr>
                                    <td>Book Purchase(বই পত্র ক্রয়) </td>
                                    <td>:</td>
                                    <td>{{ $patient->book_purchase }}</td>
                                </tr>
                                <tr>
                                    <td>Exam Fee 1(পরীক্ষার ফি ১) </td>
                                    <td>:</td>
                                    <td>{{ $patient->exm_fee1 }}</td>
                                </tr>
                                <tr>
                                    <td>Exan Fee 2(পরীক্ষার ফি ২) </td>
                                    <td>:</td>
                                    <td>{{ $patient->exm_fee2 }}</td>
                                </tr>
                                <tr>
                                    <td>Exam Fee 3(পরীক্ষার ফি ৩) </td>
                                    <td>:</td>
                                    <td>{{ $patient->exm_fee3 }}</td>
                                </tr>
                                <tr>
                                    <td>Family Member(পরিবারের সদস্য সংখ্যাঃ) </td>
                                    <td>:</td>
                                    <td>{{ $patient->member }}</td>
                                </tr> --}}
                                <tr>
                                    <td>পরিবারের সর্বমোট মাসিক আয়ঃ</td>
                                    <td>:</td>
                                    <td>{{ $patient->total_income }}</td>
                                </tr>
                                @foreach ($patient->medicines as $medicine)
                                <tr>
                                    <td>{{ @$x+=1 }}. Medicine: {{ $medicine->medicine }}</td>
                                    <td>:</td>
                                    <td>Price: {{ $medicine->price }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>রোগীর ছবিঃ</td>
                                    <td>:</td>
                                    <td>
                                        <a class="image-link" href="{{ asset('patients/' . $patient->patient_img) }}"
                                            target="_blank">
                                            <img src="{{ asset('patients/' . $patient->patient_img) }}" alt=""
                                                height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ভোটার আইডি কার্ড</td>
                                    <td>:</td>
                                    <td>
                                        <a class="image-link" href="{{ asset('patients/' . $patient->nid) }}"
                                            target="_blank">
                                            <img src="{{ asset('patients/' . $patient->nid) }}" alt=""
                                                height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ডাক্তার প্রদত্ত চিকিৎসা পত্র</td>
                                    <td>:</td>
                                    <td>
                                        <a class="image-link" href="{{ asset('patients/' . $patient->prescription) }}"
                                            target="_blank">
                                            <img src="{{ asset('patients/' . $patient->prescription) }}" alt=""
                                                height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>চেয়ারম্যান প্রদত্ত চারিত্রিক সনদঃ/td>
                                    <td>:</td>
                                    <td><a class="image-link" href="{{ asset('patients/' . $patient->sonod) }}"
                                            target="_blank">
                                            <img src="{{ asset('patients/' . $patient->sonod) }}" alt=""
                                                height="80px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Registration Date </td>
                                    <td>:</td>
                                    <td>{{ bdDate($patient->created_at) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
