<?php

namespace App\Http\Controllers;


use Mail;
use Session;
use App\User;
use Validator;
use App\News_manage;
use App\Models\Division;
use App\Basic_info_manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class homeController extends Controller
{
    public function index()
    {
        $data['basic_info']  = Basic_info_manage::where('id', 1)->first();
        $data['slide']       = DB::table('slide_manages')->where('type', 1)->orderby('id', 'desc')->get();
        $data['about_us']    = DB::table('slide_manages')->where('type', 2)->orderby('id', 'desc')->first();
        $data['our_planing'] = DB::table('slide_manages')->where('type', 3)->orderby('id', 'desc')->get();
        $data['our_offers']  = DB::table('slide_manages')->where('type', 4)->orderby('id', 'desc')->get();
        $data['Review']      = DB::table('slide_manages')->where('type', 5)->orderby('id', 'desc')->get();
        $data['news_man']    = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();
        $data['news_man2']   = DB::table('news_manages')->orderby('id', 'desc')->skip(3)->take(4)->get();

        $data['fb']      = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter'] = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin'] = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']   = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube'] = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();

        $data['bani']      = DB::table('menu_manages')->where('type', 2)->orderby('id', 'desc')->get();
        $data['porichiti'] = DB::table('menu_manages')->where('type', 3)->orderby('id', 'desc')->get();
        $data['gallery']   = DB::table('menu_manages')->where('type', 5)->orderby('id', 'desc')->get();

        return view('index', $data);
    }

    public function mission($id)
    {

    }

    public function category(request $Request, $slug)
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();

        $data['slide']            = DB::table('slide_manages')->where('type', 1)->orderby('id', 'desc')->get();
        $data['about']            = DB::table('slide_manages')->where('type', 2)->orderby('id', 'desc')->first();
        $data['events']           = DB::table('slide_manages')->where('type', 3)->orderby('id', 'desc')->get();
        $data['client_says']      = DB::table('slide_manages')->where('type', 16)->orderby('id', 'desc')->get();

        $data['instructot']       = DB::table('slide_manages')->where('type', 7)->orderby('id', 'desc')->get();
        $data['news']             = DB::table('slide_manages')->where('type', 4)->orderby('id', 'desc')->get();
        $data['fb']               = DB::table('content_manages')->where('id', 1)->orderby('id', 'desc')->first();
        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();


        $data['about_menu']       = DB::table('menu_manages')->whereIn('id', array('6', '11', '7', '8', '9', '10', '12', '13'))->get();
        $data['events']           = DB::table('menu_manages')->whereIn('id', array('14', '15'))->get();
        $data['newsss']           = DB::table('menu_manages')->where('id', 3)->first();
        $data['blog']             = DB::table('menu_manages')->where('id', 4)->first();
        $data['shop']             = DB::table('menu_manages')->where('id', 5)->first();
        $data['gellery']          = DB::table('menu_manages')->whereIn('id', array('16', '17'))->get();



        $data['category'] = DB::table('slide_manages')->where('slug', $slug)->orderby('id', 'desc')->get();
        $data['slug']       = $slug;
        return view('category', $data);
    }


    public function details($id)
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['slide_detils']     = DB::table('slide_manages')->where('id', $id)->first();
        if ($data['slide_detils']->type == 1) {
            $data['name']         = 'Slide Details';
        } elseif ($data['slide_detils']->type == 2) {
            $data['name']         = 'আমাদের পরিকল্পনা সমূহ';
        } elseif ($data['slide_detils']->type == 3) {
            $data['name']         = 'আমাদের পরিকল্পনা সমূহ';
        }
        $data['fb']               = DB::table('content_manages')->where('id', 1)->orderby('id', 'desc')->first();
        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();

        $data['news_man']          = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        return view('detail', $data);
    }

    public function news_details($id)
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['slide_detils']     = News_manage::where('id', $id)->first();
        $data['name']             = 'সর্বশেষ নিউজ';
        $data['fb']               = DB::table('content_manages')->where('id', 1)->orderby('id', 'desc')->first();
        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['news_man']         = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        $data['news_man_list']    = DB::table('news_manages')->orderby('id', 'desc')->take(10)->get();

        return view('detail', $data);
    }

    public function category_details(request $Request, $slug, $id)
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();

        $data['slide']            = DB::table('slide_manages')->where('type', 1)->orderby('id', 'desc')->get();
        $data['about']            = DB::table('slide_manages')->where('type', 2)->orderby('id', 'desc')->first();
        $data['events']           = DB::table('slide_manages')->where('type', 3)->orderby('id', 'desc')->get();
        $data['client_says']      = DB::table('slide_manages')->where('type', 16)->orderby('id', 'desc')->get();

        $data['instructot']       = DB::table('slide_manages')->where('type', 7)->orderby('id', 'desc')->get();
        $data['news']             = DB::table('slide_manages')->where('type', 4)->orderby('id', 'desc')->get();
        $data['fb']               = DB::table('content_manages')->where('id', 1)->orderby('id', 'desc')->first();
        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();


        $data['category'] = DB::table('slide_manages')->where('id', $id)->first();
        $data['slug']       = $slug;
        return view('detail', $data);
    }




    public function donate()
    {
        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['top_menu']         = DB::table('menu_manages')->where('type', 1)->orderby('id', 'desc')->get();
        $data['bottom_menu']      = DB::table('menu_manages')->where('type', 2)->orderby('id', 'desc')->get();
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['menu_manages']     = DB::table('menu_manages')->orderby('id', 'asc')->get();
        return view('donate', $data);
    }

    public function about_us()
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();

        $data['slide']            = DB::table('slide_manages')->where('type', 1)->orderby('id', 'desc')->get();
        $data['about']            = DB::table('slide_manages')->where('type', 2)->orderby('id', 'desc')->first();
        $data['events']           = DB::table('slide_manages')->where('type', 3)->orderby('id', 'desc')->get();
        $data['client_says']      = DB::table('slide_manages')->where('type', 16)->orderby('id', 'desc')->get();
        $data['instructot']       = DB::table('slide_manages')->where('type', 7)->orderby('id', 'desc')->get();
        $data['news']             = DB::table('slide_manages')->where('type', 4)->orderby('id', 'desc')->get();
        $data['fb']               = DB::table('content_manages')->where('id', 1)->orderby('id', 'desc')->first();
        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['news_man']          = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        $data['news_man2']          = DB::table('news_manages')->orderby('id', 'desc')->skip(3)->take(4)->get();
        $data['about_menu']       = DB::table('menu_manages')->whereIn('id', array('6', '11', '7', '8', '9', '10', '12', '13'))->get();
        $data['events']           = DB::table('menu_manages')->whereIn('id', array('14', '15'))->get();
        $data['newsss']           = DB::table('menu_manages')->where('id', 3)->first();
        $data['blog']             = DB::table('menu_manages')->where('id', 4)->first();
        $data['shop']             = DB::table('menu_manages')->where('id', 5)->first();
        $data['gellery']          = DB::table('menu_manages')->whereIn('id', array('16', '17'))->get();

        return view('about_us', $data);
    }

    public function contact_us()
    {

        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['name']             = 'আপনাদের মতামত';
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['news_man']          = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        $data['news_man2']          = DB::table('news_manages')->orderby('id', 'desc')->skip(3)->take(4)->get();
        return view('contact-us', $data);
    }

    public function photo_gallery()
    {

        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['top_menu']         = DB::table('menu_manages')->where('type', 1)->orderby('id', 'desc')->get();
        $data['slide']            = DB::table('slide_manages')->where('type', 2)->orderby('id', 'desc')->get();
        $data['bottom_menu']      = DB::table('menu_manages')->where('type', 2)->orderby('id', 'desc')->get();
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['menu_manages']     = DB::table('menu_manages')->orderby('id', 'asc')->get();
        $data['category_manages'] = DB::table('category_manages')->orderby('id', 'asc')->get();
        return view('photo-gallery', $data);
    }

    public function events()
    {

        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();

        $data['poricahlok']       = DB::table('menu_manages')->where('type', 1)->orderby('id', 'desc')->first();
        $data['porichiti']        = DB::table('menu_manages')->where('type', 3)->orderby('id', 'desc')->get();

        $data['name']             = 'পরিচালক পর্ষদ';
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();

        $data['news_man']          = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        return view('events', $data);
    }

    public function porichiti()
    {

        $data['fb']       = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']  = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']  = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']    = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']  = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['news_man'] = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        $data['porichiti']        = DB::table('menu_manages')->where('type', 3)->orderby('id', 'desc')->get();

        $data['name']               = 'আমাদের পরিচিতি';
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();


        return view('porichiti', $data);
    }

    public function smoronio_din()
    {

        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();

        $data['smoronio_din']        = DB::table('menu_manages')->where('type', 4)->orderby('id', 'desc')->get();

        $data['name']               = 'স্মরনীয় দিন';
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();

        $data['news_man']          = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        return view('smoronio_din', $data);
    }

    public function profit()
    {

        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();

        $data['profit']        = DB::table('menu_manages')->where('type', 6)->orderby('id', 'desc')->get();

        $data['name']               = 'লভ্যাংশ ঘোষণা';
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();

        $data['news_man']          = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        return view('profit', $data);
    }

    public function niyog()
    {

        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['news_man']          = DB::table('news_manages')->orderby('id', 'desc')->take(3)->get();

        $data['niyog']             = DB::table('menu_manages')->where('type', 7)->orderby('id', 'desc')->get();

        $data['name']               = 'নিয়োগ বিজ্ঞপ্তি';
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();



        return view('niyog', $data);
    }


    public function news()
    {
        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['top_menu']         = DB::table('menu_manages')->where('type', 1)->orderby('id', 'desc')->get();

        $data['slide']            = DB::table('slide_manages')->where('type', 2)->orderby('id', 'desc')->get();
        $data['bottom_menu']      = DB::table('menu_manages')->where('type', 4)->orderby('id', 'desc')->get();
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['menu_manages']     = DB::table('menu_manages')->orderby('id', 'asc')->get();
        $data['category_manages'] = DB::table('category_manages')->orderby('id', 'asc')->get();
        return view('news', $data);
    }


    public function terms_conditions()
    {

        $data['fb']               = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']          = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']          = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']            = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']          = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['top_menu']         = DB::table('menu_manages')->where('type', 1)->orderby('id', 'desc')->get();

        $data['bottom_menu']      = DB::table('menu_manages')->where('type', 2)->orderby('id', 'desc')->get();
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['terms']            = DB::table('content_manages')->where('type', 2)->first();
        $data['menu_manages']     = DB::table('menu_manages')->orderby('id', 'asc')->get();
        return view('terms_conditions_page', $data);
    }

    public function login()
    {
        $user_id  = Session::get('userId');
        if ($user_id) {
            return redirect('/member/dashboard');
        } else {
            $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
            return view('member.account.login', $data);
        }
    }


    public function ref_registration($id)
    {
        $data['ref_id']           = $id;
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        $data['countryList']      = DB::table('countries')->get();
        return view('member.account.ref_register', $data);
    }


    public function admin_login()
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        return view('admin.account.login', $data);
    }


    public function UserLogin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|max:191',
            'password' => 'required|max:191|min:6',
        ]);
        $admin = user::where('user_id', $request->user_id)->first();

        if (!empty($admin)) {
            if ($admin && Hash::check($request->password, $admin->password)) {
                Session::put('email', $admin->email);
                Session::put('user_name', $admin->user_id);
                Session::put('userId', $admin->id);
                return redirect('/member/dashboard');
            } else {
                $request->session()->flash('message', 'Password did not match!');
                return redirect('/login');
            }
        } else {
            $request->session()->flash('message', 'User is not exist!');
            return redirect('/login');
        }
    }

    public function forgetpassword()
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        return view('member.account.forget_password', $data);
    }

    public function password_reset(Request $request)
    {
        $user_name = $request->user_name;
        $user_details     = User::where('user_id', $request->user_name)->first();
        if (!empty($user_details)) {

            $dataX['reset_key']       = $this->rand_string(100);
            Session::put('email', $user_details->email);
            Session::put('user_name', $user_details->user_id);
            Session::put('user_id', $user_details->id);
            Session::put('key', $dataX['reset_key']);

            DB::table('users')->where('id', $user_details->id)->update($dataX);
            $this->reset_password_email($user_details->email, $user_details->user_id);
            Session::flash('message', "A reset link sent to this email {$user_details->email}. Please check");
            $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
            return view('member.account.reset_alert', $data);
        } else {
            Session::flash('message', "User is not exist");
            return \Redirect::back();
        }
    }

    public function password_reset_confirm($user_id, $secret_key)
    {
        $user_details     = User::where('id', $user_id)->first();
        if (!empty($user_details)) {
            if ($secret_key == $user_details->reset_key) {
                $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
                $data['user_id']          = $user_id;
                $data['key']              = $secret_key;
                return view('member.account.password_reset_confirmation', $data);
            } else {
                Session::flash('message', "Your secret code is not matched");
                return \Redirect::back();
            }
        } else {
            Session::flash('message', "User is not exist");
            return \Redirect::back();
        }
    }

    public function password_reset_success(Request $request)
    {
        $user_id                  = $request->user_id;
        $key                      = $request->key;
        $old_pass_check           = User::where('id', $user_id)->first();

        if ($old_pass_check->reset_key != $key) {
            //if new pass n confirm pass is not same
            Session::flash('message', "Secret code is invalid please try again");
            return \Redirect::back();
        }
        if ($request->password != $request->confirm_password) {
            //if new pass n confirm pass is not same
            Session::flash('message', "Password and confirm password not matched");
            return \Redirect::back();
        }
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            Session::flash('message', "Password field is required and minimum six charecters");
            return \Redirect::back();
        }
        $data['password']       = Hash::make($request->confirm_password);
        $data['password_plain'] = $request->confirm_password;
        $data['reset_key']      = '';
        DB::table('users')->where('id', $user_id)->update($data);
        Session::put('userId', '');
        $request->session()->flash('messagee', 'Congratulations! Your password has been reset. please login with your new passord');
        return redirect('/login');
    }

    public function forgettransactionpassword()
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        return view('member.account.forget_transac_password', $data);
    }


    public function transaction_password_reset(Request $request)
    {
        $user_name        = $request->user_name;
        $user_details     = User::where('user_id', $request->user_name)->first();
        if (!empty($user_details)) {

            $dataX['reset_key']       = $this->rand_string(100);
            Session::put('email', $user_details->email);
            Session::put('user_name', $user_details->user_id);
            Session::put('user_id', $user_details->id);
            Session::put('key', $dataX['reset_key']);

            DB::table('users')->where('id', $user_details->id)->update($dataX);
            $this->reset_transaction_password_email($user_details->email, $user_details->user_id);
            Session::flash('message', "A transaction reset link sent to this following email - {$user_details->email}. Please check");
            $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
            return view('member.account.reset_alert', $data);
        } else {
            Session::flash('message', "User is not exist");
            return \Redirect::back();
        }
    }


    public function transaction_password_reset_confirm($user_id, $secret_key)
    {
        $user_details     = User::where('id', $user_id)->first();
        if (!empty($user_details)) {
            if ($secret_key == $user_details->reset_key) {
                $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
                $data['user_id']          = $user_id;
                $data['key']              = $secret_key;
                return view('member.account.transaction_password_reset_confirmation', $data);
            } else {
                Session::flash('message', "Your secret code is not matched");
                return \Redirect::back();
            }
        } else {
            Session::flash('message', "User is not exist");
            return \Redirect::back();
        }
    }

    public function transaction_password_reset_success(Request $request)
    {
        $user_id                  = $request->user_id;
        $key                      = $request->key;
        $old_pass_check           = User::where('id', $user_id)->first();

        if ($old_pass_check->reset_key != $key) {
            //if new pass n confirm pass is not same
            Session::flash('message', "Secret code is invalid please try again");
            return \Redirect::back();
        }
        if ($request->password != $request->confirm_password) {
            //if new pass n confirm pass is not same
            Session::flash('message', "Password and confirm password not matched");
            return \Redirect::back();
        }
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            Session::flash('message', "Password field is required and minimum six charecters");
            return \Redirect::back();
        }
        $data['transaction_password']       = Hash::make($request->confirm_password);
        $data['reset_key']      = '';
        DB::table('users')->where('id', $user_id)->update($data);
        Session::put('userId', '');
        $request->session()->flash('messagee', 'Congratulations! Your transactionpassword has been reset.');
        return redirect('/login');
    }


    public function rand_string($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public function register()
    {
        $data['basic_info']        = Basic_info_manage::where('id', 1)->first();

        $data['slide']       = DB::table('slide_manages')->where('type', 1)->orderby('id', 'desc')->get();
        $data['about']       = DB::table('slide_manages')->where('type', 2)->orderby('id', 'desc')->first();
        $data['events']      = DB::table('slide_manages')->where('type', 3)->orderby('id', 'desc')->get();
        $data['client_says'] = DB::table('slide_manages')->where('type', 16)->orderby('id', 'desc')->get();
        $data['instructot']  = DB::table('slide_manages')->where('type', 7)->orderby('id', 'desc')->get();
        $data['news']        = DB::table('slide_manages')->where('type', 4)->orderby('id', 'desc')->get();
        $data['fb']          = DB::table('content_manages')->where('id', 1)->orderby('id', 'desc')->first();
        $data['fb']          = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']     = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']     = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']       = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']     = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['about_menu']  = DB::table('slide_manages')->whereIn('type', array('5', '18', '6', '7', '8', '9', '10', '11'))->get();
        $data['events']      = DB::table('slide_manages')->whereIn('type', array('12', '13'))->get();
        $data['newsss']      = DB::table('slide_manages')->where('type', 4)->first();
        $data['blog']        = DB::table('slide_manages')->where('type', 19)->first();
        $data['shop']        = DB::table('slide_manages')->where('type', 20)->first();
        $data['gellery']     = DB::table('slide_manages')->whereIn('type', array('14', '15'))->get();
        $data['countryList'] = DB::table('countries')->get();

        //$data['all_cat']          = DB::table('slide_manages')->groupBy("slug")->get();

        $data['about_menu'] = DB::table('menu_manages')->whereIn('id', array('6', '11', '7', '8', '9', '10', '12', '13'))->get();
        $data['events']     = DB::table('menu_manages')->whereIn('id', array('14', '15'))->get();
        $data['newsss']     = DB::table('menu_manages')->where('id', 3)->first();
        $data['blog']       = DB::table('menu_manages')->where('id', 4)->first();
        $data['shop']       = DB::table('menu_manages')->where('id', 5)->first();
        $data['gellery']    = DB::table('menu_manages')->whereIn('id', array('16', '17'))->get();
        $data['divisions']  = Division::all();

        return view('register', $data);
    }


    public function medical_register()
    {
        $data['basic_info']  = Basic_info_manage::where('id', 1)->first();
        $data['slide']       = DB::table('slide_manages')->where('type', 1)->orderby('id', 'desc')->get();
        $data['about']       = DB::table('slide_manages')->where('type', 2)->orderby('id', 'desc')->first();
        $data['events']      = DB::table('slide_manages')->where('type', 3)->orderby('id', 'desc')->get();
        $data['client_says'] = DB::table('slide_manages')->where('type', 16)->orderby('id', 'desc')->get();
        $data['instructot']  = DB::table('slide_manages')->where('type', 7)->orderby('id', 'desc')->get();
        $data['news']        = DB::table('slide_manages')->where('type', 4)->orderby('id', 'desc')->get();
        $data['fb']          = DB::table('content_manages')->where('id', 1)->orderby('id', 'desc')->first();
        $data['fb']          = DB::table('category_manages')->where('id', 2)->orderby('id', 'desc')->first();
        $data['twitter']     = DB::table('category_manages')->where('id', 5)->orderby('id', 'desc')->first();
        $data['linkdin']     = DB::table('category_manages')->where('id', 6)->orderby('id', 'desc')->first();
        $data['insta']       = DB::table('category_manages')->where('id', 7)->orderby('id', 'desc')->first();
        $data['youtube']     = DB::table('category_manages')->where('id', 8)->orderby('id', 'desc')->first();
        $data['about_menu']  = DB::table('slide_manages')->whereIn('type', array('5', '18', '6', '7', '8', '9', '10', '11'))->get();
        $data['events']      = DB::table('slide_manages')->whereIn('type', array('12', '13'))->get();
        $data['newsss']      = DB::table('slide_manages')->where('type', 4)->first();
        $data['blog']        = DB::table('slide_manages')->where('type', 19)->first();
        $data['shop']        = DB::table('slide_manages')->where('type', 20)->first();
        $data['gellery']     = DB::table('slide_manages')->whereIn('type', array('14', '15'))->get();
        $data['countryList'] = DB::table('countries')->get();

        //$data['all_cat']          = DB::table('slide_manages')->groupBy("slug")->get();

        $data['about_menu'] = DB::table('menu_manages')->whereIn('id', array('6', '11', '7', '8', '9', '10', '12', '13'))->get();
        $data['events']     = DB::table('menu_manages')->whereIn('id', array('14', '15'))->get();
        $data['newsss']     = DB::table('menu_manages')->where('id', 3)->first();
        $data['blog']       = DB::table('menu_manages')->where('id', 4)->first();
        $data['shop']       = DB::table('menu_manages')->where('id', 5)->first();
        $data['gellery']    = DB::table('menu_manages')->whereIn('id', array('16', '17'))->get();
        $data['divisions']  = Division::all();
        return view('medical_register', $data);
    }

    public function UserRegister(Request $request)
    {
        DB::beginTransaction();
        try {
            $student_image    = time() . '.student.' . $request->student_image->extension();
            $request->student_image->move(public_path('documents'), $student_image);

            $student_idcard   = time() . '.student_id_card.' . $request->student_idcard->extension();
            $request->student_idcard->move(public_path('documents'), $student_idcard);

            $parent_idcard    = time() . '.parent_id_card.' . $request->parent_idcard->extension();
            $request->parent_idcard->move(public_path('documents'), $parent_idcard);

            $charac_cer       = time() . '.cer.' . $request->charac_cer->extension();
            $request->charac_cer->move(public_path('documents'), $charac_cer);

            $marksheet        = time() . '.mark_sheet.' . $request->marksheet->extension();
            $request->marksheet->move(public_path('documents'), $marksheet);

            $document         = time() . '.document.' . $request->document->extension();
            $request->document->move(public_path('documents'), $document);

            $data['student_name']  = $request->student_name .' ('.$request->student_name_en.')';
            $data['father_name']   = $request->father_name .' ('.$request->father_name_en.')';
            $data['mother_name']   = $request->mother_name .' ('.$request->mother_name_en.')';
            $data['gram']          = $request->gram .' ('.$request->gram_en.')';
            $data['post_office']   = $request->post_office .' ('.$request->post_office_en.')';
            $data['thana']         = $request->thana;
            $data['disctrict']     = $request->disctrict;
            $data['finance']       = $request->finance .' ('.$request->finance_en.')';
            $data['school']        = $request->school .' ('.$request->school_en.')';
            $data['phone2']        = $request->phone2 .' ('.$request->phone2_en.')';
            $data['phone']         = $request->phone .' ('.$request->phone_en.')';
            $data['email']         = $request->email;
            $data['class']         = $request->class .' ('.$request->class_en.')';
            $data['expense']       = 0;
            $data['fee']           = $request->fee .' ('.$request->fee_en.')';
            $data['admission_fee'] = $request->admission_fee .' ('.$request->admission_fee_en.')';
            $data['board_reg_fee'] = $request->board_reg_fee .' ('.$request->board_reg_fee_en.')';
            $data['book_purchase'] = $request->book_purchase .' ('.$request->book_purchase_en.')';
            $data['exm_fee1']      = $request->exm_fee1 .' ('.$request->exm_fee1_en.')';
            $data['exm_fee2']      = $request->exm_fee2 .' ('.$request->exm_fee2_en.')';
            $data['exm_fee3']      = $request->exm_fee3 .' ('.$request->exm_fee3_en.')';

            $data['member']         = $request->member .' ('.$request->member_en.')';
            $data['income']         = $request->income .' ('.$request->income_en.')';
            $data['student_image']  = $student_image;
            $data['student_idcard'] = $student_idcard;
            $data['parent_idcard']  = $parent_idcard;
            $data['charac_cer']     = $charac_cer;
            $data['marksheet']      = $marksheet;
            $data['document']       = $document;
            $data['status']         = 0;

            return $data;

            DB::table('users')->insert($data);
            DB::commit();

            Session::flash('class', 'success');
            Session::flash('message', "Your application has been submitted.");
            return \Redirect::back();
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('message',  $exception->getMessage());
            Session::flash('class', 'failed');
            return \Redirect::back();
        }
    }

    public function basic_email($mailid)
    {
        $subject = 'Registration completed on Donatethyself.';
        $data = array('email' => $mailid, 'subject' => $subject);
        Mail::send(['html' => 'mail'], $data, function ($message) use ($data) {
            $message->from('info@tanishasourcing.com', 'Ordypremier Registration');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
    }

    public function contact_email(Request $request)
    {

        $to         = "waad@alibaba40kebabs.com.au";
        $subject    = "alibaba40kebabs";
        $message    = "
        <html>
        <head>
        <title>alibaba40kebabs</title>
        </head>
        <body>
      
        <table>
        <tr>
            <th>Name :</th>
            <th>" . $request->name . "</th>
        </tr>
       
        <tr>
            <td>Email</td>
            <td>" . $request->email . "</td>
        </tr> 
        <tr>
            <td>Subject</td>
            <td>" . $request->subject . "</td>
        </tr> 
        <tr>
            <td>Messege</td>
            <td>" . $request->message . "</td>
        </tr> 
        </table>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <waad@alibaba40kebabs.com.au>' . "\r\n";
        mail($to, $subject, $message, $headers);

        Session::flash('message', 'We have got your email. We will contact with you soon....');
        Session::flash('alert-class', 'alert-success');


        return redirect('/contact-us');


        /*   $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $input = $request->all();
        $insert = \App\Models\ContactMail::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_no' => $input['phone_no'],
            'message' => $input['message'],
        ]);
    */
    }



    public function newslater(Request $request)
    {
        $data['email']      = $request->email;
        DB::table('newslaters')->insert($data);
        Session::flash('success_alert', 'Thanks for staying with us....');
        Session::flash('alert-success', 'success');
        return \Redirect::back();
    }

    public function reset_password_email($mailid, $userid)
    {
        $subject = 'Donate Thy Self Password Reset.';
        $data = array('email' => $mailid, 'subject' => $subject);
        Mail::send(['html' => 'reset_pass'], $data, function ($message) use ($data) {
            $message->from('info@ordypremier.com', 'Ordypremier Password Reset');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
    }

    public function reset_transaction_password_email($mailid, $userid)
    {
        $subject = 'Donate Thy Self Transaction Password Reset.';
        $data = array('email' => $mailid, 'subject' => $subject);
        Mail::send(['html' => 'reset_tp_pass'], $data, function ($message) use ($data) {
            $message->from('info@ordypremier.com', 'Ordypremier Transaction Password Reset');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
    }


    public function logout()
    {
        Session::forget('email');
        Session::forget('userId');
        Session::forget('companyId');
        Session::flush();
        return redirect('/login');
    }


    public function sponserCheck(Request $request)
    {
        $sponser_id     = User::where('user_id', $request->sponser)->where('status', 1)->first();
        if (!empty($sponser_id)) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

    public function emailCheck(Request $request)
    {
        $email     = User::where('email', $request->email)->first();
        if (!empty($email)) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }
    public function userCheck(Request $request)
    {
        $user_id     = User::where('user_id', $request->user_name)->first();
        if (empty($user_id)) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

    public function product()
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        return view('product', $data);
    }

    public function medicine_benefit()
    {
        $data['basic_info']       = Basic_info_manage::where('id', 1)->first();
        return view('medicine_benefit', $data);
    }
}
