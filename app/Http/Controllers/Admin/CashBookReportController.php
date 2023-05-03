<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashBookOffice;
use Illuminate\Http\Request;
use App\Basic_info_manage;

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
}
