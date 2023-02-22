<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use Hash;
use DB;
use DataTables;
use App\User;
use App\Country;
use App\Admin;
use App\Income_transaction_record;
use App\Admin_wallet_manage;
use App\Hold_transfer_amount;
use App\Withdrawel_report;
use App\Basic_info_manage;

class PackUpdateController extends Controller
{
    public function member_account_update(Request $request)
    {
        $user_id            = Session::get('userId');       
        $member_details     = User::where('id', $user_id)->first();      

        $user_check         = User::where('user_id', $member_details->user_id)->first();  

        $sponser_check      = User::where('user_id', $member_details->sponser_name)->first();        
        $placement_id       = $member_details->placement_id;
        $placement          = $member_details->placement;
        $table_check        = DB::table('tree_manages')->where('username', $placement_id)->first();
        $placement_result   = DB::table('tree_manages')->where('placement_id', $placement_id)->first();
       
        $user_id            = Session::get('userId');      
        $user_details       = User::where('id', $user_id)->first();     
        $product_details    = DB::table('product_manages')->where('id', $request->package)->first();  
          
        if($request->payment == 'first'){                 
            if($user_details->s_wallet >= $product_details->price){                           
                $data4['s_wallet'] = $user_details->s_wallet - $product_details->price;        
                DB::table('users')->where('id', $user_details->id)->update($data4);

                $data3['date']      = date('Y-m-d');   
                $data3['amount']    = $product_details->price;   
                $data3['user_id']   = $user_details->id;   
                $data3['given_to']  = $user_details->id;   
                $data3['purpose']   = 'user_update';   
                DB::table('income_transaction_records')->insert($data3);
            }else{
                echo 4;
                exit();
            }
        }else if($request->payment == 'second'){               
            $s_wallet       = $product_details->price * 50 /100;
            $r_wallet       = $product_details->price * 25 /100;
            $ps_wallet      = $product_details->price * 25 /100;

            if(($user_details->s_wallet >= $s_wallet) && ($user_details->r_wallet >= $r_wallet) && ($user_details->ps_wallet >= $ps_wallet) ){
               
                $data4['s_wallet']  = $user_details->s_wallet - $s_wallet;        
                $data4['r_wallet']  = $user_details->r_wallet - $r_wallet;        
                $data4['ps_wallet'] = $user_details->ps_wallet - $ps_wallet;        
                DB::table('users')->where('id', $user_details->id)->update($data4);

                $data3['date']      = date('Y-m-d');   
                $data3['amount']    = $s_wallet + $r_wallet + $ps_wallet;   
                $data3['user_id']   = $user_details->id;   
                $data3['given_to']  = $user_details->id;   
                $data3['purpose']   = 'user_registration';   
                DB::table('income_transaction_records')->insert($data3);

            }else{
                echo 4;
                 exit();
            }
        } 
   
        $data['payment_type']   = $request->payment;   
        $data['package']        = $product_details->id;   
        $data['product_yes_no'] = $request->pro_yes_no;        
        $data['rank']           = $product_details->rank_name;       
        $data['active_date']    = date('Y-m-d');      
        if($request->pro_yes_no == 1){
            $data['ordy_ivsion']    = $request->ordy_ivsion; 
            $data['ordy_ten']       = $request->ordy_ten; 
            $data['ordy_mineral']   = $request->ordy_mineral; 
            $data['ordy_combe']     = $request->ordy_combe; 
        }     
       
        if($product_details->rank_name == "gold" || $product_details->rank_name == "super_gold"|| $product_details->rank_name == "platinum" || $product_details->rank_name == "super_platinum" ){
            $data['can_registration']   = 1; 
        } else {
            $data['can_registration']   = 0; 
        }
      
        DB::table('users')->where('id', Session::get('userId'))->update($data);
        $insertid               = Session::get('userId');       

        // rank count for leadership bonus distribute
        if($product_details->rank_name == "gold" || $product_details->rank_name == "super_gold"|| $product_details->rank_name == "platinum" || $product_details->rank_name == "super_platinum" ){
            $sponserDet             = User::where('user_id', $member_details->sponser_name)->first();  
            $data222['rank_count']  = $sponserDet->rank_count + 1; 
            DB::table('users')->where('id', $sponserDet->id)->update($data222);
        }

        // rank count for leadership bonus distribute
        /*$data2['username']      = $request->username; 
        $data2['placement_id']  = $request->placement_id; 
        $data2['position']      = $request->placement; */
        //DB::table('tree_manages')->insert($data2);

        $data_gap['reg_id']      = $insertid; 
        $data_gap['sponser_id']  = $sponser_check->id; 
        $data_gap['date_s']      = date('Y-m-d'); 
        DB::table('gap_incomes')->insert($data_gap);

        // pv count for joining
        $placement_details           = User::where('user_id', $member_details->placement_id)->first();  
       
        //profit share start 
        if($product_details->rank_name == 'super_starter'){
            $data_ps['pack_amount']     = $product_details->point;
            $data_ps['userid']          = $insertid;
            $data_ps['amount']          = 0;
            $data_ps['return_amount']   = $product_details->point*240/100;
            $data_ps['date']            = date('Y-m-d');
            $data_ps['status']          = 0;
            DB::table('profit_shares')->insert($data_ps);
        }else if($product_details->rank_name == 'super_bronze'){
            $data_ps['pack_amount']     = $product_details->point;
            $data_ps['userid']          = $insertid;
            $data_ps['amount']          = 0;
            $data_ps['return_amount']   = $product_details->point*300/100;
            $data_ps['date']            = date('Y-m-d');
            $data_ps['status']          = 0;
            DB::table('profit_shares')->insert($data_ps);
        }else if($product_details->rank_name == 'super_gold'){
            $data_ps['pack_amount']     = $product_details->point;
            $data_ps['userid']          = $insertid;
            $data_ps['amount']          = 0;
            $data_ps['return_amount']   = $product_details->point*400/100;
            $data_ps['date']            = date('Y-m-d');
            $data_ps['status']          = 0;
            DB::table('profit_shares')->insert($data_ps);
        }else if($product_details->rank_name == 'super_platinum'){
            $data_ps['pack_amount']     = $product_details->point;
            $data_ps['userid']          = $insertid;
            $data_ps['amount']          = 0;
            $data_ps['return_amount']   = $product_details->point*500/100;
            $data_ps['date']            = date('Y-m-d');
            $data_ps['status']          = 0;
            DB::table('profit_shares')->insert($data_ps);
        }
        /// key in bonus je join korabe se ei bonus pabe
        $disT_amnt               = $product_details->point*3/100;
        $user_details_2          = User::where('id', $user_id)->first();  
        $data_q['e_wallet']      = $user_details_2->e_wallet + $disT_amnt*80/100;           
        $data_q['m_wallet']      = $user_details_2->m_wallet + $disT_amnt*20/100;       
        DB::table('users')->where('id', $user_details_2->id)->update($data_q);

        $data_f['date']          = date('Y-m-d');   
        $data_f['amount']        = $product_details->point*3/100;   
        $data_f['user_id']       = $insertid;   
        $data_f['given_to']      = $user_details_2->id;   
        $data_f['purpose']       = 'key_in_bonus';   
        DB::table('income_transaction_records')->insert($data_f);

        /// Sponser comission distribute
        $sponser_check_2         = User::where('id', $sponser_check->id)->first();  
        $sponser_package         = DB::table('product_manages')->where('id', $sponser_check_2->package)->first();
       
        if($sponser_package->rank_name == 'starter'){

            if($product_details->rank_name == 'starter'){
                $comission      = $product_details->point*35/100;
            }else if($product_details->rank_name == 'super_starter'){
                $comission      = $product_details->point*35/100;
            }else if($product_details->rank_name == 'bronze'){
                $comission      = $product_details->point*20/100;
            }else if($product_details->rank_name == 'super_bronze'){
                $comission      = $product_details->point*20/100;
            }else if($product_details->rank_name == 'gold'){
                $comission      = $product_details->point*20/100;
            }else if($product_details->rank_name == 'super_gold'){
                $comission      = $product_details->point*20/100;
            }else if($product_details->rank_name == 'platinum'){
                $comission      = $product_details->point*20/100;
            }else if($product_details->rank_name == 'super_platinum'){
                $comission      = $product_details->point*20/100;
            }
                    
            $data_x['e_wallet']      = $sponser_check_2->e_wallet + $comission*80/100;           
            $data_x['m_wallet']      = $sponser_check_2->m_wallet + $comission*20/100;       
            DB::table('users')->where('id', $sponser_check_2->id)->update($data_x);

            $data_y['date']      = date('Y-m-d');   
            $data_y['amount']    = $comission;   
            $data_y['user_id']   = $insertid;   
            $data_y['given_to']  = $sponser_check_2->id;   
            $data_y['purpose']   = 'sponser_bonus';   
            DB::table('income_transaction_records')->insert($data_y); 

        }else  if($sponser_package->rank_name == 'super_starter'){

            if($product_details->rank_name == 'starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'bronze'){
                $comission      = $product_details->point*20/100;
            }else  if($product_details->rank_name == 'super_bronze'){
                $comission      = $product_details->point*20/100;
            }else  if($product_details->rank_name == 'gold'){
                $comission      = $product_details->point*20/100;
            }else  if($product_details->rank_name == 'super_gold'){
                $comission      = $product_details->point*20/100;
            }else  if($product_details->rank_name == 'platinum'){
                $comission      = $product_details->point*20/100;
            }else  if($product_details->rank_name == 'super_platinum'){
                $comission      = $product_details->point*20/100;
            }        

            $data_x['e_wallet']      = $sponser_check_2->e_wallet + $comission*80/100;           
            $data_x['m_wallet']      = $sponser_check_2->m_wallet + $comission*20/100;        
            DB::table('users')->where('id', $sponser_check_2->id)->update($data_x);

            $data_y['date']      = date('Y-m-d');   
            $data_y['amount']    = $comission;   
            $data_y['user_id']   = $insertid;   
            $data_y['given_to']  = $sponser_check_2->id;   
            $data_y['purpose']   = 'sponser_bonus';   
            DB::table('income_transaction_records')->insert($data_y); 

        }else  if($sponser_package->rank_name == 'bronze'){

            if($product_details->rank_name == 'starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'bronze'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'super_bronze'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'gold'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'super_gold'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'platinum'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'super_platinum'){
                $comission      = $product_details->point*25/100;
            }
           
            $data_x['e_wallet']      = $sponser_check_2->e_wallet + $comission*80/100;           
            $data_x['m_wallet']      = $sponser_check_2->m_wallet + $comission*20/100;             
            DB::table('users')->where('id', $sponser_check_2->id)->update($data_x);

            $data_y['date']      = date('Y-m-d');   
            $data_y['amount']    = $comission;   
            $data_y['user_id']   = $insertid;   
            $data_y['given_to']  = $sponser_check_2->id;   
            $data_y['purpose']   = 'sponser_bonus';   
            DB::table('income_transaction_records')->insert($data_y); 

        }else  if($sponser_package->rank_name == 'super_bronze'){

            if($product_details->rank_name == 'starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'bronze'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'super_bronze'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'gold'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'super_gold'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'platinum'){
                $comission      = $product_details->point*25/100;
            }else  if($product_details->rank_name == 'super_platinum'){
                $comission      = $product_details->point*25/100;
            }
           
            $data_x['e_wallet']      = $sponser_check_2->e_wallet + $comission*80/100;           
            $data_x['m_wallet']      = $sponser_check_2->m_wallet + $comission*20/100;             
            DB::table('users')->where('id', $sponser_check_2->id)->update($data_x);

            $data_y['date']      = date('Y-m-d');   
            $data_y['amount']    = $comission;   
            $data_y['user_id']   = $insertid;   
            $data_y['given_to']  = $sponser_check_2->id;   
            $data_y['purpose']   = 'sponser_bonus';   
            DB::table('income_transaction_records')->insert($data_y); 

        }else  if($sponser_package->rank_name == 'gold'){

            if($product_details->rank_name == 'starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_starter'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'bronze'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'super_bronze'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'gold'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'super_gold'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'platinum'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'super_platinum'){
                $comission      = $product_details->point*30/100;
            }
           
            $data_x['e_wallet']      = $sponser_check_2->e_wallet + $comission*80/100;           
            $data_x['m_wallet']      = $sponser_check_2->m_wallet + $comission*20/100;              
            DB::table('users')->where('id', $sponser_check_2->id)->update($data_x);

            $data_y['date']      = date('Y-m-d');   
            $data_y['amount']    = $comission;   
            $data_y['user_id']   = $insertid;   
            $data_y['given_to']  = $sponser_check_2->id;   
            $data_y['purpose']   = 'sponser_bonus';   
            DB::table('income_transaction_records')->insert($data_y); 

        }else  if($sponser_package->rank_name == 'super_gold'){

            if($product_details->rank_name == 'starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_starter'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'bronze'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'super_bronze'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'gold'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'super_gold'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'platinum'){
                $comission      = $product_details->point*30/100;
            }else  if($product_details->rank_name == 'super_platinum'){
                $comission      = $product_details->point*30/100;
            }
           
            $data_x['e_wallet']      = $sponser_check_2->e_wallet + $comission*80/100;           
            $data_x['m_wallet']      = $sponser_check_2->m_wallet + $comission*20/100;              
            DB::table('users')->where('id', $sponser_check_2->id)->update($data_x);

            $data_y['date']      = date('Y-m-d');   
            $data_y['amount']    = $comission;   
            $data_y['user_id']   = $insertid;   
            $data_y['given_to']  = $sponser_check_2->id;   
            $data_y['purpose']   = 'sponser_bonus';   
            DB::table('income_transaction_records')->insert($data_y); 

        }else  if($sponser_package->rank_name == 'platinum'){

            if($product_details->rank_name == 'starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'bronze'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_bronze'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'gold'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_gold'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'platinum'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_platinum'){
                $comission      = $product_details->point*35/100;
            }
           
            $data_x['e_wallet']      = $sponser_check_2->e_wallet + $comission*80/100;           
            $data_x['m_wallet']      = $sponser_check_2->m_wallet + $comission*20/100;          
            DB::table('users')->where('id', $sponser_check_2->id)->update($data_x);

            $data_y['date']      = date('Y-m-d');   
            $data_y['amount']    = $comission;   
            $data_y['user_id']   = $insertid;   
            $data_y['given_to']  = $sponser_check_2->id;   
            $data_y['purpose']   = 'sponser_bonus';   
            DB::table('income_transaction_records')->insert($data_y); 

        }else if($sponser_package->rank_name == 'super_platinum'){

            if($product_details->rank_name == 'starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_starter'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'bronze'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_bronze'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'gold'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_gold'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'platinum'){
                $comission      = $product_details->point*35/100;
            }else  if($product_details->rank_name == 'super_platinum'){
                $comission      = $product_details->point*35/100;
            }
           
            $data_x['e_wallet']      = $sponser_check_2->e_wallet + $comission*80/100;           
            $data_x['m_wallet']      = $sponser_check_2->m_wallet + $comission*20/100;            
            DB::table('users')->where('id', $sponser_check_2->id)->update($data_x);

            $data_y['date']      = date('Y-m-d');   
            $data_y['amount']    = $comission;   
            $data_y['user_id']   = $insertid;   
            $data_y['given_to']  = $sponser_check_2->id;   
            $data_y['purpose']   = 'sponser_bonus';   
            DB::table('income_transaction_records')->insert($data_y);             
        }    


         // ###############   roll up bonus start  ####################

        if($sponser_check_2->rank == 'starter' || $sponser_check_2->rank == 'super_starter'){
           if($product_details->rank_name == 'bronze' || $product_details->rank_name == 'super_bronze' || $product_details->rank_name == 'gold' || $product_details->rank_name == 'super_gold' || $product_details->rank_name == 'platinum' || $product_details->rank_name == 'super_platinum' ){
                $gap_percent             = 15;
                $sponser_of_sponser      = User::where('user_id', $sponser_check_2->sponser_name)->first();             
                $this->roll_up_income_distribute($sponser_of_sponser->user_id, $sponser_of_sponser->rank, $gap_percent, $product_details->point , $insertid, $count = 1);
            }
        }else  if($sponser_check_2->rank == 'bronze' || $sponser_check_2->rank == 'super_bronze'){            
            if($product_details->rank_name == 'bronze' || $product_details->rank_name == 'super_bronze' || $product_details->rank_name == 'gold' || $product_details->rank_name == 'super_gold' || $product_details->rank_name == 'platinum' || $product_details->rank_name == 'super_platinum' ){
                $gap_percent             = 10;
                $sponser_of_sponser      = User::where('user_id', $sponser_check_2->sponser_name)->first();
                $this->roll_up_income_distribute($sponser_of_sponser->user_id, $sponser_of_sponser->rank, $gap_percent, $product_details->point , $insertid, $count = 1);
            }
        }else  if($sponser_check_2->rank == 'gold' || $sponser_check_2->rank == 'super_gold'){            
           if($product_details->rank_name == 'bronze' || $product_details->rank_name == 'super_bronze' || $product_details->rank_name == 'gold' || $product_details->rank_name == 'super_gold' || $product_details->rank_name == 'platinum' || $product_details->rank_name == 'super_platinum' ){
                $gap_percent             = 5;
                $sponser_of_sponser      = User::where('user_id', $sponser_check_2->sponser_name)->first();             
                $this->roll_up_income_distribute($sponser_of_sponser->user_id, $sponser_of_sponser->rank, $gap_percent, $product_details->point , $insertid, $count = 1);
            }
        }

         // ###############   roll up bonus end  ####################


             if($sponser_check_2->rank == "gold" || $sponser_check_2->rank == "super_gold"){
                $this->generation_income_distribute($sponser_check_2->rank, $sponser_check_2->user_id, $product_details->point, $insertid, $count = 1);                  
             } else if( $sponser_check_2->rank == "platinum" || $sponser_check_2->rank == "super_platinum"){
                $this->generation_income_distribute_2($sponser_check_2->rank, $sponser_check_2->user_id, $product_details->point, $insertid, $count = 1); 
             } else {
               // $this->generation_income_distribute_3($sponser_check_2->rank, $sponser_check_2->user_id, $product_details->point, $insertid, $count = 1); 
             }
          
          //pv distribute to upline 
             $this->updateteamincome($member_details->placement_id, $member_details->placement, $product_details->point, $insertid);

          echo 1;
    }

   
    private function updateteamincome($mbplacement, $mbteam, $binarybalanceincome, $insertid)
    {        
        $teaminfo   =  DB::table('users')->where('user_id', $mbplacement)->first();
        $adminsinfo =  DB::table('admins')->where('id', 1)->first();
        if(!empty($teaminfo)) {
            if($mbteam == "L") {
                $data271['left_pv_flashable'] = $teaminfo->left_pv_flashable + $binarybalanceincome;               
                $data271['left_pv_counting']  = $teaminfo->left_pv_counting + $binarybalanceincome;                
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
         return $this->updateteamincome($teaminfo->placement_id, $teaminfo->placement, $binarybalanceincome, $insertid);
        }
    }


  private function generation_income_distribute($rank, $sponser_id, $point_value, $insertid, $count = 1)
    {          
        $sponser_details    = User::where('user_id', $sponser_id)->first();
        $dist_amount        = $point_value * 0.5 /100;
        $e_wallet           = $dist_amount * 80 /100;
        $m_wallet           = $dist_amount * 20 /100;
        if(!empty($sponser_details)){                 
             if($count <= 5){
                 if($rank == "gold" || $rank == "super_gold"){   
                    $data['e_wallet']        = $sponser_details->e_wallet + $e_wallet;
                    $data['m_wallet']        = $sponser_details->m_wallet + $m_wallet;              
                    DB::table('users')->where('id', $sponser_details->id)->update($data);

                    $data_y['date']          = date('Y-m-d');   
                    $data_y['amount']        = $dist_amount;   
                    $data_y['user_id']       = $insertid;   
                    $data_y['given_to']      = $sponser_details->id; 
                    $data_y['purpose']       = 'generation_income_distribute';   
                    DB::table('income_transaction_records')->insert($data_y);         

                    $admin_details           = Admin::where('id', 1)->first();                  
                    $data33['comission_balance'] = $admin_details->comission_balance + $dist_amount;                    
                    DB::table('admins')->where('id',1)->update($data33);                
                }

              $genaration_count        = $count+1;
              $sponser_details_22      = User::where('user_id', $sponser_details->sponser_name)->first();
              if(!empty($sponser_details_22)){
                 $this->generation_income_distribute($sponser_details_22->user_id, $point_value, $insertid, $genaration_count);
              }
            }       
         }else{
            $data_yx['date']          = date('Y-m-d');   
            $data_yx['amount']        = 0.5 * (5 - $count);
            $data_yx['user_id']       = 1;   
            $data_yx['given_to']      = 'admin'; 
            $data_yx['purpose']       = 'generation_income_extra';   
            DB::table('income_transaction_records')->insert($data_yx);    

            $admin_details           = Admin::where('id', 1)->first();                  
            $data55['extra_fund']    = $admin_details->extra_fund + $data_yx['amount'];                    
            DB::table('admins')->where('id',1)->update($data55);
        }
    }



 private function generation_income_distribute_2($rank, $sponser_id, $point_value, $insertid, $count = 1)
    {          
        $sponser_details    = User::where('user_id', $sponser_id)->first();
        $dist_amount        = $point_value * 0.5 /100;
        $e_wallet           = $dist_amount * 80 /100;
        $m_wallet           = $dist_amount * 20 /100;
        if(!empty($sponser_details)){                 
             if($count <= 10){
                 if($rank == "platinum" || $rank == "platinum"){   
                    $data['e_wallet']        = $sponser_details->e_wallet + $e_wallet;
                    $data['m_wallet']        = $sponser_details->m_wallet + $m_wallet;              
                    DB::table('users')->where('id', $sponser_details->id)->update($data);

                    $data_y['date']          = date('Y-m-d');   
                    $data_y['amount']        = $dist_amount;   
                    $data_y['user_id']       = $insertid;   
                    $data_y['given_to']      = $sponser_details->id; 
                    $data_y['purpose']       = 'generation_income_distribute';   
                    DB::table('income_transaction_records')->insert($data_y);         

                    $admin_details           = Admin::where('id', 1)->first();                  
                    $data33['comission_balance'] = $admin_details->comission_balance + $dist_amount;                    
                    DB::table('admins')->where('id',1)->update($data33);                  
               }
                $genaration_count        = $count+1;
                $sponser_details_22      = User::where('user_id', $sponser_details->sponser_name)->first();
                if(!empty($sponser_details_22)){                
                    $this->generation_income_distribute_2($sponser_details_22->user_id, $point_value, $insertid, $genaration_count);
                 }
            }       
         }else{
            $data_yx['date']          = date('Y-m-d');   
            $data_yx['amount']        = 0.5 * (5 - $count);
            $data_yx['user_id']       = 1;   
            $data_yx['given_to']      = 'admin'; 
            $data_yx['purpose']       = 'generation_income_extra';   
            DB::table('income_transaction_records')->insert($data_yx);    

            $admin_details           = Admin::where('id', 1)->first();                  
            $data55['extra_fund'] = $admin_details->extra_fund + $data_yx['amount'];                    
            DB::table('admins')->where('id',1)->update($data55);
        }
    }

 private function generation_income_distribute_3($rank, $sponser_id, $point_value, $insertid, $count = 1)
    {          
        $sponser_details    = User::where('user_id', $sponser_id)->first();
        $dist_amount        = $point_value * 0.5 /100;
        $e_wallet           = $dist_amount * 80 /100;
        $m_wallet           = $dist_amount * 20 /100;
        if(!empty($sponser_details)){                 
             if($count <= 5){
                 if($rank == "platinum" || $rank == "platinum"|| $rank == "gold" || $rank == "super_gold"){   
                    $data['e_wallet']        = $sponser_details->e_wallet + $e_wallet;
                    $data['m_wallet']        = $sponser_details->m_wallet + $m_wallet;              
                    DB::table('users')->where('id', $sponser_details->id)->update($data);

                    $data_y['date']          = date('Y-m-d');   
                    $data_y['amount']        = $dist_amount;   
                    $data_y['user_id']       = $insertid;   
                    $data_y['given_to']      = $sponser_details->id; 
                    $data_y['purpose']       = 'generation_income_distribute';   
                    DB::table('income_transaction_records')->insert($data_y);         

                    $admin_details           = Admin::where('id', 1)->first();                  
                    $data33['comission_balance'] = $admin_details->comission_balance + $dist_amount;                    
                    DB::table('admins')->where('id',1)->update($data33);
               }               
                $genaration_count        = $count+1;
                $sponser_details_22      = User::where('user_id', $sponser_details->sponser_name)->first();
                if(!empty($sponser_details_22)){   
                   $this->generation_income_distribute_3($sponser_details_22->user_id, $point_value, $insertid, $genaration_count);
                }
            }       
         }else{
            $data_yx['date']          = date('Y-m-d');   
            $data_yx['amount']        = 0.5 * (5 - $count);
            $data_yx['user_id']       = 1;   
            $data_yx['given_to']      = 'admin'; 
            $data_yx['purpose']       = 'generation_income_extra';   
            DB::table('income_transaction_records')->insert($data_yx);    

            $admin_details           = Admin::where('id', 1)->first();                  
            $data55['extra_fund'] = $admin_details->extra_fund + $data_yx['amount'];                    
            DB::table('admins')->where('id',1)->update($data55);
        }
    }


    private function roll_up_income_distribute($sponser_id, $sponser_rank, $gap_percent , $point_value, $insertid, $count = 1)
    {          
        $sponser_details    = User::where('user_id', $sponser_id)->first();
        if(!empty($sponser_details)){                 
           
            if($sponser_rank == "platinum" || $sponser_rank == "super_platinum"){   
                    $dist_amount             = $point_value * $gap_percent / 100;
                    $data['e_wallet']        = $sponser_details->e_wallet + $dist_amount * 80 /100;
                    $data['m_wallet']        = $sponser_details->m_wallet + $dist_amount * 20 /100;      
                    DB::table('users')->where('id', $sponser_details->id)->update($data);

                    $data_y['date']          = date('Y-m-d');   
                    $data_y['amount']        = $dist_amount;   
                    $data_y['user_id']       = $insertid;   
                    $data_y['given_to']      = $sponser_details->id; 
                    $data_y['purpose']       = 'roll_up_income_distribute';   
                    DB::table('income_transaction_records')->insert($data_y);         

                    $admin_details           = Admin::where('id', 1)->first();                  
                    $data33['comission_balance'] = $admin_details->comission_balance + $dist_amount;                    
                    DB::table('admins')->where('id',1)->update($data33);

                    $gappp_percentt = 0;
             } else if($sponser_rank == "gold" || $sponser_rank == "super_gold"){
                    if($gap_percent == 15){
                        $dist_amount2         = $point_value * 10 / 100;
                        $gappp_percentt       = 5;
                    } else if($gap_percent == 10){
                        $dist_amount2         = $point_value * $gap_percent / 100;
                        $gappp_percentt       = 0;
                    } else if($gap_percent == 5){
                        $dist_amount2         = $point_value * $gap_percent / 100;
                        $gappp_percentt       = 0;
                    }
                    $data['e_wallet']        = $sponser_details->e_wallet + $dist_amount2 * 80 /100;
                    $data['m_wallet']        = $sponser_details->m_wallet + $dist_amount2 * 20 /100;      
                    DB::table('users')->where('id', $sponser_details->id)->update($data);

                    $data_y['date']          = date('Y-m-d');   
                    $data_y['amount']        = $dist_amount2;   
                    $data_y['user_id']       = $insertid;   
                    $data_y['given_to']      = $sponser_details->id; 
                    $data_y['purpose']       = 'roll_up_income_distribute';   
                    DB::table('income_transaction_records')->insert($data_y);         

                    $admin_details           = Admin::where('id', 1)->first();                  
                    $data33['comission_balance'] = $admin_details->comission_balance + $dist_amount2;                    
                    DB::table('admins')->where('id',1)->update($data33); 

             } else if($sponser_rank == "bronze" || $sponser_rank == "super_bronze"){
                    if($gap_percent == 15){
                        $dist_amount2         = $point_value * 5 / 100;
                        $gappp_percentt       = 10;
                    } else if($gap_percent == 10){
                        $dist_amount2         = $point_value * 5 / 100;
                        $gappp_percentt       = 5;
                    } else if($gap_percent == 5){
                        $dist_amount2         = $point_value * 5 / 100;
                        $gappp_percentt       = 0;
                    }

                    $data['e_wallet']        = $sponser_details->e_wallet + $dist_amount2 * 80 /100;
                    $data['m_wallet']        = $sponser_details->m_wallet + $dist_amount2 * 20 /100;      
                    DB::table('users')->where('id', $sponser_details->id)->update($data);

                    $data_y['date']          = date('Y-m-d');   
                    $data_y['amount']        = $dist_amount2;   
                    $data_y['user_id']       = $insertid;   
                    $data_y['given_to']      = $sponser_details->id; 
                    $data_y['purpose']       = 'roll_up_income_distribute';   
                    DB::table('income_transaction_records')->insert($data_y);         

                    $admin_details           = Admin::where('id', 1)->first();                  
                    $data33['comission_balance'] = $admin_details->comission_balance + $dist_amount2;                    
                    DB::table('admins')->where('id',1)->update($data33);

             }  else if($sponser_rank == "starter" || $sponser_rank == "super_starter"){
                    if($gap_percent == 15){
                        $dist_amount2         = $point_value * 5 / 100;
                        $gappp_percentt       = 10;
                    } else if($gap_percent == 10){
                        $dist_amount2         = $point_value * 5 / 100;
                        $gappp_percentt       = 5;
                    } else if($gap_percent == 5){
                        $dist_amount2         = $point_value * 5 / 100;
                        $gappp_percentt       = 0;
                    }

                    $data['e_wallet']        = $sponser_details->e_wallet + $dist_amount2 * 80 /100;
                    $data['m_wallet']        = $sponser_details->m_wallet + $dist_amount2 * 20 /100;      
                    DB::table('users')->where('id', $sponser_details->id)->update($data);

                    $data_y['date']          = date('Y-m-d');   
                    $data_y['amount']        = $dist_amount2;   
                    $data_y['user_id']       = $insertid;   
                    $data_y['given_to']      = $sponser_details->id; 
                    $data_y['purpose']       = 'roll_up_income_distribute';   
                    DB::table('income_transaction_records')->insert($data_y);         

                    $admin_details           = Admin::where('id', 1)->first();                  
                    $data33['comission_balance'] = $admin_details->comission_balance + $dist_amount2;                    
                    DB::table('admins')->where('id',1)->update($data33);
             }                
                   
                $genaration_count        = $count+1;
                $sponser_details_22      = User::where('user_id', $sponser_details->sponser_name)->first();
                if(!empty($sponser_details_22) && ($gappp_percentt != 0)){   
                   $this->roll_up_income_distribute($sponser_details_22->user_id, $sponser_details_22->rank, $gappp_percentt, $point_value, $insertid, $genaration_count);
                }

         }else{
            $data_yx['date']          = date('Y-m-d');   
            $data_yx['amount']        = $point_value * $gap_percent / 100;
            $data_yx['user_id']       = 1;   
            $data_yx['given_to']      = 'admin'; 
            $data_yx['purpose']       = 'roll_up_income_extra';   
            DB::table('income_transaction_records')->insert($data_yx);    

            $admin_details           = Admin::where('id', 1)->first();                  
            $data55['extra_fund'] = $admin_details->extra_fund + $data_yx['amount'];                    
            DB::table('admins')->where('id',1)->update($data55);
        }
    }



}
