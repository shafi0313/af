<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ApplicantStoreRequest;
use App\Models\District;

class ApplicantController extends Controller
{
    public function store(ApplicantStoreRequest $request)
    {
        // $data = $request->validated();
        // $data['user_id'] = user()->id;
        $data = [
            'student_name'  => $request->student_name .'('.$request->student_name_en.')',
            'father_name'   => $request->father_name .'('.$request->father_name_en.')',
            'mother_name'   => $request->mother_name .'('.$request->mother_name_en.')',
            'gram'          => $request->student_name .'('.$request->student_name_en.')',
            'disctrict'     => $request->disctrict,
            'thana'         => $request->thana,
            'post_office'   => $request->post_office .'('.$request->post_office_en.')',
            'finance'       => $request->finance .'('.$request->finance_en.')',
            'school'        => $request->school .'('.$request->school_en.')',
            'phone'         => $request->phone .'('.$request->phone_en.')',
            'phone2'        => $request->phone2 .'('.$request->phone2_en.')',
            'email'         => $request->email,
            'class'         => $request->class .'('.$request->class_en.')',
            'expense'       => $request->expense,
            'fee'           => $request->fee,
            'book_purchase' => $request->book_purchase,
            'board_reg_fee' => $request->board_reg_fee,
            'exm_fee1'      => $request->exm_fee1,
            'exm_fee2'      => $request->exm_fee2,
            'exm_fee3'      => $request->exm_fee3,
            'member'        => $request->member,
            'income'        => $request->income,
        ];        
        
        if($request->hasFile('student_image')){
            $data['student_image'] = imageStore($request, 'student_image','student_image', 'documents/');
        }
        if($request->hasFile('student_idcard')){
            $data['student_idcard'] = imageStore($request, 'student_idcard','student_idcard', 'documents/');
        }
        if($request->hasFile('parent_idcard')){
            $data['parent_idcard'] = imageStore($request, 'parent_idcard','parent_idcard', 'documents/');
        }
        if($request->hasFile('charac_cer')){
            $data['charac_cer'] = imageStore($request, 'charac_cer','charac_cer', 'documents/');
        }
        if($request->hasFile('marksheet')){
            $data['marksheet'] = imageStore($request, 'marksheet','marksheet', 'documents/');
        }
        if($request->hasFile('document')){
            $data['document'] = imageStore($request, 'document','document', 'documents/');
        }

        try {
            User::create($data);
            Alert::success('Success', 'Application Created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
            Alert::error('Error', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function getDistrict(Request $request)
    {
        $applicantDisctrict = $request->applicantDisctrict;
        $datum = District::whereDivision_id($request->division_id)->get();
        $district = view('frontend.layouts.includes.district', ['datum' => $datum, 'applicantDisctrict' => $applicantDisctrict])->render();
        return response()->json(['status' => 'success', 'html' => $district, 'district']);
    }

    public function getUpazila(Request $request)
    {
        $applicantThana = $request->applicantThana;
        $datum = Upazila::whereDistrict_id($request->district_id)->get();
        $upazilas = view('frontend.layouts.includes.upazila', ['datum' => $datum, 'applicantThana' => $applicantThana])->render();
        return response()->json(['status' => 'success', 'html' => $upazilas, 'upazilas']);
    }

    public function getUnion(Request $request)
    {
        $datum = Union::whereUpazilla_id($request->upazila_id)->get();
        $unions = view('frontend.layouts.includes.union', ['datum' => $datum])->render();
        return response()->json(['status' => 'success', 'html' => $unions, 'unions']);
    }
}
