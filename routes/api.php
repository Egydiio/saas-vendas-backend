<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/deubom', function () {
    return 'deu bom dms';
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
