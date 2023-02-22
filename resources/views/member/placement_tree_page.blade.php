@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')

      <style>
    .hv-wrapper {
  display: flex; }
  .hv-wrapper .hv-item {
    display: flex;
    flex-direction: column;
    margin: auto; }
    .hv-wrapper .hv-item .hv-item-parent {
      margin-bottom: 50px;
      position: relative;
      display: flex;
      justify-content: center; }
      .hv-wrapper .hv-item .hv-item-parent:after {
        position: absolute;
        content: '';
        width: 2px;
        height: 25px;
        bottom: 0;
        left: 50%;
        background-color: rgba(255, 255, 255, 0.7);
        transform: translateY(100%); }
    .hv-wrapper .hv-item .hv-item-children {
      display: flex;
      justify-content: center; }
      .hv-wrapper .hv-item .hv-item-children .hv-item-child {
        padding: 0 15px;
        position: relative; }
        .hv-wrapper .hv-item .hv-item-children .hv-item-child:before, .hv-wrapper .hv-item .hv-item-children .hv-item-child:not(:only-child):after {
          content: '';
          position: absolute;
          background-color: rgba(255, 255, 255, 0.7);
          left: 0; }
        .hv-wrapper .hv-item .hv-item-children .hv-item-child:before {
          left: 50%;
          top: 0;
          transform: translateY(-100%);
          width: 2px;
          height: 25px; }
        .hv-wrapper .hv-item .hv-item-children .hv-item-child:after {
          top: -25px;
          transform: translateY(-100%);
          height: 2px;
          width: 100%; }
        .hv-wrapper .hv-item .hv-item-children .hv-item-child:first-child:after {
          left: 50%;
          width: 50%; }
        .hv-wrapper .hv-item .hv-item-children .hv-item-child:last-child:after {
          width: calc(50% + 1px); }

    </style>
    
    <style>
    @import url("https://fonts.googleapis.com/css?family=Poppins");
    section {
      min-height: 100%;
      display: flex;
      justify-content: center;
      flex-direction: column;
      padding: 50px 0;
      position: relative; 
    }
  section .github-badge {
    position: absolute;
    top: 0;
    left: 0; }
  section h1 {
    text-align: center;
    margin-bottom: 70px; }
  section .hv-container {
    flex-grow: 1;
    overflow: auto;
    justify-content: center; }

  .basic-style {
    background-color: #EFE6E2; }
  .basic-style > h1 {
      color: #ac2222; }

  p.simple-card {
    margin: 0;
    background-color: #fff;
    color: #DE5454;
    padding: 30px;
    border-radius: 7px;
    min-width: 100px;
    text-align: center;
    box-shadow: 0 3px 6px rgba(204, 131, 103, 0.22); }

    .hv-item-parent p {
      font-weight: bold;
      color: #DE5454; }
    .management-hierarchy {
       background-color: #6da8e394; 
       min-height: 1000px;
     }
    .management-hierarchy > h1 {
      color: #FFF; }
    .management-hierarchy .person {
      text-align: center; }
    .management-hierarchy .person > img {
      height: 110px;
      border: 5px solid #1EAADE;
      border-radius: 50%;
      overflow: hidden;
      background-color: #fff; }
    .management-hierarchy .person > p.name {
      background-color: #fff;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 12px;
      font-weight: normal;
      color: #3BAA9D;
      margin: 0;
      position: relative; }
    .management-hierarchy .person > p.name b {
      color: rgba(59, 170, 157, 0.5); }
    .management-hierarchy .person > p.name:before {
      content: '';
      position: absolute;
      width: 2px;
      height: 8px;
      background-color: #fff;
      left: 50%;
      top: 0;
      transform: translateY(-100%); 
    }
    .person p {
      font-size: 12px !important;
      color: Blue !important;
      font-weight: 900 !important;
      text-transform: uppercase !important;
    }

      
    .dropdown_custom {
      float: left;
      overflow: hidden;
    }

    .dropdown_custom-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9; 
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      -webkit-box-shadow: 0px 0px 23px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 23px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 23px 0px rgba(0,0,0,0.75);
    }
    .dropdown_custom-content div { 
      margin: 5px;
      text-decoration: none;
      padding-top: 3px;
      padding-bottom: 3px;
      color:blue !important;

    font-weight: 900 !important;
    }

    .dropdown_custom-content div:hover {
        color: black; 
      text-decoration: none;
    }
    .dropdown_custom:hover .dropdown_custom-content {
      display: block;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                     <h5 class="" style="font-size: 18px;"></h5>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">                      
                        <div class="card-body p-0 text-center ReactTable">  

            <!--Management Hierarchy-->
            <section class="management-hierarchy">
                <h1>Placement Tree</h1>
                <div class="hv-container" id="replace">
                    <div class="hv-wrapper" >             
                        <div class="hv-item">
                             <form action="{{ url('member/tree-user-search') }}" method="post"> 
                              <div class="row ">
                                <div class="col" align="right">
                                    <button data_id="
                                    @if($member_tree_details != 'null' )
                                      {{  $member_tree_details->placement_id }}
                                    @endif
                                    " type="button" class="btn btn-success btn-sm" id="level_up" style="width: 100px; font-size: 12px;">
                                      <i class="fa fa-level-up" style="font-size: 18px;" aria-hidden="true"></i>Level Up
                                    </button>
                                </div>                            
                                @csrf
                                <div class="col">
                                  <input type="text" class="form-control" name="username" placeholder="Enter user name search"  required="required"> 
                                </div>
                                <div class="col" align="left" >
                                   <button type="Submit" class="btn btn-primary btn-sm"  style="width: 100px; font-size: 12px;" required="required"><i class="fa fa-level-down" style="font-size: 18px;" aria-hidden="true"></i>Submit</button>
                                </div>                               
                              </div> 
                             </form>

                    @if($member_tree_details != 'null')
                    <div class="hv-item-parent">                         
                               <div class="person dropdown_custom">     
                                    @if(!empty($member_tree_details->image))
                                    <img src="{{ asset('storage/product/'.$member_tree_details->image) }}">              
                                    @else
                                    <img  src="{{ asset('images/user.png') }}">          
                                    @endIf   
                                    <p class="name">{{ $member_tree_details->user_id }}</p>  
                                    <div class="dropdown_custom-content">
                                          <div class="name">{{ $member_tree_details->user_id }}</div>                          
                                          <div class="name">Rank:{{ $member_tree_details->rank }}</div>
                                          <div class="name">L-PV:{{ $member_tree_details->left_pv_counting }} R-PV:{{ $member_tree_details->right_pv_counting }} </div>
                                          <div class="name">L-Carry:{{ $member_tree_details->left_pv_flashable }} R-Carry:{{ $member_tree_details->right_pv_flashable }} </div>
                                          <div class="name">Total PV:{{ $member_tree_details->left_pv_counting +$member_tree_details->right_pv_counting }}</div> 
                                    </div>
                                 </div>                           
                           </div>

                            <div class="hv-item-children">
                              <div class="hv-item-child">                          
                                <div class="hv-item">                              
                                   <div class="hv-item-parent">                                 
                                     <div class="person dropdown_custom">    
                                        @php
                                         $top_left = DB::table('tree_manages')->where('placement_id', $member_tree_details->user_id)->where('position', 'L')->first();
                                        @endphp  
                                        @if(!empty($top_left))                                
                                              @php
                                               $user_details = DB::table('users')->where('user_id', $top_left->username)->first();
                                              @endphp  
                                             @if(!empty($user_details->image))
                                              <img id="top_left_user_name_click" src="{{ asset('storage/product/'.$user_details->image) }}">
                                             @else
                                              <img id="top_left_user_name_click" src="{{ asset('images/user.png') }}">
                                             @endIf
                                             <input type="hidden" id="top_left_user_name" value="{{ $user_details->user_id }}">     
                                              <p class="name">{{ $user_details->user_id }}</p>  
                                              <div class="dropdown_custom-content">
                                                    <div class="name">{{ $user_details->user_id }}</div>                          
                                                    <div class="name">Rank:{{ $user_details->rank }}</div>
                                                    <div class="name">L-PV:{{ $user_details->left_pv_counting }} R-PV:{{ $user_details->right_pv_counting }} </div>
                                                    <div class="name">L-Carry:{{ $user_details->left_pv_flashable }} R-Carry:{{ $user_details->right_pv_flashable }} </div>
                                                    <div class="name">Total PV:{{ $user_details->left_pv_counting +$user_details->right_pv_counting }}</div> 
                                              </div>
                                        @else
                                          <img  src="{{ asset('images/user.png') }}">  
                                          <p class="name">Empty</p>      
                                        @endif
                                     </div>       
                                   </div>

                                        <div class="hv-item-children">
                                            <div class="hv-item-child">                                                      
                                                  <div class="person dropdown_custom">    
                                                      @if(!empty($top_left))    
                                                        @php
                                                         $top_left_left = DB::table('tree_manages')->where('placement_id', $top_left->username)->where('position', 'L')->first();
                                                        @endphp  
                                                          @if(!empty($top_left_left))                                                  
                                                            @php
                                                             $user_details = DB::table('users')->where('user_id', $top_left_left->username)->first();
                                                            @endphp  

                                                           @if(!empty($user_details->image))
                                                            <img id="second_top_left_user_name_one_click" src="{{ asset('storage/product/'.$user_details->image) }}">
                                                           @else
                                                             <img id="second_top_left_user_name_one_click" src="{{ asset('images/user.png') }}">            
                                                           @endIf  
                                                           <input type="hidden" id="second_top_left_user_name_one" value="{{ $user_details->user_id }}">
                                                            <p class="name">{{ $user_details->user_id }}</p>  
                                                            <div class="dropdown_custom-content">
                                                                  <div class="name">{{ $user_details->user_id }}</div>    
                                                                  <div class="name">Rank:{{ $user_details->rank }}</div>
                                                                  <div class="name">L-PV:{{ $user_details->left_pv_counting }} R-PV:{{ $user_details->right_pv_counting }} </div>
                                                                  <div class="name">L-Carry:{{ $user_details->left_pv_flashable }} R-Carry:{{ $user_details->right_pv_flashable }} </div>
                                                                  <div class="name">Total PV:{{ $user_details->left_pv_counting +$user_details->right_pv_counting }}</div> 
                                                            </div>                                            
                                                           @else
                                                            <img  src="{{ asset('images/user.png') }}">  
                                                            <p class="name">Empty</p>      
                                                          @endif
                                                      @else
                                                        <img  src="{{ asset('images/user.png') }}">  
                                                        <p class="name">Empty</p>      
                                                      @endif
                                                 </div>                                        
                                            </div>

                                            <div class="hv-item-child">                                     
                                                  <div class="person dropdown_custom">        
                                                     @if(!empty($top_left))                                     
                                                      @php
                                                        $top_left_right = DB::table('tree_manages')->where('placement_id', $top_left->username)->where('position', 'R')->first();
                                                      @endphp  
                                                         @if(!empty($top_left_right))  
                                                           @php
                                                             $user_details = DB::table('users')->where('user_id', $top_left_right->username)->first();
                                                            @endphp  

                                                            @if(!empty($user_details->image))
                                                              <img  id="second_top_right_user_name_one_click" src="{{ asset('storage/product/'.$user_details->image) }}">  @else
                                                             <img id="second_top_right_user_name_one_click" src="{{ asset('images/user.png') }}">
                                                            @endIf  
                                                            <input type="hidden" id="second_top_right_user_name_one" value="{{ $user_details->user_id }}">  
                                                            <p class="name">{{ $user_details->user_id }}</p>  
                                                            <div class="dropdown_custom-content">
                                                                  <div class="name">{{ $user_details->user_id }}</div>                 
                                                                  <div class="name">Rank:{{ $user_details->rank }}</div>
                                                                  <div class="name">L-PV:{{ $user_details->left_pv_counting }} R-PV:{{ $user_details->right_pv_counting }} </div>
                                                                   <div class="name">L-Carry:{{ $user_details->left_pv_flashable }} R-Carry:{{ $user_details->right_pv_flashable }} </div>
                                                                  <div class="name">Total PV:{{ $user_details->left_pv_counting +$user_details->right_pv_counting }}</div> 
                                                            </div>
                                                              @else
                                                            <img  src="{{ asset('images/user.png') }}">  
                                                            <p class="name">Empty</p>      
                                                          @endif
                                                      @else
                                                        <img  src="{{ asset('images/user.png') }}">  
                                                        <p class="name">Empty</p>      
                                                      @endif
                                                   </div>                                 
                                              </div>
                                          </div>
                                    </div>
                                </div>


                                <div class="hv-item-child">
                                   
                                    <div class="hv-item">
                                        <div class="hv-item-parent">
                                            <div class="person dropdown_custom">    
                                               @php
                                                 $top_right = DB::table('tree_manages')->where('placement_id', $member_tree_details->user_id)->where('position', 'R')->first();
                                                @endphp  
                                                @if(!empty($top_right))                                
                                                      @php
                                                       $user_details = DB::table('users')->where('user_id', $top_right->username)->first();
                                                      @endphp  

                                                      @if(!empty($user_details->image))
                                                        <img id="top_right_user_name_click" src="{{ asset('storage/product/'.$user_details->image) }}">  @else
                                                       <img id="top_right_user_name_click" src="{{ asset('images/user.png') }}">                           
                                                      @endIf  
                                                      <input type="hidden" id="top_right_user_name" value="{{ $user_details->user_id }}"> 
                                                      <p class="name">{{ $user_details->user_id }}</p>  
                                                      <div class="dropdown_custom-content">
                                                            <div class="name">{{ $user_details->user_id }}</div>                          
                                                            <div class="name">Rank:{{ $user_details->rank }}</div>
                                                            <div class="name">L-PV:{{ $user_details->left_pv_counting }} R-PV:{{ $user_details->right_pv_counting }} </div>
                                                            <div class="name">L-Carry:{{ $user_details->left_pv_flashable }} R-Carry:{{ $user_details->right_pv_flashable }} </div>
                                                            <div class="name">Total PV:{{ $user_details->left_pv_counting +$user_details->right_pv_counting }}</div> 
                                                      </div>
                                                @else
                                                  <img  src="{{ asset('images/user.png') }}">  
                                                  <p class="name">Empty</p>      
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hv-item-children">
                                            <div class="hv-item-child">
                                               <div class="person dropdown_custom">    
                                                @if(!empty($top_right))           
                                                @php
                                                $top_right_left = DB::table('tree_manages')->where('placement_id', $top_right->username)->where('position', 'L')->first();
                                                @endphp  
                                                   @if(!empty($top_right_left))                     
                                                      @php
                                                       $user_details = DB::table('users')->where('user_id', $top_right_left->username)->first();
                                                      @endphp  

                                                      @if(!empty($user_details->image))
                                                        <img id="second_top_left_user_name_two_click" src="{{ asset('storage/product/'.$user_details->image) }}">   @else
                                                       <img id="second_top_left_user_name_two_click" src="{{ asset('images/user.png') }}">                           
                                                      @endIf   
                                                      <input type="hidden" id="second_top_left_user_name_two" value="{{ $user_details->user_id }}">
                                                      <p class="name">{{ $user_details->user_id }}</p>  
                                                      <div class="dropdown_custom-content">
                                                            <div class="name">{{ $user_details->user_id }}</div>                          
                                                            <div class="name">Rank:{{ $user_details->rank }}</div>
                                                            <div class="name">L-PV:{{ $user_details->left_pv_counting }} R-PV:{{ $user_details->right_pv_counting }} </div>
                                                            <div class="name">L-Carry:{{ $user_details->left_pv_flashable }} R-Carry:{{ $user_details->right_pv_flashable }} </div>
                                                            <div class="name">Total PV:{{ $user_details->left_pv_counting +$user_details->right_pv_counting }}</div> 
                                                      </div>
                                                    @else
                                                  <img  src="{{ asset('images/user.png') }}">  
                                                  <p class="name">Empty</p>      
                                                @endif
                                                @else
                                                  <img  src="{{ asset('images/user.png') }}">  
                                                  <p class="name">Empty</p>      
                                                @endif
                                            </div>
                                            </div>

                                            <div class="hv-item-child">
                                                <div class="person dropdown_custom">   
                                                @if(!empty($top_right))      
                                                @php
                                                $top_right_right = DB::table('tree_manages')->where('placement_id', $top_right->username)->where('position', 'R')->first();
                                                @endphp  
                                                     @if(!empty($top_right_right))                           
                                                      @php
                                                       $user_details = DB::table('users')->where('user_id', $top_right_right->username)->first();
                                                      @endphp  
                                                      @if(!empty($user_details->image))
                                                        <img id="second_top_right_user_name_two_click" src="{{ asset('storage/product/'.$user_details->image) }}">
                                                        @else
                                                       <img  id="second_top_right_user_name_two_click" src="{{ asset('images/user.png') }}">                           
                                                      @endIf 
                                                      <input type="hidden" id="second_top_right_user_name_two" value="{{ $user_details->user_id }}">  
                                                      <p class="name">{{ $user_details->user_id }}</p>  
                                                      <div class="dropdown_custom-content">
                                                            <div class="name">{{ $user_details->user_id }}</div>          
                                                            <div class="name">Rank:{{ $user_details->rank }}</div>
                                                            <div class="name">L-PV:{{ $user_details->left_pv_counting }} R-PV:{{ $user_details->right_pv_counting }} </div>
                                                            <div class="name">L-Carry:{{ $user_details->left_pv_flashable }} R-Carry:{{ $user_details->right_pv_flashable }} </div>
                                                            <div class="name">Total PV:{{ $user_details->left_pv_counting +$user_details->right_pv_counting }}</div> 
                                                      </div>
                                                    @else
                                                      <img  src="{{ asset('images/user.png') }}">  
                                                      <p class="name">Empty</p>      
                                                    @endif
                                                @else
                                                  <img  src="{{ asset('images/user.png') }}">  
                                                  <p class="name">Empty</p>      
                                                @endif
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else
                            <p><h2 style="color: red;">Wrong User</h2></p>
                            @endif

                        </div>
                    </div>
                </div>
            </section>
                 </div>
              </div>
          </div>
      </div>
  </div>
</main>

       
<script type="text/javascript">
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  jQuery(document).ready(function() {
      $("#level_up").bind('click', $.proxy(function(event) {         
          var username     = $("#level_up").attr('data_id');          
          if(username  != null){           
           var cruneturl  = "{{ url('member/tree-lelvel-up-search') }}";
           $.ajax({
            url:cruneturl,
            type:"POST",           
            dataType : "html",
            data:{username:username, _token: CSRF_TOKEN},
            success:function(data){
                     $('#replace').html(data);
              }
            });  
         }
      }, this));
    });


    jQuery(document).ready(function() {
      $("#top_left_user_name_click").bind('click', $.proxy(function(event) {         
          var top_left_user_name     = $('#top_left_user_name').val();               
          if(top_left_user_name  != null){           
           var cruneturl  = "{{ url('member/tree-user-check') }}";
           $.ajax({
            url:cruneturl,
            type:"POST",           
            dataType : "html",
            data:{top_left_user_name:top_left_user_name, _token: CSRF_TOKEN},
            success:function(data){
                     $('#replace').html(data);
              }
            });  
         }
      }, this));
    });



   jQuery(document).ready(function() {
      $("#second_top_left_user_name_one_click").bind('click', $.proxy(function(event) {           
         var second_top_left_user_name_one        = $('#second_top_left_user_name_one').val();        
          if(second_top_left_user_name_one  != null){           
            var cruneturl  = "{{ url('member/tree-user-check') }}";
           $.ajax({
            url:cruneturl,
            type:"POST",
            data:{second_top_left_user_name_one:second_top_left_user_name_one , _token: CSRF_TOKEN},
            success:function(data){
                     $('#replace').html(data);
              }
            });      
            }      
      }, this));
    });

     jQuery(document).ready(function() {
      $("#second_top_right_user_name_one_click").bind('click', $.proxy(function(event) {           
         var second_top_right_user_name_one        = $('#second_top_right_user_name_one').val();
           if(second_top_right_user_name_one  != null){           
           var cruneturl  = "{{ url('member/tree-user-check') }}";
           $.ajax({
            url:cruneturl,
            type:"POST",
            data:{second_top_right_user_name_one:second_top_right_user_name_one, _token: CSRF_TOKEN},
            success:function(data){
                     $('#replace').html(data);
              }
            });  
            }          
      }, this));
     });

     jQuery(document).ready(function() {
      $("#top_right_user_name_click").bind('click', $.proxy(function(event) {           
         var top_right_user_name        = $('#top_right_user_name').val();       
          if(top_right_user_name  != null){      
          var cruneturl  = "{{ url('member/tree-user-check') }}";
           $.ajax({
            url:cruneturl,
            type:"POST",
            data:{top_right_user_name:top_right_user_name, _token: CSRF_TOKEN},
            success:function(data){
                     $('#replace').html(data);
              }
            });     
            }       
      }, this));
     });

   jQuery(document).ready(function() {
      $("#second_top_left_user_name_two_click").bind('click', $.proxy(function(event) {           
         var second_top_left_user_name_two        = $('#second_top_left_user_name_two').val();
            if(second_top_left_user_name_two  != null){ 
           var cruneturl  = "{{ url('member/tree-user-check') }}";
           $.ajax({
            url:cruneturl,
            type:"POST",
            data:{second_top_left_user_name_two:second_top_left_user_name_two, _token: CSRF_TOKEN},
            success:function(data){
                     $('#replace').html(data);
              }
            });            
            }
      }, this));
     });

    jQuery(document).ready(function() {
      $("#second_top_right_user_name_two_click").bind('click', $.proxy(function(event) {           
         var second_top_right_user_name_two        = $('#second_top_right_user_name_two').val();
         if(second_top_left_user_name_two  != null){ 
          var cruneturl  = "{{ url('member/tree-user-check') }}";
           $.ajax({
            url:cruneturl,
            type:"POST",
            data:{second_top_right_user_name_two:second_top_right_user_name_two, _token: CSRF_TOKEN},
            success:function(data){
                     $('#replace').html(data);
              }
            });   
            }         
      }, this));
     });


</script>     
     
@endsection
