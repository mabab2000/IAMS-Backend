<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;

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
Route::middleware(['auth:sanctum'])->group(function () {
Route::get('track/{id}',[RequestsController::class,'track']);
Route::post('add-request',[RequestsController::class,'store']); 
Route::get('request_in_department/{id}',[RequestsController::class,'req_in_dep']);
Route::post('role',[UserController::class,'attachRoleToUser']);
Route::post('add_role',[RoleController::class,'store']);
Route::put('update_role/{id}',[RoleController::class,'role_update']);
Route::get('delete_role/{id}',[RoleController::class,'role_delete']);

Route::put('update_department/{id}',[DepartmentController::class,'department_update']);

Route::post('store-student',[StudentsController::class,'store_student']);
Route::get('view_student',[StudentsController::class,'student_view']);
Route::put('update_student/{id}',[StudentsController::class,'student_update']);
Route::get('delete_student/{id}',[StudentsController::class,'student_delete']);

Route::put('update_user/{id}',[UserController::class,'user_update']);

Route::post('add-request',[RequestsController::class,'store']); 
Route::put('assign-request-to-department/{id}',[RequestsController::class,'request_department_update']);
Route::get('view_department',[DepartmentController::class,'department_view']);

Route::put('dep-descision/{id}',[RequestsController::class,'dep_descision']);
Route::get('all_request_in_department/{id}',[RequestsController::class,'all_req_in_dep']);
Route::get('request_in_department/{id}',[RequestsController::class,'req_in_dep']);
Route::get('view_user/{id}',[UserController::class,'user_oneview']);


Route::get('vieww_role',[RoleController::class,'role_vieww']);
Route::get('trackk',[RequestsController::class,'trackk']);
Route::post('logout',[AuthController::class,'logout']);
Route::post('file-upload',[FileUploadController::class,'FileUpload']);
Route::get('track/{id}',[RequestsController::class,'track']);
Route::get('view_request',[RequestsController::class,'view_request']);
Route::get('view_user',[UserController::class,'user_view']);
Route::put('assign-user-to-department',[UserController::class,'user_department_update']);
Route::get('reception_view_pending_request',[RequestsController::class,'reception_view_request']); 
});
Route::post('add_department',[DepartmentController::class,'store']);
Route::post('add_user',[UserController::class,'store']);
Route::post('login',[AuthController::class,'login']);
Route::get('view_role',[RoleController::class,'role_view']);
Route::put('forgot',[UserController::class,'forgotPassword']);
Route::get('view_user_email',[UserController::class,'user_check_email']);
Route::get('department/{id}',[DepartmentController::class,'department']);
Route::get('delete_user/{id}',[userController::class,'user_delete']);
Route::get('delete_request/{id}',[RequestsController::class,'delete_request']);
Route::get('delete_department/{id}',[DepartmentController::class,'department_delete']);
Route::put('assign_role_to_user',[RoleController::class,'assign_role']);

