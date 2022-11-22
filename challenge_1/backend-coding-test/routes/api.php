<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test',function () {
    dd("test");
});

Route::group([
    'prefix' => 'v1'
], function () {
    Route::apiResource('/employee', EmployeeController::class)->names('employee');

    Route::apiResource('/attendance', AttendanceController::class)->names('attendance');

    Route::post('/import_excel/import', [AttendanceController::class,'import']);

    Route::get('/tot_times/employees', [AttendanceController::class,'showTotHours']);
});
