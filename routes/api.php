<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleAndPermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);
Route::middleware('auth:api')->post('/logout', [LoginController::class, 'logout']);



Route::post('/roles', [RoleAndPermissionController::class, 'createRole']);
Route::put('/roles/{id}', [RoleAndPermissionController::class, 'updateRole']);
Route::delete('/roles/{id}', [RoleAndPermissionController::class, 'deleteRole']);
Route::get('/roles', [RoleAndPermissionController::class, 'listRoles']);


Route::post('/permissions', [RoleAndPermissionController::class, 'createPermission']);
Route::put('/permissions/{id}', [RoleAndPermissionController::class, 'updatePermission']);
Route::delete('/permissions/{id}', [RoleAndPermissionController::class, 'deletePermission']);
Route::get('/permissions', [RoleAndPermissionController::class, 'listPermissions']);


Route::post('/roles/assign', [RoleAndPermissionController::class, 'assignRole']);
Route::post('/roles/revoke', [RoleAndPermissionController::class, 'revokeRole']);

Route::post('/roles/permissions/give', [RoleAndPermissionController::class, 'givePermissionToRole']);
Route::post('/roles/permissions/revoke', [RoleAndPermissionController::class, 'revokePermissionFromRole']);

Route::post('/user/check-access', [RoleAndPermissionController::class, 'checkUserAccess']);