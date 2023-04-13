<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Patient;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Models\CashBookOffice;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CashBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function office()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['offices'] = CashBookOffice::all();
        return view('admin.cash_book.office', $data);
    }

    public function officeStore(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:191',
            'address' => 'required|string|max:255',
        ]);

        try {
            CashBookOffice::create($data);
            Alert::success('Success', 'Office created successfully.');
            return back();
        } catch (\Exception $e) {
            // return $e->getMessage();
            Alert::error('Error', 'Something went wrong. Please try again later.');
            return back();
        }
    }

    public function entry($office)
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['students'] = User::query()->pluck('student_name','id')->prepend('Select..','')->toArray();
        $data['patients'] = Patient::query()->pluck('name','id')->toArray();
        $data['office'] = $office;
        return view('admin.cash_book.entry', $data);
    }
}
