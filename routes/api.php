<?php

use Illuminate\Support\Facades\Route;

Route::get('pruebita', function () {
    return response()->json(['msg' => 'API FUNCIONA']);
});
