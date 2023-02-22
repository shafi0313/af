        <header class="page_header ds ms justify-nav-center s-pt-10 s-pb-10">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-11">
                    <a href="{{ route('/') }}" class="logo">
                        <img src="{{ asset('images/'.$basic_info->logo) }}" alt="{{ $basic_info->website_title }}" title="{{ $basic_info->website_title }}">
                    </a>
                </div>
                <div class="col-xl-8 col-lg-6 col-1 text-sm-center">
                    <!-- main nav start -->
                    <nav class="top-nav">
                        <ul class="nav sf-menu" style="font-size: 12px;">
                            <li class="active">
                                <a href="{{ route('/') }}">Home</a>
                            </li>                                    
                            <li>
                                <a href="#">About Us</a>
                                <ul>
                                   @foreach($about_menu as $v)
                                    <li>
                                        <a href="{{ url('category/'.$v->slug) }}">{{ $v->slug }}</a>
                                    </li>     
                                   @endforeach                                                  
                                </ul>
                            </li> 
                            <li>
                                <a href="#">Events</a>
                                <ul>
                                   @foreach($events as $v)
                                    <li>
                                        <a href="{{url('category/'.$v->slug) }}">{{ $v->slug }}</a>
                                    </li>     
                                   @endforeach                                       
                                </ul>
                            </li>    
                            <li class="">                                           
                                <a href="{{url('category/'.$newsss->slug) }}">News</a>
                            </li>  
                            <li class="">
                                <a href="{{url('category/'.$blog->slug) }}">Blog</a>
                            </li>   
                            <li class="">
                                <a href="{{url('category/'.$shop->slug) }}">Shop</a>
                            </li> 
                            <li class="">
                                <a href="{{url('category/'.$newsss->slug) }}">Gallery</a>
                                <ul>
                                   @foreach($gellery as $v)
                                    <li>
                                        <a href="{{url('category/'.$v->slug) }}">{{ $v->slug }}</a>
                                    </li>     
                                   @endforeach                                       
                                </ul>
                            </li>                         
                            <li class="">
                                <a href="{{ url('contact-us') }}">Contact-us</a>
                            </li> 
                            <li class="">
                                <a href="{{url('category/'.$newsss->slug) }}">Language</a>
                                <ul>                              
                                   <li><button  data="#googtrans(en|en)" class="btn btn-sm btn-danger lang-en lang-select" data-lang="en" ><span>English </span></button></li>   
                                   <li><button  data="#googtrans(en|ja)" class="btn btn-sm btn-info  lang-ja lang-select" data-lang="ja"><span>Japaness</span></button> </li>
                                   <li><button  data="#googtrans(en|it)" class="btn btn-sm btn-danger  lang-ja lang-select" data-lang="it"><span>Italiano </span></button> </li>
                                   <li><button  data="#googtrans(en|es)" class="btn btn-sm btn-info  lang-ja lang-select" data-lang="es"><span>Spanish </span></button> </li>
                                   <li><button  data="#googtrans(en|fr)" class="btn btn-sm btn-danger  lang-ja lang-select" data-lang="fr"><span>French </span></button> </li>
                                   <li><button  data="#googtrans(en|da)" class="btn btn-sm btn-info  lang-ja lang-select" data-lang="da"><span>Danish </span></button> </li>
                                   <li><button  data="#googtrans(en|de)" class="btn btn-sm btn-danger  lang-ja lang-select" data-lang="de"><span>German </span></button> </li>
                                </ul>
                            </li>
                        </ul>                       
                    </nav>
                    <!-- eof main nav -->
                </div>
                <div class="col-xl-2 col-lg-3 text-right d-none d-xl-block">
                    <ul class="top-includes">
                        <li>
                            <span>
                                <a href="{{ url('registration') }}" class="btn btn-outline-maincolor">Registration</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- header toggler -->
        <span class="toggle_menu"><span></span></span>
        
      
<script type="text/javascript" language="javascript" src="http://localhost/aaksbd/books_recouse/js/jquery-3.2.1.min.js"></script>

<style>
.google-translate {
    display: inline-block;
    vertical-align: top;
    padding-top: 15px;
}

.goog-logo-link {
    display: none !important;
}

.goog-te-gadget {
    color: transparent !important;
}

#google_translate_element {
    display: none;
}

.goog-te-banner-frame.skiptranslate {
    display: none !important;
}

body {
    top: 0px !important;
}

.english {
    background-color: red;
    color: white;
}

</style>


<script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT}, 'google_translate_element');
    }

  function triggerHtmlEvent(element, eventName) {
    var event;
    if (document.createEvent) {
    event = document.createEvent('HTMLEvents');
    event.initEvent(eventName, true, true);
    element.dispatchEvent(event);
    } else {
    event = document.createEventObject();
    event.eventType = eventName;
    element.fireEvent('on' + event.eventType, event);
    }
  }

  jQuery('.lang-select').click(function() {
    var theLang = jQuery(this).attr('data-lang');
    jQuery('.goog-te-combo').val(theLang);

    //alert(jQuery(this).attr('href'));
    window.location = jQuery(this).attr('data');
    location.reload();

  });
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


  
        
        
        
        </header>