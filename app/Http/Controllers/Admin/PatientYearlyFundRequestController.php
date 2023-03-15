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
