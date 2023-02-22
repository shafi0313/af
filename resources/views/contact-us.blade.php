@extends('asset')
@section('content')
<style>
    textarea {
  width: auto; 
}
</style>
<section class="inner-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12 sec-title colored text-center">
					<h2>Contact</h2>
					<ul class="breadcumb">
						<li><a href="index.html">Home</a></li>
						<li><i class="fa fa-angle-right"></i></li>
						<li><span>Contact</span></li>
					</ul>
					<span class="decor"><span class="inner"></span></span>
				</div>
			</div>
		</div>
	</section>
  <section class="contact-content sec-padding">
		<div class="container">
			<div class="sec-title text-center">
				<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been <br> the industry's standard dummy text ever since the 1500s, when an unknownto </p> -->
			</div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d1836.1454626730865!2d90.96471302632777!3d23.013087965543704!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1673712874306!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			<div class="row">
				<div class="col-md-8">
					<h2>Contact Form</h2>
					<form action="{{ url('contact-email') }}" class="contact-form row" id="contact-page-contact-form" novalidate="novalidate">
                        @csrf
						<div class="col-md-6">
							<input type="text" name="name" placeholder="Name">
							<input type="text" name="email" placeholder="Email">
							<input type="text" name="phone" placeholder="Phone">	
                            						
						</div>
						<div class="col-md-6">
                        <input type="text" name="subject" value="" placeholder="Subject" required>
							<textarea name="message" placeholder="Message" style="height:100%"></textarea>
						</div>
						<div class="col-md-12"><button class="thm-btn" type="submit">Send</button></div>
					</form>
				</div>
				<div class="col-md-4">
					<h2>Address</h2>
					<ul class="contact-info">
						<li>
							<div class="icon-box">
								<div class="inner">
									<i class="fa fa-map-marker"></i>
								</div>
							</div>
							<div class="content-box">
								<h4>Address</h4>
								<p>{{ $basic_info->address }}</p>
							</div>
						</li>
						<li>
							<div class="icon-box">
								<div class="inner">
									<i class="fa fa-phone"></i>
								</div>
							</div>
							<div class="content-box">
								<h4>Phone</h4>
								<p>{{ $basic_info->mobile }}</p>
							</div>
						</li>
						<li>
							<div class="icon-box">
								<div class="inner">
									<i class="fa fa-envelope-o"></i>
								</div>
							</div>
							<div class="content-box">
								<h4>Email</h4>
								<p>{{ $basic_info->email }}</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
  
@endsection