<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PatientYearlyFundRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $item = DB::table('order')
            ->select('*', 'patients.id as c_id', 'order.id as p_id', 'order.status as o_status')
            ->join('patients', 'patients.id', '=', 'order.student_id')
            ->orderBy('p_id', 'desc')->get();

            return DataTables::of($item)
            ->addColumn('status', function ($item) {
                if ($item->o_status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block" style="">Pending</div>';
                } elseif ($item->o_status == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Aprroved </div>';
                } elseif ($item->o_status == 2) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block" style="">Canceled </div>';
                }
            })
            ->rawColumns(['image', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.yearly_fund_request.patient.index', $data);
    }
    public function getPatient()
    {
        $item = DB::table('order')
            ->select('*', 'users.id as c_id', 'order.id as p_id', 'order.status as o_status')
            ->join('users', 'users.id', '=', 'order.student_id')
            ->orderBy('p_id', 'desc')
            ->get();

        return DataTables::of($item)->addColumn('status', function ($item) {
            if ($item->o_status == 0) {
                return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block" style="">Pending</div>';
            } elseif ($item->o_status == 1) {
                return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Aprroved </div>';
            } elseif ($item->o_status == 2) {
                return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block" style="">Canceled </div>';
            }
        })
        ->rawColumns(['image', 'status'])
        ->addIndexColumn()
        ->make(true);
    }
}
