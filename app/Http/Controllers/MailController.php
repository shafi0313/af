<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {



 
/*   public function basic_email() {
      $data = array('name'=>"donatethy self");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('sumonta121@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('donatethyself1@gmail.com','donatethyself');
      });
      echo "Basic Email Sent. Check your inbox.";
   }*/

   public function basic_email(request $req){
   $mailid = 'sumonta121@gmail.com';
   $subject = 'News Information.';
   $data = array('email' => $mailid, 'subject' => $subject);
   Mail::send(['html'=>'mail'], $data, function ($message) use ($data) {
      $message->from('expertsphp@gmail.com', 'News Information');
      $message->to($data['email']);
      $message->subject($data['subject']); 
   });
    echo "Basic Email Sent. Check your inbox.";
    
    }




}