<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// las rutas  Specialty

Route::middleware(['auth', 'admin'])->namespace('logicBussines\Admin')->group(function () {
    Route::get('/specialties','SpecialtyController@index');
    Route::get('/specialties/create','SpecialtyController@create');
    Route::get('/specialties/{specialty}/edit','SpecialtyController@edit');
    Route::post('/specialties','SpecialtyController@store');
    Route::put('/specialties/{specialty}','SpecialtyController@update');
    Route::delete('/specialties/{specialty}/destroy','SpecialtyController@destroy');

//las rutas Doctors
    Route::resource('doctors','DoctorController');

//Patients
    Route::resource('patients','PatientController');
});


Route::middleware(['auth','doctor'])->namespace('logicBussines\Doctor')->group(function () {
    Route::get('/schedule','ScheduleController@edit');
    Route::post('/schedule','ScheduleController@store');
});

Route::middleware(['auth',])->namespace('logicBussines')->group(function () {
    Route::get('/appointments/create','AppointmentController@create');
    Route::post('/appointments','AppointmentController@store');
    Route::get('/appointments','AppointmentController@index');
    Route::put('/appointments/{appointment}/cancel','AppointmentController@cancel');
    Route::get('/appointments/{appointment}/cancel','AppointmentController@showCancel');
//Json

    Route::get('/specialties/{specialty}/doctors','Api\SpecialtyController@doctors');
    Route::get('/schedule/hours','Api\ScheduleController@hours');
});




