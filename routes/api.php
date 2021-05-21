<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Пользователи
Route::get('/users','App\Http\Controllers\UserController@index');

// Элементы
Route::get('/element-categories','App\Http\Controllers\ElementController@categories');
Route::get('/element-category/{id}','App\Http\Controllers\ElementController@category_item');
Route::get('/elements','App\Http\Controllers\ElementController@elements');
Route::get('/elements/category/{id}','App\Http\Controllers\ElementController@category_elements');

// Расчеты
Route::get('/calculations','App\Http\Controllers\CalculationController@index');
Route::get('/calculation/{id}','App\Http\Controllers\CalculationController@show');
Route::post('/calculations','App\Http\Controllers\CalculationController@store');

// КП
Route::get('/offers','App\Http\Controllers\OfferController@index');
Route::get('/offer/{id}','App\Http\Controllers\OfferController@show');
Route::post('/offers','App\Http\Controllers\OfferController@store');

// Коммерческие предложения
Route::get('/offers','App\Http\Controllers\OfferController@index');