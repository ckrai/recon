<?php
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Headers:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check/login', [AuthController::class, 'checkLogin']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/get-survey-list', [SurveyController::class, 'getSurveyList']);
Route::post('/get-survey-list', [SurveyController::class, 'getSurveyList']);

Route::get('/get-survey', [SurveyController::class, 'getSurvey']);
Route::post('/get-survey', [SurveyController::class, 'getSurvey']);
Route::post('/dashboard', [SurveyController::class, 'dashboard']);
Route::get('/createSurvey', [SurveyController::class, 'createSurvey']);
Route::post('/createSurvey', [SurveyController::class, 'createSurvey']);
Route::post('/submit-answer', [SurveyController::class, 'submitAnswers']);

Route::post('uploads', [SurveyController::class, 'uploads']);
Route::post('images/all',[SurveyController::class, 'imagesAll']);





//Route::post('/me', [AuthController::class, 'me']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
