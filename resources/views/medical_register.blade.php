@extends('asset')
@section('content')
    <section class="inner-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12 sec-title colored text-center">
					<h2>চিকিৎসা ভাতার আবেদন</h2>
					<ul class="breadcumb">
						<li><a href="index.html">Home</a></li>
						<li><i class="fa fa-angle-right"></i></li>
						<li><span>আবেদন ফরম</span></li>
					</ul>
					<span class="decor"><span class="inner"></span></span>
				</div>
			</div>
		</div>
	</section>
    <section class="donation-section">
    	<div class="container">
    		<h2 class="text-thm" align="center">আবেদন ফরম</h2>
            @if(Session::has('message'))       
            <div class="cust_alert {{ Session::get('class') }}">
                <span class="closebtn">&times;</span>  
                <strong>{{ Session::get('message') }}</strong>
            </div>
            @endif
        	<div class="donation-form-outer">
                 <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{ url('register') }}" enctype="multipart/form-data" >
                    @csrf
                    <!--Form Portlet-->
                    <div class="form-portlet">
                        <div class="row clearfix">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">রোগীর নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="রোগীর নামঃ" value="" name="student_name">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">পিতার নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="পিতার নাম" value="" name="father_name">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">মাতার নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="মাতার নাম" value="" name="mother_name">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">গ্রামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="গ্রাম" value="" name="gram">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">পোস্টঃ অফিসঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="পোস্ট অফিস" value="" name="post_office">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">থানাঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="থানা" value="" name="thana">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">জেলাঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="জেলাঃ" value="" name="disctrict">
                            </div>  
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">আর্থিক অবস্থার বর্ণনাঃ  <span class="required">*</span></div>
                                <input type="text" required="" placeholder="আর্থিক অবস্থার বর্ণনা" value="" name="finance">
                            </div>
                             
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">হাসপাতালের নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="হাসপাতালের নাম" value="" name="school">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ডাক্তারের নামঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ডাক্তারের নাম" value="" name="class">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ঔষধের  মূল্য ১ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ১" value="" name="admission_fee">
                            </div>  
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ঔষধের  মূল্য ২ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ২" value="" name="board_reg_fee">
                            </div>  
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ঔষধের  মূল্য ৩ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৩" value="" name="book_purchase">
                            </div>  
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ঔষধের  মূল্য ৪ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৪" value="" name="fee">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ঔষধের  মূল্য ৫ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৫" value="" name="exm_fee1">
                            </div>  
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ঔষধের  মূল্য ৬ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৬" value="" name="exm_fee2">
                            </div>  
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ঔষধের  মূল্য ৭ঃ <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৭" value="" name="exm_fee3">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ঔষধের  মূল্য ৮ঃ  <span class="required">*</span></div>
                                <input type="text" required="" placeholder="ঔষধের  মূল্য ৮" value="" name="member">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">পরিবারের সর্বমোট মাসিক আয়ঃ  <span class="required">*</span></div>
                                <input type="number" required="" placeholder="পরিবারের সর্বমোট মাসিক আয়" value="" name="income">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">রোগীর ছবিঃ  <span class="required">*</span></div>
                                <input type="file" required=""  value="" name="student_image">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label"> ভোটার  আইডি কার্ড </div>
                                <input type="file"  value="" name="student_idcard">
                            </div> 
                              
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">ডাক্তার প্রদত্ত চিকিৎসা পত্র :    <span class="required">*</span></div>
                                <input type="file" required=""  value="" name="parent_idcard">
                            </div>
                                     
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                            	<div class="field-label">চেয়ারম্যান প্রদত্ত চারিত্রিক সনদঃ    <span class="required">*</span></div>
                                <input type="file" required=""  value="" name="charac_cer">
                            </div>
                        
                                          
                            <p class="text-danger">সতর্কীকরণঃ</p>
                            <p class="text-danger"><b style="color: red; font-size:16px;"> ০১. আবেদন পত্র দাখিল করার পূর্বে অবশ্যই প্রদত্ত তথ্যের সঠিকতা যাচাই করুন অন্যথায় আবেদন পত্রটি বাতিল হিসেবে গন্য করা হবে। </b></p>
                            <p class="text-danger" style="color: red;"> ০২.রোগী সুস্থতা লাভ করার পর  অবশ্যই কতৃপক্ষকে অবহিত করতে বাধ্য থাকিবেন, অন্যথায় কতৃপক্ষ যে সিদ্ধান্ত নিবে সেই সিদ্ধান্তই মেনে নিতে হবে।  </p>
                            <p class="text-danger" style="color: red;"> ০৩.যদি প্রতিষ্ঠান মনে করে ডাক্তার প্রদত্ত চিকিৎসা পত্ররের সঠিকতা যাচাই করার প্রয়োজন, এই মর্মে
 ডাক্তারের আপত্তি প্রতিষ্ঠানের কাছে গ্রহন যোগ্য নয়।
  </p>
                            <p class="text-danger" style="color: red;"> ০৪.সকল প্রকার তথ্যাদি ও সংযুক্তি প্রদান না করলে ফরম গ্রহনযোগ্য হবে না।</p>
		                    <hr>	                    
		                    <div class="text-center"><button class="thm-btn mt_30 mb_30" type="submit">আবেদন করুন</button></div>
                        </div>
                    </div>
                   
                </form>
            </div>
        </div>
    </section>
@endsection
        