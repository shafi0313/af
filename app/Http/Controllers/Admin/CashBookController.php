<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashBookController extends Controller
{
    public function office($data)
    {
        //
    }
    public function entry()
    {
        return view('admin.cash_book.entry');
    }
}
