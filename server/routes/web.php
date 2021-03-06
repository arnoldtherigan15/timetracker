<?php

use App\Http\Controllers\Admin\BuddyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\ScoreController;
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
    return view('auth.login');
});

/**
 * route for admin
 */

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {
        
        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        

        Route::resource('/buddy', BuddyController::class, ['as' => 'admin']);
        Route::get('/buddy/log-time/{buddy}', [BuddyController::class, 'logTime'])->name('admin.buddy.logTime');
        Route::get('/buddy-compare', [BuddyController::class, 'compare'])->name('admin.buddy.compare');

        Route::get('/importBuddy', [BuddyController::class, 'importExportView'])->name('admin.buddy.showImport');
        Route::post('/importBuddy', [BuddyController::class, 'import'])->name('admin.buddy.import');

        Route::get('/time', [TimeController::class, 'index'])->name('admin.time.index');
        Route::get('/time/export', [TimeController::class, 'export'])->name('admin.time.export.all');
        Route::get('/time/{buddy}', [TimeController::class, 'detail'])->name('admin.time.detail');
        Route::get('/time/{buddy}/export', [TimeController::class, 'exportByBuddyId'])->name('admin.time.export');

        
        Route::prefix('score')->group(function () {
            Route::get('/buddy/{buddy}', [ScoreController::class, 'index'])->name('admin.buddy.score');
            Route::get('/buddy/report/{id}', [ScoreController::class, 'generateReport'])->name('admin.buddy.score.report-pdf');
        });

    });
});
