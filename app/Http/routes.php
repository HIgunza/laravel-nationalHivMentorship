<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/manual-upload', 'ResourceCenterController@uploadManuals');
Route::get('/files-upload', 'ResourceCenterController@uploads');
Route::get('/guideline-upload', 'ResourceCenterController@uploadGuideline');
Route::get('/others-upload', 'ResourceCenterController@uploadOthers');
Route::post('/files-upload', 'ResourceCenterController@postFile');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('/reporting/sessions/{fromdate}/{todate}/{county}/{subcounty}/{facility}/{rtype}', 'ReportingController@getMentorshipSessions');
Route::get('/reporting/download/{fromdate}/{todate}/{county}/{subcounty}/{facility}/{rtype}', 'ReportingController@downloadReport');
Route::get('/facility-upload', 'SystemSetUpController@importFacilityFile');
Route::get('/facility-process', 'SystemSetUpController@processFacilityFile');
Route::post('facility-upload', 'SystemSetUpController@postFacilityFile');
Route::get('/reports', 'ReportingController@displaysessions');
Route::get('/person-home', 'PersonController@index');
Route::get('/facility-dashboard', 'ReportingController@facilitydashboard');
Route::get('/subcounty-dashboard', 'ReportingController@subcountydashboard');
Route::get('/county-dashboard', 'ReportingController@countydashboard');
Route::get('/facility/loadfacility/{id}','FacilityController@facility');
Route::get('/facility/loadsubcat/{id}','FacilityController@subcounty');
Route::get('/resource-center', 'ResourceCenterController@index');
Route::get('/register-user', 'UserController@create');
Route::get('/my-profile', 'UserController@index');
Route::get('/system-reports', 'ReportingController@index');
Route::get('/system-admin', 'AdminController@index');
Route::get('/person-mentee', 'PersonController@mentees');
Route::get('/person-mentor', 'PersonController@mentors');
Route::get('/system-setup', 'SystemSetUpController@setUp');
Route::get('/session/{id}', 'MentorshipSessionController@show');
Route::get('/mentorship-session', 'MentorshipSessionController@index');
Route::post('/session-create', 'MentorshipSessionController@store');
Route::post('/session-edit', 'MentorshipSessionController@edit');
Route::get('/indicator-list', 'MentorshipSessionIndicatorController@index');
Route::get('/person-create', 'PersonController@create');
Route::post('/person-add', 'PersonController@store');
Route::get('/session-tool/{tool}','MentorshipSessionController@create');
Route::get('/','HomeController@index');
Route::get('/dash-board',['as'=>'dash-board','uses'=>"DashBoardController@index"]);
Route::get('/home',"DashBoardController@index");
Route::controller('/','Auth\AuthController');

// Authentication routes...



/*Route::controllers([
   'password' => 'Auth\PasswordController',
]);*/

