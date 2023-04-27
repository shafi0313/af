<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashBookOffice;
use Illuminate\Http\Request;

class CashBookReportController extends Controller
{
    public function select()
    {
        $offices = CashBookOffice::all();
        return view('admin.cash_book_report.select', compact('offices'));
    }
}
