<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/logout', function () {
    \Auth::logout();
    return view('auth.login');
});

 




Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function () {
    return view('profile.show');
})->name('profile');

// Route::middleware(['auth:sanctum', 'verified'])->get('/surveyors', function () {
//     return view('surveyors');
// })->name('surveyors');

 
Route::middleware(['auth:sanctum', 'verified'])->get('/surveys','HomeController@surveys')->name('surveys');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard','HomeController@dashboard')->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/surveyors','HomeController@surveyors')->name('surveyors');
Route::middleware(['auth:sanctum', 'verified'])->post('/surveyors','HomeController@storeSurveyors')->name('surveyors');
Route::middleware(['auth:sanctum', 'verified'])->post('/surveys','HomeController@storeSurvey')->name('surveys');
Route::middleware(['auth:sanctum', 'verified'])->get('/delete_survey/{auth_token}','HomeController@deleteSurvey')->name('delete_survey');

Route::middleware(['auth:sanctum', 'verified'])->get('login_access/{status}/{id}','HomeController@loginAccess')->name('login_access');


Route::middleware(['auth:sanctum', 'verified'])->get('/management','HomeController@management')->name('management');
Route::middleware(['auth:sanctum', 'verified'])->post('/management','HomeController@storeManagement')->name('management');


Route::middleware(['auth:sanctum', 'verified'])->get('settings','HomeController@settings')->name('settings');
Route::middleware(['auth:sanctum', 'verified'])->post('settings','HomeController@storeSettings')->name('settings');



Route::get('/policy', 'HomeController@policy');

Route::get('/service', 'HomeController@service');
Route::get('/generate-csv', 'HomeController@generateCsv');
Route::get('/generate-csv-filter', 'HomeController@generateCsvFilter');
Route::get('/user-report', 'HomeController@surveyorsReport');
Route::get('/generate-survey-file', 'HomeController@generateSurveyFile');
Route::get('/generate-survey-file-by-date', 'HomeController@generateSurveyFileByDate');


Route::get('/send-survey-email', 'HomeController@sendSurveyEmail');

