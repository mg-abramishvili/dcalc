<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Пользователи
Route::get('/users','App\Http\Controllers\UserController@index');

// Элементы
Route::get('/categories','App\Http\Controllers\ElementController@categories');
Route::get('/category/{id}/','App\Http\Controllers\ElementController@category_item');
Route::get('/category/{id}/elements','App\Http\Controllers\ElementController@category_elements');
Route::post('/categories','App\Http\Controllers\ElementController@categories_store');
Route::post('/category/{id}/edit','App\Http\Controllers\ElementController@category_edit');
Route::get('/category/{id}/delete','App\Http\Controllers\ElementController@category_delete');

Route::get('/elements','App\Http\Controllers\ElementController@elements');
Route::get('/elements/filter/box/{box_id}','App\Http\Controllers\ElementController@elements_filter_box');
Route::get('/element/{id}','App\Http\Controllers\ElementController@element_item');
Route::post('/elements','App\Http\Controllers\ElementController@elements_store');
Route::post('/element/{id}/edit','App\Http\Controllers\ElementController@element_edit');
Route::get('/element/{id}/delete','App\Http\Controllers\ElementController@element_delete');

// Корпуса
Route::get('/boxes','App\Http\Controllers\BoxController@boxes');
Route::get('/box/{id}','App\Http\Controllers\BoxController@box_item');
Route::get('/boxes/filter/{type_id}','App\Http\Controllers\BoxController@boxes_filter');
Route::post('/boxes','App\Http\Controllers\BoxController@boxes_store');
Route::post('/box/{id}/edit','App\Http\Controllers\BoxController@box_edit');
Route::get('/box/{id}/delete','App\Http\Controllers\BoxController@box_delete');

// Расчеты
Route::get('/calculations','App\Http\Controllers\CalculationController@index');
Route::get('/calculation/{id}','App\Http\Controllers\CalculationController@show');
Route::post('/calculations','App\Http\Controllers\CalculationController@store');
Route::post('/calculation/{id}/edit','App\Http\Controllers\CalculationController@edit');

// КП
Route::get('/offers','App\Http\Controllers\OfferController@index');
Route::get('/offer/{id}','App\Http\Controllers\OfferController@show');
Route::post('/offers','App\Http\Controllers\OfferController@store');

// Задачи
Route::get('/tasks','App\Http\Controllers\TaskController@index');
Route::post('/tasks','App\Http\Controllers\TaskController@store');

// Новости
Route::get('/announcements','App\Http\Controllers\AnnouncementController@index');
Route::post('/announcements','App\Http\Controllers\AnnouncementController@store');

// Типы
Route::get('/types','App\Http\Controllers\TypeController@index');

// Коммерческие предложения
Route::get('/offers','App\Http\Controllers\OfferController@index');