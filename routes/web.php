<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
   ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/glav', [Controller\Site::class, 'glav'])
->middleware('auth');
Route::add('GET', '/dis', [Controller\Site::class, 'dis'])
->middleware('auth');
Route::add('GET', '/check', [Controller\Site::class, 'check'])
->middleware('auth');
Route::add(['GET', 'POST'], '/pod', [Controller\Site::class, 'pod'])
->middleware('auth');
Route::add('GET', '/sot', [Controller\Site::class, 'sot'])
->middleware('auth', 'admin');
Route::add('GET', '/add_sot', [Controller\Site::class, 'add_sot'])
    ->middleware('auth');

