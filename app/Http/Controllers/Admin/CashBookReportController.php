<?php

namespace App\Http\Controllers\Admin;

use App\Models\CashBook;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use App\Models\CashBookOffice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CashBookReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function select()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['offices'] = CashBookOffice::all();
        return view('admin.cash_book_report.select', $data);
    }

    public function report(Request $request)
    {
        $data['start_date'] = $request->start_date;
        $data['end_date']   = $request->end_date;
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['office']     = CashBookOffice::find($request->office_id);
        $data['cashBooks']  = CashBook::whereCash_book_office_id($request->office_id)
                                    ->whereIs_post(1)
                                    ->whereBetween('date',[$request->start_date, $request->end_date])
                                    ->orderBy('date','ASC')
                                    ->get();
        $data['openingBl'] = CashBook::whereCash_book_office_id($request->office_id)
                                    ->whereIs_post(1)
                                    ->where('date', '<', $request->start_date)
                                    ->get(['debit','credit']);
        return view('admin.cash_book_report.report', $data);
    }
}
