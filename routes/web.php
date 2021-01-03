<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', [ContactController::class, 'index']);

//Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table("users")->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
