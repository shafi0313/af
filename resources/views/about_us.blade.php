@extends('asset')
@section('content')
<section class="inner-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12 sec-title colored text-center">
					<h2>About Us</h2>
					<ul class="breadcumb">
						<li><a href="index.html">Home</a></li>
						<li><i class="fa fa-angle-right"></i></li>
						<li><span>About Us</span></li>
					</ul>
					<span class="decor"><span class="inner"></span></span>
				</div>
			</div>
		</div>
	</section>
  <section class="sec-padding about-content full-sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-12">
					<div class="full-sec-content">
						<div class="sec-title style-two">
						<h2>আমাদের সম্পর্কে আরও জানুন</h2>
							<span class="decor">
								<span class="inner"></span>
							</span>
						</div>
					
						<br>
						<p>অনুন্নত জাতিকে বিশ্বের উন্নয়নের রোড ম্যাপে উন্নীত করতে নৈতিক দায়িত্ব নিয়ে উন্নয়নের আলো আনতে চাই। সুতরাং, এর কার্যক্রমের মধ্যে রয়েছে সুবিধাবঞ্চিত, প্রান্তিক, দরিদ্র কৃষক এবং দুর্যোগ-আক্রান্ত দুর্বল মানুষ। এনজিও কিছু ক্ষেত্রে কারিগরি প্রশিক্ষণ, চাকরি, পারিশ্রমিক এবং প্রণোদনা প্রদান করে এই ধরনের লোকদের সহায়তা করে। সংস্থাটির লক্ষ্য শিক্ষা, সামাজিক সমস্যা, জলবায়ু পরিবর্তন, পরিবেশ, উদ্বাস্তু, উপজাতীয় এবং উপকূলীয় জনগণের উপর কিছু গবেষণা প্রকল্প বাস্তবায়নের পদক্ষেপ নেওয়া যাতে নীতিনির্ধারক এবং সংশ্লিষ্ট কর্তৃপক্ষ গবেষণার তথ্য পর্যবেক্ষণ করতে পারে এবং সমস্যাগুলির বর্তমান পরিস্থিতি উপলব্ধি করতে পারে। আনোয়ার ফ্যামিলি ট্রাস্টের একাধিক অভিজ্ঞ এবং দক্ষ পেশাদারদের সাথে একসাথে কাজ করে। দলটি সম্প্রদায় ভিত্তিক স্থানীয় প্রতিষ্ঠানের সাথে আলোচনা করে। আমাদের মূল লক্ষ্য সচেতনতা তৈরি, স্বাস্থ্যের উন্নতি, সড়ক নিরাপত্তা, শিক্ষা, গবেষণা ও উদ্ভাবন, প্রযুক্তিগত দক্ষতা, দুর্যোগ ব্যবস্থাপনা, এবং আয়-উৎপাদনমূলক কর্মসূচী সম্পর্কিত আর্থ-সামাজিক অবস্থার উপর দৃষ্টি নিবদ্ধ করে। আনোয়ার ফ্যামিলি ট্রাস্ট সঠিক-ভিত্তিক সমস্যা এবং উন্নয়ন ধারণায় স্থানীয় সম্প্রদায়ের ক্ষমতায়ন তৈরি করছে যার মাধ্যমে তারা ভবিষ্যতে প্রকল্পগুলির মালিকানা ধরে রাখতে পারে।</p>
							
					</div>
				</div>
				<div class="col-lg-7 col-md-12">
					<img class="full-width" src="{{ asset('front_end') }}/img/resources/about-1.jpg" alt="Awesome Image">
				</div>
			</div>
		</div>
	</section>
  <section class="call-to-action call-action-style">
		<div class="container">
			<div class="clearfix">
				<div class="call-to-action-corner col-md-4" style="background-image: url({{ asset('front_end') }}/img/call-to-action/left-box-bg.jpg);">
					<div class="single-call-to-action">
						<div class="icon-box">
							<div class="inner-box">
								<i class="flaticon-circle"></i>
							</div>						
						</div>
						<div class="content-box">
							<h3>Donation</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum availabl </p>
							<a href="#" class="thm-btn inverse">Donate Now</a>
						</div>
					</div>
				</div>
				<div class="call-to-action-center col-md-4" style="background-image: url({{ asset('front_end') }}/img/call-to-action/center-box-bg.jpg);">
					<div class="single-call-to-action">
						<div class="icon-box">
							<div class="inner-box">
								<i class="flaticon-social"></i>
							</div>						
						</div>
						<div class="content-box">
							<h3>Volunteer</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum availabl </p>
							<a href="#" class="thm-btn inverse">Join Now</a>
						</div>
					</div>
				</div>
				<div class="call-to-action-corner col-md-4" style="background-image: url({{ asset('front_end') }}/img/call-to-action/right-box-bg.jpg);">
					<div class="single-call-to-action">
						<div class="icon-box">
							<div class="inner-box">
								<i class="flaticon-medical"></i>
							</div>						
						</div>
						<div class="content-box">
							<h3>Fundraise</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum availabl </p>
							<a href="#" class="thm-btn inverse">Read More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  <section class="sec-padding faq-home">
		<div class="container">
			<hr>
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="sec-title style-two">
						<h2>আমাদের সম্পর্কে জানুন</h2>
						<span class="decor">
							<span class="inner"></span>
						</span>
					</div>
					<div class="accrodion-grp faq-accrodion" data-grp-name="faq-accrodion">
						<div class="accrodion active">
							<div class="accrodion-title">
								<h4>
									<span class="decor">
										<span class="inner"></span>
									</span>
									<span class="text">Worldwide charity programs </span>
								</h4>
							</div>
							<div class="accrodion-content" style="display: block;">
								<p>অনুন্নত জাতিকে বিশ্বের উন্নয়নের রোড ম্যাপে উন্নীত করতে নৈতিক দায়িত্ব নিয়ে উন্নয়নের আলো আনতে চাই। সুতরাং, এর কার্যক্রমের মধ্যে রয়েছে সুবিধাবঞ্চিত, প্রান্তিক, দরিদ্র কৃষক এবং দুর্যোগ-আক্রান্ত দুর্বল মানুষ। এনজিও কিছু ক্ষেত্রে কারিগরি প্রশিক্ষণ, চাকরি, পারিশ্রমিক এবং প্রণোদনা প্রদান করে এই ধরনের লোকদের সহায়তা করে। সংস্থাটির লক্ষ্য শিক্ষা, সামাজিক সমস্যা, জলবায়ু পরিবর্তন, পরিবেশ, উদ্বাস্তু, উপজাতীয় এবং উপকূলীয় জনগণের উপর কিছু গবেষণা প্রকল্প বাস্তবায়নের পদক্ষেপ নেওয়া যাতে নীতিনির্ধারক এবং সংশ্লিষ্ট কর্তৃপক্ষ গবেষণার তথ্য পর্যবেক্ষণ করতে পারে এবং সমস্যাগুলির বর্তমান পরিস্থিতি উপলব্ধি করতে পারে। আনোয়ার ফ্যামিলি ট্রাস্টের একাধিক অভিজ্ঞ এবং দক্ষ পেশাদারদের সাথে একসাথে কাজ করে। দলটি সম্প্রদায় ভিত্তিক স্থানীয় প্রতিষ্ঠানের সাথে আলোচনা করে। আমাদের মূল লক্ষ্য সচেতনতা তৈরি, স্বাস্থ্যের উন্নতি, সড়ক নিরাপত্তা, শিক্ষা, গবেষণা ও উদ্ভাবন, প্রযুক্তিগত দক্ষতা, দুর্যোগ ব্যবস্থাপনা, এবং আয়-উৎপাদনমূলক কর্মসূচী সম্পর্কিত আর্থ-সামাজিক অবস্থার উপর দৃষ্টি নিবদ্ধ করে। আনোয়ার ফ্যামিলি ট্রাস্টের সঠিক-ভিত্তিক সমস্যা এবং উন্নয়ন ধারণায় স্থানীয় সম্প্রদায়ের ক্ষমতায়ন তৈরি করছে যার মাধ্যমে তারা ভবিষ্যতে প্রকল্পগুলির মালিকানা ধরে রাখতে পারে।</p>
							</div>
						</div>
						<div class="accrodion ">
							<div class="accrodion-title">
								<h4>
									<span class="decor">
										<span class="inner"></span>
									</span>
									<span class="text">Leading volunteer groups </span>
								</h4>
							</div>
							<div class="accrodion-content" style="display: none;">
								<p>একটি অলাভজনক স্বেচ্ছাসেবী দাতব্য সংস্থা হিসেবে আনোয়ার ফ্যামিলি ট্রাস্টের দাতব্য কার্যক্রমে দীর্ঘ যাত্রা রয়েছে। প্রতি বছর আনোয়ার ফ্যামিলি ট্রাস্ট রমজান মাস জুড়ে ইফতার অনুষ্ঠান পরিচালনা করে। আনোয়ার ফ্যামিলি ট্রাস্টের দিয়ে দান করা সহজ এবং আরামদায়ক। আনোয়ার ফ্যামিলি ট্রাস্টের সর্বদা আপনার বিশ্বাসের প্রতি সম্মান প্রদর্শন করে এবং এর নিয়ম ও প্রবিধানের মধ্যে কাজ করে। আমরা সবসময় আপনাকে আনোয়ার ফ্যামিলি ট্রাস্ট দান করতে উত্সাহিত করি কারণ আপনার সাদাকাহ এবং যাকাত, রমজানের দান আমাদের কাছে একটি আমানাহ। আপনি এই রমজানে আপনার ইফতার অন্যান্য ভাই ও বোনদের সাথে শেয়ার করতে পারেন।</p>
								</div>
						</div>
						<div class="accrodion ">
							<div class="accrodion-title">
								<h4>
									<span class="decor">
										<span class="inner"></span>
									</span>
									<span class="text">Charity programs for children </span>
								</h4>
							</div>
							<div class="accrodion-content" style="display: none;">
								<p>Lorem Ipsum is simply du my text of the pritin industry. Lorm Ipsum hasbeen the industry's standardsdummy text eversince the 1500s,  when an unknown printer</p>
								<p>took a galley of type and scramble it to make type specimen book. It has survived not only five centurie, but also the leap into</p>
							</div>
						</div>
						<div class="accrodion ">
							<div class="accrodion-title">
								<h4>
									<span class="decor">
										<span class="inner"></span>
									</span>
									<span class="text">Online donation seystem with different method</span>
								</h4>
							</div>
							<div class="accrodion-content" style="display: none;">
								<p>Lorem Ipsum is simply du my text of the pritin industry. Lorm Ipsum hasbeen the industry's standardsdummy text eversince the 1500s,  when an unknown printer</p>
								<p>took a galley of type and scramble it to make type specimen book. It has survived not only five centurie, but also the leap into</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 hidden-md hidden-sm hidden-xs">
					<div class="img-masonary" style="position: relative; height: 456px;">
						<div class="img-w1" style="position: absolute; left: 0px; top: 0px;">
							<img src="{{ asset('front_end') }}/img/faq/1.jpg" height="450" width="280" alt="">
						</div>
						<div class="img-w1 img-h1" style="position: absolute; left: 286px; top: 0px;">
							<img src="{{ asset('front_end') }}/img/faq/2.jpg" height="450" width="280" alt="">
						</div>
						<div class="img-w1 img-h1" style="position: absolute; left: 286px; top: 226px;">
							<img src="{{ asset('front_end') }}/img/faq/3.jpg" height="450" width="280" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection