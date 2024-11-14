<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\UserController;
use App\Models\User;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route User
Route::get('tiket', [ProductController::class, 'index'])->name('admin');
Route::get('tiket/Edit/{id}/', [ProductController::class, 'edit']);
Route::post('tiket/Store', [ProductController::class, 'store']);
Route::get('tiket/Delete/{id}', [ProductController::class, 'destroy']);
Route::get('tiket/Detail/{id}', [ProductController::class, 'showDetail']);


// Route Admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
});
Route::get('/', function () {
    return redirect('/admin');
})->middleware('auth');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('admin/Edit/{id}/', [AdminController::class, 'edit']);
Route::post('admin/Store/', [AdminController::class, 'store']);
Route::get('admin/Delete/{id}', [AdminController::class, 'destroy']);
Route::get('admin/Detail/{id}', [AdminController::class, 'showDetail']);
Route::get('admin/Done', [AdminController::class, 'done']);
Route::get('admin/download-done-excel', [AdminController::class, 'downloadDoneExcel'])->name('admin.download-done-excel');

// Route User
Route::get('user', [UserController::class, 'index'])->name('user');
Route::get('user/Edit/{id}/', [UserController::class, 'edit'])->name('user.edit');
Route::post('user/Store/', [UserController::class, 'store'])->name('user.store');
Route::get('user/Detail/{id}', [UserController::class, 'showDetail']);
Route::get('user/Delete/{id}', [UserController::class, 'destroy']);

Route::get('/test', function () {
    return view('admin.index');
});

// tambahkan route baru
Route::get('/mail/send', function () {
    $data = [
        'subject' => 'Testing Kirim Email',
        'title' => 'Testing Kirim Email',
        'body' => 'Ini adalah email uji coba dari Tutorial Laravel: Send Email Via SMTP.'
    ];

    try {
        Mail::to('hidayatulnasution2@gmail.com')->send(new SendEmail($data));
        return "Email successfully sent!";
    } catch (\Exception $e) {
        return "Failed to send email. Error: " . $e->getMessage();
    }
});




// Route::get('/', function () {
//     return redirect('/dashboard');
// })->middleware('auth');
// Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
// Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
// Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
// Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
// Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
// Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
// Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
// Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
//     Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
//     Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
//     Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
//     Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
//     Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
//     Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
//     Route::get('/{page}', [PageController::class, 'index'])->name('page');
//     Route::post('logout', [LoginController::class, 'logout'])->name('logout');
// });
