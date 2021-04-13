<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Пользователи
Route::get('/users','App\Http\Controllers\UserController@index');

// Элементы
Route::get('/elements','App\Http\Controllers\ElementController@index');

// Расчеты
Route::get('/calculations','App\Http\Controllers\CalculationController@index');
Route::get('/calculation/{id}','App\Http\Controllers\CalculationController@show');
Route::post('/calculations','App\Http\Controllers\CalculationController@store');

// Коммерческие предложения
Route::get('/offers','App\Http\Controllers\OfferController@index');