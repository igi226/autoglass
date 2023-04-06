<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\VendorController;

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

Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('login', [AdminController::class, 'do_login'])->name('admin.do_login');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

    /* 
    ==============  Inventory Routes ========================
    */

    Route::get('product', [AdminController::class, 'product'])->name('admin.product.index');
    Route::get('product/add', [AdminController::class, 'add_product'])->name('admin.product.add');
    Route::post('product/create', [AdminController::class, 'create_product'])->name('admin.product.create');
    Route::get('product/delete/all', [AdminController::class, 'delete_all_product'])->name('admin.product.delete.all');
    Route::get('product/download', [AdminController::class, 'download_product'])->name('admin.product.download');
    Route::get('product/delete/{id}', [AdminController::class, 'delete_product'])->name('admin.product.delete');
    Route::get('product/edit/{id}', [AdminController::class, 'edit_product'])->name('admin.product.edit');
    Route::post('product/update/{id}', [AdminController::class, 'update_product'])->name('admin.product.update');
    Route::get('product/requests', [AdminController::class, 'product_requests'])->name('admin.product.request');

    Route::get('product/requests/approve/{id}', [AdminController::class, 'approve_product'])->name('admin.product.approve');
    Route::get('product/requests/decline/{id}', [AdminController::class, 'decline_product'])->name('admin.product.decline');

    Route::get('product/requests/approve-all', [AdminController::class, 'approve_product_all'])->name('admin.product.approve.all');
    Route::get('product/requests/decline-all', [AdminController::class, 'decline_product_all'])->name('admin.product.decline.all');
    Route::post('product/import', [AdminController::class, 'import_product'])->name('admin.product.import');
    /* User management */

    Route::get('users', [AdminController::class, 'user'])->name('admin.user.index');
    Route::get('users/add', [AdminController::class, 'add_user'])->name('admin.user.add');
    Route::get('users/download', [AdminController::class, 'download_user'])->name('admin.user.download');
    Route::get('users/edit/{id}', [AdminController::class, 'edit_user'])->name('admin.user.edit');
    Route::get('users/delete/{id}', [AdminController::class, 'delete_user'])->name('admin.user.delete');

    Route::post('users/create', [AdminController::class, 'create_user'])->name('admin.user.create');
    Route::post('users/update/{id}', [AdminController::class, 'update_user'])->name('admin.user.update');

    Route::get('users/requests', [AdminController::class, 'user_requests'])->name('admin.user.requests');
    Route::get('users/approve/{id}', [AdminController::class, 'approve_user'])->name('admin.user.approve');

    Route::get('password/change', [AdminController::class, 'change_password'])->name('admin.password.change');
    Route::post('password/change', [AdminController::class, 'do_change_password'])->name('admin.password.change');

});
Route::get('login', [VendorController::class, 'login'])->name('vendor.login');
Route::post('login', [VendorController::class, 'do_login'])->name('vendor.login');

Route::match(array('GET','POST'),'/forgot-password', [VendorController::class, 'forgot_password'])->name('vendor.forgot-password');
Route::match(array('GET','POST'),'reset-password/{token}', [VendorController::class, 'reset_password'])->name('vendor.reset-password'); 

Route::get('register', [VendorController::class, 'register'])->name('vendor.register');
Route::post('register', [VendorController::class, 'do_register'])->name('vendor.register');

Route::match(array('GET','POST'),'displaymodel',[VendorController::class, 'displaymodel'])->name('vendor.displaymodel');


Route::prefix('/')->middleware('auth')->group(function() {
    Route::get('/', [vendorController::class, 'index'])->name('vendor.index');
    Route::get('products/inventory', [VendorController::class, 'inventory'])->name('vendor.product.index');
    Route::get('products/invendory/pending', [VendorController::class, 'pending_products'])->name('vendor.product.pending');
    Route::get('products/inventory/my-products', [VendorController::class, 'my_products'])->name('vendor.product.myproduct');
    Route::post('products/inventory/import', [VendorController::class, 'inventory_import'])->name('vendor.product.import');
    Route::post('products/inventory/import-one', [VendorController::class, 'import_one'])->name('vendor.product.import_one');
    Route::post('products/inventory/import-bulk', [VendorController::class, 'inventory_import_bulk'])->name('vendor.product.import.bulk');

    Route::get('product/delete/{id}', [VendorController::class, 'delete_product'])->name('vendor.product.delete');
    Route::get('product/edit/{id}', [VendorController::class, 'edit_product'])->name('vendor.product.edit');
    Route::post('product/update/{id}', [VendorController::class, 'update_product'])->name('vendor.product.update');

    Route::get('product/requests', [VendorController::class, 'product_requests'])->name('vendor.product.request');
    Route::get('marketplace', [VendorController::class, 'market'])->name('vendor.market.index');

    Route::post('order/refund/action/{id}', [VendorController::class, 'refund_action'])->name('vendor.refund.action');
    Route::post('order/request/refund/{id}', [VendorController::class, 'request_refund'])->name('vendor.order.request.refund');
    Route::get('orders', [VendorController::class, 'orders'])->name('vendor.order.index');
    Route::get('orders/refund-requests', [VendorController::class, 'refund_request'])->name('vendor.order.refunds');
    Route::post('order/update/status/{id}', [vendorController::class, 'order_update_status'])->name('vendor.order.status.update');
    Route::post('order/request/{id}', [VendorController::class, 'request_order'])->name('vendor.order.request');
    Route::get('order/requests', [VendorController::class, 'order_requests'])->name('vendor.orders.requests');
    Route::get('order/requests/accept/{id}', [VendorController::class, 'order_requests_accept'])->name('vendor.orders.requests.accept');
    Route::get('order/requests/decline/{id}', [VendorController::class, 'order_requests_decline'])->name('vendor.orders.requests.decline');
    Route::get('order/invoice/{id}', [VendorController::class, 'order_invoice'])->name('vendor.order.invoice');
    Route::post('order/payment/{id}', [VendorController::class, 'make_payment'])->name('vendor.order.payment');
    Route::get('order/track', [vendorController::class, 'track_order'])->name('vendor.order.track');
    Route::get('order/confirm/{id}', [VendorController::class, 'confirm_order'])->name('vendor.order.confirm');
    Route::get('my-purchases', [VendorController::class, 'my_purchase'])->name('vendor.mypurchase');
    Route::get('purchase/cancel/{id}', [VendorController::class, 'cancel_purchase'])->name('vendor.purchase.cancel');
    Route::get('order/complete/{id}', [VendorController::class, 'complete_order'])->name('vendor.order.complete');
    Route::get('profile', [VendorController::class, 'profile'])->name('vendor.profile');
    Route::post('profile/update', [VendorController::class, 'update_profile'])->name('vendor.profile.update');
    Route::post('profile/avatar/update', [VendorController::class, 'avatar_update'])->name('vendor.avatar.update');

    Route::post('report', [VendorController::class, 'report'])->name('vendor.report');

    Route::get('notifications/mark-all', [VendorController::class, 'mark_as_read'])->name('vendor.notification.mark');
    Route::get('notifications', [VendorController::class, 'notifications'])->name('vendor.notifications');

    Route::get('logout', [VendorController::class, 'logout'])->name('vendor.logout');
    Route::get('/vendor/chart.js', [VendorController::class, 'ajax_chart'])->name('vendor.charts');
    //api
    Route::post('verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('api.verifyEmail');
    Route::get('/verified', function() {
        return view('api.successVerified');
    });
    
});