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

class RankController extends Controller
{ 
    public function Rank_distribute(Request $request)
    {          
        $current_date             = date('Y-m-d');
        $crone_hit_exist          = DB::table('crone_records')->where('date', $current_date)->where('type', 'rank_distribute')->first();            
        if(empty($crone_hit_exist)){

            DB::table('rank_records')->delete();

            $all_member       = DB::table('users')->where('left_count','>=',60)->where('right_count','>=',60)->get();
       
            foreach ($all_member as $key){
                $dataa60['user_name']        = $key->user_id;
                $dataa60['placement_name']   = $key->placement_id;
                $dataa60['left_count']       = $key->left_count;
                $dataa60['right_count']      = $key->right_count;               
                DB::table('rank_records')->insert($dataa60);   

                $rank_exist      = DB::table('rank_incentives')->where('username',$key->user_id)->where('rank_name','MO')->first();  
                    if(empty($rank_exist)){
                        $data7['username']     = $key->user_id;
                        $data7['rank_name']    = "MO";                 
                        $data7['prize']        = "Cox's Bazar Tour/$60";                 
                        $data7['rank_date']    = date('Y-m-d');                                  
                        $data7['status']       = 0;                 
                        DB::table('rank_incentives')->insert($data7);   

                        $data27z['rank']       = "MO";                 
                        DB::table('users')->where('user_id',$key->user_id)->update($data27z);                                        
                    }             
            }        
        
            //////////////////////// MO RANK (21 ta id lage left right a )/////////////////////////////////////
            $a           ='61';
            $b           ='120'; 
            $c           ='61';
            $d           ='120';

            $mo_rank     = DB::table('rank_records')->where(function ($query) use ($a, $b) {
                                $query->where('left_count', '>=', $a)
                                    ->Where('left_count', '<=', $b);
                            })->where(function ($query) use ($c, $d) {
                                $query->where('right_count', '>=', $c)
                                      ->Where('right_count', '<=', $d);
                            })->orderBy('id','desc')->get();               
            if(!empty($mo_rank)){
                foreach ($mo_rank as $key ) {                   
                    $this->updatecrowninfo($key->placement_name, $a, $b);
                }
            }   

            //////////////////////// SMO RANK (6 ta MO lage)/////////////////////////////////////
            $a2           ='121';
            $b2           ='350'; 
            $c2           ='121';
            $d2           ='350';
            $smo_rank     = DB::table('rank_records')->where(function ($query) use ($a2, $b2) {
                                $query->where('left_count', '>=', $a2)
                                    ->Where('left_count', '<=', $b2);
                            })->where(function ($query) use ($c2, $d2) {
                                $query->where('right_count', '>=', $c2)
                                      ->Where('right_count', '<=', $d2);
                            })->orderBy('id','desc')->get();      
            
            if(!empty($smo_rank)){
                foreach ($smo_rank as $key ) {                   
                    $this->updatecrowninfo($key->placement_name, $a2, $b2);
                }
            }  

            //////////////////////// MM RANK (6 ta SMO lage)/////////////////////////////////////
            $a3           ='351';
            $b3           ='600'; 
            $c3           ='351';
            $d3           ='600';
            $mm_rank     = DB::table('rank_records')->where(function ($query) use ($a3, $b3) {
                                $query->where('left_count', '>=', $a3)
                                    ->Where('left_count', '<=', $b3);
                            })->where(function ($query) use ($c3, $d3) {
                                $query->where('right_count', '>=', $c3)
                                      ->Where('right_count', '<=', $d3);
                            })->orderBy('id','desc')->get();      
            
            if(!empty($mm_rank)){
                foreach ($mm_rank as $key ) {                   
                    $this->updatecrowninfo($key->placement_name, $a3, $b3);
                }
            }   

            //////////////////////// SMM RANK (6 ta MM lage)/////////////////////////////////////
            $a4           ='601';
            $b4           ='1150'; 
            $c4           ='601';
            $d4           ='1150';
            $smm_rank     = DB::table('rank_records')->where(function ($query) use ($a4, $b4) {
                                $query->where('left_count', '>=', $a4)
                                    ->Where('left_count', '<=', $b4);
                            })->where(function ($query) use ($c4, $d4) {
                                $query->where('right_count', '>=', $c4)
                                      ->Where('right_count', '<=', $d4);
                            })->orderBy('id','desc')->get();      
            
            if(!empty($smm_rank)){
                foreach ($smm_rank as $key) {                   
                    $this->updatecrowninfo($key->placement_name, $a4, $b4);
                }
            }    


            //////////////////////// AGM RANK (6 ta SMM lage)/////////////////////////////////////
            $a5           ='1151';
            $b5           ='5000';
            $c5           ='1151';
            $d5           ='5000';
            $agm_rank     = DB::table('rank_records')->where(function ($query) use ($a5, $b5) {
                                $query->where('left_count', '>=', $a5)
                                    ->Where('left_count', '<=', $b5);
                            })->where(function ($query) use ($c5, $d5) {
                                $query->where('right_count', '>=', $c5)
                                      ->Where('right_count', '<=', $d5);
                            })->orderBy('id','desc')->get();      
            
            if(!empty($agm_rank)){
                foreach ($agm_rank as $key) {                   
                    $this->updatecrowninfo($key->placement_name, $a5, $b5);
                }
            }      

            //////////////////////// GM RANK (8 ta agm lage)/////////////////////////////////////
            $a6           ='5000';
            $b6           ='979775';
            $c6           ='5000';
            $d6           ='979775';
            $gm_rank     = DB::table('rank_records')->where(function ($query) use ($a6, $b6) {
                                $query->where('left_count', '>=', $a6)
                                    ->Where('left_count', '<=', $b6);
                            })->where(function ($query) use ($c6, $d6) {
                                $query->where('right_count', '>=', $c6)
                                      ->Where('right_count', '<=', $d6);
                            })->orderBy('id','desc')->get();      
            
            if(!empty($gm_rank)){
                foreach ($gm_rank as $key) {                   
                    $this->updatecrowninfo($key->placement_name, $a6, $b6);
                }
            }                  
          
        
         $dateZZ['date']         = date('Y-m-d');
         $dateZZ['updated_at']   = date("Y-m-d H:i:s");                 
         DB::table('crone_records')->where('type', 'rank_distribute')->update($dateZZ);    
        }       
    }

      private function updatecrowninfo($mbplacement , $min, $max)
        {
            $mbinfo              = DB::table('users')->where('user_id',$mbplacement)->first();         
            
            if(!empty($mbinfo)) {
                 $rrrinfo             = DB::table('rank_records')->where('user_name',$mbinfo->user_id)->first();
                if(!empty($rrrinfo)) {
                    if($rrrinfo->left_count < $max) {
                        $data27['left_count']  = $rrrinfo->left_count + $min;
                        $data27['right_count'] = $rrrinfo->right_count + $min;                 
                        DB::table('rank_records')->where('id',$rrrinfo->id)->update($data27);  

                        $rank_find      = DB::table('rank_records')->where('user_name', $mbplacement)->first();       
                          if($rank_find->left_count == 121 && $rank_find->right_count == 121){
                                $rank_exist      = DB::table('rank_incentives')->where('username',$rank_find->user_name)->where('rank_name','SMO')->first();  
                                if(empty($rank_exist)){
                                    $data7['username']     = $rank_find->user_name;
                                    $data7['rank_name']    = "SMO";                 
                                    $data7['prize']        = "Smart Phone";                 
                                    $data7['rank_date']    = date('Y-m-d');                                      
                                    $data7['status']       = 0;                 
                                    DB::table('rank_incentives')->insert($data7);       

                                    $data27z['rank']       = "SMO";                 
                                    DB::table('users')->where('user_id',$rank_find->user_name)->update($data27z);                        
                                }
                            }

                             if($rank_find->left_count == 351 && $rank_find->right_count == 351){
                                $rank_exist      = DB::table('rank_incentives')->where('username',$rank_find->user_name)->where('rank_name','MM')->first();  
                                if(empty($rank_exist)){
                                    $data7['username']     = $rank_find->user_name;
                                    $data7['rank_name']    = "MM";                 
                                    $data7['prize']        = "Laptop";                 
                                    $data7['rank_date']    = date('Y-m-d');                                      
                                    $data7['status']       = 0;                 
                                    DB::table('rank_incentives')->insert($data7);     

                                    $data27z['rank']       = "MM";                 
                                    DB::table('users')->where('user_id',$rank_find->user_name)->update($data27z);                         
                                }
                            } if($rank_find->left_count == 601 && $rank_find->right_count == 601){
                                $rank_exist      = DB::table('rank_incentives')->where('username',$rank_find->user_name)->where('rank_name','SMM')->first();  
                                if(empty($rank_exist)){
                                    $data7['username']     = $rank_find->user_name;
                                    $data7['rank_name']    = "SMM";                 
                                    $data7['prize']        = "Malaysia Tour";                 
                                    $data7['rank_date']    = date('Y-m-d');                                      
                                    $data7['status']       = 0;                 
                                    DB::table('rank_incentives')->insert($data7);         

                                    $data27z['rank']       = "SMM";                 
                                    DB::table('users')->where('user_id',$rank_find->user_name)->update($data27z);                     
                                }
                            }
                            if($rank_find->left_count == 1151 && $rank_find->right_count == 1151){
                                $rank_exist      = DB::table('rank_incentives')->where('username',$rank_find->user_name)->where('rank_name','AGM')->first();  
                                if(empty($rank_exist)){
                                    $data7['username']     = $rank_find->user_name;
                                    $data7['rank_name']    = "AGM";                 
                                    $data7['prize']        = "Motor Cycle";                 
                                    $data7['rank_date']    = date('Y-m-d');                                      
                                    $data7['status']       = 0;                 
                                    DB::table('rank_incentives')->insert($data7);   

                                    $data27z['rank']       = "AGM";                 
                                    DB::table('users')->where('user_id',$rank_find->user_name)->update($data27z);                             
                                }
                            }
                           
                            if($rank_find->left_count == 5001 && $rank_find->right_count == 5001){
                                $rank_exist      = DB::table('rank_incentives')->where('username',$rank_find->user_name)->where('rank_name','GM')->first();  
                                if(empty($rank_exist)){
                                    $data7['username']     = $rank_find->user_name;
                                    $data7['rank_name']    = "GM";                 
                                    $data7['prize']        = "Luxury Car";                 
                                    $data7['rank_date']    = date('Y-m-d');                                      
                                    $data7['status']       = 0;                 
                                    DB::table('rank_incentives')->insert($data7);         

                                    $data27z['rank']       = "GM";                 
                                    DB::table('users')->where('user_id',$rank_find->user_name)->update($data27z);                     
                                }
                            }
                       
                    }                    
                }
            }
            if(!empty($mbinfo)){ return $this->updatecrowninfo($mbinfo->placement_id, $min, $max); }
        }










}
