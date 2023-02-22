<nav class="mainmenu-area stricky">
    <div class="container">
        <div class="navigation pull-left">
            <div class="nav-header">
                <ul>
                    <li class="dropdown">
                        <a href="{{ url('/') }}" title="Home">হোম</a>
                    </li>
                    <li><a href="{{ url('about-us') }}" title="About">সম্পর্কিত</a></li>
                    <li class="dropdown">
                        <a href="#Mission" title="Mission">মিশন</a>
                    </li>
                    <li class="dropdown">
                        <a href="#events" title="Events">ইভেন্টস</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" title="Volunteer">স্বেচ্ছাসেবক</a>
                    </li>
                    <li class="dropdown">
                        <a href="#Gallery" title="Gallery">গ্যালারি</a>
                    </li>

                    <li>
                        <a href="{{ url('contact-us') }}" title="Contact">যোগাযোগ</a>
                    </li>
                    <li>
                        <a class="thm-btn" style="padding: 10px;" href="{{ url('registration') }}"
                            title="Student allowance application">ছাত্র-ছাত্রী
                            বৃত্তি আবেদন</a>
                    </li>
                    <li>
                        <a class="thm-btn" style="padding: 10px;" href="{{ url('medical-registration') }}"
                            title="Medical Allowance Application">চিকিৎসা ভাতা আবেদন</a>
                    </li>
                </ul>
            </div>
            <div class="nav-footer">
                <button><i class="fa fa-bars"></i></button>
            </div>
        </div>
    </div>
</nav>
