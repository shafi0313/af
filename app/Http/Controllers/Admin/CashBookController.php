<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Patient;
use App\Models\CashBook;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Models\GeneralLedger;
use App\Models\CashBookOffice;
use Illuminate\Support\Facades\DB;
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
        $data['students']   = User::query()->pluck('student_name', 'id')->prepend('Select..', '')->toArray();
        $data['patients']   = Patient::query()->pluck('name', 'id')->toArray();
        $data['office']     = CashBookOffice::find($office);
        $data['cashBooks']  = CashBook::with(['student', 'patient'])->whereIs_post(0)->get();
        $cashBook           = GeneralLedger::whereSource('CBO')->select('debit', 'credit')->get();
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
        if ($user_identify == 's') {
            $data['user_type'] = 1;
        } else if ($user_identify == 'p') {
            $data['user_type'] = 2;
        } else {
            $data['user_type'] = 3;
        }
        $data['user_id'] = $user_id;

        // return $data;
        try {
            CashBook::create($data);
            toast('Cash book entry created successfully.', 'success');
            return back();
        } catch (\Exception $e) {
            return $e->getMessage();
            Alert::error('Error', 'Something went wrong. Please try again later.');
            return back();
        }
    }

    public function post(Request $request)
    {
        DB::beginTransaction();
        $tran_id = transaction_id('CBO');
        $cashBooks = CashBook::whereIs_post(0)->get();
        // return$cashBooks->first()->date;
        foreach ($cashBooks->groupBy(['user_id', 'user_type']) as $cashBookGroup) {
            foreach ($cashBookGroup as $cashBook) {
                $ledger['user_id']   = $cashBook->first()->user_id;
                $ledger['user_type'] = $cashBook->first()->user_type;
                $ledger['date']      = $cashBook->first()->date;
                $ledger['source']    = 'CBO';
                $ledger['tran_id']   = $tran_id;
                $ledger['debit']     = $cashBook->sum('debit');
                $ledger['credit']    = $cashBook->sum('credit');

                GeneralLedger::create($ledger);
            }
        }
        CashBook::whereIs_post(0)->update(['is_post' => 1, 'tran_id' => $tran_id]);

        $ledger['user_id']   = 0;
        $ledger['user_type'] = 0;
        $ledger['date']      = $cashBooks->first()->date;
        $ledger['source']    = 'CBO';
        $ledger['tran_id']   = $tran_id;
        $ledger['narration'] = 'Balance';
        if ($cashBooks->sum('debit') > $cashBooks->sum('credit')) {
            $ledger['credit'] = $cashBooks->sum('debit') - $cashBooks->sum('credit');
            $ledger['debit']  = 0;
        } else {
            $ledger['debit']  = $cashBooks->sum('credit') - $cashBooks->sum('debit');
            $ledger['credit'] = 0;
        }
        GeneralLedger::create($ledger);
        try{
            DB::commit();
            Alert::success('Success', 'Cash book entry posted successfully.');
            return back();
        }catch(\Exception $e){
            DB::rollback();
            Alert::error('Error', 'Something went wrong. Please try again later.');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            CashBook::find($id)->delete();
            toast('Cash book entry deleted successfully.', 'success');
            return back();
        } catch (\Exception $e) {
            toast('Cash book entry delete failed.', 'error');
            return back();
        }
    }
}
