<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\User;
use App\Country;
use App\Admin;
use App\Income_transaction_record;


class MatchingbonusdistributeController extends Controller
{ 

    public function matching_distribute(Request $request)
    {          
        $current_date             = date('Y-m-d');
        $crone_hit_exist          = DB::table('crone_records')->where('date', $current_date)->where('type', 'matching_income_distribute')->first();            
        if(empty($crone_hit_exist)){
            $all_users            = DB::table('users')->where('left_count','>=',10)->where('right_count','>=',10)->orderBy('id', 'desc')->get();          
            foreach($all_users as $v){               
               
                if($v->left_count > $v->right_count){
                    $distribute_pv        = $v->right_pv_flashable;
                } else if($v->left_count < $v->right_count){
                    $distribute_pv        =  $v->left_count; 
                }else if($v->left_count == $v->right_count){
                    $distribute_pv        = $v->right_count; 
                }         
               
                $data_2['e_wallet']           = $v->e_wallet + $distribute_pv;             
                $data_2['left_pv_flashable']  = $v->left_pv_flashable - $distribute_pv;
                $data_2['right_pv_flashable'] = $v->right_pv_flashable - $distribute_pv; 
                $data_2['right_count']        = $v->right_count - $distribute_pv;
                $data_2['left_count']         = $v->left_count - $distribute_pv;
                DB::table('users')->where('user_id',$v->user_id)->update($data_2);

                $data_y['date']               = date('Y-m-d');   
                $data_y['amount']             = $tenPercent;   
                $data_y['user_id']            = $v->id;   
                $data_y['given_to']           = $v->user_id;   
                $data_y['purpose']            = 'matching_amount_distribute';   
                DB::table('income_transaction_records')->insert($data_y); 
           
            } 
            $dateZZ['date']         = date('Y-m-d');
            $dateZZ['updated_at']   = date("Y-m-d H:i:s");                 
            DB::table('crone_records')->where('type', 'matching_income_distribute')->update($dateZZ);    
              
      }
   }


}
