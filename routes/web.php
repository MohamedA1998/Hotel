<?php

use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\FrontBookingController;
use App\Http\Controllers\Frontend\FrontRoomController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
        return view('frontend.dashboard.UserDashboard');
    })->name('dashboard');

    Route::controller(UserController::class)->group(function(){
        Route::get('user/invoice/{id}' , 'UserInvoicePDF')->name('user.invoice');
        Route::get('user/booking' , [UserController::class , 'UserBooking'])->name('user.booking');
    });
});


// Room In Gloable
Route::controller( FrontRoomController::class )->group(function(){
    Route::get('rooms' , 'GetAllRoomData')->name('frontroom.rooms');
    Route::get('rooms/details/{room}' , 'SingleRoomDetails')->name('frontroom.roomdetails');

    Route::get('rooms/search' , 'SearchFromBooking')->name('room.search');
    Route::get('/search/room/details/{room}', 'SearchRoomDetails')->name('search_room_details');
    Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');
});
// End


// Booking Controller Should By Auth middleware Work With
Route::controller(FrontBookingController::class)->middleware('auth')->group(function(){
    Route::get('/checkout/' , 'CheckOut')->name('checkout');
    Route::post('/booking/store/' , 'BookingStore')->name('user_booking_store');
    Route::post('/checkout/store' , 'CheckOutStore')->name('checkout_store');

    Route::match(['get','post'],'/stripe_pay', [FrontBookingController::class, 'stripe_pay'])->name('stripe_pay');
});
// End


// Comment Rout In All Check In Middleware In Controller
Route::resource('/comment' , CommentController::class);
Route::post('/update/comment/status' , [CommentController::class , 'UpdateCheckedStatus'])->name('comment.status.update');
// End


Route::controller(UserController::class)->group(function(){
    Route::get('/' , 'HomePage')->name('home');
    Route::get('show/gallery' , 'ShowAllGallery')->name('gallery.showall');
    Route::get('/contact' , 'ContactUS')->name('contact');
    Route::post('/contact' , 'StoreContact')->name('store.contact');
});


// Static Page
Route::view('/about' , 'frontend.about')->name('about');
Route::view('/book' , 'frontend.book')->name('book');
Route::view('/allteam' , 'frontend.team')->name('allteam');
Route::view('/faq' , 'frontend.faq')->name('faq');
Route::view('/restaurant' , 'frontend.restaurant')->name('restaurant');
Route::view('/reservation' , 'frontend.reservation')->name('reservation');
Route::view('/testimonials' , 'frontend.testimonials')->name('testimonials');
Route::view('/terms-condition' , 'frontend.terms-condition')->name('terms-condition');
Route::view('/privacy-policy' , 'frontend.privacy-policy')->name('privacy-policy');
Route::view('/404' , 'frontend.404')->name('404');
Route::view('/coming-soon' , 'frontend.coming-soon')->name('coming-soon');
Route::view('/services' , 'frontend.services')->name('services');

// This Comment Fro Test Conflect
Route::view('/contact_ssss' , 'frontend.contact')->name('contact');
