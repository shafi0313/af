<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Models\Medicine;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Models\PatientFundRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RequestedMedicine;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PatientFundRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $patients = PatientFundRequest::with(['patient','ApprovedMedicines'])->latest();

            return DataTables::eloquent($patients)
            ->addColumn('requested_amt', function ($row) {
                return number_format($row->ApprovedMedicines->sum('requested_amt'),2);
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
            ->filter(function ($query) use ($request) {
                if ($request->has('patient_id') && $request->patient_id != '') {
                    $query->where('patient_id', $request->patient_id);
                }
            })
            ->rawColumns(['requested_amt','status','created_at','updated_at'])
            ->addIndexColumn()
            ->make(true);
        }
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['patients'] = Patient::all();
        return view('admin.fund_request.patient.index', $data);
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
                        <td>
                            <input type='text' class='form-control medicine_price' value='{$medicine->price}' readonly>                            
                         </td>
                        <td>
                            <input type='text' class='form-control requested_amt' name='requested_amt[]' value='0'>                            
                        </td>
                    </tr>";
            }
            return response()->json(['message' => __('app.success-message'), 'html' => $html], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $duplicateCheck = PatientFundRequest::where('patient_id', $request->patient_id)->where('year', $request->year)->get();
            if(count($duplicateCheck) > 0){
                Alert::error('Error', 'Patient Fund Request Already Created');
                return back();
            }
            $patient_fund_request = PatientFundRequest::create([
                'patient_id' => $request->patient_id,
                'year'       => $request->year,
                'status'     => 0,
                'updated_at' => null,
            ]);
            foreach ($request->medicine_id as $i => $medicine) {
                RequestedMedicine::create([
                    'patient_fund_request_id' => $patient_fund_request->id,
                    'medicine_id'             => $request->medicine_id[$i],
                    // 'medicine'                => $request->medicine[$i],
                    'requested_amt'            => $request->requested_amt[$i],
                ]);
            }
            DB::commit();
            Alert::success('Success', 'Patient Fund Request Created Successfully');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::success('Error', 'Patient Fund Request Created Failed');
            return back();
        }
    }
}
