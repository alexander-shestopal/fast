<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', 'buy');
Auth::routes();

Route::get('/buy', [PageController::class, 'pageBuy'])->name('page.buy');
Route::get('/download', [PageController::class, 'pageDownload'])->name('download');
Route::get('/click/buy', [PageController::class, 'click']);
Route::get('/click/download', [PageController::class, 'download']);
Route::get('/report', [PageController::class, 'report'])->name('report')->middleware(['onlyAdmin']);
Route::get('/statistic', [PageController::class, 'statistic'])->name('statistic')->middleware(['onlyAdmin']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware(['auth']);


