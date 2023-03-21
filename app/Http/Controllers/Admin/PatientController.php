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
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Http\Requests\ApplicantUpdateRequest;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $patients = Patient::latest();
            return DataTables::of($patients)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                    // return $row->created_at;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block">Pending
                             </div>';
                    } elseif ($row->status == 1) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Approved </div>';
                    } elseif ($row->status == 2) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block">Canceled </div>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '';

                    $btn .= view('button', ['type' => 'ajax-view', 'route' => route('admin.patient.show', $row->id), 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.patient.edit', $row->id), 'row' => $row]);
                    if (Auth::user()->id == 1) {
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

    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        $data = $request->validated();
        if ($request->hasFile('patient_img')) {
            $data['patient_img'] = imageUpdate($request, 'patient_img', 'patient_img', 'patients/', $patient->patient_img);
        } else {
            $data['patient_img'] = $patient->patient_img;
        }
        if ($request->hasFile('nid')) {
            $data['nid'] = imageUpdate($request, 'nid', 'nid', 'documents/', $patient->nid);
        } else {
            $data['nid'] = $patient->nid;
        }
        if ($request->hasFile('sonod')) {
            $data['sonod'] = imageUpdate($request, 'sonod', 'sonod', 'documents/', $patient->sonod);
        } else {
            $data['sonod'] = $patient->sonod;
        }
        if ($request->hasFile('prescription')) {
            $data['prescription'] = imageUpdate($request, 'prescription', 'prescription', 'documents/', $patient->prescription);
        } else {
            $data['prescription'] = $patient->prescription;
        }
        if ($request->has('medicine')) {
            foreach ($request->medicine as $key => $value) {
                Medicine::create([
                    'patient_id' => $patient->id,
                    'medicine'   => $value,
                    'price'      => $request->price[$key],
                ]);
            }
        }

        try {
            $patient->update($data);
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
        try {
            $medicine = Medicine::find($id);
            $medicine->delete();
            $medicines = Medicine::where('patient_id', $medicine->patient_id)->get();
            $html = '';
            foreach ($medicines as $i => $medicine) {
                $html .= "<tr>
                        <td>". $i+1 ."</td>
                        <td>{$medicine->medicine }</td>
                        <td>{$medicine->price}</td>
                        <td>
                            <a href='javascript:;' onclick='meddel(event, $medicine->id)'  class='btn btn-success btn-sm'  title='Delete'> <i class='fa fa-trash'></i></a>
                        </td>
                    </tr>";
            }
            return response()->json(['message' => __('app.success-message'), 'html' => $html], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
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
