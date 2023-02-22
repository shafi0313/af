            <div class="hv-container" id="replace" style=" padding-bottom: 250px;">
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
                                   <button type="Submit" class="btn btn-primary btn-sm"  style="width: 100px; font-size: 12px;"><i class="fa fa-level-down" style="font-size: 18px;" aria-hidden="true"></i>Submit</button>
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
     
