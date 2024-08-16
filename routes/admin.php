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


    // Serarch In Applaction Not Use Middleware From BlogPost
    Route::controller(BlogPostController::class)->group(function(){
        Route::get('/blog/details/{slug}' , 'BlogDetailsBySlug')->name('blogpost.details.slug');
        // Serarch In Global Middleware From BlogCategory By Id
        Route::get('/blog/category/{id}' , 'BlogPostByCategoryId')->name('blog.category.id');
        // End Serarch
        Route::get('/blog' , 'BlogPostAllData')->name('blog.all');
    });
    // End
