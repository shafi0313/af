<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!|
*/

Route::get('/set', function () {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache set';
});

Route::get('/clear', function () {
    $exitCode = Artisan::call('config:clear');
    return 'Config cache cleared';
});
 

////////////************** Cron route End **************** /////////////////////

////////////************** Front end route starts **************** /////////////////////
Route::get('/', 'homeController@index')->name('/');
Route::get('/donation-plan', 'homeController@how_works')->name('donation-plan');
Route::get('/donate', 'homeController@donate')->name('donate');
Route::get('/about-us', 'homeController@about_us')->name('about-us');
Route::get('/contact-us', 'homeController@contact_us')->name('contact-us');
Route::get('/terms-conditions', 'homeController@terms_conditions')->name('terms-conditions');
Route::post('/password-reset', 'homeController@password_reset');
Route::get('/password-reset-confirm/{data}/{data2}', 'homeController@password_reset_confirm');
Route::post('/password-reset-confirmation-success', 'homeController@password_reset_success');
Route::get('/transaction-password-reset-confirm/{data}/{data2}', 'homeController@transaction_password_reset_confirm');
Route::post('/transaction-password-reset-confirmation-success', 'homeController@transaction_password_reset_success');
Route::get('/product', 'homeController@product');
Route::get('/photo-gallery', 'homeController@photo_gallery')->name('photo-gallery');
Route::post('/contact-email', 'homeController@contact_email');
Route::post('/newslater', 'homeController@newslater');
Route::get('/porichalok-porshod', 'homeController@events')->name('events');
Route::get('/porichiti', 'homeController@porichiti')->name('porichiti');
Route::get('/smoronio-din', 'homeController@smoronio_din')->name('smoronio_din');
Route::get('/profit', 'homeController@profit')->name('profit');
Route::get('/niyog', 'homeController@niyog')->name('niyog');
Route::get('/latest-news', 'homeController@news')->name('news');
Route::get('/details/{data}', 'homeController@details');
Route::get('/news-details/{data}', 'homeController@news_details');
Route::get('category/{data}', 'homeController@category');
Route::get('detail/{data}/{data2}', 'homeController@category_details');
//Route::post('how-it-works', function () { return view('how-it-works'); });

////////////************** Front end route ends **************** /////////////////////


////////////************** Admin route Starts **************** /////////////////////

Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin');
Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('login');
Route::get('/admin', 'Auth\Admin\LoginController@showLoginForm')->name('admin');
Route::post('/admin/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
Route::get('/admin/dashboard', 'Admin\AdminController@index')->name('admin.index');
Route::get('/admin/summary-report', 'Admin\AdminController@summary_report')->name('summary');
Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

//*************website dyanamic mamanage start****************//
// SLide Mnagement
Route::get('/content-manage', 'Admin\AdminController@slide_manage')->name('admin.slide-manage');
Route::get('/slide-manage-view', 'Admin\AdminController@slide_manage_view');
Route::post('/slide-manage-insert', 'Admin\AdminController@slide_insert');
Route::get('/slide-manage-edit', 'Admin\AdminController@slide_manage_edit');
Route::get('/slide-manage-delete', 'Admin\AdminController@slide_manage_delete');

// SLide Mnagement
Route::get('/news-manage', 'Admin\AdminController@slide_manage')->name('admin.news-manage');
Route::get('/news-manage-view', 'Admin\AdminController@news_manage_view');
Route::post('/news-manage-insert', 'Admin\AdminController@news_insert');
Route::get('/news-manage-edit', 'Admin\AdminController@news_manage_edit');
Route::get('/news-manage-delete', 'Admin\AdminController@news_manage_delete');

// Requested Payment Approval Menu Management
Route::get('/all-manage', 'Admin\AdminController@menu_manage')->name('admin.menu-manage');
Route::get('/all-manage2', 'Admin\AdminController@menu_manage2')->name('admin.menu-manage2');
Route::get('/menu-manage-view2', 'Admin\AdminController@menu_manage_view2');
Route::get('/menu-manage-view2/completed/{id}', 'Admin\AdminController@menu_manage_view2completed')->name('admin.menu_manage_view2.completed');
Route::get('/menu-manage-view', 'Admin\AdminController@menu_manage_view');
Route::post('/menu-manage-insert', 'Admin\AdminController@menu_insert');
Route::get('/menu-manage-edit', 'Admin\AdminController@menu_manage_edit');
Route::get('/menu-manage-delete', 'Admin\AdminController@menu_manage_delete');


Route::get('menu_manage_view_delete/{id}','Admin\AdminController@menu_manage_view_delete')->name('admin.menu_manage_view_delete');

//*************website dyanamic mamanage end ****************//
Route::get('/admin/profile', 'Admin\AdminController@profile');
Route::post('/admin/passwordupdate', 'Admin\AdminController@password_update');

//*************Account active BTC ****************//
Route::get('/admin/newsletter', 'Admin\AdminController@member_activation')->name('admin.member_activation');
Route::get('/admin/member_activation_list', 'Admin\AdminController@member_activation_list');
Route::post('/admin/member_activation_success', 'Admin\AdminController@member_activation_success');
//*************Account active BTC ****************//


//*************fund add start ****************//
Route::get('/admin/profit-return', 'Admin\AdminController@profit_return');

Route::get('/admin/content-manage', 'Admin\AdminController@add_fund')->name('admin.fund_add');
Route::post('/admin/fund-store', 'Admin\AdminController@AddUnit')->name('admin.fund_store');
Route::get('/view-unit', 'Admin\AdminController@ViewUnit');
//*************fund add end ****************//


//*************Agent add start ****************//

Route::get('/admin/social-link', 'Admin\AdminController@agent_fund')->name('admin.agent_add');
Route::post('/admin/agent-store', 'Admin\AdminController@agent_store')->name('admin.agent_store');
Route::get('/admin/agent_view', 'Admin\AdminController@agent_view')->name('admin.agent_view');

//*************Agent add end ****************//

//*************wallet sell start ****************//
Route::get('/admin/registration', 'Admin\AdminController@registration')->name('admin.registration');
Route::get('/registration-list', 'Admin\AdminController@personal_reg_view');

Route::get('/admin/registration-club', 'Admin\AdminController@club_vuew')->name('admin.wallet_sell_2');
Route::get('/admin/reg_club', 'Admin\AdminController@club_reg_view');

Route::post('/wallet-sell-success', 'Admin\AdminController@wallet_sell_success');

Route::get('/wallet-sell-edit', 'Admin\AdminController@view_wallet_edit');
Route::post('/wallet-sell-update', 'Admin\AdminController@view_wallet_update');
//*************wallet sell end ****************//

Route::get('/basic-info-manage', 'Admin\AdminController@basic_info_manage')->name('admin.basic-info-manage');

Route::get('/admin/basic-info-view', 'Admin\AdminController@basic_info_view');

Route::get('/admin/basic-info-edit', 'Admin\AdminController@basic_info_edit');

Route::post('/admin/basic_update', 'Admin\AdminController@basic_update');

Route::get('/news-manage', 'Admin\AdminController@product_manage')->name('admin.product-manage');

Route::get('/admin/product-view', 'Admin\AdminController@product_view');

Route::post('/admin/product-insert', 'Admin\AdminController@product_insert');

Route::get('/home-product-manage', 'Admin\AdminController@home_product_manage')->name('admin.home-product-manage');

Route::get('/admin/home-product-view', 'Admin\AdminController@home_product_view');

Route::post('/admin/home-product-insert', 'Admin\AdminController@home_product_insert');

Route::get('/admin/product-edit', 'Admin\AdminController@product_edit');

Route::get('/admin/home-product-edit', 'Admin\AdminController@home_product_edit');

Route::get('/admin/view-single-product', 'Admin\AdminController@ViewSingleProduct');

Route::get('/admin/status_update', 'Admin\AdminController@status_update');

Route::get('/admin/status_update_no', 'Admin\AdminController@status_update_no');

Route::get('/admin/home-view-single-product', 'Admin\AdminController@HomeViewSingleProduct');

Route::get('/admin/wallet-transfer-approve', 'Admin\AdminController@wallet_tran_approve')->name('admin.transfer-wallet-approve');

Route::get('/admin/wallet-tran-list', 'Admin\AdminController@wallet_tran_list');

Route::post('/admin/wallet_tran_succes', 'Admin\AdminController@wallet_tran_succes');

Route::get('/admin/wallet-move-approve', 'Admin\AdminController@wallet_move_approve')->name('admin.wallet-move-approve');

Route::get('/admin/all-user-list', 'Admin\AdminController@all_user_list')->name('admin.all-user-list');

Route::get('/admin/user_login_direct/{data}', 'Admin\AdminController@user_login_direct');

Route::get('/admin/all-user-show', 'Admin\AdminController@all_user_show');

Route::get('/admin/wallet-move-list', 'Admin\AdminController@wallet_move_list');

Route::post('/admin/wallet_move_succes', 'Admin\AdminController@wallet_move_succes');

Route::get('/admin/withdraw-wallet-aprrove', 'Admin\AdminController@withdraw_wallet_aprrove')->name('admin.withdraw-wallet-aprrove');

Route::get('/admin/withdraw-wallet-list', 'Admin\AdminController@withdraw_wallet_list');

Route::post('/admin/withdraw_wallet_succes', 'Admin\AdminController@withdraw_wallet_succes');

Route::get('/admin/user-activation-by-admin', 'Admin\AdminController@user_activation_admin')->name('admin.user-activation-by-admin');

Route::get('/admin/activation-list', 'Admin\AdminController@activation_list');

Route::get('/admin/user-rank-reward', 'Admin\AdminController@rank_reward')->name('admin.user-rank-reward');

Route::get('/admin/rank-reward-list', 'Admin\AdminController@rank_reward_list');

Route::get('/admin/refferral-amount-report', 'Admin\AdminController@refferral_amount_report')->name('admin.refferral-amount-report');

Route::get('/admin/refferral-amount-list', 'Admin\AdminController@refferral_amount_list');

Route::get('/admin/downlink-amount-distribute', 'Admin\AdminController@downlink_amount_distribute')->name('admin.downlink-amount-distribute');

Route::get('/admin/downlink-amount-distrubute-list', 'Admin\AdminController@downlink_amount_distrubute_list');

Route::get('/admin/amount-distribution', 'Admin\AdminController@amount_distribution')->name('admin.amount-distribution');

Route::get('/admin/rank-distribute', 'Admin\AdminController@rank_distribute');

Route::get('/admin/agent-wallet-withdraw', 'Admin\AdminController@agent_wallet_transfer')->name('admin.agent-wallet-transfer');

Route::get('/admin/applicants', 'Admin\AdminController@applicants')->name('admin.applicants');

Route::get('/admin/view-applicants', 'Admin\AdminController@view_applicants')->name('admin.view-applicants');

Route::post('/admin/approve_amnt_req', 'Admin\AdminController@approve_amnt_req');
Route::post('/admin/approve_amnt_req2', 'Admin\AdminController@approve_amnt_req2');

Route::get('/admin/agent_with_report', 'Admin\AdminController@agent_with_report');
Route::get('/admin/agent_with_report/show', 'Admin\AdminController@agent_with_report_show')->name('admin.agent_with_report.show');
Route::get('/admin/agent_with_report2', 'Admin\AdminController@agent_with_report2');
Route::get('/admin/approve/{id}', 'Admin\AdminController@approve_amnt');

Route::get('/admin/payment-approve', 'Admin\AdminController@payment_approve');


Route::get('/admin/agent-wallet-withdraw-all', 'Admin\AdminController@agent_wallet_transfer_all')->name('admin.agent-wallet-transfer-all');

Route::get('/admin/agent_with_report_all', 'Admin\AdminController@agent_with_report_all');

Route::get('/admin/delete_item', 'Admin\AdminController@delete_item');

Route::get('/admin/delete_category', 'Admin\AdminController@delete_category');

Route::get('/admin/view-edit-unit', 'Admin\AdminController@view_edit_unit');

Route::get('/admin/category_edit', 'Admin\AdminController@category_edit');


////////////************** Admin route ends **************** /////////////////////


////////////************** Member route ends **************** /////////////////////

Route::get('/registration', 'homeController@register')->name('register');

Route::get('/medical-registration', 'homeController@medical_register');



Route::get('/logout', 'homeController@logout')->name('logout');

Route::post('/login', 'homeController@UserLogin');

Route::get('/forget-password', 'homeController@forgetpassword')->name('forget-password');

Route::get('/forget-transaction-password', 'homeController@forgettransactionpassword')->name('forget-transaction-password');

Route::post('/transaction-password-reset', 'homeController@transaction_password_reset');

Route::post('/register', 'homeController@UserRegister');

Route::get('/registration/ref/{data}', 'homeController@ref_registration');

Route::post('/sponser-check', 'homeController@sponserCheck')->name('sponser_id_check');

Route::post('/email-address-check', 'homeController@emailCheck')->name('email_address_check');

Route::post('/user-id-check', 'homeController@userCheck')->name('user_id_check');

Route::group(['middleware' => 'CheckLogin'], function () {
    /*
        Route::get('/member/dashboard','Member\MemberController@index');

        Route::get('/member/registration','Member\MemberController@registration')->name('member.registration');

        Route::post('/member/member-account-active','Member\MemberController@member_account_create');

        Route::post('/member/member-account-update','Member\PackUpdateController@member_account_update');

        Route::post('/member/username_search','Member\MemberController@username_search');

        Route::post('/member/sponser_search','Member\MemberController@sponser_search');

        Route::post('/member/placement_search','Member\MemberController@placement_search');

        Route::post('/member/balance_search','Member\MemberController@balance_search');

        Route::get('/member/summary','Member\MemberController@summary_report')->name('member.summary');

        Route::get('/member/profile','Member\MemberController@member_profile')->name('member.profile');

        Route::post('/member/profile-update','Member\MemberController@profile_update');

        Route::post('/member/passwordupdate','Member\MemberController@password_update');

        Route::post('/member/tranpasswordupdate','Member\MemberController@tran_password_update');

        Route::post('/member/tranpasswordexistupdate','Member\MemberController@tran_password_exist_update');

        Route::get('/member/new-member','Member\MemberController@new_member')->name('member.new_member');

        Route::get('/member/view-unit','Member\MemberController@view_new_list');

        Route::get('/member/refferd-member','Member\MemberController@refferd_member')->name('member.refferd_member');

        Route::get('/member/view-reffered-list','Member\MemberController@view_reffered_list');

        Route::get('/member/refferel-link','Member\MemberController@refferel_link')->name('member.refferel_link');

        Route::get('/member/wallet-transfer','Member\MemberController@wallet_transfer')->name('member.wallet-transfer');
        Route::post('/member/member-wallet-transfer','Member\MemberController@wallet_transfer_success');

        Route::get('/member/hold_wallt_transfer','Member\MemberController@hold_trn_bal');

        Route::get('/member/wallet-convert','Member\MemberController@main_wallet_move')->name('member.main-wallet-move');

        Route::post('/member/wallet-move-success','Member\MemberController@wallet_move_success');

        Route::get('/member/move_trn_bal','Member\MemberController@move_trn_bal');

        Route::post('/member/withdrawel_cancel','Member\MemberController@withdrawel_cancel');

        Route::get('/member/referral-income-report','Member\MemberController@referral_income_report')->name('member.referral-income-report');

        Route::get('/member/refferral_report','Member\MemberController@refferral_report');

        Route::get('/member/generation-level','Member\MemberController@generation_level')->name('member.generation-level');

        Route::get('/member/rank-reward-report','Member\MemberController@rank_reward_report')->name('member.rank-reward-report');

        Route::get('/member/rank_reward_report_show','Member\MemberController@rank_reward_report_show');

        Route::get('/member/profit-share-return-report','Member\MemberController@profit_return_report')->name('member.profit-share-return-report');

        Route::get('/member/profit_return_report_show','Member\MemberController@profit_return_report_show');

        Route::get('/member/matching-income-report','Member\MemberController@matching_income_report')->name('member.matching-income-report');

        Route::get('/member/matching-income-show','Member\MemberController@matching_income_report_show');

        Route::get('/member/rank-report','Member\MemberController@rank_report')->name('member.rank-report');

        Route::get('/member/rank-report-show','Member\MemberController@rank_report_show');

        Route::get('/member/generation-income-report','Member\MemberController@generation_income_report')->name('member.generation-income-report');

        Route::get('/member/generation-income-show','Member\MemberController@generation_income_report_show');

        Route::get('/member/rollup-income-report','Member\MemberController@rollup_income_report')->name('member.rollup-income-report');

        Route::get('/member/rollup-income-show','Member\MemberController@rollup_income_report_show');

        Route::get('/member/key-in-bonus','Member\MemberController@direct_downlink_report')->name('member.direct-downlink-report');

        Route::get('/member/direct_downlink_report_show','Member\MemberController@direct_downlink_report_show');

        Route::get('/member/downlink-user-list','Member\MemberController@downlink_user_list')->name('member.downlink-user-list');

        Route::get('/member/downlink_user_show','Member\MemberController@downlink_user_list_show');

        Route::get('/member/e-wallet-withdrawel','Member\MemberController@main_wallet_withdrawel')->name('member.balance-withdrawel');

        Route::get('/member/placement-tree','Member\MemberController@placement_tree')->name('member.placement-tree');

        Route::get('/member/balance-withdrawel-view','Member\MemberController@balance_withdrawel_view');

        Route::post('/member/balance-withdrawel-success','Member\MemberController@balance_withdrawel_success');

        Route::get('/member/balance-receive-report','Member\MemberController@balance_receive_report')->name('member.balance-receive-report');

        Route::get('/member/balance-receive-report-view','Member\MemberController@balance_receive_report_view');

        Route::get('/member/user-balance-receive-report','Member\MemberController@user_balance_receive_report')->name('member.user-balance-receive-report');

        Route::get('/member/user-balance-receive-show','Member\MemberController@user_balance_receive_show');
        Route::get('/member/point-convert','Member\MemberController@point_convert')->name('member.point-convert');

        Route::post('/member/tree-user-check','Member\MemberController@tree_user_check');

        Route::post('/member/tree-user-search','Member\MemberController@tree_user_search');

        Route::post('/member/tree-lelvel-up-search','Member\MemberController@tree_lelvel_up');

        Route::get('/member/flexiload','Member\MemberController@flexiload')->name('member.flexiload');

        Route::post('/member/flexiload_action','Member\MemberController@flexiload_action');

        Route::get('/member/flexiload_view','Member\MemberController@flexiload_view');*/
});
