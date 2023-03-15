<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Models\Division;
use App\Models\Medicine;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $applicants = Patient::latest();
            return DataTables::of($applicants)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                    // return $row->created_at;
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

                    $btn .= view('button', ['type' => 'ajax-view', 'route' => route('admin.patient.show', $row->id), 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.patient.edit', $row->id), 'row' => $row]);
                    if (Auth::user()->id == 1){
                        $btn .= '<button type="button" class="btn btn-success btn-sm" onclick="accept('.$row->id.')" title="Accept"><i class="material-icons">done_outline </i></button> ';
                        $btn .= '<button type="button" class="btn btn-warning btn-sm" onclick="reject('.$row->id.')" title="Reject"><i class="material-icons">cancel_presentation</i></button> ';
                    }
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.patient.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'created_at'])
                ->make(true);
        }
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.patient.index', $data);
    }

    public function show(Request $request, Patient $patient)
    {
        if ($request->ajax()) {            
            $modal = view('admin.patient.show')->with(['patient' => $patient])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    // public function medicine(Request $request, Patient $patient)
    // {
    //     if ($request->ajax()) {
    //         $modal = view('admin.patient.edit')->with(['patient' => $patient, 'divisions' => $divisions])->render();
    //         return response()->json(['modal' => $modal], 200);
    //     }
    //     return abort(500);
    // }

    public function edit(Request $request, Patient $patient)
    {
        if ($request->ajax()) {
            $divisions = Division::all();
            $modal = view('admin.patient.edit')->with(['patient' => $patient, 'divisions' => $divisions])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    public function update(ApplicantUpdateRequest $request, Patient $patient)
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

    public function accept(Request $request)
    {
        try {
            Patient::find($request->id)->update(['status' => 1]);
            return response()->json(['message'=> 'Patient Accepted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
        }        
    }

    public function reject(Request $request)
    {
        try {
            Patient::find($request->id)->update(['status' => 2]);
            return response()->json(['message'=> 'Patient Rejected'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
        }        
    }

    public function delete($id)
    {
        // return $id;
        try {
            return Medicine::find($id);
            // $patient->delete();
            // return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            // return response()->json(['message' => __('app.oops')], 500);
            return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();
            return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
