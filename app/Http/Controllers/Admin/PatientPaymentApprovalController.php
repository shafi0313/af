<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Models\FundRequetion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PatientPaymentApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $applicants = FundRequetion::with('patient')->latest();
            return DataTables::eloquent($applicants)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                return '<img src="'.asset('documents/'.$row->image).'" alt="image" width="50" height="50">';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            // ->addColumn('updated_at', function ($row) {
            //     return $row->updated_at ? $row->updated_at->diffForHumans() : 'Not Updated';
            // })
            ->addColumn('status', function ($row) {
                if ($row->status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block">Pending</div>';
                } elseif ($row->status == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Approved</div>';
                } elseif ($row->status == 2) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block">Canceled </div>';
                }
            })
            ->addColumn('action', function ($row) {
                $btn = '';

                // $btn .= view('button', ['type' => 'ajax-view', 'route' => route('admin.patient.show', $row->id), 'row' => $row]);
                // $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.patient-fund-approval.edit', $row->id), 'row' => $row]);
                if (Auth::user()->id == 1) {
                    $btn .= '<button type="button" class="btn btn-success btn-sm" onclick="accept('.$row->id.')" title="Accept"><i class="material-icons">done_outline </i></button> ';
                    // $btn .= '<button type="button" class="btn btn-warning btn-sm" onclick="reject('.$row->id.')" title="Reject"><i class="material-icons">cancel_presentation</i></button> ';
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.patient-payment-approval.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                }
                // $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.patient-payment-approval.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                return $btn;
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('patient_id') && $request->patient_id != '') {
                    $query->where('patient_id', $request->patient_id);
                }
            })
            ->rawColumns(['status', 'created_at','image','action'])
            ->make(true);
        }
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.patient_payment_approval.index', $data);
    }

    public function accept(Request $request)
    {
        try {
            FundRequetion::find($request->id)->update(['status' => 1]);
            return response()->json(['message'=> 'Patient Accepted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
        }
    }

    public function destroy(FundRequetion $patient_payment_approval)
    {
        try {
            $patient_payment_approval->delete();
            return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
