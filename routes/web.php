<?php

use App\Core\Route;

Route::add('get', '/', function () {
});

Route::get('/form', function () {
    echo 'form called';
});

Route::post('/saveForm', function () {
});

Route::get('/articles','ArticleController@index');
Route::get('/articles/create','ArticleController@create');
