<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ApplicantUpdateRequest;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $applicants = User::query();
            return DataTables::of($applicants)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    // return $row->created_at->diffForHumans();
                    return $row->created_at;
                })           
                ->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block">Pending
                             </div>';
                    } else if ($row->status == 1) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Approved </div>';
                    } else if ($row->status == 2) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block">Canceled </div>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '';

                    $btn .= view('button', ['type' => 'ajax-view', 'route' => route('admin.applicant.show', $row->id), 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.applicant.edit', $row->id), 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.applicant.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'created_at'])
                ->make(true);
        }
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.applicant.index', $data);
    }

    public function show(Request $request, User $applicant)
    {
        if ($request->ajax()) {            
            $modal = view('admin.applicant.show')->with(['applicant' => $applicant])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    public function edit(Request $request, User $applicant)
    {
        if ($request->ajax()) {
            $divisions = Division::all();
            $modal = view('admin.applicant.edit')->with(['applicant' => $applicant, 'divisions' => $divisions])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    public function update(ApplicantUpdateRequest $request, User $applicant)
    {        
        $data = $request->validated();
        // if($request->hasFile('image')){
        //     $data['image'] = imageUpdate($request, 'image', 'user', 'uploads/images/user/', $image);
        // }

        if($request->hasFile('student_image')){
            $data['student_image'] = imageUpdate($request, 'student_image','student_image', 'documents/', $applicant->student_image);
        }
        if($request->hasFile('student_idcard')){
            $data['student_idcard'] = imageUpdate($request, 'student_idcard','student_idcard', 'documents/', $applicant->student_idcard);
        }
        if($request->hasFile('parent_idcard')){
            $data['parent_idcard'] = imageUpdate($request, 'parent_idcard','parent_idcard', 'documents/', $applicant->parent_idcard);
        }
        if($request->hasFile('charac_cer')){
            $data['charac_cer'] = imageUpdate($request, 'charac_cer','charac_cer', 'documents/', $applicant->charac_cer);
        }
        if($request->hasFile('marksheet')){
            $data['marksheet'] = imageUpdate($request, 'marksheet','marksheet', 'documents/', $applicant->marksheet);
        }
        if($request->hasFile('document')){
            $data['document'] = imageUpdate($request, 'document','document', 'documents/', $applicant->document);
        }

        try {
            $applicant->update($data);
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function getDistrict(Request $request)
    {
        $datum = District::whereDivision_id($request->district_id)->get();
        $district = view('frontend.layouts.includes.district', ['datum' => $datum])->render();
        return response()->json(['status' => 'success', 'html' => $district, 'district']);
    }

    public function getUpazila(Request $request)
    {
        $datum = Upazila::whereDistrict_id($request->district_id)->get();
        $upazilas = view('frontend.layouts.includes.upazila', ['datum' => $datum])->render();
        return response()->json(['status' => 'success', 'html' => $upazilas, 'upazilas']);
    }

    public function getUnion(Request $request)
    {
        $datum = Union::whereUpazilla_id($request->upazila_id)->get();
        $unions = view('frontend.layouts.includes.union', ['datum' => $datum])->render();
        return response()->json(['status' => 'success', 'html' => $unions, 'unions']);
    }

    public function destroy(User $applicant)
    {
        try {
            $applicant->delete();
            return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
