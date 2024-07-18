<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
 
    return "Cleared!";
 
 });

 
Route::get('/', function () {
    return view('frontend.index');
});

Auth::routes();

Route::get('/generate_roi', [App\Http\Controllers\Cron::class, 'generate_roi'])->name('generate_roi');
Route::get('/reward_bonus', [App\Http\Controllers\Cron::class, 'reward_bonus'])->name('reward_bonus');
Route::get('/reward_bonus', [App\Http\Controllers\Cron::class, 'reward_bonus'])->name('reward_bonus');


Route::post('login', [App\Http\Controllers\Login::class, 'login'])->name('login');
Route::get('forgot-password', [App\Http\Controllers\Login::class, 'forgot_password'])->name('forgot-password');
Route::any('forgot_submit', [App\Http\Controllers\Login::class, 'forgot_password_submit'])->name('forgot_submit');
Route::any('submitResetPassword', [App\Http\Controllers\Login::class, 'submitResetPassword'])->name('submitResetPassword');
Route::any('verifyCode', [App\Http\Controllers\Login::class, 'verifyCode'])->name('verifyCode');
Route::get('codeVerify', [App\Http\Controllers\Login::class, 'codeVerify'])->name('codeVerify');
Route::get('resetPassword', [App\Http\Controllers\Login::class, 'resetPassword'])->name('resetPassword');

Route::post('/getUserName', [App\Http\Controllers\Register::class, 'getUserNameAjax'])->name('getUserName');
Route::post('/registers', [App\Http\Controllers\Register::class, 'register'])->name('registers');
Route::get('/register_sucess', [App\Http\Controllers\Register::class, 'index'])->name('register_sucess');

Route::any('/Index', [App\Http\Controllers\FrontController::class, 'index'])->name('Index');
Route::get('/about-us', [App\Http\Controllers\FrontController::class, 'about'])->name('about-us');
Route::get('/contact-us', [App\Http\Controllers\FrontController::class, 'contact'])->name('contact-us');
Route::get('/menu', [App\Http\Controllers\FrontController::class, 'menu'])->name('menu');
Route::get('/event', [App\Http\Controllers\FrontController::class, 'event'])->name('event');



Route::get('/home', [App\Http\Controllers\UserPanel\Dashboard::class, 'index'])->name('home');
Route::prefix('user')->group(function ()
{
Route::middleware('auth')->group(function ()
{
Route::get('/dashboard', [App\Http\Controllers\UserPanel\Dashboard::class, 'index'])->name('user.dashboard');


// profile
Route::get('/profile', [App\Http\Controllers\UserPanel\Profile::class, 'index'])->name('user.profile');
Route::post('/update-profile', [App\Http\Controllers\UserPanel\Profile::class, 'profile_update'])->name('user.update-profile');
Route::get('/ChangePass', [App\Http\Controllers\UserPanel\Profile::class, 'change_password'])->name('user.ChangePass');
Route::get('/BankDetail', [App\Http\Controllers\UserPanel\Profile::class, 'BankDetail'])->name('user.BankDetail');

Route::post('/edit-password', [App\Http\Controllers\UserPanel\Profile::class, 'change_password_post'])->name('user.edit-password');
Route::post('/bank-update', [App\Http\Controllers\UserPanel\Profile::class, 'bank_profile_update'])->name('user.bank-update');
Route::post('/change-trxpasswword', [App\Http\Controllers\UserPanel\Profile::class, 'change_trxpassword_post'])->name('user.change-trxpasswword');
// end profile


// add fund

Route::get('/AddFund', [App\Http\Controllers\UserPanel\AddFund::class, 'index'])->name('user.AddFund');
Route::get('invoices_details/{id}', [App\Http\Controllers\UserPanel\AddFund::class, 'invoices_details'])->name('user.invoices_details');
Route::get('/fundHistory', [App\Http\Controllers\UserPanel\AddFund::class, 'fundHistory'])->name('user.fundHistory');
Route::any('/SubmitBuyFund', [App\Http\Controllers\UserPanel\AddFund::class, 'SubmitBuyFund'])->name('user.SubmitBuyFund');
Route::any('/add-cart', [App\Http\Controllers\UserPanel\AddFund::class, 'add_cart'])->name('user.add-cart');
Route::get('/sellerInvoice', [App\Http\Controllers\UserPanel\AddFund::class, 'sellerInvoice'])->name('user.sellerInvoice');
Route::get('ViewSellerInvoice/{id}', [App\Http\Controllers\UserPanel\AddFund::class, 'ViewSellerInvoice'])->name('user.ViewSellerInvoice');
Route::any('/ecommerceCart', [App\Http\Controllers\UserPanel\AddFund::class, 'ecommerce_cart'])->name('user.ecommerceCart');
Route::post('/fund_activation', [App\Http\Controllers\UserPanel\AddFund::class, 'fundActivation'])->name('user.fundActivation');
Route::post('/seller_billing', [App\Http\Controllers\UserPanel\AddFund::class, 'sellerBilling'])->name('user.sellerBilling');
Route::post('/vendor_billing', [App\Http\Controllers\UserPanel\AddFund::class, 'vendorBilling'])->name('user.vendorBilling');
Route::any('/vendorCart', [App\Http\Controllers\UserPanel\AddFund::class, 'vendorCart'])->name('user.vendorCart');

// end add fund

//add vandor
Route::get('/addagent', [App\Http\Controllers\UserPanel\AddFund::class, 'agentindex'])->name('user.Addagent');
Route::post('/agentActivation2', [App\Http\Controllers\UserPanel\AddFund::class, 'seller_cart2'])->name('user.agentActivation');

Route::post('/addproductsname', [App\Http\Controllers\UserPanel\AddFund::class, 'getProductsByCategory'])->name('user.addproductsname');
Route::post('/fetch-products', [App\Http\Controllers\UserPanel\AddFund::class, 'fetchProducts'])->name('fetch.products');

// invest
Route::get('/invest', [App\Http\Controllers\UserPanel\Invest::class, 'index'])->name('user.invest');
Route::get('/categories_menu', [App\Http\Controllers\UserPanel\Invest::class, 'categories_menu'])->name('user.categories_menu');
Route::post('/addfatch', [App\Http\Controllers\UserPanel\Invest::class, 'addfatch'])->name('add.fatch');
Route::get('/vender_history', [App\Http\Controllers\UserPanel\Invest::class, 'vender_history'])->name('user.vender_history');
Route::post('/vendor_card', [App\Http\Controllers\UserPanel\Invest::class, 'vendor_card'])->name('user.vendor_card');
Route::get('/agent_invoice', [App\Http\Controllers\UserPanel\Invest::class, 'agent_invoice'])->name('user.agent_invoice');
Route::post('/fundActivation', [App\Http\Controllers\UserPanel\Invest::class, 'fundActivation'])->name('user.fund_activation');
Route::get('/DepositHistory', [App\Http\Controllers\UserPanel\Invest::class, 'invest_list'])->name('user.DepositHistory');
Route::any('/ecommerce_cart', [App\Http\Controllers\UserPanel\Invest::class, 'ecommerce_cart'])->name('user.ecommerce_cart');
Route::get('view-invoice/{id}', [App\Http\Controllers\UserPanel\Invest::class, 'view_invoice'])->name('user.view-invoice');
Route::get('/vendor_invoice/{id}', [App\Http\Controllers\UserPanel\Invest::class, 'vendor_invoice'])->name('user.vendor_invoice');
Route::get('/vendor_cards', [App\Http\Controllers\UserPanel\Invest::class, 'vendor_cards'])->name('user.vendor_cards');
Route::get('/buy_products', [App\Http\Controllers\UserPanel\Invest::class, 'buy_products'])->name('user.buy_products');
Route::post('/close-request/{id}',[App\Http\Controllers\UserPanel\Invest::class,'closeRequest'])->name('user.close-request');



Route::post('/get-products', [App\Http\Controllers\UserPanel\Invest::class, 'fetchProduct'])->name('product.fatch');
// Route::get('/get-product', [App\Http\Controllers\UserPanel\Invest::class, 'getProducts'])->name('get.product');

// end invest

// withdraw
Route::get('/Withdraw', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'index'])->name('user.withdraw');
Route::post('/WithdrawRequest', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'WithdrawRequest'])->name('user.Withdraw-Request');
Route::get('/WithdrawHistory', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'WithdrawHistory'])->name('user.Withdraw-History');
// end withdraw

//team
Route::get('/referral-team', [App\Http\Controllers\UserPanel\Team::class, 'index'])->name('user.referral-team');
Route::get('/level-team', [App\Http\Controllers\UserPanel\Team::class, 'LevelTeam'])->name('user.level-team');
//end team

//bonus
Route::get('/level-income', [App\Http\Controllers\UserPanel\Bonus::class, 'index'])->name('user.level-income');
Route::get('/direct-income', [App\Http\Controllers\UserPanel\Bonus::class, 'direct_income'])->name('user.direct-income');
Route::get('/reward-bonus', [App\Http\Controllers\UserPanel\Bonus::class, 'reward_income'])->name('user.reward-bonus');
Route::get('/roi-bonus', [App\Http\Controllers\UserPanel\Bonus::class, 'roi_income'])->name('user.roi-bonus');
Route::get('/cashback-bonus', [App\Http\Controllers\UserPanel\Bonus::class, 'cashback_bonus'])->name('user.cashback-bonus');
//end bonus

//tickets
Route::get('/GenerateTicket',[App\Http\Controllers\UserPanel\Tickets::class,'GenerateTicket'])->name('user.GenerateTicket');
Route::post('/SubmitTicket',[App\Http\Controllers\UserPanel\Tickets::class,'SubmitTicket'])->name('user.SubmitTicket');
Route::get('/SupportMessage',[App\Http\Controllers\UserPanel\Tickets::class,'SupportMessage'])->name('user.SupportMessage');
Route::get('/ViewMessage',[App\Http\Controllers\UserPanel\Tickets::class,'ViewMessage'])->name('user.ViewMessage');

//end tickets

});
});


// admin

Route::prefix('admin')->group(function () {
Route::get('/admin-login', [App\Http\Controllers\Admin\AdminLogin::class, 'index'])->name('admin.admin-login');
Route::post('LoginAction', [App\Http\Controllers\Admin\AdminLogin::class, 'admin_login'])->name('admin.LoginAction');
Route::get('/admin-logout', [App\Http\Controllers\Admin\AdminLogin::class, 'admin_sign_out'])->name('admin.admin-logout');
Route::group(['middleware' => ['admin']], function ()
{

 Route::get('/dashboard', [App\Http\Controllers\Admin\Dashboard::class, 'index'])->name('admin.dashboard');
 Route::get('/add-bank-details', [App\Http\Controllers\Admin\Dashboard::class, 'add_bank_detail'])->name('admin.add-bank-details');
 Route::get('/view-bank-detail', [App\Http\Controllers\Admin\Dashboard::class, 'view_bank_detail'])->name('admin.view-bank-detail');
 Route::get('/edit-bank-kyc', [App\Http\Controllers\Admin\Dashboard::class, 'edit_bank_kyc'])->name('admin.edit-bank-kyc');
 Route::get('/remove-bank-detail', [App\Http\Controllers\Admin\Dashboard::class, 'remove_bank_detail'])->name('admin.remove-bank-detail');

 
 Route::post('/update-user-kyc-detail', [App\Http\Controllers\Admin\Dashboard::class, 'users_bank_kyc'])->name('admin.update-user-kyc-detail');
 
 Route::get('/changePassword', [App\Http\Controllers\Admin\Dashboard::class, 'changePassword'])->name('admin.changePassword');
 Route::post('/change-password-post', [App\Http\Controllers\Admin\Dashboard::class, 'change_password_post'])->name('admin.change-password-post');
 
 // active users controller
 

 Route::get('/active-user', [App\Http\Controllers\Admin\ActiveuserController::class, 'active_user'])->name('admin.active-user');
 Route::post('activate-admin', [App\Http\Controllers\Admin\ActiveuserController::class, 'activate_admin_post'])->name('admin.activate-admin');

 // usercontroller
 Route::get('/totalusers', [App\Http\Controllers\Admin\UserController::class, 'alluserlist'])->name('admin.totalusers');
 Route::get('/add_agent', [App\Http\Controllers\Admin\UserController::class, 'add_agent'])->name('admin.add_agent');
 Route::post('/agent_post', [App\Http\Controllers\Admin\UserController::class, 'agent_post'])->name('admin.agent_post');
 Route::get('/agent_history', [App\Http\Controllers\Admin\UserController::class, 'agent_history'])->name('admin.agent_history');
 Route::get('/vendor_history', [App\Http\Controllers\Admin\UserController::class, 'vendor_history'])->name('admin.vendor_history');
 Route::get('/edit_member/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit_member'])->name('admin.edit_member');
 Route::post('/edit_member_post', [App\Http\Controllers\Admin\UserController::class, 'edit_member_post'])->name('admin.edit_member_post');
 Route::Post('/edit_vendor_post', [App\Http\Controllers\Admin\UserController::class, 'edit_vendor_post'])->name('admin.edit_vendor_post');
 Route::get('/edit_vendor/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit_vendor'])->name('admin.edit_vendor');


 Route::get('/active-users', [App\Http\Controllers\Admin\UserController::class, 'active_users'])->name('admin.active-users');
 Route::get('/pending-user', [App\Http\Controllers\Admin\UserController::class, 'pending_users'])->name('admin.pending-user');
 Route::get('/edit-users', [App\Http\Controllers\Admin\UserController::class, 'edit_users'])->name('admin.edit-users');
 Route::get('edit-user-view/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit_users_view'])->name('admin.edit-user-view');

 Route::any('update-user-profile', [App\Http\Controllers\Admin\UserController::class, 'users_profile_update'])->name('admin.update-user-profile');
 Route::get('/block-users', [App\Http\Controllers\Admin\UserController::class, 'block_users'])->name('admin.block-users');
 Route::get('block-submit', [App\Http\Controllers\Admin\UserController::class, 'block_submit'])->name('admin.block-submit');
 Route::get('sellerSubmit', [App\Http\Controllers\Admin\UserController::class, 'sellerSubmit'])->name('admin.sellerSubmit');
 
 //end userController

//DepositManagmentController
 Route::get('/deposit-request', [App\Http\Controllers\Admin\DepositController::class, 'deposit_request'])->name('admin.deposit-request');
 Route::get('/rejected-deposit', [App\Http\Controllers\Admin\DepositController::class, 'rejected_deposit'])->name('admin.rejected-deposit');
 
 Route::get('/deposit-list', [App\Http\Controllers\Admin\DepositController::class, 'deposit_list'])->name('admin.deposit-list');
 Route::get('/Sellerinvoice', [App\Http\Controllers\Admin\DepositController::class, 'Sellerinvoice'])->name('admin.Sellerinvoice');
 
 Route::get('deposit_request_done', [App\Http\Controllers\Admin\DepositController::class, 'deposit_request_done'])->name('admin.deposit_request_done');
 Route::get('view-invoice/{id}', [App\Http\Controllers\Admin\DepositController::class, 'view_invoice'])->name('admin.view-invoice');
 Route::get('view-seller-invoice/{id}', [App\Http\Controllers\Admin\DepositController::class, 'view_seller_invoice'])->name('admin.view-seller-invoice');
 
// end DepositManagmentController

//fundController
 Route::get('Add-fund-list', [App\Http\Controllers\Admin\FundController::class, 'add_fund_report'])->name('admin.add-fund-list');
 Route::get('fund-report', [App\Http\Controllers\Admin\FundController::class, 'fund_report'])->name('admin.fund-report');
 
 Route::get('fund_request_done', [App\Http\Controllers\Admin\FundController::class, 'fund_request_done'])->name('admin.fund_request_done');
 Route::get('Add-fund-Report', [App\Http\Controllers\Admin\FundController::class, 'add_fund_reports'])->name('Add-fund-Report');

//end fundController


//productController
Route::post('a_product', [App\Http\Controllers\Admin\ProductController::class, 'a_product'])->name('admin.a_product');
Route::get('view_invoices/{id}', [App\Http\Controllers\Admin\ProductController::class, 'view_invoices'])->name('admin.view_invoices');
Route::get('vendor_invoice_b/{id}', [App\Http\Controllers\Admin\ProductController::class, 'vendor_invoice_b'])->name('admin.vendor_invoice_b');

Route::get('agent_report', [App\Http\Controllers\Admin\ProductController::class, 'agent_report'])->name('admin.agent_report');
Route::get('agent_product', [App\Http\Controllers\Admin\ProductController::class, 'agent_product'])->name('admin.agent_product');
Route::get('v_product', [App\Http\Controllers\Admin\ProductController::class, 'v_product'])->name('admin.v_product');
Route::post('vendor_product', [App\Http\Controllers\Admin\ProductController::class, 'vendor_product'])->name('admin.vendor_product');
Route::get('add-product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.add-product');
Route::get('category', [App\Http\Controllers\Admin\ProductController::class, 'category'])->name('admin.category');
Route::post('/toggle-status', [App\Http\Controllers\Admin\ProductController::class, 'toggleStatus'])->name('toggle.status');
Route::post('editcategory', [App\Http\Controllers\Admin\ProductController::class, 'editcategory'])->name('admin.editcategory');
Route::get('edit_category/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit_category'])->name('admin.edit_category');
Route::get('Categorylist', [App\Http\Controllers\Admin\ProductController::class, 'Categorylist'])->name('admin.Categorylist');
Route::post('categorie', [App\Http\Controllers\Admin\ProductController::class, 'categorie'])->name('admin.categorie');
Route::get('admin-product', [App\Http\Controllers\Admin\ProductController::class, 'admin_product'])->name('admin.admin-product');
Route::get('billing-product', [App\Http\Controllers\Admin\ProductController::class, 'billing_product'])->name('admin.billing-product');
Route::get('deleteProduct', [App\Http\Controllers\Admin\ProductController::class, 'deleteProduct'])->name('admin.deleteProduct');
Route::get('product-request', [App\Http\Controllers\Admin\ProductController::class, 'product_request'])->name('admin.product-request');
Route::get('sellerProduct', [App\Http\Controllers\Admin\ProductController::class, 'sellerProduct'])->name('admin.sellerProduct');
Route::get('adminProduct', [App\Http\Controllers\Admin\ProductController::class, 'adminProduct'])->name('admin.adminProduct');
Route::any('billing-to-soller', [App\Http\Controllers\Admin\ProductController::class, 'billingToSeller'])->name('admin.billing-to-soller');
Route::any('billing-to-admin', [App\Http\Controllers\Admin\ProductController::class, 'billingToAdmin'])->name('admin.billing-to-admin');
Route::any('billingSubmitSeller', [App\Http\Controllers\Admin\ProductController::class, 'billingSubmitSeller'])->name('admin.billingSubmitSeller');
Route::any('billingSubmitAdmin', [App\Http\Controllers\Admin\ProductController::class, 'billingSubmitAdmin'])->name('admin.billingSubmitAdmin');

Route::post('approvedProduct', [App\Http\Controllers\Admin\ProductController::class, 'approvedProduct'])->name('admin.approvedProduct');

Route::post('product-request-done', [App\Http\Controllers\Admin\ProductController::class, 'product_request_done_multiple'])->name('admin.product-request-done');

Route::post('addProduct', [App\Http\Controllers\Admin\ProductController::class, 'addProduct'])->name('admin.addProduct');
Route::post('editProduct', [App\Http\Controllers\Admin\ProductController::class, 'editProduct'])->name('admin.editProduct');
Route::get('confirm_product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'confirm_product'])->name('admin.confirm_product');
Route::get('rejectProduct', [App\Http\Controllers\Admin\ProductController::class, 'rejectProduct'])->name('admin.rejectProduct');
Route::get('productList', [App\Http\Controllers\Admin\ProductController::class, 'productList'])->name('admin.productList');
Route::get('edit-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit_product'])->name('admin.edit-product');

//end productController



//bonusController
Route::get('roi-bonus', [App\Http\Controllers\Admin\BonusController::class, 'roi_bonus'])->name('admin.roi-bonus');
Route::get('level-bonus', [App\Http\Controllers\Admin\BonusController::class, 'level_bonus'])->name('admin.level-bonus');
Route::get('sponsor-bonus', [App\Http\Controllers\Admin\BonusController::class, 'sponsor_bonus'])->name('admin.sponsor-bonus');
Route::get('reward-bonus', [App\Http\Controllers\Admin\BonusController::class, 'reward_bonus'])->name('admin.reward-bonus');


// withdraw
Route::get('pendingWithdrawal', [App\Http\Controllers\Admin\WithdrawController::class, 'pendingWithdrawal'])->name('admin.pendingWithdrawal');
Route::get('payment-ledgers', [App\Http\Controllers\Admin\WithdrawController::class, 'paymentledgers'])->name('admin.payment-ledgers');

Route::get('withdraw_request_done', [App\Http\Controllers\Admin\WithdrawController::class, 'withdraw_request_done'])->name('admin.withdraw_request_done');
Route::get('rejectedWithdrawal', [App\Http\Controllers\Admin\WithdrawController::class, 'rejectedWithdrawal'])->name('admin.rejectedWithdrawal');
Route::get('approvedWithdrawal', [App\Http\Controllers\Admin\WithdrawController::class, 'approvedWithdrawal'])->name('admin.approvedWithdrawal');
Route::any('/withdraw_request_done_multiple', [App\Http\Controllers\Admin\WithdrawController::class, 'withdraw_request_done_multiple'])->name('admin.withdraw_request_done_multiple');

// support


Route::get('support-query', [App\Http\Controllers\Admin\SupportController::class, 'index'])->name('admin.support-query');
Route::get('get_support_msg', [App\Http\Controllers\Admin\SupportController::class, 'get_support_msg'])->name('admin.get_support_msg');
Route::get('close_ticket_', [App\Http\Controllers\Admin\SupportController::class, 'close_ticket_'])->name('admin.close_ticket_');
Route::get('reply_support_msg', [App\Http\Controllers\Admin\SupportController::class, 'reply_support_msg'])->name('admin.reply_support_msg');
Route::post('admin_ticket_submit', [App\Http\Controllers\Admin\SupportController::class, 'admin_ticket_submit'])->name('admin.admin_ticket_submit');

});

});
