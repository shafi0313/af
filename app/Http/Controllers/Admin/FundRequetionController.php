<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Models\FundRequetion;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class FundRequetionController extends Controller
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
            ->filter(function ($query) use ($request) {
                if ($request->has('patient_id') && $request->patient_id != '') {
                    $query->where('patient_id', $request->patient_id);
                }
            })
            ->rawColumns(['status', 'created_at','image'])
            ->make(true);
        }
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['patients'] = Patient::all();
        return view('admin.patient_fund_requetion.index', $data);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required',
            'amount'     => 'required|numeric',
            'comment'    => 'required|string',
            'image'      => 'required|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
        ]);
        if($request->hasFile('image')){
            $data['image'] = imageStore($request, 'image','patient_re', 'documents/');
        }
        // $date['updated_at'] = null;

        try {
            FundRequetion::create($data);
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

}
