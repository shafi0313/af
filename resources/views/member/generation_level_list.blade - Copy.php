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
                            <th>Level</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Joining Date</th>
                            <th>Referrel ID</th> 
                            <th>Status</th>
                            <th>Rank</th>    
                          </tr>
                        @if(!empty($first_genaration)) 
                             @foreach($first_genaration as $v)
                              <tr>                        
                                <td>1</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                               
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>     
                                <td>{{ $v->rank }}</td>                           
                              </tr>
                             @endforeach  
                        @endif  

                       @if(!empty($sec_genaration)) 
                             @foreach($sec_genaration as $v)
                              <tr>                        
                                <td>2</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif 

                       @if(!empty($three_genaration)) 
                             @foreach($three_genaration as $v)
                              <tr>                        
                                <td>3</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif   

                       @if(!empty($four_genaration)) 
                             @foreach($four_genaration as $v)
                              <tr>                        
                                <td>4</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif 


                      @if(!empty($fiv_genaration)) 
                             @foreach($fiv_genaration as $v)
                              <tr>                        
                                <td>5</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif  

                   @if(!empty($six_genaration)) 
                             @foreach($six_genaration as $v)
                              <tr>                        
                                <td>6</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif  

                       @if(!empty($seven_genaration)) 
                             @foreach($seven_genaration as $v)
                              <tr>                        
                                <td>7</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif  

                        @if(!empty($eight_genaration)) 
                             @foreach($eight_genaration as $v)
                              <tr>                        
                                <td>8</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif  

                        @if(!empty($nine_genaration)) 
                             @foreach($nine_genaration as $v)
                              <tr>                        
                                <td>9</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
                                 <td>{{ $v->rank }}</td>                            
                              </tr>
                             @endforeach  
                        @endif     

                      @if(!empty($ten_genaration)) 
                             @foreach($ten_genaration as $v)
                              <tr>                        
                                <td>10</td>
                                <td>{{ $v->user_id }}</td>
                                <td>{{ $v->first_name }} {{ $v->last_name }}</td>
                                <td>{{ $v->mobile }} </td>
                                <td>{{ $v->joining_date }} </td>
                                <td>{{ $v->sponser_name }}</td>                              
                                <td>
                                    @if(empty($v->active_date))
                                    <span style="color: red; font-weight: 800">Inactive</span>
                                    @else
                                    <span style="color: green; font-weight: 800">Active</span>
                                    @endif
                                </td>    
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
