<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Patient;
use App\Models\CashBook;
use App\Basic_info_manage;
use App\Models\MenuManage;
use App\Models\PeriodLock;
use App\Models\CashbookNote;
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
        $items = DB::table('menu_manages')
                ->leftjoin('cash_books', 'cash_books.user_id', '=', 'menu_manages.type')
                ->select(
                    'cash_books.user_id as user_id',
                    'cash_books.recept_date as c_recept_date',
                    'menu_manages.title',
                    'menu_manages.long_details',
                    'menu_manages.type',
                    'menu_manages.short_details',
                    'menu_manages.completed',
                    'menu_manages.recept_date',
                )->where('short_details',1)
                ->where('completed',1)
                ->get();
                foreach ($items as $item) {
                    DB::table('cash_books')
                        ->where('user_id', $item->type)
                        ->update(['recept_date' => $item->recept_date]);
                }


        $periodLock = PeriodLock::first()->date;
        if ($periodLock >= date('Y-m-d')) {
            Alert::info('Info', 'Period is locked.');
            return back();
        }
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
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong. Please try again later.');
        }
        return back();
    }

    public function entry($office)
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['students']   = User::query()->pluck('student_name', 'id')->prepend('Select..', '')->toArray();
        $data['patients']   = Patient::query()->pluck('name', 'id')->toArray();
        $data['office']     = CashBookOffice::find($office);
        $data['cashBooks']  = CashBook::with(['student', 'patient'])->whereIs_post(0)->get();
        // $cashBook           = GeneralLedger::whereSource('CBO')->select('debit', 'credit')->get();
        $cashBook             = CashBook::select('debit', 'credit')->whereIs_post(1)->get();
        $data['openingBl']    = $cashBook->sum('credit') - $cashBook->sum('debit');           //received - payment
        $data['cashbookNote'] = CashbookNote::first();
        return view('admin.cash_book.entry', $data);
    }

    public function getReceiptDate(Request $request)
    {
        if ($request->ajax()) {
            preg_match('/\d+/', $request->user_id, $matches);
            $user_id = $matches[0];
            $cashBook = CashBook::where('user_id', $user_id)->where('user_type', 1)->where('is_post', 1)->pluck('recept_date')->toArray();
            $receiptDate = MenuManage::where('type', $user_id)->where('short_details', 1)->where('completed', 1)->whereNotIn('recept_date',$cashBook)->get();

            return response()->json(['receiptDate' => $receiptDate]);
        }
    }

    public function getBalance(Request $request)
    {
        if ($request->ajax()) {
            $balance = MenuManage::find($request->id)->title;
            return response()->json($balance);
        }
    }

    public function store(Request $request)
    {
        $periodLock = PeriodLock::first()->date;
        if ($periodLock >= $request->date) {
            Alert::info('Info', 'Period is locked.');
            return back();
        }

        $data = $request->validate([
            'user'                => 'required',
            'cash_book_office_id' => 'required|numeric',
            'date'                => 'required|date',
            'recept_date'         => 'required|date',
            'narration'           => 'required|string|max:255',
            'debit'               => 'nullable|numeric',
            'credit'              => 'nullable|numeric',
            'payment_by'          => 'nullable|string|max:255',
        ]);

        $user_id = preg_replace('/[^0-9]/', '', $request->user); // Take user id
        $user_identify = preg_replace('/[^a-z A-Z]/', '', $request->user); // Take user identify
        if ($user_identify == 's') { // s = student
            $cashCheck = CashBook::whereUser_id($user_id)->whereDate('recept_date', $request->recept_date)->where('debit', $request->debit)->count();
            if ($cashCheck > 0) {
                toast('Cash book entry already exists.', 'error');
                return back();
            }
            $data['user_type'] = 1;
        } else if ($user_identify == 'p') { // p = patient
            $data['user_type'] = 2;
        } else if ($user_identify == 'e') { // e = employee
            $data['user_type'] = 4;
        } else {
            $data['user_type'] = 3;
        }
        $data['user_id'] = $user_id;
        try {
            CashBook::create($data);
            toast('Cash book entry created successfully.', 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            Alert::error('Error', 'Something went wrong. Please try again later.');
        }
        return back();
    }

    public function post(Request $request)
    {
        DB::beginTransaction();
        $tran_id = transaction_id('CBO');
        $cashBooks = CashBook::whereIs_post(0)->get();
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
        // For balance 
        $ledger['user_id']   = 0;
        $ledger['user_type'] = 0;
        $ledger['date']      = CashBook::whereIs_post(0)->orderBy('date', 'desc')->first()->date;
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

        try {
            GeneralLedger::create($ledger);
            CashBook::whereIs_post(0)->update(['is_post' => 1, 'tran_id' => $tran_id]);
            DB::commit();
            Alert::success('Success', 'Cash book entry posted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Something went wrong. Please try again later.');
        }
        return back();
    }

    public function destroy($id)
    {
        try {
            CashBook::find($id)->delete();
            toast('Cash book entry deleted successfully.', 'success');
        } catch (\Exception $e) {
            toast('Cash book entry delete failed.', 'error');
        }
        return back();
    }

    public function noteStore(Request $request)
    {
        try {
            if (CashbookNote::first()) {
                CashbookNote::first()->update(['note' => $request->note]);
            } else {
                CashbookNote::create(['note' => $request->note]);
            }
            toast('Note created successfully.', 'success');
        } catch (\Exception $e) {
            return $e->getMessage();
            toast('Note create failed.', 'error');
        }
        return back();
    }
}
