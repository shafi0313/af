 
  <!-- Footer -->
  <footer id="footer" class="footer" data-bg-img="images/footer-bg.png" data-bg-color="#25272e">
    <div class="container pt-70 pb-40">
      <div class="row border-bottom-black">
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">

            <img class="mt-10 mb-20" alt="" src="{{ asset('front_end') }}/logo.png">
            <p style="color: white;">নিবন্ধন নং ০২, তারিখঃ- ১৬-০২-১৯৬০ ইং।</p>
            <p>{{ $basic_info->address }}</p>
            <ul class="list-inline mt-5">
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored mr-5"></i> <a class="text-gray" href="#">  +৮৮০ {{ $basic_info->mobile }}</a> </li>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored mr-5"></i> <a class="text-gray" href="#">{{ $basic_info->email }}</a> </li>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-colored mr-5"></i> <a class="text-gray" href="#">{{ $basic_info->web_address }}</a> </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">সর্বশেষ সংবাদ</h5>
            <div class="latest-posts">
                 @foreach($news_man as $v)
              <article class="post media-post clearfix pb-0 mb-10">
                <a href="{{ url('news-details/'.$v->id) }}" class="post-thumb"><img alt="" src="{{ asset('images/'.$v->image) }}" style="max-height: 40px;"></a>
                <div class="post-right">
                  <h5 class="post-title mt-0 mb-5"><a href="{{ url('news-details/'.$v->id) }}">{{ $v->title }}</a></h5>
                  <p class="post-date mb-0 font-12">{{ date('h:i:s a m/d/Y', strtotime($v->created_at) ) }}</p>
                </div>
              </article>
                 @endforeach
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">সকল সংবাদপত্র</h5>
            <ul class="list angle-double-right list-border">
              <li><a href="https://bdnews24.com/">bdnews24</a></li>
              <li><a href="https://www.dailyinqilab.com/">dailyinqilab</a></li>
              <li><a href="https://www.prothomalo.com/">prothomalo</a></li>
              <li><a href="https://www.jugantor.com/">jugantor</a></li>
              <li><a href="https://www.somoyerkonthosor.com/">somoyerkonthosor</a></li>              
              <li><a href="https://www.thedailystar.net/">thedailystar</a></li>              
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">ফেসবুক পেইজ</h5>
            <div class="opening-hours">
           <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fbdpolwel&tabs=timeline&width=350&height=210&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=130695877742511" width="350" height="210" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-10">
         
        <div class="col-md-5">
           @if(Session::has('success_alert'))
           <p class="alert alert-success">{{ Session::get('success_alert') }}</p>
          @endif
          <div class="widget dark">
            <h5 class="widget-title mb-10">Subscribe Us</h5>
            <!-- Mailchimp Subscription Form Starts Here -->
            <form id="" action="{{ url('newslater') }}" method="post" class="newsletter-form">
              @csrf
              <div class="input-group">
                <input type="email" value="" required="" name="email" placeholder="Your Email" class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-footer" style="height: 45px;">
                <span class="input-group-btn">
                  <button data-height="45px" class="btn btn-colored btn-theme-colored btn-xs m-0 font-14" type="submit">Subscribe</button>
                </span>
              </div>
            </form>
          
          </div>
        </div>
        <div class="col-md-3 col-md-offset-1">
          <div class="widget dark">
            <h5 class="widget-title mb-10">এখনই কল করুন..</h5>
            <div class="text-gray">
              +৮৮০ {{ $basic_info->mobile }} <br>            
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Connect With Us</h5>
            <ul class="styled-icons icon-dark icon-theme-colored icon-circled icon-sm">
              <li><a href="{{ $fb->name }}"><i class="fa fa-facebook"></i></a></li>
              <li><a href="{{ $twitter->name }}"><i class="fa fa-twitter"></i></a></li>
              <li><a href="{{ $youtube->name }}"><i class="fa fa-youtube"></i></a></li>
              <li><a href="{{ $insta->name }}"><i class="fa fa-instagram"></i></a></li>
              <li><a href="{{ $linkdin->name }}"><i class="fa fa-linkdin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom bg-black-333">
      <div class="container pt-15 pb-10">
        <div class="row">
          <div class="col-md-6">
            <p class="font-11 text-black-777 m-0">Copyright &copy;2020. Developed By <a href="https://www.sawebsoft.com/"> SA WEBSOFT</a></p>
          </div>
          <div class="col-md-6 text-right">
            <div class="widget no-border m-0">
             <!--  <ul class="list-inline sm-text-center mt-5 font-12">
                <li>
                  <a href="#">FAQ</a>
                </li>
                <li>|</li>
                <li>
                  <a href="#">Help Desk</a>
                </li>
                <li>|</li>
                <li>
                  <a href="#">Support</a>
                </li>
              </ul> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>