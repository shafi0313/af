<?php

namespace App\Http\Controllers\Admin;

use App\Basic_info_manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MenuManage;
use RealRashid\SweetAlert\Facades\Alert;

class StudentFundRequetionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function edit($id)
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['student'] = MenuManage::find($id);
        return view('admin.student_fund_requetion.edit', $data);
    }

    public function update(Request $request, MenuManage $student_fund_requetion)
    {
        $data = $request->validate([
            'long_details' => 'required|string',
            'title'        => 'required|numeric',
            'recept_date'  => 'required|date',
            'month'        => 'required|string',
            'year'         => 'required|string',
            'image'        => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
        ]);
        
        if($request->hasFile('image')){
            $data['image'] = imageUpdate($request, 'image','student_recept', 'images/', $student_fund_requetion->image);
        }

        try {
            $student_fund_requetion->update($data);
            Alert::success('Success', 'Student Fund Requetion Updated Successfully');
            return redirect()->route('admin.menu-manage');
        } catch (\Exception $e) {
            Alert::error('Error', 'Student Fund Requetion Updated Failed');
            return back();
        }
    }
}
