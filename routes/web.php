<?php

use App\Http\Controllers\AdminVideoController;
use App\Http\Controllers\PageAdminDashboardController;
use App\Http\Controllers\PageCourseDetailsController;
use App\Http\Controllers\PageDashboardController;
use App\Http\Controllers\PageHomeController;
use App\Http\Controllers\PageVideosController;
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

Route::get('/', PageHomeController::class)->name('pages.home');

Route::get('courses/{course:slug}', PageCourseDetailsController::class)
    ->name('pages.course-details');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', PageDashboardController::class)->name('pages.dashboard');
    Route::get('videos/{course:slug}/{video:slug?}', PageVideosController::class)
        ->name('pages.course-videos');

    //////ADMIN
//    Route::get('/admin-dashboard', PageAdminDashboardController::class)->name('pages.admin-dashboard');
//    Route::resource('admin/videos', AdminVideoController::class);

//    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
//        ->group(function () {
//            Route::get('/admin-dashboard', [PageAdminDashboardController::class, '__invoke'])->name('pages.admin-dashboard');
//            Route::resource('admin/videos', AdminVideoController::class);
//        });
        Route::get('/admin-dashboard', PageAdminDashboardController::class)->name('pages.admin-dashboard');
        Route::resource('/admin/videos', AdminVideoController::class)->names('admin.videos');
});

Route::webhooks('webhooks');
