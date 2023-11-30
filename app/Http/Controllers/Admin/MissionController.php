<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mission;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $missions = Mission::query();
            return DataTables::of($missions)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.missions.edit', $row->id), 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.missions.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.mission.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|max:100',
            'icon'    => 'required|max:255',
            'content' => 'required',
        ]);
        try {
            Mission::create($data);
            // return response()->json(['success' => 'Mission created successfully.']);
            Alert::success('Success', 'Mission created successfully.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Mission creation failed!');
            return back();
            // return $e->getMessage();
            // return response()->json(['error' => 'Mission creation failed!']);
        }
    }

    public function edit(Request $request, Mission $mission)
    {
        if ($request->ajax()) {
            $modal = view('admin.mission.edit')->with(['mission' => $mission])->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    public function update(Request $request, Mission $mission)
    {
        $data = $request->validate([
            'title'   => 'required|max:100',
            'icon'    => 'required|max:255',
            'content' => 'required',
        ]);

        try {
            $mission->update($data);
            // return response()->json(['message' => 'Data Successfully Inserted'], 200);
            Alert::success('Success', 'Data Updated Inserted');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Data Updated Failed');
            return back();
            // return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function destroy(Mission $mission)
    {
        try {
            $mission->delete();
            return response()->json(['message' => __('app.success-message')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
