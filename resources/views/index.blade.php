@extends('asset')

@section('content')
	<section class="rev_slider_wrapper">
		<div id="slider1" class="rev_slider"  data-version="5.0">
			<ul>
			@foreach($slide as $v)
				<li data-transition="parallaxvertical">
					<img src="{{ asset('images/'.$v->image) }}"  alt=""  width="1920" height="705" data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="2" >
					<div class="tp-caption sfl tp-resizeme thm-banner-h1 blue-bg" 
				        data-x="left" data-hoffset="0" 
				        data-y="top" data-voffset="249" 
				        data-whitespace="nowrap"
				        data-transform_idle="o:1;" 
				        data-transform_in="o:0" 
				        data-transform_out="o:0" 
				        data-start="500">
						To feed and educate!
				    </div>
					<div class="tp-caption sfr tp-resizeme thm-banner-h1 heavy black-bg" 
				        data-x="left" data-hoffset="0" 
				        data-y="top" data-voffset="318" 
				        data-whitespace="nowrap"
				        data-transform_idle="o:1;" 
				        data-transform_in="o:0" 
				        data-transform_out="o:0" 
				        data-start="1000">
						We need your support
				    </div>
					<div class="tp-caption sfb tp-resizeme thm-banner-h3" 
				        data-x="left" data-hoffset="0" 
				        data-y="top" data-voffset="386" 
				        data-whitespace="nowrap"
				        data-transform_idle="o:1;" 
				        data-transform_in="o:0" 
				        data-transform_out="o:0" 
				        data-start="1500">
						Became a part to change the world
				    </div>
					<div class="tp-caption sfl tp-resizeme" 
				        data-x="left" data-hoffset="0" 
				        data-y="top" data-voffset="450" 
				        data-whitespace="nowrap"
				        data-transform_idle="o:1;" 
				        data-transform_in="o:0" 
				        data-transform_out="o:0" 
				        data-start="2300">
						<a href="#" class="thm-btn">Donate Now</a>
				    </div>
					<div class="tp-caption sfr tp-resizeme" 
				        data-x="left" data-hoffset="185" 
				        data-y="top" data-voffset="450" 
				        data-whitespace="nowrap"
				        data-transform_idle="o:1;" 
				        data-transform_in="o:0" 
				        data-transform_out="o:0" 
				        data-start="2600">
						<a href="#" class="thm-btn inverse">Learn More</a>
				    </div>
				</li>
				@endforeach				
			</ul>
		</div>
	</section>


	<section class="welcome-section bg-color-f7 sec-padding77">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="welcome-content">
						<h2 class="welcome-title">আমাদের প্রকল্পসমূহ</h2>
						<p>এর সেবাই প্রধান উদ্দেশ্য। সবাইকে আমন্ত্রন।</p>
					
					</div>
				</div>
				<div class="col-md-9 welcome-projects">
					<div class="row">
						<div class="col-sm-6 col-md-3 inner">
							<div class="welcome-project">
								<div class="thumb">
									<img src="{{ asset('front_end') }}/img/projects/n1.jpg" alt="">
									<div class="overlay">
										<a href="#">Donate Now</a>
										<a href="#">Read More</a>
									</div>
								</div>
								<div class="caption">
									<h4 class="title">Education Fund</h4>
									<p>শিশু ও এতিমদের বিনামূল্যে শিক্ষা প্রদানের মাধ্যমে জাতীয় সম্পদে পরিণত করা।</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 inner">
							<div class="welcome-project">
								<div class="thumb">
									<img src="{{ asset('front_end') }}/img/projects/n2.jpg" alt="">
									<div class="overlay">
										<a href="#">Donate Now</a>
										<a href="#">Read More</a>
									</div>
								</div>
								<div class="caption">
									<h4 class="title">Medical Fund</h4>
									<p>সুবিধাবঞ্চিত মানুষের কাছে বিনামূল্যে  খাবার ও স্বাস্থ্যসেবা পৌঁছে দেওয়া।</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 inner">
							<div class="welcome-project">
								<div class="thumb">
									<img src="{{ asset('front_end') }}/img/projects/n3.jpg" alt="">
									<div class="overlay">
										<a href="#">Donate Now</a>
										<a href="#">Read More</a>
									</div>
								</div>
								<div class="caption">
									<h4 class="title">Winter Cloth distribution Fund</h4>
									<p> আমরা শীতের হাত থেকে বাঁচতে সুবিধাবঞ্চিত সম্প্রদায়ের আমরা শীতবস্ত্র বিতরণ করি</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 inner">
							<div class="welcome-project">
								<div class="thumb">
									<img src="{{ asset('front_end') }}/img/projects/n4.jpg" alt="">
									<div class="overlay">
										<a href="#">Donate Now</a>
										<a href="#">Read More</a>
									</div>
								</div>
								<div class="caption">
									<h4 class="title">Self Improvement Contribution Fund</h4>
									<p> আমাদের স্বনির্ভর প্রকল্প যার মাধ্যমে আমরা চলমান কর্মসংস্থানের সুযোগ তৈরি করার লক্ষ্য রাখছি।  </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="recent-causes sec-padding">
		<div class="container">
			<div class="sec-title text-center">
				<h2>আমাদের  নতুন সেবাসমূহ</h2>
				<span class="decor"><span class="inner"></span></span>
			</div>
			<div class="row causes-style">
	          <div class="col-sm-12 col-md-4 col-lg-4">
	            <div class="causes sm-col5-center">
	              <div class="thumb">
	                <img class="full-width" alt="" src="{{ asset('images') }}/water.jpg">
	              </div>
	              <div class="causes-details clearfix">
	                <h4 class="title"><a href="#">বিশুদ্ধ পানির প্রকল্প</a></h4>
	                <p>সুবিধাবঞ্চিত শিক্ষার্থী ও রোগীদের পর এবার প্রত্যন্ত গ্রাম অঞ্চলের বিশুদ্ধ খাবার পানির তৃষ্ণা মেটাতে এগিয়ে এসেছে 
 স্বেচ্ছাসেবী সংগঠন বেলায়েত ওয়েলফেয়ার ট্রাস্ট। এ সংঘটনটি ফাতেহা বেগম ও আনোয়ার হোসেইন এর পারিবারিক উদ্দ্যেগে
২০২২ সালে যাত্রা শুরু করে। সুবিধাবঞ্চিতদের মাঝে 
বিশুদ্ধ পানির তৃষ্ণা মিটাতে নতুন প্রকল্পে আপনাদের সহযোগিতা ও আন্তরিকতা কামনা করছি।

.</p>
	                <div>
	                 <a href="#" class="thm-btn btn-xs"><i class="fa fa-angle-double-right text-white"></i> Donate Now</a>
	                 <a class="thm-btn inverse btn-xs" href="#"><i class="fa fa-heart text-theme-colored"></i> 25 Donators</a>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="col-sm-12 col-md-4 col-lg-4">
	            <div class="causes sm-col5-center">
	              <div class="thumb">
	                <img class="full-width" alt="" src="{{ asset('images') }}/house.jpg">
	              </div>
	              <div class="causes-details clearfix">
	                <h4 class="title"><a href="#">গৃহায়ন অনুদান</a></h4>
	                <p>আমাদের নতুন প্রকল্পের উদ্দেশ্য ভূমিহীন, গৃহহীন, ছিন্নমূল অসহায় দরিদ্র জনগোষ্ঠীর
 পুনর্বাসন,প্রশিক্ষণের মাধ্যমে জীবিকানির্বাহে সক্ষম করে তোলা 
এবং আয়বর্ধক কার্যক্রম সৃষ্টির মাধ্যমে দারিদ্র্যকে দূর করা। এই প্রকল্পটি আগামী ২০২৫ সালের মধ্যে
শুরু করা হবে বলে আপনাদের সহযোগিতা ও আন্তরিকতা কামনা করছি।
p>
	                <div>
	                 <a href="#" class="thm-btn btn-xs"><i class="fa fa-angle-double-right text-white"></i> Donate Now</a>
	                 <a class="thm-btn inverse btn-xs" href="#"><i class="fa fa-heart text-theme-colored"></i> 25 Donators</a>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="col-sm-12 col-md-4 col-lg-4">
	            <div class="causes sm-col5-center">
	              <div class="thumb">
	                <img class="full-width" alt="" src="{{ asset('images') }}/disable.jpg">
	              </div>
	              <div class="causes-details clearfix">
	                <h4 class="title"><a href="#">প্রতিবন্ধী ব্যক্তির জন্য অনুদান</a></h4>
	                <p>প্রতিবন্ধীত্ব বাংলাদেশের অন্যতম প্রধান সামাজিক ও অর্থনৈতিক সমস্যা। প্রতিবন্ধীদের নিয়ে কোনো নির্ভরযোগ্য তথ্য পাওয়া যায় না। বিভিন্ন তথ্যসূত্র থেকে প্রতিবন্ধীত্বের উপর বিভিন্ন ধরনের তথ্য পাওয়া যায়। খানার আয় ও ব্যয় জরীপ ২০১০ অনুযায়ী, অক্ষমতার হার মোট জনগোষ্ঠির ৯.১ শতাংশ, যদিও ২০১১ সালের জাতীয় আদম শুমারী অনুযায়ী এ হার শতকরা ১.৭ শতাংশ। বাংলাদেশে ক্রমবর্ধমান উপলব্ধি হলো এই যে, প্রতিবন্ধী শিশু মূল যে প্রতিবন্ধকতার সন্মূখীন হয় সেটা তার বৈকল্য নয়, বরং সেটা হলো ব্যাপক বৈষম্য এবং কুসংস্কার।.</p>
	                <div>
	                 <a href="#" class="thm-btn btn-xs"><i class="fa fa-angle-double-right text-white"></i> Donate Now</a>
	                 <a class="thm-btn inverse btn-xs" href="#"><i class="fa fa-heart text-theme-colored"></i> 25 Donators</a>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
		</div>
	</section>


	<section class="overlay-white sec-padding parallax-section sec-padding89">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 promote-project style-inner text-center">
					<h3>Save People from Hunger,Homeless,Illiteracy & Poverty</h3>
					<div class="sec-title colored text-center">
						<span class="decor">
							<span class="inner"></span>
						</span>
					</div>
					<h2>Became a part of the member of Belayet-Anwar welfare Trust </h2>
					<a href="#" class="thm-btn">Donate Now</a>
                    <a href="#" class="thm-btn inverse">Read More</a>
				</div>
			</div>
		</div>
	</section>


	<section class="home-serivce sec-padding sec-padding74" id="Mission">
		<div class="container">
			<div class="sec-title text-center">
				<h2>আমাদের মিশন</h2>
				<span class="decor"><span class="inner"></span></span>
			</div>
			<div class="row single-service-style">
				@foreach ($missions as $mission)
					<div class="col-md-3 col-sm-6">
						<div class="single-service-home">
							<div class="content">
								<h3>{!! $mission->icon !!} {{ $mission->title }}</h3>
								<p>{{ $mission->content }}</p>
								
							</div>
						</div>
					</div>
					
				@endforeach
				{{-- <div class="col-md-3 col-sm-6">
					<div class="single-service-home">
						<div class="content">
							<h3><i class="flaticon-gesture-1"></i> Education</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
							
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="single-service-home">
						<div class="content">
							<h3><i class="flaticon-people-1"></i> Orphans</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
							
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="single-service-home">
						<div class="content">
							<h3><i class="flaticon-hand"></i> Water</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
							
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="single-service-home">
						<div class="content">
							<h3><i class="flaticon-people-1"></i> Health</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
							
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="single-service-home">
						<div class="content">
							<h3><i class="flaticon-hand"></i> Hunger</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
							
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="single-service-home">
						<div class="content">
							<h3><i class="flaticon-gesture-1"></i> Emergencies</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
							
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="single-service-home">
						<div class="content">
							<h3><i class="flaticon-hand"></i> Humanity</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
							
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="single-service-home">
						<div class="content">
							<h3><i class="flaticon-gesture-1"></i> Clothes</h3>
							<p>There are many variations of lorem passagei of Lorem Ipsum available but the majority have </p>
							
						</div>
					</div>
				</div> --}}
			</div>
		</div>
	</section>


	<section class="fact-counter-wrapper sec-padding parallax-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12 fact-inner">
					<h2>আমরা ২০২২ সাল থেকে নিরলস ভাবে দূঃস্থ মানুষের জন্য সেবা করে যাচ্ছি। এ মহৎ কাজে যোগদান করুন এখনই। </h2>
					<a href="{{ url('registration') }}" class="thm-btn inverse">Be a part of us</a>
				</div>
				<div class="col-lg-6 col-md-12 md-text-center">
					<!--<div class="single-fact">-->
					<!--	<div class="icon-box">-->
					<!--		<i class="flaticon-shapes-2"></i>-->
					<!--	</div>-->
					<!--	<span class="timer" data-from="10" data-to="365" data-speed="5000" data-refresh-interval="50">৩০</span>-->
					<!--	<p>মোট ভলান্টিয়ার</p>-->
					<!--</div>-->
					<div class="single-fact">
						<div class="icon-box">
							<i class="flaticon-people-3"></i>
						</div>
						<span class="timer" data-from="10" data-to="937" data-speed="5000" data-refresh-interval="50">937</span>
						<p>মোট সেবাগ্রহীতা </p>
					</div>
					<!--<div class="single-fact">-->
					<!--	<div class="icon-box">-->
					<!--		<i class="flaticon-hands"></i>-->
					<!--	</div>-->
					<!--	<span class="timer" data-from="10" data-to="155" data-speed="5000" data-refresh-interval="50">৮</span>-->
					<!--	<p>মোট প্রকল্প</p>-->
					<!--</div>-->
				</div>
			</div>
		</div>
	</section>

    <section id="Gallery" class="gallery-section full-width pb_2">
    	<div class="auto-container">
			<div class="sec-title text-center">
				<h2>ছবিঘর</h2>
				<span class="decor"><span class="inner"></span></span>
			</div>
            <!--Filter-->
            <div class="filters">
            	<ul class="filter-tabs style-one clearfix anim-3-all">
                    <li class="filter" data-role="button" data-filter="all">All</li>
                    <li class="filter" data-role="button" data-filter=".child">Child</li>
                    <li class="filter" data-role="button" data-filter=".charity">Charity</li>
                    <li class="filter" data-role="button" data-filter=".sponsorship">Sponsorship</li>
                    <li class="filter" data-role="button" data-filter=".volunteering">Volunteering</li>
                </ul>
            </div>
        </div>
        <style>
			.image {
				height: 300px;
			}
		</style>
        <div class="images-container">
            <div class="filter-list clearfix">
                
                <!--Image Box-->
                <div class="image-box mix mix_all charity sponsorship volunteering">
                    <div class="inner-box">
                        <figure class="image"><a href="images/gallery/1.jpg" class="lightbox-image"><img src="{{ asset('images/gallery/1.jpg') }}" alt=""></a></figure>
                        <a href="images/gallery/n1.jpg" class="lightbox-image btn-zoom" title="Image Title Here"><span class="icon fa fa-dot-circle-o"></span></a>
                    </div>
                </div>
                
                <!--Image Box-->
                <div class="image-box mix mix_all charity sponsorship volunteering">
                    <div class="inner-box">
                        <figure class="image"><a href="images/gallery/n2.jpg" class="lightbox-image"><img src="{{ asset('images/gallery/2.jpg') }}" alt=""></a></figure>
                        <a href="images/gallery/n2.jpg" class="lightbox-image btn-zoom" title="Image Title Here"><span class="icon fa fa-dot-circle-o"></span></a>
                    </div>
                </div>
                
                <!--Image Box-->
                <div class="image-box mix mix_all child charity">
                    <div class="inner-box">
                        <figure class="image"><a href="images/gallery/n3.jpg" class="lightbox-image"><img src="{{ asset('images/gallery/3.jpg') }}" alt=""></a></figure>
                        <a href="images/gallery/n3.jpg" class="lightbox-image btn-zoom" title="Image Title Here"><span class="icon fa fa-dot-circle-o"></span></a>
                    </div>
                </div>
                
                <!--Image Box-->
                <div class="image-box mix mix_all child charity sponsorship">
                    <div class="inner-box">
                        <figure class="image"><a href="images/gallery/n4.jpg" class="lightbox-image"><img src="{{ asset('images/gallery/4.jpg') }}" alt=""></a></figure>
                        <a href="images/gallery/n4.jpg" class="lightbox-image btn-zoom" title="Image Title Here"><span class="icon fa fa-dot-circle-o"></span></a>
                    </div>
                </div>
                
                <!--Image Box-->
                <div class="image-box mix mix_all child sponsorship volunteering">
                    <div class="inner-box">
                        <figure class="image"><a href="images/gallery/n5.jpg" class="lightbox-image"><img src="{{ asset('images/gallery/5.jpg') }}" alt=""></a></figure>
                        <a href="images/gallery/n5.jpg" class="lightbox-image btn-zoom" title="Image Title Here"><span class="icon fa fa-dot-circle-o"></span></a>
                    </div>
                </div>
                
                <!--Image Box-->
                <div class="image-box mix mix_all child charity">
                    <div class="inner-box">
                        <figure class="image"><a href="images/gallery/n6.jpg" class="lightbox-image"><img src="{{ asset('images/gallery/6.jpg') }}" alt=""></a></figure>
                        <a href="images/gallery/n6.jpg" class="lightbox-image btn-zoom" title="Image Title Here"><span class="icon fa fa-dot-circle-o"></span></a>
                    </div>
                </div>
                
                <!--Image Box-->
                <div class="image-box mix mix_all child charity sponsorship volunteering">
                    <div class="inner-box">
                        <figure class="image"><a href="images/gallery/n7.jpg" class="lightbox-image"><img src="{{ asset('images/gallery/7.jpg') }}" alt=""></a></figure>
                        <a href="images/gallery/n7.jpg" class="lightbox-image btn-zoom" title="Image Title Here"><span class="icon fa fa-dot-circle-o"></span></a>
                    </div>
                </div>
                
                <!--Image Box-->
                <div class="image-box mix mix_all charity sponsorship volunteering">
                    <div class="inner-box">
                        <figure class="image"><a href="images/gallery/n8.jpg" class="lightbox-image"><img src="{{ asset('images/gallery/8.jpg') }}" alt=""></a></figure>
                        <a href="images/gallery/n8.jpg" class="lightbox-image btn-zoom" title="Image Title Here"><span class="icon fa fa-dot-circle-o"></span></a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

	<section id="events" class="upcoming-event sec-padding bg-pattern bg-color-thm sec-padding75">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="sec-title text-center">
						<h2 class="text-white">Upcoming Events</h2>
					
						<span class="decor"><span class="inner"></span></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="event-post">
						<div class="thumb">
							<img src="{{ asset('front_end') }}/img/event/ue1.jpg" alt="">
							<div class="overlay">
								<a href="#">Join Us</a>
								<a href="#">Donate Now</a>
							</div>
						</div>
						<div class="caption">
							<h3 class="title"><a href="#">শিক্ষা বৃত্তি ও চিকিৎসা সহায়তা প্রদান</a></h3>
							<i class="fa fa-map-marker"></i>
							<p class="event-time"><span></span> সারা বছর <span></span></p>
							<p class="event-location">বাংলাদেশে</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="event-post">
						<div class="thumb">
							<img src="{{ asset('front_end') }}/img/event/ue2.jpg" alt="">
							<div class="overlay">
								<a href="#">Join Us</a>
								<a href="#">Donate Now</a>
							</div>
						</div>
						<div class="caption">
							<h3 class="title"><a href="#">রমজানে মসজিদে ইফতার  আয়োজন।</a></h3>
							<i class="fa fa-map-marker"></i>
							<p class="event-time"><span></span> পুরো রমজান মাস <span></span></p>
							<p class="event-location">বাংলাদেশে</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="event-post">
						<div class="thumb">
							<img src="{{ asset('front_end') }}/img/event/ue3.jpg" alt="">
							<div class="overlay">
								<a href="#">Join Us</a>
								<a href="#">Donate Now</a>
							</div>
						</div>
						<div class="caption">
							<h3 class="title"><a href="#">শীতকালে শীত বস্ত্র বিতরন কার্যক্রম। </a></h3>
							<i class="fa fa-map-marker"></i>
							<p class="event-time"><span>প্রতি শীতকাল</span></p>
							<p class="event-location">বাংলাদেশে</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<!-- 
	<section class="sec-padding meet-Volunteer">
		<div class="container">
			<div class="row">
				<div class="col-xs-10">
					<div class="sec-title text-left">
						<h2>Meet Our Volunteers</h2>
	
						<span class="decor"><span class="inner"></span></span>
					</div>
				</div>
			</div>
			<div class="clearfix">
				<div class="team-carousel owl-carousel owl-theme">
					<div class="item">
						<div class="single-team-member">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/team/1.jpg" alt="">
								<div class="overlay">
									<div class="box">
										<div class="content">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<h3>Muhibbur Rashid</h3>
							<span>Businessman</span>
					
							<a href="volunteer-profile.html" class="thm-btn">View Profile</a>
						</div>
					</div>
					<div class="item">
						<div class="single-team-member">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/team/2.jpg" alt="">
								<div class="overlay">
									<div class="box">
										<div class="content">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<h3>Rashed Kabir</h3>						
							<span>Businessman</span>
							<p>Lorem ipsum dolor sit amet, sea dolor essent nostrud no, pro no vidit aterum mediocritatem.</p>
							<a href="volunteer-profile.html" class="thm-btn">View Profile</a>
						</div>
					</div>
					<div class="item">
						<div class="single-team-member">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/team/3.jpg" alt="">
								<div class="overlay">
									<div class="box">
										<div class="content">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<h3>Jannatul Ferdous</h3>						
							<span>Businessman</span>
							<p>Lorem ipsum dolor sit amet, sea dolor essent nostrud no, pro no vidit aterum mediocritatem.</p>
							<a href="volunteer-profile.html" class="thm-btn">View Profile</a>
						</div>
					</div>
					<div class="item">
						<div class="single-team-member">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/team/4.jpg" alt="">
								<div class="overlay">
									<div class="box">
										<div class="content">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<h3>Ashikur Rahman</h3>
							<span>Businessman</span>
							<p>Lorem ipsum dolor sit amet, sea dolor essent nostrud no, pro no vidit aterum mediocritatem.</p>
							<a href="volunteer-profile.html" class="thm-btn">View Profile</a>
						</div>
					</div>
					<div class="item">
						<div class="single-team-member">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/team/1.jpg" alt="">
								<div class="overlay">
									<div class="box">
										<div class="content">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<h3>Muhibbur Rashid</h3>
							<span>Businessman</span>
							<p>Lorem ipsum dolor sit amet, sea dolor essent nostrud no, pro no vidit aterum mediocritatem.</p>
							<a href="volunteer-profile.html" class="thm-btn">View Profile</a>
						</div>
					</div>
					<div class="item">
						<div class="single-team-member">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/team/2.jpg" alt="">
								<div class="overlay">
									<div class="box">
										<div class="content">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<h3>Rashed Kabir</h3>						
							<span>Businessman</span>
							<p>Lorem ipsum dolor sit amet, sea dolor essent nostrud no, pro no vidit aterum mediocritatem.</p>
							<a href="volunteer-profile.html" class="thm-btn">View Profile</a>
						</div>
					</div>
					<div class="item">
						<div class="single-team-member">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/team/3.jpg" alt="">
								<div class="overlay">
									<div class="box">
										<div class="content">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<h3>Jannatul Ferdous</h3>						
							<span>Businessman</span>
							<p>Lorem ipsum dolor sit amet, sea dolor essent nostrud no, pro no vidit aterum mediocritatem.</p>
							<a href="volunteer-profile.html" class="thm-btn">View Profile</a>
						</div>
					</div>
					<div class="item">
						<div class="single-team-member">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/team/4.jpg" alt="">
								<div class="overlay">
									<div class="box">
										<div class="content">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<h3>Ashikur Rahman</h3>
							<span>Businessman</span>
							<p>Lorem ipsum dolor sit amet, sea dolor essent nostrud no, pro no vidit aterum mediocritatem.</p>
							<a href="volunteer-profile.html" class="thm-btn">View Profile</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="sec-padding testimonials-wrapper parallax-section sec-padding77">
		<div class="container">
			<div class="sec-title colored text-center">
				<h2>Testimonials</h2>
				<span class="decor">
					<span class="inner"></span>
				</span>
			</div>
			<div class="testimonaials-carousel owl-carousel owl-theme">
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
				<div class="item">
					<div class="single-testimonaials">
						<div class="qoute-box">
							<i class="qoute">“</i>
						</div>
						<p>Lorem ipsum dolor sit amet, per justo iracundia an. Inani tation tritani mea ut. Mundi scriptorem</p>
						<h3>Roberto Carlos</h3>
						<span>Patient of Asthama</span>
					</div>
				</div>
			</div>
		</div>
	</section> -->

<!-- 
	<section class="blog-home sec-padding">
		<div class="container">
			<div class="sec-title text-center">
				<h2>Latest News</h2>
				<span class="decor">
					<span class="inner"></span>
				</span>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-12 blogs-inner">
					<div class="single-blog-post">
						<div class="img-box">
							<img class="full-width" src="{{ asset('front_end') }}/img/blog/1.jpg" alt="">
							<div class="overlay">
								<div class="box">
									<div class="content">
										<ul>
											<li><a href="blog-details.html"><i class="fa fa-link"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="content-box">
							<div class="date-box">
								<div class="inner">
									<div class="date">
										<b>24</b>
										apr
									</div>
									<div class="comment">
										<i class="flaticon-interface-1"></i> 8
									</div>
								</div>
							</div>
							<div class="content">
								<a href="blog-details.html"><h3>Lates blog post with image</h3></a>
								<p>There are many variations passages available, but the lorem, ipsum... </p>
								<a class="btn-details" href="blog-details.html">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 blogs-inner">
					<div class="single-blog-post">
						<div class="img-box">
							<img class="full-width" src="{{ asset('front_end') }}/img/blog/2.jpg" alt="">
							<div class="overlay">
								<div class="box">
									<div class="content">
										<ul>
											<li><a href="blog-details.html"><i class="fa fa-link"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="content-box">
							<div class="date-box">
								<div class="inner">
									<div class="date">
										<b>24</b>
										apr
									</div>
									<div class="comment">
										<i class="flaticon-interface-1"></i> 8
									</div>
								</div>
							</div>
							<div class="content">
								<a href="blog-details.html"><h3>Lates blog post with image</h3></a>
								<p>There are many variations passages available, but the lorem, ipsum... </p>
								<a class="btn-details" href="blog-details.html">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 blogs-inner">
					<div class="single-blog-post">
						<div class="img-box">
							<img class="full-width" src="{{ asset('front_end') }}/img/blog/3.jpg" alt="">
							<div class="overlay">
								<div class="box">
									<div class="content">
										<ul>
											<li><a href="blog-details.html"><i class="fa fa-link"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="content-box">
							<div class="date-box">
								<div class="inner">
									<div class="date">
										<b>24</b>
										apr
									</div>
									<div class="comment">
										<i class="flaticon-interface-1"></i> 8
									</div>
								</div>
							</div>
							<div class="content">
								<a href="blog-details.html"><h3>Lates blog post with image</h3></a>
								<p>There are many variations passages available, but the lorem, ipsum... </p>
								<a class="btn-details" href="blog-details.html">Read More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> 


	<section class="bg-color-thm p_35">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="clients-carousel owl-carousel owl-theme">
						<div class="item">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/clients/logo-1.png" alt="">
							</div>
						</div>
						<div class="item">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/clients/logo-2.png" alt="">
							</div>
						</div>
						<div class="item">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/clients/logo-3.png" alt="">
							</div>
						</div>
						<div class="item">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/clients/logo-4.png" alt="">
							</div>
						</div>
						<div class="item">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/clients/logo-5.png" alt="">
							</div>
						</div>
						<div class="item">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/clients/logo-1.png" alt="">
							</div>
						</div>
						<div class="item">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/clients/logo-2.png" alt="">
							</div>
						</div>
						<div class="item">
							<div class="img-box">
								<img src="{{ asset('front_end') }}/img/clients/logo-3.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	-->
	@endsection
