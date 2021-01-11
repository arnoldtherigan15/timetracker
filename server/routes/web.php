<?php

use App\Http\Controllers\Admin\BuddyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TimeController;
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

        Route::get('/importBuddy', [BuddyController::class, 'importExportView'])->name('admin.buddy.showImport');
        Route::post('/importBuddy', [BuddyController::class, 'import'])->name('admin.buddy.import');

        Route::get('/time', [TimeController::class, 'index'])->name('admin.time.index');
        Route::get('/time/{buddy}', [TimeController::class, 'detail'])->name('admin.time.detail');
    });
});
