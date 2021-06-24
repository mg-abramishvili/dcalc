<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/me', 'App\Http\Controllers\AuthController@me')->middleware('auth:sanctum');

// Пользователи
Route::get('/users','App\Http\Controllers\UserController@index')->middleware('auth:sanctum');
Route::get('/user/{id}','App\Http\Controllers\UserController@user_item')->middleware('auth:sanctum');
Route::post('/users','App\Http\Controllers\UserController@users_store')->middleware('auth:sanctum');
Route::post('/user/{id}/edit','App\Http\Controllers\UserController@user_edit')->middleware('auth:sanctum');

// Проекты
Route::get('/projects','App\Http\Controllers\ProjectController@projects');
Route::get('/project/{id}','App\Http\Controllers\ProjectController@project_item');
Route::post('/projects','App\Http\Controllers\ProjectController@projects_store');

// Клиенты
Route::get('/clients','App\Http\Controllers\ClientController@clients');
Route::post('/clients','App\Http\Controllers\ClientController@clients_store');

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
Route::post('/box/file_upload','App\Http\Controllers\BoxController@file_upload');

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

// Счетчики
Route::get('/counter_users','App\Http\Controllers\CounterController@user_count');
Route::get('/counter_projects','App\Http\Controllers\CounterController@project_count');
Route::get('/counter_clients','App\Http\Controllers\CounterController@client_count');