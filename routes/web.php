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
    return view('dashboard');
})->name('home')->middleware('auth');

Auth::routes();


// Routes Protected by Autb middleware
Route::group(['middleware' => 'auth'], function() {
    
    // Questions
    Route::delete('surveys/{sid}/questions/{qid}', 'QuestionController@destroy');
    Route::match(['put', 'patch'], 'surveys/{sid}/questions/{qid}', 'QuestionController@update');
    Route::get('surveys/{sid}/questions/{qid}/edit', 'QuestionController@edit');
    Route::get('surveys/{sid}/questions', 'QuestionController@create');
    Route::post('surveys/{sid}/questions', 'QuestionController@store');
    Route::get('surveys/statistics', 'SurveysController@statistics')->name('surveys.statistics');

    /* Surveys */
    Route::resource('surveys', 'SurveysController', ['except', 'show']);
    // Route::get('/surveys/{sid}/start', 'SurveysController@start');
    Route::get('surveys/{sid}/statistics', 'SurveysController@show_statistics');



    // Route::get('/users', 'PagesController@users')->name('users');
    Route::get('dashboard', 'PagesController@dashboard')->name('dashboard');
    // Route::get('/surveys', 'PagesController@surveys')->name('surveys');
    Route::get('settings', 'PagesController@settings')->name('settings');

    /* Profile */
    Route::resource('profile', 'ProfileController')->middleware('auth');

    // Users
    Route::get('/users', 'UsersController@index')->name('users');
    Route::delete('/users/{id}', 'UsersController@destroy');
});

/* Surveys */
Route::get('surveys/{sid}/start', 'SurveysController@start')->name('surveys.start');
Route::get('surveys/{sid}/end', 'SurveysController@end')->name('surveys.end');

/* Questions */
Route::get('surveys/{sid}/questions/{qid}', 'QuestionController@show');



// Route::get('survey/statistics', 'SurveysController@statistics')->name('surveys.statistics');


// Route::get('profile/{id}', 'PagesController@show')->name('profile.show')->middleware('auth');
// Route::match(['put', 'patch'], 'profile/{id}', 'PagesController@update')->name('profile.update')->middleware('auth');






// ajax routes
Route::post('/ajaxSurveysSearch', 'AjaxController@search_surveys');

Route::post('/ajaxUsersSearch', 'AjaxController@search_users');
Route::post('/ajaxUsersSort', 'AjaxController@sort_users');

Route::post('/ajaxSealSurvey', 'AjaxController@seal_survey');


// Partici
Route::post("/partici/{sid}/{qid}", "ParticiController@store");

// CREATE FIRST TIME ADMIN ACCOUNT
Route::get('/init', 'UsersController@init');
