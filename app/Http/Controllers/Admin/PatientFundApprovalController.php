<?php

namespace App\Http\Controllers\Admin;

use App\Models\Medicine;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Models\PatientFundRequest;
use App\Http\Controllers\Controller;
use App\Models\RequestedMedicine;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PatientFundApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $patients = PatientFundRequest::with(['patient','ApprovedMedicines'])->orderBy('created_at', 'desc');

            return DataTables::eloquent($patients)
            ->addColumn('requested_amt', function ($row) {
                return number_format($row->ApprovedMedicines->sum('requested_amt'),2);
            })
            ->addColumn('approved_amt', function ($row) {
                return number_format($row->ApprovedMedicines->sum('approved_amt'),2);
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('updated_at', function ($row) {
                return $row->updated_at ? $row->updated_at->diffForHumans() : 'Not Updated';
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block" style="">Pending</div>';
                } elseif ($row->status == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Approved </div>';
                } elseif ($row->status == 2) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block" style="">Canceled </div>';
                }
            })
            ->addColumn('action', function ($row) {
                $btn = '';

                // $btn .= view('button', ['type' => 'ajax-view', 'route' => route('admin.patient.show', $row->id), 'row' => $row]);
                $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.patient-fund-approval.edit', $row->id), 'row' => $row]);
                // if (Auth::user()->id == 1) {
                //     $btn .= '<button type="button" class="btn btn-success btn-sm" onclick="accept('.$row->id.')" title="Accept"><i class="material-icons">done_outline </i></button> ';
                //     $btn .= '<button type="button" class="btn btn-warning btn-sm" onclick="reject('.$row->id.')" title="Reject"><i class="material-icons">cancel_presentation</i></button> ';
                // }
                // $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.patient.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                return $btn;
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('patient_id') && $request->patient_id != '') {
                    $query->where('patient_id', $request->patient_id);
                }
            })
            ->rawColumns(['requested_amt','approved_amt','status','created_at','updated_at','action'])
            ->addIndexColumn()
            ->make(true);
        }
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.patient_fund_approval.index', $data);
    }

    public function edit(Request $request, PatientFundRequest $patient_fund_approval)
    {
        if ($request->ajax()) {
            $modal = view('admin.patient_fund_approval.edit')->with(['patient_fund_approval' => $patient_fund_approval])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    public function update(Request $request, PatientFundRequest $patient_fund_approval)
    {
        try {
            foreach ($request->medicine_id as $i => $approvalMedicine) {
                $data = [
                    'approved_amt' => $request->approved_amt[$i],
                ];
                RequestedMedicine::whereId($request->medicine_id[$i])->update($data);
            }
            $patient_fund_approval->update(['status' => 1, 'updated_at' => now()]);
            return response()->json(['message'=> 'Data Successfully Updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function getMedicines(Request $request)
    {
        try {
            $medicines = Medicine::where('patient_id', $request->patient_id)->get();
            $html = '';
            foreach ($medicines as $i => $medicine) {
                $html .= "<tr>
                        <input type='hidden'name='medicine_id[]' value='{$medicine->id }'>
                        <td>{$medicine->medicine }</td>
                        <td>{$medicine->price}</td>
                        <td>
                            <input type='text' class='form-control' name='requested_amt[]' value='0'>                            
                        </td>
                    </tr>";
            }
            return response()->json(['message' => __('app.success-message'), 'html' => $html], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
