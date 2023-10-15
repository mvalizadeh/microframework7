<?php

use App\Core\Route;
use App\Middleware\BlockFirefox;

Route::add('get', '/', function () {
});

Route::get('/form', function () {
    echo 'form called';
});

Route::post('/saveForm', function () {
});

Route::get('/articles','ArticleController@index',[BlockFirefox::class]);
Route::get('/articles/create','ArticleController@create');
