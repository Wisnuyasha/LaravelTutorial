<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutPage;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Demo\DemoController;
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


Route::controller(DemoController::class)->group(function () {
    Route::get('/', 'HomeMain')->name('home');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function (){
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');
    });
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
    Route::post('/store/multi/image', 'StoreMulti')->name('store.multi.image');
    Route::get('/all/multi/image', 'AllMulti')->name('all.multi.image');
    Route::get('/edit/multi/image/{id}', 'EditMulti')->name('edit.multi.image');
    Route::post('/update/multi/image', 'UpdateMulti')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}', 'DeleteMulti')->name('delete.multi.image');
});

Route::controller(PortfolioController::class)->group(function() {
    Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');
    Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');
    Route::post('/store/portfolio', 'StorePortfolio')->name('store.portfolio');
    Route::get('/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio', 'UpdatePortfolio')->name('update.portfolio');
    Route::get('/delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');
    
    Route::get('/portfolio', 'HomePortfolio')->name('home.portfolio');
    Route::get('/details/portfolio/{id}', 'DetailsPortfolio')->name('details.portfolio');
});

Route::controller(BlogCategoryController::class)->group(function() {
    Route::get('/all/blog/category','AllBlogCategory')->name('all.blog.category');
    Route::get('/add/blog/category','AddBlogCategory')->name('add.blog.category');
    Route::post('/store/blog/category','StoreBlogCategory')->name('store.blog.category');
    Route::get('/edit/blog/category/{id}', 'EditBlogCategory')->name('edit.blog.category');
    Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
    Route::post('/update/blog/category/{id}', 'UpdateBlogCategory')->name('update.blog.category');
});

Route::controller(BlogController::class)->group(function() {
    Route::get('/all/blog', 'AllBlog')->name('all.blog');
    Route::get('/add/blog', 'AddBlog')->name('add.blog');
    Route::post('/store/blog', 'StoreBlog')->name('store.blog');
    Route::get('/edit/blog/{id}', 'EditBlog')->name('edit.blog');
    Route::post('/update/blog', 'UpdateBlog')->name('update.blog');
    Route::get('/delete/blog/{id}', 'DeleteBlog')->name('delete.blog');

    Route::get('/blog/details/{id}', 'BlogDetails')->name('blog.details');
    Route::get('/category/blog/{id}', 'CategoryBlog')->name('category.blog');
    Route::get('/blog', 'HomeBlog')->name('home.blog');

});

Route::controller(FooterController::class)->group(function() {
    Route::get('/footer/setup', 'FooterSetup')->name('footer.setup');
    Route::post('/update/footer=', 'UpdateFooter')->name('update.footer');
});

Route::controller(ContactController::class)->group(function() {
    Route::get('/contact', 'Contact')->name('contact.me');
    Route::post('/store/message', 'StoreMessage')->name('store.message');

    Route::get('/contact/message', 'ContactMessage')->name('contact.message');
    Route::get('/delete/message/{id}', 'DeleteMessage')->name('delete.message');
});


require __DIR__.'/auth.php';