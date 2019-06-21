<?php

use Illuminate\Http\Request;


Route::apiResource('users', 'AdminApi\UserController');
Route::apiResource('roles', 'AdminApi\RoleController');
Route::apiResource('permissions', 'AdminApi\PermissionController');
Route::apiResource('blogs', 'BlogController')->middleware('auth');

Route::post('blogs/{blog}/update-image', 'BlogController@updateFeaturedImage')->middleware('auth');

Route::apiResource('categories', 'CategoryController')->middleware('auth');
Route::get('activities/{userId?}', 'AdminApi\ActivityController@index');

