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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
/*Job Routes */
Route::get('/', 'JobController@index');
Route::get('/jobs/{id}/{job}', 'JobController@show')->name('jobs.show');
Route::get('/jobs/create', 'JobController@create')->name('jobs.create');
Route::post('/jobs/create', 'JobController@store')->name('jobs.store');
Route::get('/jobs/{id}/{job}/edit', 'JobController@edit')->name('jobs.edit');
Route::post('/jobs/{id}/{job}/update', 'JobController@update')->name('jobs.update');
Route::get('/jobs/my-job', 'JobController@myjob')->name('jobs.myjob');
/* Job Applications and applicant routes */
/* 1). Seeker can apply to jobs route */
Route::post('/applications/{id}', 'JobController@apply')->name('jobs.apply');
/* 2). Employer can view applicants route */
Route::get('/jobs/applications', 'JobController@applicants')->name('jobs.applicants');
Route::get('/jobs/alljobs', 'JobController@alljobs')->name('jobs.alljobs');

/* Seeker can save and unsave jobs - stored in Favorites table in database*/
Route::post('/save/{id}', 'FavoriteController@savejob')->name('favorite.savejob');
Route::post('/unsave/{id}', 'FavoriteController@unsavejob')->name('favorite.unsavejob');
/* Search Jobs */
Route::get('/jobs/search', 'JobController@searchjob');
/* Company Routes */
Route::get('/company/{id}/{name}', 'CompanyController@index')->name('company.index');
Route::get('company/create', 'CompanyController@create')->name('company.view');
Route::post('company/create', 'CompanyController@store')->name('company.store');
Route::post('company/coverphoto', 'CompanyController@coverphoto')->name('company.coverphoto');
Route::post('company/logo', 'CompanyController@logo')->name('company.logo');

/* User Profile Routes */
Route::get('user/profile', 'ProfileController@index')->name('profile.view');
Route::post('user/profile/create', 'ProfileController@store')->name('profile.create');
Route::post('user/coverletter', 'ProfileController@coverletter')->name('profile.coverletter');
Route::post('user/resume', 'ProfileController@resume')->name('profile.resume');
Route::post('user/avatar', 'ProfileController@avatar')->name('profile.avatar');

/* Employer Registration Routes */
Route::view('employer/register', 'auth.employer-register')->name('employer.register');
Route::post('employer/register', 'EmployerRegisterController@employerRegister')->name('emp.register');
