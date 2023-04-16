<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Patient;
use App\Models\CashBook;
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
        $data['students']   = User::query()->pluck('student_name','id')->prepend('Select..','')->toArray();
        $data['patients']   = Patient::query()->pluck('name','id')->toArray();
        $data['office']     = CashBookOffice::find($office);
        $data['cashBooks']  = CashBook::with(['student','patient'])->whereIs_post(0)->get();
        $cashBook           = CashBook::select('debit','credit')->whereIs_post(1)->get();
        $data['closingBl']  = $cashBook->sum('debit') - $cashBook->sum('credit');
        return view('admin.cash_book.entry', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user'                => 'required',
            'cash_book_office_id' => 'required|numeric',
            'date'                => 'required|date',
            'narration'           => 'required|string|max:255',
            'debit'               => 'nullable|numeric',
            'credit'              => 'nullable|numeric',
            'payment_by'          => 'required|string|max:255',
        ]);

        $user_id = preg_replace('/[^0-9]/', '', $request->user);
        $user_identify = preg_replace('/[^a-z A-Z]/', '', $request->user);
        // return$request->user;
        if($user_identify == 's'){
            $data['user_type'] = 1;
        }else if ($user_identify == 'p') {
            $data['user_type'] = 2;
        }else{
            $data['user_type'] = 3;
        }
        // if(!empty($user_identify)){
        //     $data['debit'] = $request->debit;            
        // }else{
        //     $data['credit'] = $request->credit;
        // }
        $data['user_id'] = $user_id;
        

        // return $data;
        try {
            CashBook::create($data);
            toast('Cash book entry created successfully.','success');
            // Alert::success('Success', 'Cash book entry created successfully.');
            return back();
        } catch (\Exception $e) {
            return $e->getMessage();
            Alert::error('Error', 'Something went wrong. Please try again later.');
            return back();
        }
    }
}
