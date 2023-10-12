<?php

use App\Core\Route;

Route::add('get', '/', function () {
});

Route::get('/form', function () {
});

Route::post('/saveForm', function () {
});


dd(Route::routes());