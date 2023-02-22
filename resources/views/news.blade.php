
@extends('asset')

@section('content')
<section class="inner-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>News</h2> 
            </div>
        </div>
    </div> 
  </section>
        <!--Contact Us Area Start-->
        <div class="contact-us-area area-padding">
        
          <div class="container gallery-container">

    <h1>Events</h1>
    
    <div class="tz-gallery">

        <div class="row">
          @foreach($slide as $v)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a class="lightbox" href="{{ asset('images/'.$v->image) }}">
                        <img src="{{ asset('images/'.$v->image) }}" alt="g1">
                    </a>
                    <div class="caption">
                        <h3>{{ $v->title }}</h3>
                        <p>{{ $v->short_details }}</p>
                    </div>
                </div>
            </div>
           @endforeach
            
   
    </div>

</div>




            </div>
        </div>
        <!--End of Contact Us ARea-->     
      
      @endsection

      <script type="text/javascript" src="http://fancyapps.com/fancybox/source/jquery.fancybox.js"></script>