<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Admin;
use App\Menu_manage;
use App\News_manage;
use App\Crone_record;
use App\Home_product;
use App\Slide_manage;
use App\Product_manage;
use App\Basic_info_manage;
use App\Withdrawel_report;
use App\Admin_wallet_manage;
use Illuminate\Http\Request;
use App\Hold_transfer_amount;
use App\Income_transaction_record;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $today                    = date('Y-m-d');
        $data['admin_info']       = Admin::find(1);

        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        return view('admin.index', $data);
    }

    public function profile()
    {
        $user_id                  = Session::get('userId');

        $data['admin_info']       = Admin::find(1);
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();

        $data['countryList']      = DB::table('countries')->get();
        return view('admin.profile', $data);
    }


    public function password_update(Request $request)
    {
        $user_id                  = 1;
        $old_pass_check           = DB::table('admins')->where('id', $user_id)->first();
        if (!(Hash::check($request->old_tran_password, $old_pass_check->password))) {
            echo 2;
            exit();
        }
        if ($request->tran_password != $request->tran_new_password) {
            //if new pass n confirm pass is not same
            echo 4;
            exit();
        }
        $validator = Validator::make($request->all(), [
            'tran_new_password' => 'required',

        ]);
        if ($validator->fails()) {
            echo 5;
            exit();
        }
        $data['password']       = Hash::make($request->tran_new_password);

        DB::table('admins')->where('id', $user_id)->update($data);

        echo 1;
    }

    public function summary_report()
    {
        $today                    = date('Y-m-d');
        $data['admin_info']       = Admin::find(1);
        $data['total_user']       = User::count();
        $data['today_user']       = User::where('active_date', $today)->count();
        $data['ref_distr']        = Income_transaction_record::where('purpose', 'referrel_income_distribute')->sum('amount');
        $data['downline_amnt_dist'] = Income_transaction_record::where('purpose', 'downlink_amount_distribute')->sum('amount');
        $data['renk_reward']      = Income_transaction_record::where('given_to', 'user_rank')->sum('amount');
        $data['wallet_move']      = Income_transaction_record::where('given_to', 'admin')->where('purpose', 'wallet_move')->sum('amount');
        $data['wallet_transfer']  = Income_transaction_record::where('given_to', 'admin')->where('purpose', 'wallet_transfer')->sum('amount');
        $data['withdraw']         = Income_transaction_record::where('given_to', 'admin')->where('purpose', 'admin_withdraw_percent')->sum('amount');
        $data['overflow']         = Income_transaction_record::where('given_to', 'admin')->where('purpose', 'referrel_income_overflow')->sum('amount');

        $data['admin_active']     = Income_transaction_record::where('given_to', 'admin')->where('purpose', 'member_reg_by_admin')->sum('amount');

        $data['user_active']     = Income_transaction_record::where('given_to', 'admin')->where('purpose', 'member_reg')->sum('amount');

        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();

        return view('admin.summary_report', $data);
    }


    public function add_fund()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.add_fund_page', $data);
    }


    public function agent_fund()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.agent_fund_page', $data);
    }

    public function agent_store(Request $request)
    {
        $id = $request->inputUnitId;
        if (empty($id)) {
            $data['name'] = $request->name;
            DB::table('category_manages')->insert($data);
            echo 1;
        } else {
            $data['name'] = $request->name;
            DB::table('category_manages')->where('id', $id)->update($data);
            echo 2;
        }
    }


    public function agent_view(Request $request)
    {
        $item =  DB::table('category_manages')->orderby('id', 'desc')->get();
        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<button type="button" class="btn btn-white edit" id="' . $item->id . '"><i class="material-icons"></i></button>

            ';
        })
            ->addIndexColumn()
            ->make(true);
    }


    public function category_edit(Request $request)
    {
        $item = DB::table('category_manages')->find($request->input('id'));
        echo json_encode($item);
    }

    public function delete_category(Request $request)
    {
        DB::table('category_manages')->where('id', $request->id)->delete();
        echo 1;
    }

    public function agent_wallet_transfer()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['admin_info'] = DB::table('admins')->where('id', Auth::user()->id)->first();
        return view('admin.wallet_tranfser', $data);
    }

    public function applicants()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['admin_info'] = DB::table('admins')->where('id', Auth::user()->id)->first();
        return view('admin.applicants', $data);
    }


    public function view_applicants()
    {
        $sell_list =  DB::table('users')->get();

        return DataTables::of($sell_list)
            ->addColumn('action', function ($sell_list) {
                return '<div class="d-table mx-auto row btn-group-sm btn-group">         
            <button type="button" id="' . $sell_list->id . '" class="btn btn-primary view"><i class="material-icons">visibility</i></button>
            <div class="d-table mx-auto storage/product/btn-group-sm btn-group">';
            })
            ->addColumn('status', function ($sell_list) {
                if ($sell_list->status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block" style="">
                        Pending
                         </div>';
                } elseif ($sell_list->status == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">
            Aprroved </div>';
                } elseif ($sell_list->status == 2) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block" style="">
            Canceled </div>';
                }
            })

            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }


    public function approve_amnt_req(Request $request)
    {
        $duplicateCheck = DB::table('order')->whereStudent_id($request->student_id)->where('year', $request->year)->get();
        if ($duplicateCheck->count() > 0) {
            Session::flash('msg', 'Already Requested');
            Session::flash('class', 'alert-danger');
            return redirect('admin/agent-wallet-withdraw');
        }
        DB::table('order')->insert([
            'student_id' => $request->student_id,
            'req_amnt' => $request->grand_total,
            'year' => $request->year,
            'aprv_amnt' => 0,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        foreach ($request->expense as $key => $value) {
            if (!empty($request->quantity[$key])) {
                DB::table('order_details')->insert([
                    'order_id' => $insertid,
                    'student_id' => $request->student_id,
                    'ex_id' => $request->expense[$key],
                    'req_amnt' => $request->quantity[$key],
                    'aprv_amnt' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        Session::flash('msg', 'Register Success');
        Session::flash('class', 'alert-success');
        return redirect('admin/agent-wallet-withdraw');
    }

    public function approve_amnt_req2(Request $request)
    {
        // return $request->all();
        DB::table('order')->where('id', $request->id)->update([
            'aprv_amnt' => $request->grand_total,
            'status' => 1,
            'updated_at' => now(),
        ]);

        foreach ($request->expense as $key => $value) {
            if (!empty($request->quantity[$key])) {
                DB::table('order_details')->where('id', $request->expense[$key])->update([
                    'req_amnt'   => $request->quantity[$key],
                    'aprv_amnt'  => $request->approve[$key],
                    'updated_at' => now(),
                ]);
            }
        }
        Session::flash('msg', 'Successfully updated');
        Session::flash('class', 'alert-success');
        return redirect('admin/payment-approve');
    }

    public function agent_with_report_all()
    {
        $user_id  = Auth::user()->id;

        $unit =  DB::table('income_transaction_records')->where('user_id', $user_id)->where('purpose', 'agent_withdraw')->get();
        return DataTables::of($unit)
            ->addIndexColumn()
            ->make(true);
    }


    public function agent_wallet_transfer_all()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['admin_info'] = DB::table('admins')->where('id', Auth::user()->id)->first();
        return view('admin.wallet_tranfser_all', $data);
    }

    public function payment_approve()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['admin_info'] = DB::table('admins')->where('id', Auth::user()->id)->first();
        return view('admin.payment_approve', $data);
    }

   

    public function agent_with_report()
    {
        $item = DB::table('order')
            ->select('*', 'users.id as c_id', 'order.id as p_id', 'order.status as o_status')
            ->join('users', 'users.id', '=', 'order.student_id')
            // ->join('menu_manages', 'menu_manages.type', '=', 'order.student_id')
            ->orderBy('o_status', 'ASC')
            ->get();

        return DataTables::of($item)->addColumn('status', function ($item) {
            if ($item->o_status == 0) {
                return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block" style="">Pending</div>';
            } elseif ($item->o_status == 1) {
                return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Approved </div>';
            } elseif ($item->o_status == 2) {
                return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block" style="">Canceled </div>';
            }
        })
            ->addColumn('action', function ($item) {
                return '<a type="button" class="btn btn-white yearlyFundRequest" data-id="' . $item->id . '"><i class="fa-solid fa-eye"></i></a>';
            })
            ->addColumn('created_at', function ($item) {
                return bdDate($item->created_at);
            })
            ->rawColumns(['action', 'created_at', 'image', 'status'])
            ->addIndexColumn()
            ->make(true);
    }

    public function agent_with_report_show(Request $request)
    {
        if ($request->ajax()) {
            return $orderDetails = DB::table('order_details')
                ->select('expenses.id as exp_id', 'expenses.name', 'order_details.order_id', 'order_details.req_amnt', 'order_details.aprv_amnt', 'users.student_name')
                ->join('expenses', 'expenses.id', '=', 'order_details.ex_id')
                ->join('users', 'users.id', '=', 'order_details.student_id')
                ->where('order_details.order_id', $request->id)
                ->get();
            return response()->json($orderDetails);
        }
    }


    public function agent_with_report2()
    {
        $item = DB::table('order')
            ->select('*', 'users.id as c_id', 'order.id as p_id', 'order.status as o_status')
            ->join('users', 'users.id', '=', 'order.student_id')
            ->orderBy('o_status', 'asc')
            ->get();

        return DataTables::of($item)
            ->addColumn('status', function ($item) {
                if ($item->o_status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block" style="">Pending</div>';
                } elseif ($item->o_status == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Aprroved </div>';
                } elseif ($item->o_status == 2) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block" style="">Canceled </div>';
                }
            })
            ->addColumn('created_at', function ($item) {
                return bdDate($item->created_at);
            })
            ->addColumn('action', function ($item) {
                return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">            
                    <a type="button" target="_blank" class="btn btn-white edit" href="approve/' . $item->p_id . '"><i class="material-icons"></i></a>
                </div>';
            })

            ->rawColumns(['created_at', 'action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }


    public function approve_amnt($id)
    {
        $data['order'] =   DB::table('order')->where('id', $id)->first();
        $data['student'] =   DB::table('users')->where('id', $data['order']->student_id)->first();
        $data['order_d'] =   DB::table('order_details')->where('order_id', $id)->get();
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();

        return view('admin.approve_amnt', $data);
    }


    public function basic_info_manage()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();

        return view('admin.basic_info_manage_page', $data);
    }

    public function basic_info_view()
    {
        $item = Basic_info_manage::where('id', 1)->get();
        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">            
            <button type="button" class="btn btn-white edit" id="' . $item->id . '"><i class="material-icons"></i></button>
            ';
        })->addColumn('image', function ($item) {
            return '<img src="images/' . $item->logo . '" class="img-thumbnail" width="70px">';
        })
            ->rawColumns(['image', 'action'])
            ->addIndexColumn()
            ->make(true);
    }


    public function basic_info_edit(Request $request)
    {
        $Basic_info_manage = Basic_info_manage::find($request->input('id'));
        echo json_encode($Basic_info_manage);
    }


    public function basic_update(Request $request)
    {
        if ($request->itemId != "") {
            $Basic_info = Basic_info_manage::find($request->itemId);
        } else {
            echo $out;
        }
        if ($request->hasFile('ProductPic')) {
            $validator = Validator::make($request->all(), [
                'ProductPic' => 'max:20000',
            ]);
            if ($validator->fails()) {
                return;
            }

            if (File::exists('images/' . $Basic_info->logo)) {
                File::delete('images/' . $Basic_info->logo);
            }
            $extension = $request->file('ProductPic')->getClientOriginalExtension();
            $fileStore2 = rand(10, 100) . time() . "." . $extension;
            $request->file('ProductPic')->move(public_path("images"), $fileStore2);
            $Basic_info->logo = $fileStore2;
        }


        if ($request->hasFile('promo_image')) {
            $validator = Validator::make($request->all(), [
                'promo_image' => 'max:20000',
            ]);
            if ($validator->fails()) {
                return;
            }

            if (File::exists('images/' . $Basic_info->promo_image)) {
                File::delete('images/' . $Basic_info->promo_image);
            }
            $extension = $request->file('promo_image')->getClientOriginalExtension();
            $fileStore2 = rand(10, 100) . time() . "." . $extension;
            $request->file('promo_image')->move(public_path("images"), $fileStore2);
            $Basic_info->promo_image = $fileStore2;
        }

        $Basic_info->website_title   = $request->website_title;
        $Basic_info->mobile          = $request->mobile;
        $Basic_info->email           = $request->email;
        $Basic_info->web_address     = $request->web_address;
        $Basic_info->address         = $request->address;
        $Basic_info->withdraw_charge = $request->withdraw_charge;
        $Basic_info->wall_move_charge = $request->wall_move_charge;
        $Basic_info->wall_tran_charge = $request->wall_tran_charge;
        $Basic_info->btc_amount      = $request->btc_amount;
        $Basic_info->btc_wallet      = $request->btc_wallet;
        $Basic_info->currency        = $request->currency;
        $Basic_info->notice          = $request->notice;
        $Basic_info->profit_share_charge    = $request->profit_share_charge;
        $Basic_info->save();
        echo 1;
    }


    public function product_manage()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['category']   = DB::table('category_manages')->orderBy('id', 'desc')->get();
        return view('admin.package_manage_page', $data);
    }

    public function product_view()
    {
        $item = DB::table('product_manages')
            ->select('*', 'category_manages.id as c_id', 'product_manages.id as p_id')
            ->join('category_manages', 'category_manages.id', '=', 'product_manages.category')
            ->orderBy('p_id', 'desc')
            ->get();
        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">         
            <button type="button" id="' . $item->p_id . '" class="btn btn-white view"><i class="material-icons"></i></button>   
            <button type="button" class="btn btn-white edit" id="' . $item->p_id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $item->p_id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            ';
        })->addColumn('image', function ($item) {
            return '<img src="images/' . $item->logo . '" class="img-thumbnail" width="70px">';
        })

            ->rawColumns(['image', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function home_product_manage()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.home_product', $data);
    }

    public function home_product_view()
    {
        $item = DB::table('home_products')->get();
        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">         
            <button type="button" id="' . $item->id . '" class="btn btn-white view"><i class="material-icons"></i></button>   
            <button type="button" class="btn btn-white edit" id="' . $item->id . '"><i class="material-icons"></i></button>
            ';
        })->addColumn('image', function ($item) {
            return '<img src="images/' . $item->logo . '" class="img-thumbnail" width="70px">';
        })
            ->rawColumns(['image', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function delete_item(Request $request)
    {
        DB::table('product_manages')->where('id', $request->id)->delete();
        echo 1;
    }

    public function ViewSingleProduct(Request $request)
    {
        $item = User::find($request->id);

        $output = array(
            'student_name' => $item->student_name,
            'father_name' => $item->father_name,
            'mother_name' => $item->mother_name,
            'gram' => $item->gram,
            'post_office' => $item->post_office,
            'thana' => $item->thana,
            'disctrict' => $item->disctrict,
            'finance' => $item->finance,
            'class' => $item->class,
            'fee' => $item->fee,
            'admission_fee' => $item->admission_fee,
            'board_reg_fee' => $item->board_reg_fee,
            'book_purchase' => $item->book_purchase,
            'exm_fee1' => $item->exm_fee1,
            'exm_fee2' => $item->exm_fee2,
            'exm_fee3' => $item->exm_fee3,
            'phone' => $item->phone,
            'phone2' => $item->phone2,
            'email' => $item->email,
            'member' => $item->member,
            'school' => $item->school,
            'income' => $item->income,
            'expense' => $item->expense,
            'student_image' => $item->student_image,
            'student_idcard' => $item->student_idcard,
            'parent_idcard' => $item->parent_idcard,
            'charac_cer' => $item->charac_cer,
            'marksheet' => $item->marksheet,
            'document' => $item->document,
            'status' => $item->status,
            'joining_date' => $item->joining_date,
            'created' => $item->created_at
        );
        echo json_encode($output);
    }


    public function status_update(Request $request)
    {
        $item                 = User::find($request->id);
        $data['status']       = 1;
        $data['updated_at']   = date('Y-m-d H:i:s');
        DB::table('users')->where('id', $item->id)->update($data);
        echo 1;
    }

    public function status_update_no(Request $request)
    {
        $item                 = User::find($request->id);
        $data['status']       = 2;
        DB::table('users')->where('id', $item->id)->update($data);
        echo 1;
    }


    public function product_edit(Request $request)
    {
        $item = DB::table('product_manages')->find($request->input('id'));
        echo json_encode($item);
    }

    public function home_product_edit(Request $request)
    {
        $item = DB::table('home_products')->where('id', $request->id)->first();
        echo json_encode($item);
    }

    public function view_edit_unit(Request $request)
    {
        $item = DB::table('content_manages')->find($request->input('id'));
        echo json_encode($item);
    }


    public function homestatus_update(Request $request)
    {
        $item   = Home_product::find($request->id);
        $output = array(
            'product_name' => $item->product_name,
            'price' => $item->price,
            'point' => $item->point,
            'quantity' => $item->quantity,
            'delivery_quantity' => $item->delivery_quantity,
            'logo' => $item->logo,
            'created' => $item->created_at
        );
        echo json_encode($output);
    }


    public function home_product_insert(Request $request)
    {
        if ($request->itemId != "") {
            $Basic_info = Home_product::find($request->itemId);
        } else {
            $Basic_info = new Home_product;
        }

        if ($request->hasFile('ProductPic')) {
            $validator = Validator::make($request->all(), [
                'ProductPic' => 'max:200000',
            ]);
            if ($validator->fails()) {
                return;
            }

            if (File::exists('images/' . $Basic_info->logo)) {
                File::delete('images/' . $Basic_info->logo);
            }
            $extension = $request->file('ProductPic')->getClientOriginalExtension();
            $fileStore2 = rand(10, 100) . time() . "." . $extension;
            $request->file('ProductPic')->move(public_path("images"), $fileStore2);
            $Basic_info->logo = $fileStore2;
        }

        /*
            if ($request->hasFile('promo_image')) {

                $validator = Validator::make($request->all(), [
                'promo_image' => 'max:20000',
                ]);
                if ($validator->fails()) {
                    return ;
                }

                if (File::exists('images/' .$Basic_info->promo_image))
                {
                  File::delete('images/' .$Basic_info->promo_image);
                }
                $extension = $request->file('promo_image')->getClientOriginalExtension();
                $fileStore2 = rand(10, 100) . time() . "." . $extension;
                $request->file('promo_image')->move(public_path("images"), $fileStore2);
                $Basic_info->promo_image = $fileStore2;
            }*/

        $Basic_info->product_name        = $request->product_name;
        $Basic_info->rank_name           = strtolower(str_replace(' ', '_', $request->product_name));
        $Basic_info->price               = 0;
        $Basic_info->point               = 0;
        $Basic_info->quantity            = 0;
        $Basic_info->delivery_quantity   = 0;
        $Basic_info->category            = 0;
        $Basic_info->save();

        if ($request->itemId != "") {
            echo 1;
        } else {
            echo 2;
        }
    }

    public function product_insert(Request $request)
    {
        if ($request->itemId != "") {
            $Basic_info = Product_manage::find($request->itemId);
        } else {
            $Basic_info = new Product_manage;
        }

        if ($request->hasFile('ProductPic')) {
            $validator = Validator::make($request->all(), [
                'ProductPic' => 'max:200000',
            ]);
            if ($validator->fails()) {
                return;
            }

            if (File::exists('images/' . $Basic_info->logo)) {
                File::delete('images/' . $Basic_info->logo);
            }
            $extension = $request->file('ProductPic')->getClientOriginalExtension();
            $fileStore2 = rand(10, 100) . time() . "." . $extension;
            $request->file('ProductPic')->move(public_path("images"), $fileStore2);
            $Basic_info->logo = $fileStore2;
        }

        /*
            if ($request->hasFile('promo_image')) {

                $validator = Validator::make($request->all(), [
                'promo_image' => 'max:200000',
                ]);
                if ($validator->fails()) {
                    return ;
                }

                if (File::exists('images/' .$Basic_info->promo_image))
                {
                  File::delete('images/' .$Basic_info->promo_image);
                }
                $extension = $request->file('promo_image')->getClientOriginalExtension();
                $fileStore2 = rand(10, 100) . time() . "." . $extension;
                $request->file('promo_image')->move(public_path("images"), $fileStore2);
                $Basic_info->promo_image = $fileStore2;
            }*/

        $Basic_info->product_name        = $request->product_name;
        $Basic_info->rank_name           = strtolower(str_replace(' ', '_', $request->product_name));
        $Basic_info->price               = $request->price;
        $Basic_info->point               = 0;
        $Basic_info->quantity            = 0;
        $Basic_info->delivery_quantity   = 0;
        $Basic_info->category            = $request->category;
        $Basic_info->save();

        if ($request->itemId != "") {
            echo 1;
        } else {
            echo 2;
        }
    }


    public function slide_manage()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.slide_manage_page', $data);
    }

    public function slide_manage_view()
    {
        $item = Slide_manage::all();
        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">            
            <button type="button" class="btn btn-white edit" id="' . $item->id . '"><i class="material-icons"></i></button><button type="button" id="' . $item->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            ';
        })
            ->addColumn('image', function ($item) {
                return '<img src="images/' . $item->image . '" class="img-thumbnail" width="30px">';
            })
            ->addColumn('type', function ($item) {
                if ($item->type == 1) {
                    return 'SLIDE';
                } elseif ($item->type == 2) {
                    return 'ABOUT';
                } elseif ($item->type == 3) {
                    return 'OUR PLANING';
                }
            })
            ->rawColumns(['image', 'action', 'type'])
            ->addIndexColumn()
            ->make(true);
    }


    public function slide_insert(Request $request)
    {
        if (!empty($request->id)) {
            $Slide_manage     = Slide_manage::find($request->id);
        } else {
            $Slide_manage     = new Slide_manage();
        }

        if ($request->hasFile('ProductPic')) {
            $validator = Validator::make($request->all(), [
                'ProductPic' => 'max:100000',
            ]);

            if ($validator->fails()) {
                return;
            }

            if (File::exists('images/' . $Slide_manage->image)) {
                File::delete('images/' . $Slide_manage->image);
            }
            $extension = $request->file('ProductPic')->getClientOriginalExtension();
            $fileStore2 = rand(10, 100) . time() . "." . $extension;
            $request->file('ProductPic')->move(public_path("images"), $fileStore2);
            $Slide_manage->image = $fileStore2;
        }

        $Slide_manage->title           = $request->title;
        $Slide_manage->short_details   = $request->short_details;
        $Slide_manage->long_details    = $request->long_details;
        $Slide_manage->type            = $request->type;
        $slug                          = $request->type;

        if ($slug == 1) {
            $Slide_manage->slug =  str_replace(" ", "-", strtolower("SLIDE"));
        } elseif ($slug == 2) {
            $Slide_manage->slug = str_replace(" ", "-", strtolower("ABOUT"));
        } elseif ($slug == 3) {
            $Slide_manage->slug = str_replace(" ", "-", strtolower("OUR PLANING"));
        }

        $Slide_manage->save();
        if (!empty($request->id)) {
            echo 1;
        } else {
            echo 2;
        }
    }


    public function slide_manage_edit(Request $request)
    {
        $slide_manages = Slide_manage::find($request->input('id'));
        echo json_encode($slide_manages);
    }


    public function slide_manage_delete(Request $request)
    {
        $slide_manages = Slide_manage::find($request->input('id'));
        if (File::exists('images/' . $slide_manages->image)) {
            File::delete('images/' . $slide_manages->image);
        }
        if ($slide_manages->delete()) {
            echo "1";
        }
    }


    public function news_manage()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.news_manage_page', $data);
    }

    public function news_manage_view()
    {
        $item = DB::table('news_manages')->orderBy('id', 'desc')->get();
        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">            
            <button type="button" class="btn btn-white edit" id="' . $item->id . '"><i class="material-icons"></i></button><button type="button" id="' . $item->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            ';
        })
            ->addColumn('image', function ($item) {
                return '<img src="images/' . $item->image . '" class="img-thumbnail" width="30px">';
            })

            ->rawColumns(['image', 'action'])
            ->addIndexColumn()
            ->make(true);
    }


    public function news_insert(Request $request)
    {
        if (!empty($request->id)) {
            $Slide_manage     = News_manage::find($request->id);
        } else {
            $Slide_manage     = new News_manage();
        }

        if ($request->hasFile('ProductPic')) {
            /*  $validator = Validator::make($request->all(), [
            'ProductPic' => 'max:100000',
            ]);

            if ($validator->fails()) {
                return ;
            }
*/
            if (File::exists('images/' . $Slide_manage->image)) {
                File::delete('images/' . $Slide_manage->image);
            }
            $extension = $request->file('ProductPic')->getClientOriginalExtension();
            $fileStore2 = rand(10, 100) . time() . "." . $extension;
            $request->file('ProductPic')->move(public_path("images"), $fileStore2);
            $Slide_manage->image = $fileStore2;
        }

        $Slide_manage->title           = $request->title;
        $Slide_manage->short_details   = $request->short_details;
        $Slide_manage->long_details    = $request->long_details;
        $Slide_manage->slug =  str_replace(" ", "-", strtolower("NEWS"));


        $Slide_manage->save();
        if (!empty($request->id)) {
            echo 1;
        } else {
            echo 2;
        }
    }


    public function news_manage_edit(Request $request)
    {
        $news_manages = DB::table('news_manages')->find($request->input('id'));
        echo json_encode($news_manages);
    }


    public function news_manage_delete(Request $request)
    {
        $news_manages = DB::table('news_manages')->find($request->input('id'));
        if (File::exists('images/' . $news_manages->image)) {
            File::delete('images/' . $news_manages->image);
        }

        DB::table('news_manages')->where('id', $request->id)->delete();
        echo 1;
    }

    public function menu_manage()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.menu_manage_page', $data);
    }

    public function menu_manage2()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.menu_manage_page2', $data);
    }

    public function menu_manage_view()
    {
        $item = DB::table('menu_manages')
            ->select([
                'users.*',
                'menu_manages.type',
                'menu_manages.id as menu_manages_id',
                'menu_manages.image',
                'menu_manages.long_details',
                'menu_manages.title',
                'menu_manages.short_details',
                'menu_manages.completed',
                'menu_manages.recept_date as recept_date',
                'menu_manages.month',
                'menu_manages.monthly_fee_amount',
                'menu_manages.year',
            ])
            ->leftjoin('users', 'users.id', '=', 'menu_manages.type')
            ->orderby('menu_manages.short_details', 'asc')
            ->orderby('menu_manages.recept_date', 'DESC')
            ->get();
        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">            
            <button type="button" class="btn btn-white edit" id="' . $item->id . '"><i class="material-icons"></i></button><button type="button" id="' . $item->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            ';
        })
            ->addColumn('recept_date', function ($item) {
                return $item->recept_date ? bdDate($item->recept_date) : '';
            })
            ->addColumn('image', function ($item) {
                return '<a href="images/' . $item->image . '" target="_blank"><img src="images/' . $item->image . '" class="img-thumbnail" width="30px"></a>';
            })
            ->addColumn('status', function ($item) {
                if ($item->short_details == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block">Pending</div>';
                } elseif ($item->short_details == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">Approved</div>';
                } elseif ($item->short_details == 2) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block">Canceled</div>';
                }
            })
            ->addColumn('action', function ($item) {
                $route = route('admin.menu_manage_view_delete', $item->menu_manages_id);
                $routeEdit = route('admin.student-fund-requetion.edit', $item->menu_manages_id);
                if ($item->completed == 0) {
                    return '<a href="' . $routeEdit . '" class="btn btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="' . $route . '" class="btn btn-danger">
                                <i class="material-icons"></i>
                            </a>';
                }
            })
            ->rawColumns(['recept_date', 'long_details', 'image', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }
    public function menu_manage_view_delete($id)
    {
        $data = DB::table('menu_manages')->where('id', $id)->first();
        $path = public_path('images/' . $data->image);
        if (@GetImageSize($path)) {
            unlink($path);
        }
        try {
            DB::table('menu_manages')->where('id', $id)->delete();
            Alert::success('Deleted Successfully');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong');
            return back();
        }
    }

    

    public function menu_manage_view2completed($id)
    {
        $check = DB::table('menu_manages')->where('id', $id)->first();
        if ($check->short_details == 0) {
            Alert::info('Info', 'At first accept this request');
            return back();
        }
        try {
            DB::table('menu_manages')->where('id', $id)->update(['completed' => 1]);
            Alert::success('Success');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong');
            return back();
        }
    }
    // Requested Payment Approval

    public function menu_insert(Request $request)
    {
        if (!empty($request->id)) {
            $Slide_manage = Menu_manage::find($request->id);
        } else {
            $Slide_manage = new Menu_manage();
        }

        // $requisitionAmt = Menu_manage::where('year', $request->year)->where('type', $request->type)->sum('title');

        $aprv_amnt = DB::table('order')->where('year', $request->year)->where('student_id', $request->type)->sum('aprv_amnt');
        $payment = DB::table('order')->where('year', $request->year)->where('student_id', $request->type)->sum('accmulative_amnt');

        if($payment + $request->title > $aprv_amnt){
            return back()->with('error', 'You can not request more than approved amount');
            echo 3;
            exit();
        }
        

        if ($request->hasFile('ProductPic')) {
            $validator = Validator::make($request->all(), [
                'ProductPic' => 'max:512',
            ]);

            if ($validator->fails()) {
                return;
            }

            if (File::exists('images/' . $Slide_manage->image)) {
                File::delete('images/' . $Slide_manage->image);
            }
            $extension = $request->file('ProductPic')->getClientOriginalExtension();
            $fileStore2 = rand(10, 100) . time() . "." . $extension;
            $request->file('ProductPic')->move(public_path("images"), $fileStore2);
            $Slide_manage->image = $fileStore2;
        }

        $Slide_manage->title              = $request->title;
        $Slide_manage->type               = $request->type;
        $Slide_manage->recept_date        = $request->recept_date;
        $Slide_manage->short_details      = 0;
        $Slide_manage->long_details       = $request->long_details;
        $Slide_manage->month              = $request->month;
        $Slide_manage->monthly_fee_amount = $request->monthly_fee_amount;
        $Slide_manage->year               = $request->year;
        $Slide_manage->save();
        if (!empty($request->id)) {
            echo 1;
        } else {
            echo 2;
        }
    }


    public function menu_manage_edit(Request $request)
    {
        $slide_manages = Menu_manage::find($request->input('id'));
        echo json_encode($slide_manages);
    }


    public function menu_manage_delete(Request $request)
    {
        $slide_manages = Menu_manage::find($request->input('id'));
        if (File::exists('images/' . $slide_manages->image)) {
            File::delete('images/' . $slide_manages->image);
        }
        if ($slide_manages->delete()) {
            echo "1";
        }
    }

    public function AddUnit(Request $request)
    {
        if (empty($request->inputUnitId)) {
            $data['title']      = $request->unitName;
            $data['type']       = $request->type;
            $data['details']    = $request->detail;
            DB::table('content_manages')->insert($data);
            echo 1;
        } else {
            $data['title']      = $request->unitName;
            $data['details']    = $request->detail;
            DB::table('content_manages')->where('id', $request->inputUnitId)->update($data);
            echo 2;
        }
    }

    public function ViewUnit()
    {
        $unit = DB::table('content_manages')->orderBy('id', 'desc')->get();
        return DataTables::of($unit)
            ->addColumn('action', function ($unit) {
                return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
                         <button type="button" class="btn btn-primary edit" id="' . $unit->id . '"><i class="material-icons">edit</i></button>
                         </div>';
            })
            ->addColumn('type', function ($sell_list) {
                if ($sell_list->type == 1) {
                    return 'About Us';
                } elseif ($sell_list->type == 2) {
                    return 'Terms & Condition';
                }
            })
            ->rawColumns(['action', 'type'])
            ->addIndexColumn()
            ->make(true);
    }


    public function registration()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['user_list']  = User::all();
        return view('admin.registration', $data);
    }



    public function wallet_sell_success(Request $request)
    {
        $admin_wallet_record         = new Admin_wallet_manage;
        if ($request->amount > 0) {
            $admin_wallet                = Admin::find(1);
            $main_wallet                 = $admin_wallet->main_wallet - $request->amount;
            if ($main_wallet > 0) {
                $admin_wallet_record->user_id = $request->user_id;
                $admin_wallet_record->amount = $request->amount;
                $admin_wallet_record->type   = 'user';
                $admin_wallet_record->comment = $request->comment;
                $admin_wallet_record->date   = date('Y-m-d');
                $admin_wallet_record->save();

                $wallet_type                 = $request->wallet_type;
                $userwallet                  = User::where('id', $request->user_id)->first();
                if ($wallet_type == 'e_wallet') {
                    $data['e_wallet']      = $userwallet->e_wallet + $request->amount;
                } elseif ($wallet_type == 'r_wallet') {
                    $data['r_wallet']      = $userwallet->r_wallet + $request->amount;
                } elseif ($wallet_type == 'ps_wallet') {
                    $data['ps_wallet']      = $userwallet->ps_wallet + $request->amount;
                }
                DB::table('users')->where('id', $request->user_id)->update($data);

                $admin_wallet                = Admin::find(1);
                $main_wallet                 = $admin_wallet->main_wallet - $request->amount;
                DB::table('admins')->where('id', 1)->update(['main_wallet' => $main_wallet]);
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 0;
        }
    }


    public function view_wallet_update(Request $request)
    {
        $data['id']      = $request->update_id;
        if ($data['id'] != '') {
            $data['comment']      = $request->comment_update;
            DB::table('admin_wallet_manages')->where('id', $request->update_id)->update($data);
            echo 1;
        } else {
            echo 2;
        }
    }


    public function personal_reg_view()
    {
        $sell_list =  DB::table('users')

            ->get();
        return DataTables::of($sell_list)
            ->addColumn('action', function ($sell_list) {
                return '<div class="d-table mx-auto row btn-group-sm btn-group">         
            <button type="button" id="' . $sell_list->id . '" class="btn btn-primary view"><i class="material-icons">visibility</i></button>
            <div class="d-table mx-auto storage/product/btn-group-sm btn-group">         
            <button type="button" id="' . $sell_list->id . '" class="btn btn-success ok"><i class="material-icons">done_outline
</i></button><button type="button" id="' . $sell_list->id . '" class="btn btn-danger no"><i class="material-icons">cancel_presentation
</i></button> ';
            })
            ->addColumn('status', function ($sell_list) {
                if ($sell_list->status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block" style="">
                        Pending
                         </div>';
                } elseif ($sell_list->status == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">
            Aprroved </div>';
                } elseif ($sell_list->status == 2) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block" style="">
            Canceled </div>';
                }
            })

            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }


    public function club_vuew()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['user_list']  = User::all();
        return view('admin.wallet_sell_page2', $data);
    }

    public function club_reg_view()
    {
        $sell_list =  DB::table('users')->where('type', 2)->get();
        return DataTables::of($sell_list)
            ->addColumn('action', function ($sell_list) {
                return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">         
            <button type="button" id="' . $sell_list->id . '" class="btn btn-white view"><i class="material-icons"></i></button>
            <div class="d-table mx-auto storage/product/btn-group-sm btn-group">         
            <button type="button" id="' . $sell_list->id . '" class="btn btn-success ok"><i class="material-icons">done_outline
</i></button><button type="button" id="' . $sell_list->id . '" class="btn btn-danger no"><i class="material-icons">cancel_presentation
</i></button> ';
            })
            ->addColumn('type', function ($sell_list) {
                if ($sell_list->type == 1) {
                    return 'Personal Registration';
                } else {
                    return 'Club Registration';
                }
            })
            ->addColumn('status', function ($sell_list) {
                if ($sell_list->status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-info btn-block" style="">
                        Pending
                         </div>';
                } elseif ($sell_list->status == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group btn-success btn-block">
            Aprroved </div>';
                } elseif ($sell_list->status == 2) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group  btn-danger btn-block" style="">
            Canceled </div>';
                }
            })
            ->rawColumns(['action', 'type', 'status'])
            ->addIndexColumn()
            ->make(true);
    }

    public function view_wallet_edit(Request $request)
    {
        $admin_wallet_manage = Admin_wallet_manage::where('admin_wallet_manages.id', $request->input('id'))
            ->select('*', 'admin_wallet_manages.id as update_id')
            ->leftjoin('users', 'users.id', '=', 'admin_wallet_manages.user_id')
            ->first();
        echo json_encode($admin_wallet_manage);
    }

    public function wallet_tran_approve()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.wallet_approved_page', $data);
    }

    public function wallet_tran_list()
    {
        $new_list =  DB::table('hold_transfer_amounts')
            ->select('*', 'hold_transfer_amounts.status as p_status', 'hold_transfer_amounts.id as h_id')
            ->join('users', 'users.id', '=', 'hold_transfer_amounts.sender')
            ->where(['tran_type' => 'bal_tran'])
            ->orderBy('hold_transfer_amounts.id', 'desc')
            ->get();

        return DataTables::of($new_list)
            ->addColumn('action', function ($new_list) {
                if ($new_list->p_status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
                         <button type="button" class="btn btn-white edit" id="' . $new_list->h_id . '"><i class="material-icons">done_outline</i></button>
                         </div>';
                } else {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
            Aprroved </div>';
                }
            })
            ->addColumn('send_user', function ($new_list) {
                return User::where('id', $new_list->sender)->first()->user_id;
            })
            ->addColumn('send_name', function ($new_list) {
                return User::where('id', $new_list->sender)->first()->first_name;
            })
            ->addColumn('send_mobile', function ($new_list) {
                return User::where('id', $new_list->sender)->first()->mobile;
            })
            ->addColumn('receive_user', function ($new_list) {
                return User::where('id', $new_list->receiver)->first()->user_id;
            })
            ->addColumn('receive_name', function ($new_list) {
                return User::where('id', $new_list->receiver)->first()->first_name;
            })
            ->addColumn('receive_mobile', function ($new_list) {
                return User::where('id', $new_list->receiver)->first()->mobile;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'send_user', 'send_name', 'send_mobile', 'receive_user', 'receive_name', 'receive_mobile'])
            ->make(true);
    }

    public function wallet_tran_succes(Request $request)
    {
        $tran_id              = $request->id;
        $holdamount           = Hold_transfer_amount::where('id', $tran_id)->where('status', 0)->first();
        $receiverUser         = User::where('id', $holdamount->receiver)->first();
        $basic_info           = Basic_info_manage::where('id', 1)->first();
        $admin_profit         = $holdamount->amount * $basic_info->wall_tran_charge / 100;
        $data['reg_wallet']   = $receiverUser->reg_wallet + ($holdamount->amount - $admin_profit);

        DB::table('users')->where('id', $holdamount->receiver)->update($data);

        $data2['status']      = 1;
        DB::table('hold_transfer_amounts')->where('id', $tran_id)->update($data2);

        $admin_wallet         = Admin::find(1);
        $main_wallet          = $admin_wallet->income_wallet + $admin_profit;
        DB::table('admins')->where('id', 1)->update(['income_wallet' => $main_wallet]);

        $record               = new Income_transaction_record();
        $record->date         = date('Y-m-d');
        $record->amount       = $admin_profit;
        $record->user_id      = $receiverUser->id;
        $record->given_to     = 'admin';
        $record->purpose      = 'wallet_transfer';
        $record->save();

        echo 1;
    }


    public function wallet_move_approve()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.wallet_move_aprrove_page', $data);
    }



    public function wallet_move_list()
    {
        $new_list =  DB::table('hold_transfer_amounts')
            ->select('*', 'hold_transfer_amounts.status as p_status', 'hold_transfer_amounts.id as h_id')
            ->join('users', 'users.id', '=', 'hold_transfer_amounts.sender')
            ->where(['tran_type' => 'wallet_move'])
            ->orderBy('hold_transfer_amounts.id', 'desc')
            ->get();

        return DataTables::of($new_list)
            ->addColumn('action', function ($new_list) {
                if ($new_list->p_status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
                         <button type="button" class="btn btn-white edit" id="' . $new_list->h_id . '"><i class="material-icons">done_outline</i></button>
                         </div>';
                } else {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
            Aprroved </div>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function wallet_move_succes(Request $request)
    {
        $tran_id              = $request->id;

        $holdamount           = Hold_transfer_amount::where('id', $tran_id)->where('status', 0)->first();
        $receiverUser         = User::where('id', $holdamount->receiver)->first();
        $basic_info           = Basic_info_manage::where('id', 1)->first();
        $admin_profit         = $holdamount->amount * $basic_info->wall_move_charge / 100;
        $data['reg_wallet']   = $receiverUser->reg_wallet + ($holdamount->amount - $admin_profit);
        DB::table('users')->where('id', $holdamount->receiver)->update($data);

        $data2['status']      = 1;
        DB::table('hold_transfer_amounts')->where('id', $tran_id)->update($data2);

        $admin_wallet         = Admin::find(1);
        $main_wallet          = $admin_wallet->income_wallet + $admin_profit;
        DB::table('admins')->where('id', 1)->update(['income_wallet' => $main_wallet]);

        $record               = new Income_transaction_record();
        $record->date         = date('Y-m-d');
        $record->amount       = $admin_profit;
        $record->user_id      = $receiverUser->id;
        $record->given_to     = 'admin';
        $record->purpose      = 'wallet_move';
        $record->save();
        echo 1;
    }


    public function all_user_list()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.userL_list_page', $data);
    }

    public function user_login_direct($user_id)
    {
        $admin = user::where('id', $user_id)->first();
        if (!empty($admin)) {
            Session::put('email', $admin->email);
            Session::put('user_name', $admin->user_id);
            Session::put('userId', $admin->id);
            return redirect('/member/dashboard');
        }
    }

    public function all_user_show()
    {
        $new_list =  DB::table('users')
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($new_list)
            ->addColumn('panel', function ($new_list) {
                return
                    '<a target="_blank" href="' . url('admin/user_login_direct', $new_list->id) . '" class="btn btn-sm btn-primary" >Click</a>';
            })
            ->addColumn('status', function ($new_list) {
                if ($new_list->status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
            Inactive </div>';
                } else {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
            Active </div>';
                }
            })
            ->addColumn('action', function ($new_list) {
                return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
                         <button type="button" class="btn btn-white edit" id="' . $new_list->id . '"><i class="material-icons">done_outline</i></button>
                         </div>';
            })
            ->addIndexColumn()
            ->rawColumns(['panel', 'status', 'action'])
            ->make(true);
    }


    public function withdraw_wallet_aprrove()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['with_total'] = DB::table('withdrawel_reports')->sum('amount');
        return view('admin.withdraw_wallet_approved_page', $data);
    }


    public function withdraw_wallet_list()
    {
        $new_list =  DB::table('withdrawel_reports')
            ->select('*', 'withdrawel_reports.status as p_status', 'withdrawel_reports.id as h_id')
            ->join('users', 'users.id', '=', 'withdrawel_reports.userid')
            ->orderBy('withdrawel_reports.id', 'desc')
            ->get();

        return DataTables::of($new_list)
            ->addColumn('action', function ($new_list) {
                if ($new_list->p_status == 0) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
                         <button type="button" class="btn btn-white edit" id="' . $new_list->h_id . '"><i class="material-icons">done_outline</i></button>
                         </div>';
                } else {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
           Aprroved </div>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function withdraw_wallet_succes(Request $request)
    {
        $tran_id              = $request->id;
        $withdrawel_report    = Withdrawel_report::where('id', $tran_id)->where('status', 0)->first();
        $basic_info           = Basic_info_manage::where('id', 1)->first();
        $admin_profit         = $withdrawel_report->amount * $basic_info->withdraw_charge / 100;

        $data2['status']      = 1;
        DB::table('withdrawel_reports')->where('id', $tran_id)->update($data2);

        $admin_wallet         = Admin::find(1);
        $main_wallet          = $admin_wallet->income_wallet + $admin_profit;
        DB::table('admins')->where('id', 1)->update(['income_wallet' => $main_wallet]);

        $record               = new Income_transaction_record();
        $record->date         = date('Y-m-d');
        $record->amount       = $admin_profit;
        $record->user_id      = $withdrawel_report->userid;
        $record->given_to     = 'admin';
        $record->purpose      = 'admin_withdraw_percent';
        $record->save();
        echo 1;
    }

    public function member_activation()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.member_activation_page', $data);
    }

    public function member_activation_list()
    {
        $new_list =  DB::table('newslaters')->orderby('id', 'desc')->get();
        return DataTables::of($new_list)

            ->addIndexColumn()
            ->make(true);
    }

    public function member_activation_success(Request $request)
    {
        $new_member_id          = $request->id;

        $data['status']         = 1;
        $data['active_date']    = date('Y-m-d');
        DB::table('users')->where('id', $new_member_id)->update($data);

        $admin_wallet           = Admin::find(1);
        $data2['income_wallet'] = $admin_wallet->income_wallet + 30;
        DB::table('admins')->where('id', 1)->update($data2);

        $recordd                = new Income_transaction_record();
        $recordd->date          = date('Y-m-d');
        $recordd->amount        = 15;
        $recordd->user_id       = $new_member_id;
        $recordd->given_to      = 'admin';
        $recordd->purpose       = 'member_reg';
        $recordd->save();

        $record                 = new Income_transaction_record();
        $record->date           = date('Y-m-d');
        $record->amount         = 15;
        $record->user_id        = $new_member_id;
        $record->given_to       = 'admin';
        $record->purpose        = 'member_reg_by_admin';
        $record->save();



        $check_international   = DB::table('users')->where('rank', 'INTERNATIONAL')->get();

        foreach ($check_international as $key) {
            $dataY['int_point_wallet']    = $key->int_point_wallet + 0.3;
            DB::table('users')->where('id', $key->id)->update($dataY);
        }
        echo 1;
    }

    public function user_activation_admin()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.user_activation_admin', $data);
    }

    public function activation_list()
    {
        $new_list =  DB::table('income_transaction_records')
            ->select('*', 'income_transaction_records.id as u_id')
            ->join('users', 'users.id', '=', 'income_transaction_records.user_id')
            ->where(['purpose' => 'member_reg_by_admin'])
            ->orderBy('u_id', 'desc')
            ->get();
        return DataTables::of($new_list)
            ->addColumn('action', function ($new_list) {
                if ($new_list->status == 1) {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
            Aprroved </div>';
                } else {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
            Aprroved </div>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function rank_reward()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        return view('admin.rank_reward_report', $data);
    }

    public function rank_reward_list()
    {
        $new_list = DB::table('rank_records')
            ->select('*', 'rank_records.status as rank_status', 'rank_records.id as rank_id')
            ->join('users', 'users.user_id', '=', 'rank_records.user_name')
            ->orderBy('rank_records.id', 'desc')
            ->get();
        return DataTables::of($new_list)
            ->addColumn('action', function ($new_list) {
                if ($new_list->rank_status == 1) {
                    return '<button type="button" class="btn btn-primary btn-sm">Paid</button>';
                } else {
                    return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
                         <button type="button" class="btn btn-danger edit" id="' . $new_list->rank_id . '">Pending</button>
                         </div>';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function refferral_amount_report()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['ref_distr']  = Income_transaction_record::where('purpose', 'referrel_income_distribute')->sum('amount');
        return view('admin.refferral_amount_report', $data);
    }

    public function refferral_amount_list()
    {
        $new_list =  DB::table('income_transaction_records')
            ->select('*', 'income_transaction_records.id as u_id')
            ->join('users', 'users.id', '=', 'income_transaction_records.user_id')
            ->where(['purpose' => 'referrel_income_distribute'])
            ->orderBy('u_id', 'desc')
            ->get();
        return DataTables::of($new_list)

            ->addIndexColumn()
            ->make(true);
    }

    public function downlink_amount_distribute()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['ref_distr']  = Income_transaction_record::where('purpose', 'downlink_amount_distribute')->sum('amount');
        return view('admin.downlink_amount_distribute', $data);
    }

    public function downlink_amount_distrubute_list()
    {
        $new_list =  DB::table('income_transaction_records')
            ->select('*', 'income_transaction_records.id as u_id')
            ->join('users', 'users.id', '=', 'income_transaction_records.user_id')
            ->where(['purpose' => 'downlink_amount_distribute'])
            ->orderBy('u_id', 'desc')
            ->get();
        return DataTables::of($new_list)

            ->addIndexColumn()
            ->make(true);
    }

    public function amount_distribution()
    {
        $data['basic_info'] = Basic_info_manage::where('id', 1)->first();
        $data['spon_count'] = Crone_record::where('id', 1)->first();
        $data['ref_dist']   = Crone_record::where('id', 2)->first();
        $data['rank_distr'] = Crone_record::where('id', 3)->first();
        $data['inc_distr']  = Crone_record::where('id', 4)->first();
        $data['today']      = date('Y-m-d');

        return view('admin.amount_distribution', $data);
    }

    public function rank_distribute(Request $request)
    {
        $data['status']          = 1;
        DB::table('rank_records')->where('id', $request->id)->update($data);
        echo 1;
    }

    public function profit_return(Request $request)
    {
        $all_user         = DB::table('users')->where('activation_limit', '<', '365')->get();
        $amount           = $request->amount;
        foreach ($all_user as $key) {
            $data['e_wallet']               = $key->e_wallet + $amount;
            $data['activation_limit']       = $key->activation_limit + 1;
            DB::table('users')->where('id', $key->id)->update($data);

            $data_y['date']          = date('Y-m-d');
            $data_y['amount']        = $amount;
            $data_y['user_id']       = $key->id;
            $data_y['given_to']      = $key->id;
            $data_y['purpose']       = '5tk_profit_return';
            DB::table('income_transaction_records')->insert($data_y);
        }

        $dateZZ['date']         = date('Y-m-d');
        $dateZZ['updated_at']   = date("Y-m-d H:i:s");
        DB::table('crone_records')->where('type', 'profit_sharing_return')->update($dateZZ);
    }
}
