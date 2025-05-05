<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LoginControlller;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Session;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;

Route::group(['prefix'=>'account'],function(){

    Route::group(['middleware'=>'guest'],function(){
        Route::get('login',[LoginController::class,'index'])->name('account.login');
        Route::get('register',[LoginController::class,'register'])->name('account.register');    
        Route::post('process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
        
    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard',[Dashboardcontroller::class,'index'])->name('account.dashboard');
        Route::get('/profile',[ProfileController::class,'profileshow'])->name('profileshow');
        Route::get('/booking/{id}',[DashboardController::class,'userbook'])->name('user.booking');
        Route::get('cancelbookings/{id}',[DashboardController::class,'cancelbooking'])->name('cancel.booking');
        Route::post('/room/{roomId}/review', [ReviewController::class, 'store'])->name('review.store');
        Route::get('/room/{roomId}/reviews', [ReviewController::class, 'showReviews'])->name('review.show');
        Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.delete');
        Route::get('/recommend/{roomId}', [RecommendationController::class, 'recommend'])->name('recommend');
        Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/payment/failed', [PaymentController::class, 'paymentFailed'])->name('payment.failed');

    });

    Route::get('gallery',[Dashboardcontroller::class,'viewgallery'])->name('gallery');
});


Route::group(['prefix'=>'admin'],function(){

    Route::group(['middleware'=>'admin.guest'],function(){
        Route::get('login',[LoginControlller::class,'index'])->name('admin.login');
        Route::post('authenticate',[LoginControlller::class,'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware'=>'admin.auth'],function(){
        Route::get('dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::get('createroom',[AdminDashboardController::class,'rooms'])->name('admin.create');
        Route::get('logout',[LoginControlller::class,'logout'])->name('admin.logout');
        Route::post('add_room',[AdminDashboardController::class,'add_room'])->name('add_room');
        Route::get('view_room',[AdminDashboardController::class,'view_room'])->name('admin.viewroom');
        Route::get('services/add', [AdminDashboardController::class, 'add_service'])->name('services.add');
        Route::post('services/store', [AdminDashboardController::class, 'store_service'])->name('services.store');
        Route::get('services/view', [AdminDashboardController::class, 'view_service'])->name('services.view');
        Route::get('delete_room/{id}',[AdminDashboardController::class,'delete_room'])->name('admin.deleteroom');
        Route::get('update_room/{id}',[AdminDashboardController::class,'update_room'])->name('admin.updateroom');
        Route::post('edit_room/{id}',[AdminDashboardController::class,'edit_room'])->name('admin.editroom');
        Route::get('mainpage',[AdminDashboardController::class,'edit_main'])->name('admin.mainpage');
        Route::post('add_main',[AdminDashboardController::class,'add_main'])->name('add_main');
        Route::get('view_main',[AdminDashboardController::class,'view_main'])->name('admin.viewmain');
        Route::get('update_main/{id}',[AdminDashboardController::class,'update_main'])->name('admin.updatemain');
        Route::post('edit_main/{id}',[AdminDashboardController::class,'edit_images'])->name('admin.editimage');
        Route::get('bookings',[AdminDashboardController::class,'booking'])->name('admin.booking');
        Route::get('deletebookings/{id}',[AdminDashboardController::class,'deletebooking'])->name('delete.booking');
        Route::get('approvebook/{id}',[AdminDashboardController::class,'approvebooking'])->name('approve_book');
        Route::get('rejectbook/{id}',[AdminDashboardController::class,'rejectbooking'])->name('reject_book');
        Route::get('view_gallery',[AdminDashboardController::class,'view_gallery'])->name('view_gallery');
        Route::post('uploadgallery',[AdminDashboardController::class,'uploadgallery'])->name('uploadgallery');
        Route::get('deleteimage/{id}',[AdminDashboardController::class,'deleteimage'])->name('deleteimage');
        Route::get('deleteservice/{id}',[AdminDashboardController::class,'delete_service'])->name('deleteservice');
        Route::get('view_newsletter',[AdminDashboardController::class,'view_newsletter'])->name('view_newsletter');
        Route::get('manage_user',[AdminDashboardController::class,'manage_user'])->name('manage_user');
        Route::get('/delete_user/{id}', [AdminDashboardController::class,'delete_user', 'delete_user']);


        Route::get('/admin/enquiries', [AdminDashboardController::class, 'viewEnquiries'])->name('admin.enquiries');
        Route::get('/admin/enquiries/reply/{id}', [AdminDashboardController::class, 'replyForm'])->name('admin.enquiries.reply');
        Route::post('/admin/enquiries/reply/{id}', [AdminDashboardController::class, 'sendReply'])->name('admin.enquiries.sendReply');
    });
});


Route::get('/rooms',[LoginController::class,'view_room'])->name('account.room');
Route::get('/services',[LoginController::class,'viewservice'])->name('services');
Route::post('newsletter',[LoginController::class,'add_newsletter'])->name('add_newsletter');
Route::get('/room_details/{id}',[LoginController::class,'room_details'])->name('room_details');
Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment'])->name('paymentInitiate');
Route::post('/booking-details', [PaymentController::class, 'bookingDetails'])->name('bookingDetails');
Route::get('/payment/response', [PaymentController::class, 'paymentResponse'])->name('paymentResponse');
Route::post('/add_booking/{id}',[LoginController::class,'add_booking'])->name('add_booking');
Route::get('/about',[Dashboardcontroller::class,'about'])->name('abouts');
Route::post('/enquiries', [LoginController::class, 'storeenquiry'])->name('enquiries.store');
Route::get('/check',[LoginController::class,'checkavailability'])->name('checkavailability');
Route::get('/',[LoginController::class,'home'])->name('account.home');


Route::get('/set-currency/{currency}', function ($currency) {
    Session::put('currency', $currency);
    return back();
})->name('set-currency');