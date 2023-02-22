<?php

namespace App\Http\Controllers;

use App\User;
use App\Crone_record;
use App\Admin;
use App\Income_transaction_record;
use DB;
use DateTime;
use Mail;
use Session;
class Referrel_income_distributionController extends Controller
{
        public function amount_distribute()
        {   
            /////////********** (2nd postion) It Will run at 1 am ***********/////////
            $current_date             = date('Y-m-d');
            $crone_hit_exist          = DB::table('crone_records')->where('date', $current_date)->where('type', 'referrel_income')->first();
            
            if(empty($crone_hit_exist)){              
                $yesterday                = date('Y-m-d', strtotime('-1 day'));            
                $newRegisteredUser        = DB::table('users')->where([['active_date', $yesterday], ['status', 1]])->orderBy('id', 'desc')->get();               
    //// gotokal notun jara registration koreche tader sponser der comission distribute hobe ekhan theke**********///////
                foreach($newRegisteredUser as $v){              
                     $this->income_distribut($v->sponser_name, $autoCount = 1, $v->id);
                }       
                  
                $dateZZ['date']         = date('Y-m-d');
                $dateZZ['updated_at']   = date("Y-m-d H:i:s");                 
                DB::table('crone_records')->where('type', 'referrel_income')->update($dateZZ);    
            }
        }


        private function income_distribut($sponser_id, $autoCount = 1, $userid){                   
                
            $sponser_details     = DB::table('users')->where('user_id', $sponser_id)->first();        
            if(!empty($sponser_details)){
                if($autoCount <= 10){    
                    
                    if($autoCount == 1){
                         $ditribute_amount = 30 * 10 /100; 
                    } else if($autoCount == 2){
                         $ditribute_amount = 30 * 4 /100;
                    } else if($autoCount == 3){
                         $ditribute_amount = 30 * 2 /100;
                    }else if($autoCount == 4){
                         $ditribute_amount = 30 * 2 /100;
                    }else if($autoCount == 5){
                         $ditribute_amount = 30 * 1 /100;
                    }else if($autoCount == 6){
                         $ditribute_amount = 30 * 1 /100;
                    }else if($autoCount == 7){
                         $ditribute_amount = 30 * 0.5 /100;
                    }else if($autoCount == 8){
                         $ditribute_amount = 30 * 0.5 /100;
                    }else if($autoCount == 9){
                         $ditribute_amount = 30 * 0.5 /100;
                    }else if($autoCount == 10){
                         $ditribute_amount = 30 * 0.5 /100;
                    }

                    $main_wallet           = $ditribute_amount / 2;
                    $reg_wallet            = $ditribute_amount / 2;
                    $data['main_wallet']   = $sponser_details->main_wallet + $main_wallet;
                    $data['reg_wallet']    = $sponser_details->reg_wallet + $reg_wallet;
                    $data['point_wallet']  = $sponser_details->point_wallet + 3;
                    $data['providend_fund_point']   = $sponser_details->providend_fund_point + 0.3;
                    $data['tour_fund_point']        = $sponser_details->tour_fund_point + 0.3;
                    $data['yrly_inctv_fund_point']  = $sponser_details->yrly_inctv_fund_point + 0.3;
                    DB::table('users')->where('id', $sponser_details->id)->update($data);   

                    $record                = new Income_transaction_record();
                    $record->date          = date('Y-m-d');
                    $record->amount        = $ditribute_amount;
                    $record->user_id       = $userid;
                    $record->given_to      = $sponser_details->id;
                    $record->purpose       = 'referrel_income_distribute';
                    $record->save();          

                    ///************ rank update and rank reward start ******* //////////////
                    $check_designation           = DB::table('users')->where('id', $sponser_details->id)->first();         
                    if(empty($check_designation->rank) && ($check_designation->point_wallet >= 200) && ($check_designation->point_wallet < 900)){

                         $dataX['main_wallet']   = $check_designation->main_wallet + 10;
                         $dataX['reg_wallet']    = $check_designation->reg_wallet + 10;
                         $dataX['rank']          = 'BRONZE';
                         DB::table('users')->where('id', $sponser_details->id)->update($dataX); 

                         $record                 = new Income_transaction_record();
                         $record->date           = date('Y-m-d');
                         $record->amount         = 20;
                         $record->user_id        = $sponser_details->id;
                         $record->given_to       = 'user_rank';
                         $record->purpose        = 'BRONZE';
                         $record->save();
                         
                         Session::put('rank_name',  $dataX['rank']); 
                         $this->basic_email($sponser_details->email);    

                    } else if(($check_designation->rank == 'BRONZE') && ($check_designation->point_wallet >= 900) && ($check_designation->point_wallet < 2500)){

                         $dataX['main_wallet']   = $check_designation->main_wallet + 20;
                         $dataX['reg_wallet']    = $check_designation->reg_wallet + 20;
                         $dataX['rank']          = 'SILVER';
                         DB::table('users')->where('id', $sponser_details->id)->update($dataX); 

                         $record                 = new Income_transaction_record();
                         $record->date           = date('Y-m-d');
                         $record->amount         = 40;
                         $record->user_id        = $sponser_details->id;
                         $record->given_to       = 'user_rank';
                         $record->purpose        = 'SILVER';
                         $record->save();

                         Session::put('rank_name',  $dataX['rank']); 
                         $this->basic_email($sponser_details->email);   

                    } else if(($check_designation->rank == 'SILVER') && ($check_designation->point_wallet >= 2500) && ($check_designation->point_wallet < 6000)){

                         $dataX['main_wallet']   = $check_designation->main_wallet + 40;
                         $dataX['reg_wallet']    = $check_designation->reg_wallet + 40;
                         $dataX['rank']          = 'GOLD';
                         DB::table('users')->where('id', $sponser_details->id)->update($dataX); 

                         $record                 = new Income_transaction_record();
                         $record->date           = date('Y-m-d');
                         $record->amount         = 80;
                         $record->user_id        = $sponser_details->id;
                         $record->given_to       = 'user_rank';
                         $record->purpose        = 'GOLD';
                         $record->save();

                         Session::put('rank_name',  $dataX['rank']); 
                         $this->basic_email($sponser_details->email);   

                    } else if(($check_designation->rank == 'GOLD') && ($check_designation->point_wallet >= 6000) && ($check_designation->point_wallet < 16000)){

                         $dataX['main_wallet']   = $check_designation->main_wallet + 80;
                         $dataX['reg_wallet']    = $check_designation->reg_wallet + 80;
                         $dataX['rank']          = 'RUBI';
                         DB::table('users')->where('id', $sponser_details->id)->update($dataX); 

                         $record                 = new Income_transaction_record();
                         $record->date           = date('Y-m-d');
                         $record->amount         = 160;
                         $record->user_id        = $sponser_details->id;
                         $record->given_to       = 'user_rank';
                         $record->purpose        = 'RUBI';
                         $record->save();

                         Session::put('rank_name',  $dataX['rank']); 
                         $this->basic_email($sponser_details->email);   

                    } else if(($check_designation->rank == 'RUBI') && ($check_designation->point_wallet >= 16000) && ($check_designation->point_wallet < 45000)){

                         $dataX['main_wallet']   = $check_designation->main_wallet + 160;
                         $dataX['reg_wallet']    = $check_designation->reg_wallet + 160;
                         $dataX['rank']          = 'DIAMOND';
                         DB::table('users')->where('id', $sponser_details->id)->update($dataX); 

                         $record                 = new Income_transaction_record();
                         $record->date           = date('Y-m-d');
                         $record->amount         = 320;
                         $record->user_id        = $sponser_details->id;
                         $record->given_to       = 'user_rank';
                         $record->purpose        = 'DIAMOND';
                         $record->save();

                         Session::put('rank_name',  $dataX['rank']); 
                         $this->basic_email($sponser_details->email);   


                    } else if(($check_designation->rank == 'DIAMOND') && ($check_designation->point_wallet >= 45000) && ($check_designation->point_wallet < 50000)){

                         $dataX['main_wallet']   = $check_designation->main_wallet + 320;
                         $dataX['reg_wallet']    = $check_designation->reg_wallet + 320;
                         $dataX['rank']          = 'AMBASSADOR';
                         DB::table('users')->where('id', $sponser_details->id)->update($dataX); 

                         $record                 = new Income_transaction_record();
                         $record->date           = date('Y-m-d');
                         $record->amount         = 640;
                         $record->user_id        = $sponser_details->id;
                         $record->given_to       = 'user_rank';
                         $record->purpose        = 'AMBASSADOR';
                         $record->save();

                         Session::put('rank_name',  $dataX['rank']); 
                         $this->basic_email($sponser_details->email);
                    } else if(($check_designation->rank == 'AMBASSADOR') && ($check_designation->point_wallet >= 50000) && ($check_designation->point_wallet < 1000000)){
                        
                         $dataX['rank']          = 'INTERNATIONAL';
                         DB::table('users')->where('id', $sponser_details->id)->update($dataX); 

                         $record                 = new Income_transaction_record();
                         $record->date           = date('Y-m-d');
                         $record->amount         = 0;
                         $record->user_id        = $sponser_details->id;
                         $record->given_to       = 'user_rank';
                         $record->purpose        = 'INTERNATIONAL';
                         $record->save();

                         Session::put('rank_name',  $dataX['rank']); 
                         $this->basic_email($sponser_details->email);
                    }

                      ///// *** rank update and rank reward end ******* //////////////

                  

                    return $this->income_distribut($sponser_details->sponser_name, $autoCount+1, $userid);                         
                }     
            } else {
                    ////**********  over flow amount insert to admin ********///////////
                   
                    if($autoCount == 2){
                         $ditribute_amount_extra = 30 * 12 /100;
                    } else if($autoCount == 3){
                         $ditribute_amount_extra = 30 * 8 /100;
                    }else if($autoCount == 4){
                         $ditribute_amount_extra = 30 * 6 /100;
                    }else if($autoCount == 5){
                         $ditribute_amount_extra = 30 * 4 /100;
                    }else if($autoCount == 6){
                         $ditribute_amount_extra = 30 * 3 /100;
                    }else if($autoCount == 7){
                         $ditribute_amount_extra = 30 * 2 /100;
                    }else if($autoCount == 8){
                         $ditribute_amount_extra = 30 * 1.5 /100;
                    }else if($autoCount == 9){
                         $ditribute_amount_extra = 30 * 1 /100;
                    }else if($autoCount == 10){
                         $ditribute_amount_extra = 30 * 0.5 /100;
                    }
                    if(!empty($ditribute_amount_extra)){
                        $record                = new Income_transaction_record();
                        $record->date          = date('Y-m-d');
                        $record->amount        = $ditribute_amount_extra;
                        $record->user_id       = $userid;
                        $record->given_to      = 'admin';
                        $record->purpose       = 'referrel_income_overflow';
                        $record->save();

                        $admin_wallet          = Admin::find(1);    
                        $data2['extra_fund']   = $admin_wallet->extra_fund + $ditribute_amount_extra;
                        DB::table('admins')->where('id',1)->update($data2);
                    }else{

                    }

            }

           
        }


    public function basic_email($mailid){      
       $subject = 'Donate Thy Self Rank Achievement';
       $data = array('email' => $mailid, 'subject' => $subject);
       Mail::send(['html'=>'mail_rank'], $data, function ($message) use ($data) {
          $message->from('info@donatethyself.com', 'Donate Thy Self Rank Achievement');
          $message->to($data['email']);
          $message->subject($data['subject']); 
       });   
     }
        


   
}
