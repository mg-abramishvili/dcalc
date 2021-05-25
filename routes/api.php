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
Route::post('/elements','App\Http\Controllers\ElementController@store');
Route::get('/elements_count','App\Http\Controllers\ElementController@elements_count');
Route::post('/ecategory_create','App\Http\Controllers\ElementController@store_ecategory');
Route::post('/ecategory_edit/{id}','App\Http\Controllers\ElementController@edit_ecategory');

// Расчеты
Route::get('/calculations','App\Http\Controllers\CalculationController@index');
Route::get('/calculation/{id}','App\Http\Controllers\CalculationController@show');
Route::post('/calculations','App\Http\Controllers\CalculationController@store');
Route::get('/calculations_count','App\Http\Controllers\CalculationController@index_count');

// КП
Route::get('/offers','App\Http\Controllers\OfferController@index');
Route::get('/offer/{id}','App\Http\Controllers\OfferController@show');
Route::post('/offers','App\Http\Controllers\OfferController@store');
Route::get('/offers_count','App\Http\Controllers\OfferController@index_count');

// Задачи
Route::get('/tasks','App\Http\Controllers\TaskController@index');
Route::post('/tasks','App\Http\Controllers\TaskController@store');

// Новости
Route::get('/announcements','App\Http\Controllers\AnnouncementController@index');
Route::post('/announcements','App\Http\Controllers\AnnouncementController@store');

// Коммерческие предложения
Route::get('/offers','App\Http\Controllers\OfferController@index');