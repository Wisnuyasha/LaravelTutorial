<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutPage;
use App\Http\Controllers\Home\HomeSliderController;
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

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware('auth')->name('dashboard');

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

Route::controller(HomeSliderController::class)->group(function() {
    Route::get('/home/slide', 'HomeSlide')->name('home.slide');
    Route::post('/update/slide', 'UpdateSlide')->name('update.slide');
    Route::get('/home/about', 'HomeAbout')->name('home.about');
    Route::post('/update/about', 'UpdateAbout')->name('update.about');
});

Route::controller(AboutPage::class)->group(function(){
    Route::get('/about/page', 'AboutPage')->name('about.page');
    Route::get('/about/multi/image', 'AboutMulti')->name('about.multi.image');
    Route::post('/store/multi/image', 'StoreMulti')->name('update.multi.image');
    Route::get('/all/multi/image', 'AllMulti')->name('all.multi.image');
});



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';


// laravel 8
// Route::get('/about',
//     [DemoController::class, 'Index']
// );
// Route::get('/contact',
//     [DemoController::class, 'Contact']
// );

// laravel 9
// Route::controller(DemoController::class)->group(function () {
//     Route::get('/about', 'Index')->name('about.page')->middleware('check');
//     Route::get('/contact', 'Contact')->name('contact.page');
// });