<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CheckLogController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RegisterForgetController;
use App\Http\Controllers\Admin\RegisterLeaveController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\WorkSheetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegisterLateEarlyController;
use App\Http\Controllers\RegisterOverTimeController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')
    ->middleware(['api'])
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('/login', 'login');
        Route::delete('/logout', 'logout');
        Route::put('/change-pass', 'changePassWord');
    });

Route::prefix('member')
    ->middleware(['checkAuth'])
    ->controller(MemberController::class)
    ->group(function () {
        Route::get('profile', 'edit');
        Route::put('profile/update', 'update');
    });

Route::prefix('notifications')
    ->middleware(['checkAuth'])
    ->controller(NotificationController::class)
    ->group(function () {
        Route::get('/', 'getListNotification');
        Route::get('/detail/{noticeId}', 'getNoticeDetail');
        Route::get('/download/{file}', 'downloadFileAttachment');
    });

Route::prefix('worksheet')
    ->middleware(['checkAuth'])
    ->group(function () {
        Route::get('my-timesheet', [WorkSheetController::class, 'list']);
        Route::get('/checkLogs', [CheckLogController::class, 'getTimeLogs']);
        Route::get('{id}', [WorkSheetController::class, 'getRequest']);
        Route::get('/getByDate/{work_date}', [RegisterLateEarlyController::class, 'getWorksheetByWorkDate']);
    });

Route::prefix('worksheet/request/LateEarly')
    ->middleware(['checkAuth'])
    ->controller(RegisterLateEarlyController::class)
    ->group(function () {
        Route::post('/create', 'createRequestLateEarly');
        Route::put('/update', 'updateRequestLateEarly');
    });

Route::prefix('worksheet/request/OverTime')
    ->middleware(['checkAuth'])
    ->controller(RegisterOverTimeController::class)
    ->group(function () {
        Route::post('/create', 'createRequestOverTime');
        Route::put('/update', 'updateRequestOverTime');
    });


Route::prefix('worksheet/request/forget')
    ->middleware(['checkAuth'])
    ->controller(RegisterForgetController::class)
    ->group(function () {
        Route::post('create', 'createForget');
        Route::put('update', 'updateForget');
    });

Route::prefix('worksheet/request/leave')
    ->middleware(['checkAuth'])
    ->controller(RegisterLeaveController::class)
    ->group(function () {
        Route::post('create', 'createLeave');
        Route::put('update', 'updateLeave');
    });

Route::prefix('permission')
    ->middleware(['checkAuth', 'authorization:admin'])
    ->controller(PermissionController::class)
    ->group(function () {
        Route::get('', 'list');
        Route::post('create', 'create');
        Route::put('update/{id}', 'update');
        Route::delete('delete/{id}', 'delete');
    });

Route::prefix('role')
    ->middleware(['checkAuth', 'authorization:admin'])
    ->controller(RoleController::class)
    ->group(function () {
        Route::post('add-permission/{id}', 'addPermission');
        Route::put('update-permission/{id}', 'updatePermission');
        Route::delete('delete-permission/{id}', 'deletePermission');
    });

Route::prefix('manager')
    ->middleware(['checkAuth', 'authorization:manager'])
    ->controller(ManagerController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/show/{id}', 'show');
        Route::put('/confirm/{id}', 'update');
    });

Route::prefix('admin')
    ->middleware(['checkAuth', 'authorization:admin'])
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/show/{id}', 'show');
        Route::put('/approve/{id}', 'update');
    });
