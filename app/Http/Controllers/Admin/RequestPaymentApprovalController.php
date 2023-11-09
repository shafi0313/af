<?php

namespace App\Http\Controllers\Admin;

use App\Basic_info_manage;
use App\Models\MenuManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class RequestPaymentApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // Requested Payment Approval
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $item = DB::table('menu_manages')
                ->leftjoin('users', 'users.id', '=', 'menu_manages.type')
                ->select('users.*', 'menu_manages.id as menu_id', 'menu_manages.title', 'menu_manages.long_details', 'menu_manages.image', 
                'menu_manages.type', 'menu_manages.short_details', 
                'menu_manages.completed', 'menu_manages.recept_date', 'menu_manages.month', 'menu_manages.year', 'menu_manages.monthly_fee_amount')
                ->orderby('menu_manages.short_details', 'asc')
                ->get();
            return DataTables::of($item)
                ->addColumn('created_at', function ($item) {
                    return bdDate($item->created_at);
                })
                ->addColumn('image', function ($item) {
                    return '<a href="images/' . $item->image . '" target="_blank"><img src="images/' . $item->image . '" class="img-thumbnail" width="30px"></a>';
                })
                ->addColumn('status', function ($item) {
                    if ($item->short_details == 0) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block">Pending</div>';
                    } elseif ($item->short_details == 1) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Approved</div>';
                    } elseif ($item->short_details == 2) {
                        return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block">Canceled</div>';
                    }
                })
                ->addColumn('action', function ($item) {
                    $completed = $item->completed == 1 ? 'disabled' : '';
                    $completedA = $item->completed == 1 ? 'disabled_' : '';
                    return '<div class="d-table mx-auto btn-group-sm btn-group">            
                        <a type="button" class="btn btn-primary btn-check edit ' . $completed . '" title="Approved" href="payment-approve-monhtly/' . $item->menu_id . '" id="' . $item->menu_id . '" onclick="return confirm(' . "'Do you want to accept this request?'" . ')">
                            <i class="material-icons">done</i>
                        </a>
                        <a class="btn btn-warning" href="' . route('admin.request-payment-approval.edit', $item->menu_id) . '">
                        <i class="fa-solid fa-file-pen"></i>
                        </a>
                        <button type="button" title="Delete" id="' . $item->menu_id . '" class="btn btn-danger delete" ' . $completed . '><i class="material-icons"></i></button>
                    </div>';
                })
                ->rawColumns(['long_details','created_at', 'image', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        // <a class="btn btn-warning ' . $completedA . '" href="' . route('admin.menu_manage_view2.completed', $item->menu_id) . '" onclick="return confirm(' . "'Do you want to disable this request?'" . ')">
        //                 <i class="fa-solid fa-file-pen"></i>
        //                 </a>
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.request_payment_approval.index', $data);
    }

    public function edit($id)
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['RPApproval'] = MenuManage::find($id);
        $data['students'] = DB::table('users')->orderby('id', 'desc')->get();
        return view('admin.request_payment_approval.edit', $data);
    }

    public function update(Request $request, $id)
    {      
        // $request->validate([
        //     'type'               => 'required',
        //     'title'              => 'required',
        //     'recept_date'        => 'required',
        //     'month'              => 'required',
        //     'monthly_fee_amount' => 'required',
        //     'year'               => 'required',
        //     'long_details'       => 'required',
        // ]);
        $RPApproval = MenuManage::find($id);
        $data = [
            'type'               => $request->type,
            'title'              => $request->title,
            'recept_date'        => $request->recept_date,
            'month'              => $request->month,
            'monthly_fee_amount' => $request->monthly_fee_amount,
            'year'               => $request->year,
            'long_details'       => $request->long_details,
        ];
        if($request->hasFile('image')){
            $data['image'] = imageUpdate($request, 'image', 'menu_', 'images/', $RPApproval->image);
        
        }
        $RPApproval->update($data);
        return back()->with('success', 'Request Payment Approval Updated Successfully');
    }
}
