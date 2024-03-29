<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePass;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home',compact('brands','abouts','images'));
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', [ContactController::class, 'index']);

//Categories Route
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/category/remove/{id}', [CategoryController::class, 'Remove']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/delete/{id}', [CategoryController::class, 'Delete']);

//Brands Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/store', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

//Multi Images Route
Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/store', [BrandController::class, 'StoreImg'])->name('store.image');

//Slider Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/slider/add', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/slider/store', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'EditSlider'])->name('edit.slider');
Route::get('/slider/delete/{id}', [HomeController::class, 'DeleteSlider']);
Route::post('/slider/update/{id}', [HomeController::class, 'UpdateSlider']);

//Home About Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/about/add', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/about/store', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/about/update/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);

//Portofolio Page Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');

//Contact Page Route
Route::get('admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('admin/contact/add', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('admin/contact/store', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('admin/contact/edit/{id}', [ContactController::class, 'AdminEditContact']);
Route::post('admin/contact/update/{id}', [ContactController::class, 'AdminUpdateContact']);
Route::get('admin/contact/delete/{id}', [ContactController::class, 'AdminDeleteContact']);

Route::get('admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('admin/message/delete/{id}', [ContactController::class, 'AdminDeleteMessage']);


//Contact Page Route
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
   // $users = DB::table("users")->get();
    return view('admin.index');
})->name('dashboard');



Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');


//Change Password in User Profile
Route::get('/user/password', [ChangePass::class, 'ChangePassword'])->name('change.password');
Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');

//User Profile
Route::get('/profile/update', [ChangePass::class, 'ProfileUpdate'])->name('profile.update');
Route::post('user/profile/update', [ChangePass::class, 'UpdateUser'])->name('update.user.profile');
