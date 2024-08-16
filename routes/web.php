<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BlogCategorieController;
use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\BookAreaController;
use App\Http\Controllers\Backend\BookingController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\RoomNumberController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\FrontBookingController;
use App\Http\Controllers\Frontend\FrontRoomController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\ImageController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';


// Auth Middleware
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
        return view('frontend.dashboard.UserDashboard');
    })->name('dashboard');

    Route::controller(UserController::class)->group(function(){
        Route::get('user/invoice/{id}' , 'UserInvoicePDF')->name('user.invoice');
        Route::get('user/booking' , [UserController::class , 'UserBooking'])->name('user.booking');
    });
    
});
// End Auth Middleware









// Admin Middleware
Route::middleware('admin')->group(function(){
    // Admin Data
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/dashboard' , 'AdminDashboard')->name('admin');
        Route::get('/admin/profile' , 'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/update/{user}' , 'AdminProfileUpdate')->name('admin.profile.update');
        Route::get('/admin/password' , 'AdminChangePassword')->name('admin.password');
        Route::post('/admin/password/update/{user}' , 'AdminPasswordUpdate')->name('admin.password.update');
    });
    // End

    
    Route::resource('team' , TeamController::class)
        ->except('show' , 'edit' , 'create');
    
    Route::resource('bookarea' , BookAreaController::class)
        ->only('index' , 'update');
    
    Route::resource('room/type' , RoomTypeController::class)
        ->only('index' , 'store' , 'destroy');
    
    // We Wont To Handel Image Service To Work With Array
    // Handel Delete Image
    Route::resource('room' , RoomController::class)
        ->only('edit' , 'update');
    Route::get('room/{room}/delete/{index}' , [RoomController::class , 'RoomDeleteSpaceficImage'])
        ->name('room.delete.image');
    Route::resource('room.roomnumber' , RoomNumberController::class)
        ->only('store' , 'update' , 'destroy');



    Route::resource('testimonial' , TestimonialController::class);
    Route::resource('blogCategorie' , BlogCategorieController::class);
    Route::resource('blogpost' , BlogPostController::class);
    
    
    
    
    
    

    Route::resource('booking' , BookingController::class);
    Route::controller(BookingController::class)->group(function(){
        Route::get('/assign_room/{id}', 'AssignRoom')->name('assign_room');
        Route::get('/assign_room/store/{booking_id}/{room_number_id}', 'AssignRoomStore')->name('assign_room_store');
        Route::get('/assign_room_delete/{id}', 'AssignRoomDelete')->name('assign_room_delete');
        Route::get('download/invoice/{id}' , 'DownloadInvoice')->name('download.invoice');

        /// Notification In Admin But Method In This 
        Route::post('/mark-notification-as-read/{notificationId}', 'MarkAsRead');
    });


    Route::resource('roomlist' , RoomListController::class);

    Route::controller(SettingController::class)->group(function(){
        Route::get('smtp/setting' , 'index')->name('setting.index');
        Route::put('smtp/setting/{setting}' , 'update')->name('setting.update');
        
        Route::get('site/setting' , 'SiteSettingIndex')->name('sitesetting.index');
        Route::put('site/setting/{site}' , 'SiteSettingUpdate')->name('sitesetting.update');
    });

    Route::controller(ReportController::class)->group(function(){
        Route::get('/bookings/report/' , 'BookingReport')->name('booking.report');
        Route::post('/bookings/report/search-by-date' , 'SearchByDate')->name('booking.reportSearch');
    });

    Route::resource('/gallery' , GalleryController::class);
    Route::delete('gallery/select/delete' , [GalleryController::class , 'DeleteSelected'])->name('gallery.select');

    
    Route::get('/contact/message' , [ContactController::class , 'GetMessage'])->name('contact.all');



    // Permission All Route
    Route::controller(RoleController::class)->group(function(){
        Route::get('/all/permission/' , 'AllPermission')->name('all.permission');
        Route::get('/add/permission/' , 'AddPermission')->name('add.permission');
        Route::post('/store/permission/' , 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}' , 'EditPermission')->name('edit.permission');
        Route::post('/update/permission/' , 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}' , 'DeletePermission')->name('delete.permission');
        Route::get('/import/permission/' , 'ImportPermission')->name('import.permission');
        Route::get('/export/' , 'Export')->name('export');
        Route::post('/import/' , 'Import')->name('import');       
    });


    // Roles All Route
    Route::controller(RoleController::class)->group(function(){
        Route::get('/all/roles/' , 'AllRoles')->name('all.roles');
        Route::get('/add/roles/' , 'AddRoles')->name('add.roles');
        Route::post('/store/roles/' , 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}' , 'EditRoles')->name('edit.roles');
        Route::post('/update/roles/' , 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}' , 'DeleteRoles')->name('delete.roles');
        

        Route::get('/add/roles/permission/' , 'AddRolesPermission')->name('add.roles.permission');
        Route::get('/all/roles/permission/' , 'AllRolesPermission')->name('all.roles.permission');
        Route::post('/role/permission/store' , 'RolePermissionStore')->name('role.permission.store');

        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');

    });


    // Admin User All Route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/admin/' , 'AllAdmin')->name('all.admin');
        Route::get('/add/admin/' , 'AddAdmin')->name('add.admin');
        Route::post('/store/admin/' , 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}' , 'EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    });

});
// End Admin Middleware



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



// Serarch In Applaction Not Use Middleware From BlogPost
Route::controller(BlogPostController::class)->group(function(){
    Route::get('/blog/details/{slug}' , 'BlogDetailsBySlug')->name('blogpost.details.slug');
    // Serarch In Global Middleware From BlogCategory By Id
    Route::get('/blog/category/{id}' , 'BlogPostByCategoryId')->name('blog.category.id');
    // End Serarch
    Route::get('/blog' , 'BlogPostAllData')->name('blog.all');
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

// Route::view('/gallery' , 'frontend.gallery')->name('gallery');
// Route::view('/checkout' , 'frontend.checkout')->name('checkout');
// Route::view('/blog' , 'frontend.blog')->name('blog');
// Route::view('/sign-in' , 'frontend.sign-in')->name('sign-in');
// Route::view('/sign-up' , 'frontend.sign-up')->name('sign-up');

