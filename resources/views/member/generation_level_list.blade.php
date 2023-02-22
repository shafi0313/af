@extends('member.layout.app')

@section('content')

    @include('member.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                     <h5 class="" style="font-size: 18px;">Generation Level</h5>
                </div>
            </div>
     
     
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">                      
                        <div class="card-body p-0 text-center ReactTable">

                            <style>
                                #customers {
                                  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                                  border-collapse: collapse;
                                  width: 100%;
                                }

                                #customers td, #customers th {
                                  border: 1px solid #ddd;
                                  padding: 8px;
                                }

                                #customers tr:nth-child(even){background-color: #f2f2f2;}

                                #customers tr:hover {background-color: #ddd;}

                                #customers th {
                                  padding-top: 12px;
                                  padding-bottom: 12px;
                                  text-align: center;
                                  background-color: #4CAF50;
                                  color: white;
                                }
                                </style>
                    </head>
                    <body>
                        <table id="customers">
                          <tr>                        
                            <th>SL</th>
                            <th>Level</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Joining Date</th>
                           <!--  <th>Active Date</th> -->
                            <th>Referrel ID</th> 
                        <!--     <th>Status</th> -->
                            <th>Rank</th>    
                          </tr>
                        @if(!empty($level_one))                            
                             @foreach($level_one as $v)
                              <tr>  
                                <td>{{ $lvl_one   = ++$loop->index }}</td>                      
                                <td>1</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                               <!--  <td>{{ $v->active_date }} </td> -->
                                <td>{{ $v->sponser_name }}</td>                               
                             <!--    <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>  -->    
                                <td>{{ $v->rank }}</td>                           
                              </tr>
                             @endforeach  
                        @endif  

                       @if(!empty($level_two)) 
                             @foreach($level_two as $v)
                              <tr>   
                                <td>{{ $lvl_two = ++$loop->index + $lvl_one }}</td>
                                <td>2</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                              
                                <td>{{ $v->sponser_name }}</td>                              
                            
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif 

                       @if(!empty($level_three)) 
                             @foreach($level_three as $v)
                              <tr>                        
                                <td>{{ $lvl_three = ++$loop->index + $lvl_two }}</td>
                                <td>3</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                               
                                <td>{{ $v->sponser_name }}</td>                              
                            
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif   

                       @if(!empty($level_four)) 
                             @foreach($level_four as $v)
                              <tr>                        
                                <td>{{ $lvl_four = ++$loop->index + $lvl_three }}</td>
                                <td>4</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                             
                                <td>{{ $v->sponser_name }}</td>                              
                               
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif 


                      @if(!empty($level_five)) 
                             @foreach($level_five as $v)
                              <tr>                        
                                <td>{{ $lvl_five = ++$loop->index + $lvl_four }}</td>
                                <td>5</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                              
                                <td>{{ $v->sponser_name }}</td>                              
                               
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif  

                   @if(!empty($level_six)) 
                             @foreach($level_six as $v)
                              <tr>                        
                                <td>{{ $lvl_six = ++$loop->index + $lvl_five }}</td>
                                <td>6</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                
                                <td>{{ $v->sponser_name }}</td>                              
                              
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif  

                       @if(!empty($level_seven)) 
                             @foreach($level_seven as $v)
                              <tr>                        
                                <td>{{ $lvl_seven = ++$loop->index + $lvl_six }}</td>
                                <td>7</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                              <td>{{ $v->joining_date }} </td>
                                
                                <td>{{ $v->sponser_name }}</td>                              
                               
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif  

                        @if(!empty($level_eight)) 
                             @foreach($level_eight as $v)
                              <tr>                        
                                <td>{{ $lvl_eight = ++$loop->index + $lvl_seven }}</td>
                                <td>8</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                             
                                <td>{{ $v->sponser_name }}</td>                              
                               
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif  

                        @if(!empty($level_nine)) 
                             @foreach($level_nine as $v)
                              <tr>                        
                                <td>{{ $lvl_nine = ++$loop->index + $lvl_eight }}</td>
                                <td>9</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                
                                <td>{{ $v->sponser_name }}</td>                              
                               
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif     

                      @if(!empty($level_ten)) 
                             @foreach($level_ten as $v)
                              <tr>                        
                                <td>{{ ++$loop->index + $lvl_nine }}</td>
                                <td>10</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                              
                                <td>{{ $v->sponser_name }}</td>                              
                               
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif                       
                        </table>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
