<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\OptionsController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('users-page');

Route::prefix('admin')->group(function () {
    Route::namespace('Admin')->as('admin.')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin-login');
        Route::post('login', [AuthController::class, 'postFormLogin'])->name('admin-post-login');
        Route::middleware(['AdminAuth'])->group(function () {
            Route::post('logout', [AuthController::class, 'logout'])->name('admin-logout');
            Route::get('dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::get('/', [UserController::class, 'index'])->name('users-list');
                Route::get('/create', [UserController::class, 'create'])->name('users-create');
                Route::post('/store', [UserController::class, 'store'])->name('users-store');
                Route::get('/edit/{user_id}', [UserController::class, 'edit'])->name('users-edit');
                Route::post('/update/{user_id}', [UserController::class, 'update'])->name('users-update');
                Route::post('/destroy/{user_id}', [UserController::class, 'destroy'])->name('users-destroy');
            });
            Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('categories-list');
                Route::get('/create', [CategoriesController::class, 'create'])->name('categories-create');
                Route::post('/store', [CategoriesController::class, 'store'])->name('categories-store');
                Route::get('/edit/{category_id}', [CategoriesController::class, 'edit'])->name('categories-edit');
                Route::post('/update/{category_id}', [CategoriesController::class, 'update'])->name('categories-update');
                Route::post('/destroy/{category_id}', [CategoriesController::class, 'destroy'])->name('categories-destroy');
            });
            Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
                Route::get('/', [PostsController::class, 'index'])->name('posts-list');
                Route::get('/create', [PostsController::class, 'create'])->name('posts-create');
                Route::post('/store', [PostsController::class, 'store'])->name('posts-store');
                Route::get('/edit/{post_id}', [PostsController::class, 'edit'])->name('posts-edit');
                Route::post('/update/{post_id}', [PostsController::class, 'update'])->name('posts-update');
                Route::post('/destroy/{post_id}', [PostsController::class, 'destroy'])->name('posts-destroy');
                Route::post('/change-always-show', [PostsController::class, 'changeAlwaysShow'])->name('changeAlwaysShow');
            });
            Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
                Route::get('/', [PostsController::class, 'getPagesList'])->name('pages-list');
                Route::get('/create', [PostsController::class, 'createPage'])->name('pages-create');
                Route::post('/store', [PostsController::class, 'store'])->name('pages-store');
                Route::get('/edit/{post_id}', [PostsController::class, 'edit'])->name('pages-edit');
                Route::post('/update/{post_id}', [PostsController::class, 'update'])->name('pages-update');
                Route::post('/destroy/{post_id}', [PostsController::class, 'destroy'])->name('pages-destroy');
            });
            Route::group(['prefix' => 'options', 'as' => 'options.'], function () {
                Route::get('/', [OptionsController::class, 'index'])->name('options-list');
                Route::get('/create', [OptionsController::class, 'create'])->name('options-create');
                Route::post('/store', [OptionsController::class, 'store'])->name('options-store');
                Route::get('/edit/{option_id}', [OptionsController::class, 'edit'])->name('options-edit');
                Route::post('/update/{option_id}', [OptionsController::class, 'update'])->name('options-update');
                Route::post('/destroy/{option_id}', [OptionsController::class, 'destroy'])->name('options-destroy');
            });
            Route::group(['prefix' => 'languages', 'as' => 'languages.'], function () {
                Route::get('/', [LanguagesController::class, 'index'])->name('languages-list');
                Route::get('/create', [LanguagesController::class, 'create'])->name('languages-create');
                Route::post('/store', [LanguagesController::class, 'store'])->name('languages-store');
                Route::get('/edit/{language_id}', [LanguagesController::class, 'edit'])->name('languages-edit');
                Route::post('/update/{language_id}', [LanguagesController::class, 'update'])->name('languages-update');
                Route::post('/destroy/{language_id}', [LanguagesController::class, 'destroy'])->name('languages-destroy');
            });
            Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
                Route::get('/', [ContactsController::class, 'index'])->name('contacts-list');
                Route::get('/create', [ContactsController::class, 'create'])->name('contacts-create');
                Route::post('/store', [ContactsController::class, 'store'])->name('contacts-store');
            });
        });
    });
});
