<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use Hash;
use DB;
use Mail;
use DataTables;
use App\User;
use App\Country;
use App\Admin;
use App\Income_transaction_record;
use App\Admin_wallet_manage;
use App\Hold_transfer_amount;
use App\Withdrawel_report;
use App\Basic_info_manage;

class MemberController extends Controller
{
    public function index()
    {     
        // $yesterday             = date('Y-m-d', strtotime('-1 day'));      
        $today                    = date('Y-m-d');      
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
           
        $data['total_reff_income']= Income_transaction_record::where('purpose','sponser_bonus')->where('given_to',$user_id)->sum('amount');    

        $data['gen_income']       = Income_transaction_record::where('purpose','generation_income_distribute')->where('given_to',$user_id)->sum('amount');  

        $data['matchingAmount']   = Income_transaction_record::where('purpose','matching_amount_distribute')->where('user_id',$user_id)->sum('amount');  

        $data['down_active']      = User::where('id','>', $user_id)->where('status', 1)->count('id'); 
        $data['down_inactive']    = User::where('id','>', $user_id)->where('status', 0)->count('id');     
        $data['total_sum']        = Hold_transfer_amount::where('sender',$user_id)->sum('amount');  
        $data['total_with_sum']   = Withdrawel_report::where('userid',$user_id)->sum('amount');
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['admin_blance_rcv'] = Admin_wallet_manage::where('user_id',$user_id)->sum('amount');
        $data['products']        = DB::table('product_manages')->get();  
        return view('member.index', $data);
    }   

  public function summary_report()
  {
    $today                    = date('Y-m-d');    
    $user_id                  = Session::get('userId');       
    $data['member_details']   = User::where('id', $user_id)->first(); 
    $data['basic_info']       = Basic_info_manage::where('id',1)->first();

    $data['ref_distr']        = Income_transaction_record::where('purpose', 'referrel_income_distribute')->where('given_to', $user_id)->sum('amount');  

   
    $data['downline_amnt_dist']= Income_transaction_record::where('purpose', 'downlink_amount_distribute')->where('user_id', $user_id)->sum('amount');   
   
    $data['renk_reward']      = Income_transaction_record::where('given_to', 'user_rank')->where('user_id', $user_id)->sum('amount');
   
    $data['wallet_move']      = Income_transaction_record::where('given_to', 'admin')->where('user_id', $user_id)->where('purpose', 'wallet_move')->sum('amount');
   
    $data['wallet_transfer']  = Income_transaction_record::where('given_to', 'admin')->where('user_id', $user_id)->where('purpose', 'wallet_transfer')->sum('amount');    
   
    $data['withdraw']         = Withdrawel_report::where('userid', $user_id)->sum('amount');   

    $data['balance_from_admin']  = Admin_wallet_manage::where('user_id',$user_id)->sum('amount');

    $data['balance_from_user']   = Hold_transfer_amount::where('receiver',$user_id)->where(['tran_type' => 'bal_tran'])->sum('amount');

    $data['wallet_transfer_charge']  = Income_transaction_record::where('user_id', $user_id)->where('purpose', 'wallet_transfer')->sum('amount'); 

    $data['wallet_move_charge']      = Income_transaction_record::where('user_id', $user_id)->where('purpose', 'wallet_move')->sum('amount');

    $data['withdraw_charge']         = Income_transaction_record::where('user_id', $user_id)->where('purpose', 'admin_withdraw_percent')->sum('amount');  

    return view('member.summary_report',  $data);   
  }


    public function logout()
    {
        Session::forget('email');
        Session::forget('userId');
        Session::forget('companyId');
        Session::flush();
        return redirect('/');
    }

    public function member_profile()
    {   
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();       
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();     
           
        $data['countryList']      = DB::table('countries')->get();  
        return view('member.profile', $data);
    }   

    public function registration()
    {   
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();       
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();         
        $data['countryList']      = DB::table('countries')->get();  
        $data['product_manages']  = DB::table('product_manages')->get();  
        $data['agents']           = DB::table('admins')->where('id','!=','1')->get();  
        return view('member.registration', $data);
    }   


    public function new_member()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();  
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();                   
        return view('member.new_member', $data);
    }


   public function view_new_list()
    {
        $user_id                  = Session::get('userId');       
        $user_details             = User::where('id', $user_id)->first();          
        $new_list                 = User::where('sponser_name', $user_details->user_id)->where('status', 0)->get();

        return DataTables::of($new_list)->addColumn('action', function ($new_list) {
            
            if ($new_list->pending == 0){
                  return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-primary edit" id="' . $new_list->id . '"><i class="material-icons">done_outline</i></button>
           ';

            }else{             
                return '<span class="btn btn-primary">Pending</span>
           ';

            }           

        })
        ->addIndexColumn()
        ->make(true);
    }

    public function refferd_member()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();    
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();           
        return view('member.refferd_member', $data);
    }


    public function view_reffered_list()
    {
        $user_id                  = Session::get('userId');       
        $user_details             = User::where('id', $user_id)->first();          
        $new_list                 = User::where('sponser_name', $user_details->user_id)->where('status', 1)->orderBy('id', 'desc')->get();
        return DataTables::of($new_list)
        ->addIndexColumn()
        ->make(true);
    }

    public function refferel_link()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();       
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();         
        return view('member.refferel_link', $data);
    }
   
   public function profile_update(Request $request)
    {
       if ($request->hasFile('ProductPic')) {
            $validator = Validator::make($request->all(), [
                'ProductPic' => 'max:20000',                   
            ]);
            if ($validator->fails()) {                    
                return ;
            }
            $extension  = $request->file('ProductPic')->getClientOriginalExtension();
            $fileStore2 = rand(10, 100) . time() . "." . $extension;
            $request->file('ProductPic')->move(public_path("storage/product"), $fileStore2);
            $data['image']   = $fileStore2;                 
        }

        $data['first_name']       = $request->f_name;
        $data['last_name']        = $request->l_name;
        $data['gender']           = $request->gender;
        $data['mobile']           = $request->mobile;
        $data['address']          = $request->address;
        $data['country']          = $request->counrty;
        $data['birth_date']       = $request->birthday;           
        $data['withdraw_account']= $request->withdraw_account;           
        DB::table('users')->where('id', Session::get('userId'))->update($data);
        echo 1;       
    }

    public function username_search(Request $request)
    {        
        $username       = $request->username;       
        $username_result   = DB::table('users')->where('user_id', $username)->first();
        if(empty($username_result)){
            echo 1;
        }else {
            echo 2;
        }         
    }

    public function sponser_search(Request $request)
    {        
        $sponser       = $request->sponser;       
        $username_result   = DB::table('users')->where('user_id', $sponser)->first();
        if(!empty($username_result)){
            echo 1;
        }else {
            echo 2;
        }         
    }

    public function balance_search(Request $request)
    {                   
        $package            = $request->package;  
        $payment            = $request->payment;       
        $user_id            = Session::get('userId');        
        $user_details       = User::where('id', $user_id)->first();     
        $product_details    = DB::table('product_manages')->where('id', $package)->first();     
        
       if($payment == 'first'){                 
            if($user_details->e_wallet >= $product_details->price){
                echo 1;
            }else{
                echo 2;
            }
        }else if($payment == 'second'){               
            $s_wallet       = $product_details->price * 50 /100;
            $r_wallet       = $product_details->price * 25 /100;
            $ps_wallet      = $product_details->price * 25 /100;

            if(($user_details->s_wallet >= $s_wallet) && ($user_details->r_wallet >= $r_wallet) && ($user_details->ps_wallet >= $ps_wallet) ){
                echo 1;
            }else{
                echo 2;
            }
        }             
    }

    public function placement_search(Request $request)
    {        
        $placement_id       = $request->placement_id;
        $placement          = $request->placement;
        $table_check        = DB::table('tree_manages')->where('username', $placement_id)->first();
        $placement_result   = DB::table('tree_manages')->where('placement_id', $placement_id)->first();
        if(!empty($table_check)){
            if(!empty($placement_result)){
               if($placement == "L"){
                    $left_position = DB::table('tree_manages')->where('placement_id', $placement_id)->where('position',$placement)->first();
                     if(empty($left_position)){
                        echo 1 ;
                     }else {
                        echo 2 ;
                     }
               }else if($placement == "R"){
                     $right_position = DB::table('tree_manages')->where('placement_id', $placement_id)->where('position',$placement)->first();
                     if(empty($right_position)){
                        echo 1 ;
                     }else {
                        echo 2 ;
                     }
                }              
            }else {
                echo 3;
            } 
        }else {
            echo 4;
        }         
    }

    public function member_account_create(Request $request)
    {       
        $user_check           = User::where('user_id', $request->username)->first();     
        if(!empty($user_check)){
            echo 2;
            exit();
        } 

        $sponser_check        = User::where('user_id', $request->sponser)->first();     
        if(empty($sponser_check)){
            echo 3;
            exit();
        }

        $placement_id       = $request->placement_id;
        $placement          = $request->placement;
        $table_check        = DB::table('tree_manages')->where('username', $placement_id)->first();
        $placement_result   = DB::table('tree_manages')->where('placement_id', $placement_id)->first();
        if(!empty($table_check)){
            if(!empty($placement_result)){
               if($placement == "L"){
                    $left_position = DB::table('tree_manages')->where('placement_id', $placement_id)->where('position',$placement)->first();
                     if(empty($left_position)){
                       
                     }else {
                        echo 5 ;
                         exit();
                     }
               }else if($placement == "R"){
                     $right_position = DB::table('tree_manages')->where('placement_id', $placement_id)->where('position',$placement)->first();
                     if(empty($right_position)){
                       
                     }else {
                        echo 6 ;
                         exit();
                     }
                }              
            }else {
               
            } 
        }else {
            echo 7;
            exit();
        } 


    
        $user_id            = Session::get('userId');      
        $user_details       = User::where('id', $user_id)->first();     
        $product_details    = DB::table('product_manages')->where('id', $request->package)->first();  
          
        if($request->payment == 'first'){                 
            if($user_details->e_wallet >= $product_details->price){                           
                $data4['e_wallet'] = $user_details->e_wallet - $product_details->price;        
                DB::table('users')->where('id', $user_details->id)->update($data4);

                $data3['date']      = date('Y-m-d');   
                $data3['amount']    = $product_details->price;   
                $data3['user_id']   = $user_details->id;   
                $data3['given_to']  = $request->username;   
                $data3['purpose']   = 'user_registration';   
                DB::table('income_transaction_records')->insert($data3);
            }else{
                echo 4;
                exit();
            }
        }

        // account create
        $data['first_name']     = $request->f_name;   
        $data['last_name']      = $request->l_name;   
        $data['email']          = $request->email;             
        $data['mobile']         = $request->phone;   
        $data['user_id']        = $request->username;   
        $data['sponser_name']   = $request->sponser;           
        $data['package']        = $request->package;    
        $data['placement']      = $request->placement;    
        $data['placement_id']   = $request->placement_id;    
        $data['country']        = $request->country;   
        $data['rank']           = $product_details->rank_name;   
        $data['password']       = Hash::make($request->password); 
        $data['password_plain'] = $request->password;    
        $data['joining_date']   = date('Y-m-d');   
        $data['active_date']    = date('Y-m-d');   
        $data['rank_count']     = 0;       
        $data['status']              = 1; 
        $data['btc_amount']          = 0;        
        $data['can_registration']    = 0; 
        $data['left_pv_flashable']   = 0; 
        $data['right_pv_flashable']  = 0; 
        $data['left_pv_counting']    = 0; 
        $data['right_pv_counting']   = 0; 
        $data['left_count']          = 0; 
        $data['right_count']         = 0; 
        $data['right_count']         = 0; 
        $data['activation_limit']         = 0; 
        DB::table('users')->insert($data);
        $insertid               = DB::getPdo()->lastInsertId();    

        // tree insert 
        $data2['username']      = $request->username; 
        $data2['placement_id']  = $request->placement_id; 
        $data2['position']      = $request->placement; 
        DB::table('tree_manages')->insert($data2);

        // rank count for leadership bonus distribute
         /*      if($product_details->rank_name == "gold" || $product_details->rank_name == "super_gold"|| $product_details->rank_name == "platinum" || $product_details->rank_name == "super_platinum" ){
            $sponserDet             = User::where('user_id', $request->sponser)->first();  
            $data222['rank_count']  = $sponserDet->rank_count + 1; 
            DB::table('users')->where('id', $sponserDet->id)->update($data222);
        }*/

        // agent commision
/*
        $agent_details          = Admin::where('id', $request->agent)->first();  
        $data222['main_wallet'] = $agent_details->main_wallet + 50; 
        DB::table('admins')->where('id', $agent_details->id)->update($data222);

        $data_y['date']         = date('Y-m-d');   
        $data_y['amount']       = 100;   
        $data_y['user_id']      = $insertid;   
        $data_y['given_to']     = $agent_details->id; 
        $data_y['purpose']      = 'agent_comission_distribute';   
        DB::table('income_transaction_records')->insert($data_y);*/

        $sponser_det    = DB::table('users')->where('id', $insertid)->first();  
        $this->generation_income_distribute($request->sponser, $insertid, $product_details->price, $count = 1);   
        $this->updateteamincome($request->placement_id, $request->placement, $insertid, $product_details->price);

        Session::put('email_id', $request->email);            
        Session::put('users_name', $request->username); 
        Session::put('pass', $request->password); 
        //$this->basic_email($request->email);  
        echo 1;
    }

    public function basic_email($mailid){      
       $subject = 'Registration completed on the golden creatives.';
       $data = array('email' => $mailid, 'subject' => $subject);
       Mail::send(['html'=>'mail'], $data, function ($message) use ($data) {
          $message->from('info@tgc.com', ' the golden creatives Registration');
          $message->to($data['email']);
          $message->subject($data['subject']); 
       });   
    }

/*
   private function updateteamincome($mbplacement, $mbteam, $insertid)
    {   
        $binarybalanceincome = 10;
        $teaminfo                =  DB::table('users')->where('user_id', $mbplacement)->first();      
        if(!empty($teaminfo)) {           
            if($mbteam == "L") {            
                    if($teaminfo->left_count < 21){
                       $data['left_count']     = $teaminfo->left_count + 1;
                       DB::table('users')->where('id', $teaminfo->id)->update($data);    
                    }                 
            } elseif($mbteam == "R") {
                   if($teaminfo->right_count < 21){
                       $data['right_count']     = $teaminfo->right_count + 1;
                       DB::table('users')->where('id', $teaminfo->id)->update($data);    
                    }       
            }          
        }
        if(!empty($teaminfo)){
         return $this->updateteamincome($teaminfo->placement_id, $teaminfo->placement, $binarybalanceincome, $insertid);
        }
    }*/


  private function updateteamincome($mbplacement, $mbteam, $insertid, $binarybalanceincome)
    {   
        $teaminfo   =  DB::table('users')->where('user_id', $mbplacement)->first();
        $adminsinfo =  DB::table('admins')->where('id', 1)->first();
        if(!empty($teaminfo)) {
            if($mbteam == "L") {
                $data271['left_pv_flashable'] = $teaminfo->left_pv_flashable + $binarybalanceincome; 
                $data271['left_pv_counting']  = $teaminfo->left_pv_counting + $binarybalanceincome;    
              
                if($teaminfo->left_count < 100){
                   $data271['left_count']     = $teaminfo->left_count + 1;                   
                }          
                DB::table('users')->where('id', $teaminfo->id)->update($data271);                

                $data_y['date']               = date('Y-m-d');   
                $data_y['amount']             = $binarybalanceincome;   
                $data_y['user_id']            = $insertid;   
                $data_y['given_to']           = $teaminfo->user_id;   
                $data_y['purpose']            = 'matching_carry_amount';   
                DB::table('income_transaction_records')->insert($data_y); 

                $data_p['left_carry']         = $adminsinfo->left_carry + $binarybalanceincome;      
                DB::table('admins')->where('id', $adminsinfo->id)->update($data_p);

            } elseif($mbteam == "R") {
                $data2710['right_pv_flashable']= $teaminfo->right_pv_flashable + $binarybalanceincome;
                $data2710['right_pv_counting'] = $teaminfo->right_pv_counting + $binarybalanceincome;    
                if($teaminfo->right_count < 100){
                   $data2710['right_count']   = $teaminfo->right_count + 1;                   
                }   
                DB::table('users')->where('id', $teaminfo->id)->update($data2710);

                $data_y['date']               = date('Y-m-d');   
                $data_y['amount']             = $binarybalanceincome;   
                $data_y['user_id']            = $insertid;   
                $data_y['given_to']           = $teaminfo->user_id;   
                $data_y['purpose']            = 'matching_carry_amount';   
                DB::table('income_transaction_records')->insert($data_y); 

                $data_p['right_carry']        = $adminsinfo->right_carry + $binarybalanceincome;      
                DB::table('admins')->where('id', $adminsinfo->id)->update($data_p);
            }               
        }
        if(!empty($teaminfo)){
         return $this->updateteamincome($teaminfo->placement_id, $teaminfo->placement, $insertid, $binarybalanceincome);
        }
    }


  private function generation_income_distribute($sponser_id, $insertid, $price,  $count = 1)
    {          
        $sponser_details    = User::where('user_id', $sponser_id)->first();

        if(!empty($sponser_details)){                 
             if($count <= 8){
                    if($count == 1){
                         $dist_amount = $price*1.5/100;
                         $data_y['purpose']       = 'sponser_bonus';   
                    }else{
                         $dist_amount = $price*0.3/100;
                         $data_y['purpose']       = 'generation_income_distribute';   
                    }
                    
                    $data['e_wallet']        = $sponser_details->e_wallet + $dist_amount;
                    DB::table('users')->where('id', $sponser_details->id)->update($data);

                    $data_y['date']          = date('Y-m-d');   
                    $data_y['amount']        = $dist_amount;   
                    $data_y['user_id']       = $insertid;   
                    $data_y['given_to']      = $sponser_details->id; 
                    DB::table('income_transaction_records')->insert($data_y);         

                    $admin_details           = Admin::where('id', 1)->first();                  
                    $data33['comission_balance'] = $admin_details->comission_balance + $dist_amount;   
                    DB::table('admins')->where('id',1)->update($data33);                
                
              $genaration_count        = $count+1;             
              if(!empty($sponser_details)){
                 $this->generation_income_distribute($sponser_details->sponser_name, $insertid, $price, $genaration_count);
              }
            }       
         }else{
          /*  $data_yx['date']          = date('Y-m-d');   
            $data_yx['amount']        = 0.5 * (5 - $count);
            $data_yx['user_id']       = 1;   
            $data_yx['given_to']      = 'admin'; 
            $data_yx['purpose']       = 'generation_income_extra';   
            DB::table('income_transaction_records')->insert($data_yx);    

            $admin_details           = Admin::where('id', 1)->first();                  
            $data55['extra_fund']    = $admin_details->extra_fund + $data_yx['amount'];                    
            DB::table('admins')->where('id',1)->update($data55);*/
        }
    }

    public function password_update(Request $request){
     
        $user_id                  = Session::get('userId');       
        $old_pass_check           = User::where('id', $user_id)->first();      
        if (!(Hash::check($request->old_password, $old_pass_check->password))) {        
            //if db passwords not matches                  
         echo 2;
         exit();
        }       
        if(strcmp($request->old_password, $request->new_password) == 0){       
            //if old password and new password are same      
            echo 3;
             exit();
        }  
        if($request->password != $request->new_password){
              //if new pass n confirm pass is not same
             echo 4;
             exit();
        }   
        $validator = Validator::make($request->all(), [
               'password' => 'required',
            'new_password' => 'required|min:6'             
          ]);
          if ($validator->fails()) {                    
             echo 5;
            exit();
        } 
        $data['password']       = Hash::make($request->new_password);
        $data['password_plain'] = $request->new_password;        
        DB::table('users')->where('id', $user_id)->update($data);
        Session::put('userId', '');
        echo 1 ;
    }


    public function tran_password_update(Request $request){         
        $user_id                  = Session::get('userId'); 

        if($request->tran_password != $request->tran_new_password){
              //if new pass n confirm pass is not same
             echo 4;
             exit();
        }   
        $validator = Validator::make($request->all(), [
               'tran_password'  => 'required',
            'tran_new_password' => 'required|min:6'             
          ]);
          if ($validator->fails()) {                    
             echo 5;
            exit();
        } 
        $data['transaction_password']  = Hash::make($request->tran_new_password);      
        DB::table('users')->where('id', $user_id)->update($data);      
        echo 1 ;
    }

    public function tran_password_exist_update(Request $request){         
        $user_id                  = Session::get('userId');       
        $old_pass_check           = User::where('id', $user_id)->first();  
        //print_r($request->tran_new_password); die();
        if (!(Hash::check($request->old_tran_password, $old_pass_check->transaction_password))) {        
            //if db passwords not matches                  
            echo 2;
            exit();
        }            
        if(strcmp($request->old_tran_password, $request->tran_new_password) == 0){       
            //if old password and new password are same      
            echo 3;
            exit();
        }  
        if($request->tran_password != $request->tran_new_password){
             //if new pass n confirm pass is not same
             echo 4;
             exit();
        } 
        $validator = Validator::make($request->all(),[
             'tran_password' => 'required',
             'tran_new_password' => 'required|min:6'             
          ]);
          if ($validator->fails()) {                    
             echo 5;
            exit();
        } 

        $data['transaction_password']       = Hash::make($request->tran_new_password);      
        DB::table('users')->where('id', $user_id)->update($data);
        echo 1 ;
    }

    public function wallet_transfer()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['user_list']        = User::where('id', '!=', $user_id)->where('status', 1)->orderBy('id', 'DESC')->get();    
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();        
        $data['total_sum']        = Hold_transfer_amount::where('sender',$user_id)->sum('amount');    
        return view('member.wallet_tranfser', $data);
    }  

    public function wallet_transfer_success(Request $request)
      {   
         $transfer_amount          = $request->amount;      
         $send_to                  = $request->user_id;      
         $wallet_type              = $request->wallet_type;      
         $user_id                  = Session::get('userId');       
         $user_details             = User::where('id', $user_id)->first();    
         if ((Hash::check($request->tran_password, $user_details->transaction_password))) {
             if($transfer_amount >= 5){      

                  if($user_id != 0){
                    $hold_amount              = new Hold_transfer_amount();
                       if($wallet_type == "e_wallet"){
                            if($user_details->e_wallet >= $transfer_amount){
                                 $hold_amount->tran_type   = 'e_bal_tran';
                            }else{
                               echo 3;
                               exit();
                            }
                        }else if($wallet_type == "r_wallet"){
                            if($user_details->r_wallet >= $transfer_amount){
                                 $hold_amount->tran_type   = 'r_bal_tran';
                            }else{
                               echo 3;
                               exit();
                            }
                        }else if($wallet_type == "ps_wallet"){
                            if($user_details->ps_wallet >= $transfer_amount){
                                 $hold_amount->tran_type   = 'ps_bal_tran';
                            }else{
                               echo 3;
                               exit();
                            }
                        }
                    $hold_amount->amount      = $transfer_amount;
                    $hold_amount->date        = date('Y-m-d');
                    $hold_amount->sender      = $user_id;
                    $hold_amount->receiver    = $send_to;                   
                    $hold_amount->status      = 1;
                    $hold_amount->save();

                        if($wallet_type == "e_wallet"){
                              $data['e_wallet']         = $user_details->e_wallet - $transfer_amount;  
                        }else if($wallet_type == "r_wallet"){
                              $data['r_wallet']         = $user_details->r_wallet - $transfer_amount;   
                        }else if($wallet_type == "ps_wallet"){
                              $data['ps_wallet']         = $user_details->ps_wallet - $transfer_amount;
                        }                   
                    DB::table('users')->where('id', $user_details->id)->update($data);                   
      
                    $receiverUser             = User::where('id', $send_to)->first();
                    $basic_info               = Basic_info_manage::where('id',1)->first();  
                    $admin_profit             = $transfer_amount * $basic_info->wall_tran_charge/100;
                   
                        if($wallet_type == "e_wallet"){
                           $data['e_wallet']       = $receiverUser->e_wallet + ( $transfer_amount - $admin_profit);
                        }else if($wallet_type == "r_wallet"){
                           $data['r_wallet']       = $receiverUser->r_wallet + ( $transfer_amount - $admin_profit); 
                        }else if($wallet_type == "ps_wallet"){
                           $data['ps_wallet']       = $receiverUser->ps_wallet + ( $transfer_amount - $admin_profit);
                        }
                    DB::table('users')->where('id', $send_to)->update($data);
                   
                    $admin_wallet             = Admin::find(1);    
                    $main_wallet              = $admin_wallet->income_wallet + $admin_profit;             
                    DB::table('admins')->where('id',1)->update(['income_wallet' => $main_wallet]);

                    $record                   = new Income_transaction_record();
                    $record->date             = date('Y-m-d');
                    $record->amount           = $admin_profit;
                    $record->user_id          = $receiverUser->id;
                    $record->given_to         = 'admin';                
                    if($wallet_type == "e_wallet"){
                           $record->purpose    = 'e_wallet_transfer';
                    }else if($wallet_type == "r_wallet"){
                           $record->purpose    = 'r_wallet_transfer';
                    }else if($wallet_type == "ps_wallet"){
                           $record->purpose    = 'ps_wallet_transfer';
                    }
                    $record->save();
                    echo 11;

                  } else {
                    $hold_amount              = new Hold_transfer_amount();
                    $hold_amount->amount      = $transfer_amount;
                    $hold_amount->date        = date('Y-m-d');
                    $hold_amount->sender      = $user_id;
                    $hold_amount->receiver    = $send_to;
                    $hold_amount->tran_type   = 'e_bal_tran';
                    if($wallet_type == "e_wallet"){
                       $hold_amount->tran_type   = 's_bal_tran';
                    }else if($wallet_type == "r_wallet"){
                       $hold_amount->tran_type   = 'r_bal_tran';
                    }else if($wallet_type == "ps_wallet"){
                       $hold_amount->tran_type   = 'ps_bal_tran';
                    }
                    $hold_amount->status      = 0;
                    $hold_amount->save();
                    $data['e_wallet']         = $user_details->e_wallet - $transfer_amount;
                    DB::table('users')->where('id', $user_details->id)->update($data);
                    echo 1;
                  }
               
             }else{
                echo 2;
             }
          } else {
             echo 5;
          }
      }

    public function hold_trn_bal()
    {
        $user_id      = Session::get('userId');           
        $user_details = User::where('id', $user_id)->first();  
        $new_list     =  DB::table('hold_transfer_amounts')  
                  ->select('*','hold_transfer_amounts.status as p_status')
                  ->join('users','users.id','=','hold_transfer_amounts.receiver')
                  ->where(['sender' => $user_id])
                  ->orwhere(['tran_type' => 'e_bal_tran'])
                  ->orwhere(['tran_type' => 'r_bal_tran'])
                  ->orwhere(['tran_type' => 'ps_bal_tran'])
                  ->orderBy('hold_transfer_amounts.id','desc')
                  ->get();

        return DataTables::of($new_list)
        ->addColumn('action', function ($new_list) {            
            if ($new_list->p_status == 0){
                 return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
            Pending </div>';
            }else{
                 return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
            Paid </div>';
            } 
        })
        ->addIndexColumn()
        ->make(true);
    }

    public function main_wallet_move()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['user_list']        = User::where('id', '!=', $user_id)->get();           
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();     
        return view('member.wallet_move', $data);
    }  

    public function wallet_move_success(Request $request)
      {   
         $transfer_amount          = $request->amount;       
         $user_id                  = Session::get('userId');       
         $user_details             = User::where('id', $user_id)->first();      
         if ((Hash::check($request->tran_password, $user_details->transaction_password))) {             
             if($transfer_amount >= 5){
                if($user_details->e_wallet >= $transfer_amount){
                    $hold_amount              = new Hold_transfer_amount();
                    $hold_amount->amount      = $transfer_amount;
                    $hold_amount->date        = date('Y-m-d');
                    $hold_amount->sender      = $user_id;
                    $hold_amount->receiver    = $user_id;
                    $hold_amount->tran_type   = 'e_wallet_move';
                    $hold_amount->status      = 0;
                    $hold_amount->save();
                    $insert_id                = $hold_amount->id;

                    $data['e_wallet']      = $user_details->e_wallet - $transfer_amount;
                    DB::table('users')->where('id', $user_details->id)->update($data);
                   
                    $holdamount           = Hold_transfer_amount::where('id', $insert_id)->where('status',0)->first();          
                    $receiverUser         = User::where('id', $holdamount->receiver)->first();
                    $basic_info           = Basic_info_manage::where('id',1)->first();  
                    $admin_profit         = $holdamount->amount * $basic_info->wall_move_charge/100;
                    $data['r_wallet']     = $receiverUser->r_wallet + ( $holdamount->amount - $admin_profit);
                    DB::table('users')->where('id', $holdamount->receiver)->update($data);
                     
                    $data2['status']      = 1;
                    DB::table('hold_transfer_amounts')->where('id', $insert_id)->update($data2);

                    $admin_wallet         = Admin::find(1);    
                    $main_wallet          = $admin_wallet->income_wallet + $admin_profit;             
                    DB::table('admins')->where('id',1)->update(['income_wallet' => $main_wallet]);

                    $record               = new Income_transaction_record();
                    $record->date         = date('Y-m-d');
                    $record->amount       = $admin_profit;
                    $record->user_id      = $receiverUser->id;
                    $record->given_to     = 'admin';
                    $record->purpose      = 'wallet_move';
                    $record->save();
                    echo 1;
                }else{
                    echo 3;
                }
             }else{
                 echo 2;
             }
        } else {
            echo 4;
        }
      }


    public function move_trn_bal()
    {
        $user_id                  = Session::get('userId');           
        $user_details             = User::where('id', $user_id)->first();  
        $new_list =  DB::table('hold_transfer_amounts')  
                  ->select('*','hold_transfer_amounts.status as p_status')
                  ->join('users','users.id','=','hold_transfer_amounts.sender')
                  ->where(['sender' => $user_id])
                  ->where(['tran_type' => 'e_wallet_move'])
                  ->orderBy('hold_transfer_amounts.id','desc')
                  ->get();

        return DataTables::of($new_list)
        ->addColumn('action', function ($new_list) {            
            if ($new_list->p_status == 0){
                 return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
            Pending </div>';
            }else{
                 return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
            Paid </div>';
            } 
        })
        ->addIndexColumn()
        ->make(true);
    }

   public function referral_income_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Income_transaction_record::where('purpose','generation_income_distribute')->where('given_to',$user_id)->sum('amount');  
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();             
        return view('member.referral_income_report', $data);
    }

   public function refferral_report()
    {
        $user_id                  = Session::get('userId');        
        $new_list =  DB::table('income_transaction_records')                   
                  ->join('users','users.id','=','income_transaction_records.user_id')
                  ->where(['purpose' => 'generation_income_distribute'])                 
                  ->where(['income_transaction_records.given_to' => $user_id])                 
                  ->orderBy('income_transaction_records.date','desc')
                  ->get();
        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    } 


    public function rank_reward_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Income_transaction_record::where('given_to','user_rank')->where('user_id',$user_id)->sum('amount');          
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();     
        return view('member.rank_reward_report', $data);
    }

   public function rank_reward_report_show()
    {
        $user_id                  = Session::get('userId');        
        $new_list =  DB::table('income_transaction_records')                   
                  ->join('users','users.id','=','income_transaction_records.user_id')
                  ->where(['given_to' => 'user_rank'])                 
                  ->where(['income_transaction_records.user_id' => $user_id])                 
                  ->orderBy('income_transaction_records.date','desc')
                  ->get();

        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    } 


    public function profit_return_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = DB::table('income_transaction_records')->where('purpose','5tk_profit_return')->where('user_id',$user_id)->sum('amount');          
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();     
        return view('member.profit_share_report', $data);
    }

    public function profit_return_report_show()
    {
        $user_id                  = Session::get('userId');        
        $new_list =  DB::table('income_transaction_records')                   
                  ->join('users','users.id','=','income_transaction_records.user_id')
                  ->where(['purpose' => '5tk_profit_return'])                 
                  ->where(['income_transaction_records.user_id' => $user_id])                 
                  ->orderBy('income_transaction_records.date','desc')
                  ->get();

        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    } 

    public function matching_income_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = DB::table('income_transaction_records')->where('purpose','matching_amount_distribute')->where('user_id',$user_id)->sum('amount');          
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();     
        return view('member.matching_income_report', $data);
    }

   public function matching_income_report_show()
    {
        $user_id                  = Session::get('userId');        
        $new_list =  DB::table('income_transaction_records')                   
                  ->join('users','users.id','=','income_transaction_records.user_id')
                  ->where(['purpose' => 'matching_amount_distribute'])                 
                  ->where(['income_transaction_records.user_id' => $user_id])                 
                  ->orderBy('income_transaction_records.date','desc')
                  ->get();

        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    }  

    public function rank_report()
    {                
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();                       
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();     
        return view('member.rank_report', $data);
    }

   public function rank_report_show()
    {
        $user_id  = Session::get('user_name');

        $new_list = DB::table('rank_incentives')  
                 
                  ->where(['rank_incentives.username' => $user_id])                 
                  ->orderBy('rank_incentives.rank_date','asc')
                  ->get();
                   
        return DataTables::of($new_list)     
        ->addColumn('action', function ($new_list) {            
            if ($new_list->status == 1){
                 return '<button type="button" class="btn btn-primary btn-sm">Paid</button>';
            }else{
                 return '<button type="button" class="btn btn-danger btn-sm">Pending</button>';
            } 
        })
        ->addIndexColumn()             
        ->make(true);
    }  

    // key - in - bonus
    public function direct_downlink_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Income_transaction_record::where('purpose','key_in_bonus')->where('given_to',$user_id)->sum('amount');  
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();             
        return view('member.direct_downlink_report', $data);
    }


   public function direct_downlink_report_show()
    {
        $user_id                  = Session::get('userId');        
        $new_list =  DB::table('income_transaction_records')                   
                  ->join('users','users.id','=','income_transaction_records.user_id')
                  ->where(['purpose' => 'key_in_bonus'])                 
                  ->where(['income_transaction_records.given_to' => $user_id])                 
                  ->orderBy('income_transaction_records.date','desc')
                  ->get();

        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    }


    public function generation_level()
    { 
        $user_id                  = Session::get('userId');                    
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();       
        $data['member_details']   = User::where('id', $user_id)->first();  
        $first_level              = DB::table('users')->where('sponser_name', $data['member_details']->user_id)->get();

        $level_one             = array();
        foreach($first_level as $userdetails) {
         $level_one[]          = $userdetails;
        }
        $data['level_one']     = $level_one;
        

        $level_two             = array();
        foreach($level_one as $userdetailss) {          
        $dasdsad               = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_two[]          = $asdasdasd;
           }        
        }
        $data['level_two']     = $level_two;


        $level_three           = array();
        foreach($level_two as $userdetailss) {          
        $dasdsad               = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_three[]          = $asdasdasd;
           }        
        }
        $data['level_three']    = $level_three;


        $level_four            = array();
        foreach($level_three as $userdetailss) {          
        $dasdsad               = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_four[]          = $asdasdasd;
           }        
        }
        $data['level_four']    = $level_four;


        $level_five            = array();
        foreach($level_four as $userdetailss) {          
        $dasdsad               = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_five[]          = $asdasdasd;
           }        
        }
        $data['level_five']    = $level_five;


        $level_six            = array();
        foreach($level_five as $userdetailss) {          
        $dasdsad               = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_six[]          = $asdasdasd;
           }        
        }
        $data['level_six']    = $level_six;


        $level_seven            = array();
        foreach($level_six as $userdetailss) {          
        $dasdsad               = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_seven[]          = $asdasdasd;
           }        
        }
        $data['level_seven']    = $level_seven;


        $level_eight            = array();
        foreach($level_seven as $userdetailss) {          
        $dasdsad                = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_eight[]          = $asdasdasd;
           }        
        }
        $data['level_eight']    = $level_eight;


        $level_nine            = array();
        foreach($level_eight as $userdetailss) {          
        $dasdsad                = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_nine[]          = $asdasdasd;
           }        
        }
        $data['level_nine']    = $level_nine;


        $level_ten            = array();
        foreach($level_nine as $userdetailss) {          
        $dasdsad                = DB::table('users')->where('sponser_name', $userdetailss->user_id)->get();          
           foreach($dasdsad as $asdasdasd) {   
                  $level_ten[]          = $asdasdasd;
           }        
        }
        
        $data['level_ten']    = $level_ten;     
        return view('member.generation_level_list', $data);

    }

    public function downlink_user_list()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();  
        return view('member.downlink_user_list', $data);
    }


   public function downlink_user_list_show()
    {
        $user_id  = Session::get('userId');         
        $new_list = DB::table('users')      
                  ->select('user_id','country_name','joining_date','active_date', 'flag_name')
                  ->join('countries','countries.id','=','users.country')
                  ->where('users.id','>', $user_id)                    
                  ->orderBy('users.id','desc')
                  ->get();
        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    }

    public function main_wallet_withdrawel()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Withdrawel_report::where('userid',$user_id)->sum('amount');
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();              
        return view('member.withdrawel_main_wallet', $data);
    }


    public function balance_withdrawel_view()
    {
        $user_id  = Session::get('userId');                  
        $new_list = DB::table('withdrawel_reports')                   
                  ->where(['userid' => $user_id])                
                  ->orderBy('date','desc')
                  ->get();

        return DataTables::of($new_list)
        ->addColumn('status', function ($new_list) {            
            if ($new_list->status == 0){
                 return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:red;">
            Pending </div>';
            }else{
                 return '<div class="d-table mx-auto btn-group-sm btn-group" style="color:green;">
            Paid </div>';
            } 
        }) 
        ->addColumn('action', function ($new_list) {            
            if ($new_list->status == 0){
                 return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">            
            <button type="button" class="btn btn-primary edit" id="' . $new_list->id . '">Cancel
            ';
            }
        })
        ->rawColumns(['status', 'action'])
        ->addIndexColumn()
        ->make(true);
    }

     public function balance_withdrawel_success(Request $request)
      {   
         $date                     = date('Y-m-d');
         $transfer_amount          = $request->amount;       
         $user_id                  = Session::get('userId');       
         $user_details             = User::where('id', $user_id)->first();           
         $withdraw_check           = Withdrawel_report::where('userid', $user_id)->where('date', $date)->first();
         $thirty_percent           = $user_details->e_wallet - $transfer_amount;           
        if ((Hash::check($request->tran_password, $user_details->transaction_password))) {    
            if($transfer_amount >= 500 ){
              if($user_details->e_wallet >= $transfer_amount){
                  if(empty($withdraw_check)){
                      $withdrawel_amount              = new Withdrawel_report();
                      $withdrawel_amount->userid      = $user_id;
                      $withdrawel_amount->amount      = $transfer_amount;
                      $withdrawel_amount->net_amount  = $request->net_amount;
                      $withdrawel_amount->date        = date('Y-m-d');                    
                      $withdrawel_amount->method      = $request->method;             
                      $withdrawel_amount->status      = 0;
                      $withdrawel_amount->save();

                      $data['e_wallet'] = $user_details->e_wallet - $transfer_amount;
                      DB::table('users')->where('id', $user_details->id)->update($data);
                      echo 1;
                  }else{
                    echo 6;
                  }
              }else{
                  echo 3;
              }
           }else{
               echo 2;
           }
        }else{
           echo 5;
        }
      }

    public function withdrawel_cancel(Request $request)
    {        
        $id                       = $request->id;       
        $user_id                  = Session::get('userId');       
        $user_details             = User::where('id', $user_id)->first();           
        $withdrawel_report        = Withdrawel_report::where('id', $id)->first();          

        $data['e_wallet']      = $user_details->e_wallet + $withdrawel_report->amount;
        DB::table('users')->where('id', $user_details->id)->update($data);  
        DB::table('withdrawel_reports')->where('id', $id)->delete();  
        echo 1;
    }

   public function balance_receive_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Admin_wallet_manage::where('user_id',$user_id)->sum('amount');
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();              
        return view('member.wallet_receive_report', $data);
    }


    public function balance_receive_report_view()
    {
        $user_id  = Session::get('userId');                  
        $new_list = DB::table('admin_wallet_manages')                   
                  ->where(['user_id' => $user_id])                
                  ->orderBy('date','desc')
                  ->get();

        return DataTables::of($new_list)      
        ->addIndexColumn()
        ->make(true);
    }


    public function user_balance_receive_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Hold_transfer_amount::where('receiver',$user_id)->where(['tran_type' => 'bal_tran'])->sum('amount');
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();              
        return view('member.balance_receive_from_user', $data);
    }


    public function user_balance_receive_show()
    {
        $user_id  = Session::get('userId');                  
        $new_list = DB::table('hold_transfer_amounts') 
                  ->join('users','users.id','=','hold_transfer_amounts.sender')                         
                  ->where(['receiver' => $user_id])                
                  ->where(['hold_transfer_amounts.status' => 1])  
                  ->where(['tran_type' => 'bal_tran'])  
                  ->orderBy('date','desc')
                  ->get();

        return DataTables::of($new_list)      
        ->addIndexColumn()
        ->make(true);
    }


    public function point_convert()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Admin_wallet_manage::where('user_id',$user_id)->sum('amount');
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();              
        return view('member.point_convert_page', $data);
    }


    public function point_convert_success()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Admin_wallet_manage::where('user_id',$user_id)->sum('amount');
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();              
        return view('member.wallet_receive_report', $data);
    }

    public function placement_tree()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();   
        $data['member_tree_details']  = User::where('id', $user_id)->first();         
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();              
        return view('member.placement_tree_page', $data);
    }

    public function tree_user_check(Request $request)
    {       
       
      $top_left_user_name                   = $request->top_left_user_name;
      $second_top_left_user_name_one        = $request->second_top_left_user_name_one;
      $second_top_right_user_name_one       = $request->second_top_right_user_name_one;
      $top_right_user_name                  = $request->top_right_user_name;
      $second_top_left_user_name_two        = $request->second_top_left_user_name_two;
      $second_top_right_user_name_two       = $request->second_top_right_user_name_two;
    
      if(!empty($top_left_user_name)){    
        $data['top_id']         =  $top_left_user_name;        
      } else if(!empty($second_top_left_user_name_one)){      
         $data['top_id']         =  $second_top_left_user_name_one; 
      }else if(!empty($second_top_right_user_name_one)){      
         $data['top_id']         =  $second_top_right_user_name_one;
      }else if(!empty($top_right_user_name)){
         $data['top_id']         =  $top_right_user_name;     
      }else if(!empty($second_top_left_user_name_two)){
         $data['top_id']         =  $second_top_left_user_name_two; 
      }else if(!empty($second_top_right_user_name_two)){     
         $data['top_id']         =  $second_top_right_user_name_two;
      }     
      
      $data['userId']               = Session::get('userId'); 
      $data['member_tree_details']  = User::where('user_id', $data['top_id'])->first();       
      return view('member.placement_tree_details', $data); 
    }


   public function generation_income_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Income_transaction_record::where('purpose','generation_income_distribute')->where('given_to',$user_id)->sum('amount');  
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();             
        return view('member.generation_report', $data);
    }

   public function generation_income_report_show()
    {
        $user_id                  = Session::get('userId');        
        $new_list =  DB::table('income_transaction_records')                   
                  ->join('users','users.id','=','income_transaction_records.user_id')
                  ->where(['purpose' => 'generation_income_distribute'])                 
                  ->where(['income_transaction_records.given_to' => $user_id])                 
                  ->orderBy('income_transaction_records.date','desc')
                  ->get();
        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    } 

   public function rollup_income_report()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Income_transaction_record::where('purpose','roll_up_income_distribute')->where('given_to',$user_id)->sum('amount');  
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();             
        return view('member.rollup_report', $data);
    }

   public function rollup_income_report_show()
    {
        $user_id                  = Session::get('userId');        
        $new_list =  DB::table('income_transaction_records')                   
                  ->join('users','users.id','=','income_transaction_records.user_id')
                  ->where(['purpose' => 'roll_up_income_distribute'])                 
                  ->where(['income_transaction_records.given_to' => $user_id])                 
                  ->orderBy('income_transaction_records.date','desc')
                  ->get();
        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    } 

   public function tree_user_search(Request $request)
    {             
      $username                           = $request->username;
      $user_det['userId']                 = Session::get('userId');       
      $user_id                            = Session::get('userId');             
      $placement_user_details             = User::where('id', $user_id)->first();         
      $data                               = $this->placement_user_exist_check($username, $placement_user_details->user_id, $count = 1);  

      $data['member_details']             = User::where('id', $user_id)->first();  
      if($data['top_id'] == 1){
          $data['member_tree_details']  = User::where('user_id', $username)->first();  
      } else {
          $data['member_tree_details']  = "null"; 
      } 
       //dd( $data['member_tree_details'] );
      $data['basic_info']               = Basic_info_manage::where('id', 1)->first(); 
      return view('member.placement_tree_page', $data); 
    }
   
   public function tree_lelvel_up(Request $request)
    {  
      $username                           = $request->username;
      $user_det['userId']                 = Session::get('userId');       
      $user_id                            = Session::get('userId');             
      $placement_user_details             = User::where('id', $user_id)->first();         
      $data                               = $this->placement_user_exist_check($username, $placement_user_details->user_id, $count = 1);  

      $data['member_details']             = User::where('id', $user_id)->first();  
      if($data['top_id'] == 1){
          $data['member_tree_details']  = User::where('user_id', $username)->first();  
      } else {
          $data['member_tree_details']  = "null"; 
      } 
       //dd( $data['member_tree_details'] );
      $data['basic_info']               = Basic_info_manage::where('id', 1)->first(); 
      return view('member.placement_tree_up_page', $data); 
    }


   private function placement_user_exist_check($username, $placement_user, $count = 1)
    {          
        $sponser_details    = User::where('user_id', $username)->orderBy('id', 'desc')->first();     

        if(!empty($sponser_details)){                 
             if($sponser_details->placement_id == $placement_user){    
                 return $user_det = array('top_id' => 1);            
             } else {    
                $counttt = 1 + $count;
                return $this->placement_user_exist_check($sponser_details->placement_id, $placement_user, $counttt);
                return $user_det = array('top_id' => 0);                            
             }                
         }else{    
           return $user_det = array('top_id' => 0);          
        }     
    }


   public function flexiload()
    {        
        $user_id                  = Session::get('userId');       
        $data['member_details']   = User::where('id', $user_id)->first();              
        $data['total_sum']        = Income_transaction_record::where('purpose','generation_income_distribute')->where('given_to',$user_id)->sum('amount');  
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();             
        return view('member.flexiload_page', $data);
    }

   public function flexiload_view()
    {        
        $user_id  = Session::get('userId');        
        $new_list =  DB::table('income_transaction_records')                   
                  ->join('users','users.id','=','income_transaction_records.user_id')
                  ->where(['purpose' => 'mobile_recharge'])                 
                  ->where(['income_transaction_records.user_id' => $user_id])                 
                  ->orderBy('income_transaction_records.date','desc')
                  ->get();
        return DataTables::of($new_list)     
        ->addIndexColumn()
        ->make(true);
    }

    public function flexiload_action(Request $request)
    {   
         $date                     = date('Y-m-d');
         $traamount                = $request->amount;       
         $number                   = $request->number;       
         $preOrpostPaid            = $request->preOrpostPaid;       
         $user_id                  = Session::get('userId');       
         $user_details             = User::where('id', $user_id)->first();           
         $withdraw_check           = Withdrawel_report::where('userid', $user_id)->where('date', $date)->first();
         $transfer_amount          = $traamount/90;
         $thirty_percent           = ($user_details->s_wallet - $transfer_amount);           
         if ((Hash::check($request->tran_password, $user_details->transaction_password))) {    
           
              if($user_details->s_wallet >= $transfer_amount){              
             
                 if($traamount >= 10){                     
                        // mobile recharge start
                        $urlgenrte  = 'http://load16.com/db/api_bd.php?api=websoft&pass=websoft11&mobile='.$number.'&type='.$preOrpostPaid.'&amt='.$traamount.'';
                        $ch = curl_init($urlgenrte);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml =0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);      

                        if($response == 'Insufficient Balance'){                          
                            echo 3;
                            exit();
                        } else if($response == 'Doublicate Entry'){
                            echo 4;
                            ecit();
                        } else {
                            $data3['date']         = date('Y-m-d');   
                            $data3['amount']       = $traamount;   
                            $data3['user_id']      = $user_details->id;
                            $data3['given_to']     = $number;
                            $data3['purpose']      = 'mobile_recharge';   
                            DB::table('income_transaction_records')->insert($data3);

                            $data['s_wallet'] = $user_details->s_wallet - $transfer_amount;
                            DB::table('users')->where('id', $user_details->id)->update($data);
                            echo 1;
                        }

                      }else{
                          echo 2;
                      }  
                 }else{
                  echo 3;
              }         
            }else{
               echo 5;
          }
    }



}
