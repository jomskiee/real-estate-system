<?php

use App\Http\Controllers\AddFavorite;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Agent\AgencyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Agent\FavController;
use App\Http\Controllers\Agent\FormController;
use App\Http\Controllers\Agent\ImageController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\User\FavoritesController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
//For all users


Route::get('/', [FrontEndController::class, 'index'])->name('index');
Route::get('/all-properties', [FrontEndController::class, 'viewAll'])->name('viewAll');
Route::get('/property/{slug}', [FrontEndController::class, 'viewProp'])->name('viewProp');
Route::get('/contact-us', [FrontEndController::class, 'contact'])->name('contact');
Route::post('/contact-us/sent', [FrontEndController::class, 'sendMessage'])->name('send.contact');
// Route::get('/house', function () {
//     return view('property');
// });
//Route::post('/user-register', [App\Http\Controllers\CustomerController::class, 'register'])->name('registerUser');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('register/store', [FormController::class, 'store'])->name('registration.store');

Auth::routes(['verify' => true]);
// Route::resource('/registration', FormController::class)->except([ 'edit', 'index','destroy', 'update', 'show']);


Route::post('/my-dashboard/myprofile/update-password', [App\Http\Controllers\PasswordController::class, 'change_password'])->name('password');
Route::post('/profile/image', [App\Http\Controllers\PasswordController::class, 'cropImage'])->name('crop');


Route::post('/property/add-to-favorite/{id}', [AddFavorite::class,'store'])->name('storeFav');
Route::post('/property/report-abuse/{id}', [AddFavorite::class, 'report'])->name('storeRep');
// Route::post('/property/comment/{id}', [CommentController::class, 'storeComment'])->name('storeCom');

Route::get('/all-properties/search', [FrontEndController::class, 'search'])->name('search');

 //comment


 //For ADMIN//
Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    //admin profile
    Route::namespace('App\Http\Controllers\Admin')->group(function(){
        Route::resource('/dashboard/admin-profile', MyProfileController::class)->except(['index', 'edit','create' ,'store', 'destroy']);
    });
    //admin dashboard
    Route::get('/dashboard',[GeneralController::class, 'dashboard'])->name('dashboard');

    //users management
    Route::namespace('App\Http\Controllers\Admin')->group(function(){
        Route::get('/dashboard/users/search', [GeneralController::class,'searchUser'])->name('searchUser');
        Route::post('/dashboard/users/active/{id}', [GeneralController::class, 'activeUser'])->name('activeUser');
        Route::resource('/dashboard/users', UserController::class)->except(['create']);
    });
    //clients management
    Route::get('/dahsboard/clients', [ClientController::class, 'index'])->name('agencies');
    Route::get('/dahsboard/clients/private', [ClientController::class, 'private'])->name('agencies.private');
    Route::get('/dahsboard/clients/agent', [ClientController::class, 'agent'])->name('agencies.agent');
    //properties management
    Route::post('/dashboard/all-properties/status/{id}', [GeneralController::class, 'statusProp'])->name('status');
    Route::get('/dashboard/all-properties/search', [GeneralController::class,'searchProp'])->name('searchProp');
    Route::post('/dashboard/all-properties/facility', [GeneralController::class, 'createPropType'])->name('propType');
    Route::namespace('App\Http\Controllers\Admin')->group(function(){
        Route::resource('/dashboard/all-properties', PropertiesController::class)->except(['update', 'edit','create' ,'store','destroy']);

    });
    // Route::get('/dashboard/favorites',[GeneralController::class, 'favorites'])->name('favAd');
    // Route::delete('/dashboard/favorites/{id}',[GeneralController::class, 'delFav'])->name('delFavAdmin');

    Route::get('/dashboard/reports',[GeneralController::class, 'reports'])->name('rep');
    Route::get('/dashboard/reports/filter',[ClientController::class, 'reports'])->name('filterRep');



    Route::get('/dashboard/testimonial',[GeneralController::class, 'testimonial'])->name('test');
    Route::post('/dashboard/testimonial/publish/{id}', [GeneralController::class, 'publish'])->name('publishTest');

    Route::delete('/dashboard/reports/{id}',[GeneralController::class, 'delReport'])->name('delReport');

});


//For AGENT//
Route::group(['middleware' => ['auth', 'isActive', 'isClient','verified']], function () {

    Route::get('/my-dashboard',[FormController::class, 'dashboard'])->name('my-dashboard');
    Route::get('/my-dashboard/contact-us', [FormController::class, 'contact'])->name('contactAge');
    Route::post('/my-dashboard/contact-us/sent', [FormController::class, 'sendMessage'])->name('sendConcern');
    Route::post('/my-dashboard/request/{id}', [FormController::class, 'request'])->name('requestInfo');


    Route::namespace('App\Http\Controllers\Agent')->group(function(){

        Route::resource('/my-dashboard/myprofile', MyProfileController::class)->except(['create', 'edit', 'index', 'store', 'destroy']);
        Route::resource('/my-dashboard/properties', PropertyController::class);
    });
    //Route::post('/my-dashboard/images', [App\Http\Controllers\Agent\PropertyController::class, 'propertyImage'])->name('imageUpload');
    Route::namespace('App\Http\Controllers\Agent')->group(function(){
        //Route::('/my-dashboard/images', [App\Http\Controllers\Agent\PropertyController::class, 'propertyImage'])->name('imageUpload');
        Route::post('/my-dashboard/properties/sort', [ImageController::class, 'sort'])->name('properties.sort');
        Route::get('/my-dashboard/properties/search', [ImageController::class, 'searchProp'])->name('properties.search');
        Route::post('/my-dashboard/properties/delete', [ImageController::class, 'deleteImage'])->name('deleteImage');
        Route::post('/my-dashboard/properties/publish/{id}', [ImageController::class, 'publishProp'])->name('publish');
        Route::post('/my-dashboard/properties/upload_image/{id}', [ImageController::class, 'uploadImage'])->name('upload.image');

    });
    Route::resource('/my-dashboard/agency', AgencyController::class)->except(['create', 'edit', 'index' ,'destroy']);
    Route::get('/my-dashboard/favorites',[FavController::class, 'favorites'])->name('favAge');
    Route::delete('/my-dashboard/favorites/{id}',[FavController::class, 'delFav'])->name('delFavAge');
    Route::get('/my-dashboard/reports/{id}',[FavController::class, 'repProp'])->name('repProp');
    Route::get('/my-dashboard/reports',[FavController::class, 'report'])->name('report');


});


