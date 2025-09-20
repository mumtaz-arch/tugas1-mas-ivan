<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/example', function () {
// 	return 'This is an example route';
// });

// Route::get('/example2', function () {
// 	return 'This is another example route';
// });

// Route::get('/example2', [App\Http\Controllers\ExampleController::class, 'index']);


Route::get('/example2/{id}', [App\Http\Controllers\ExampleController::class,'index']);

Route::get('/users',[
	App\Http\Controllers\UserController::class,'index'
]);

Route::get('/posts',[
	App\Http\Controllers\PostController::class,'index'
]);

Route::resource('posts', App\Http\Controllers\PostController::class);