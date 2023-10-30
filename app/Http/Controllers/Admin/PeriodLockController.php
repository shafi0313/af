<?php

namespace App\Http\Controllers\Admin;

use App\Basic_info_manage;
use App\Models\PeriodLock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PeriodLockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['period_lock'] = PeriodLock::first();
        return view('admin.period-lock.index', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        PeriodLock::updateOrCreate(['id' => PeriodLock::first()->id],[
            'date' => $request->date,
        ]);

        try{
            Alert::success('Success', 'Period Locked Successfully');
            return back();
        } catch (\Exception $e) {
            Alert::success('Error', 'Something Went Wrong, Please Try Again!');
            return back();
        }
    }
}
