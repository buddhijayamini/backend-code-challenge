<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\Attendance\Application\AttendanceController as ApplicationAttendanceController;

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
    return view('welcome');
});

Route::get('/import_excel', [AttendanceController::class,'viewExcel']);
Route::post('/import_excel/import', [AttendanceController::class,'importView']);

Route::get('/view_excel', [ApplicationAttendanceController::class,'index']);
Route::get('/view_total_works', [AttendanceController::class,'viewTotHours']);
Route::post('/store_excel', [ApplicationAttendanceController::class,'store']);
