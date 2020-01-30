<?php

	@session_start();
	@ob_start();

	require __DIR__.'/core/controller.php';
	require __DIR__.'/app/config.php';
	require __DIR__.'/core/database.php';
	require __DIR__.'/core/model.php';
	require __DIR__.'/core/route.php';

	

	if (@$_SESSION['LOGIN_SESSION']) {
		Route::run('/', 'dashboard@index' );
	}else{
		Route::run('/','home@index');
	}
	

	/* General routes */
	Route::run('/api/signin', 'api/signin@index' ,'POST');
	Route::run('/api/signup', 'api/signup@index' , 'POST' );
	Route::run('/signout' , 'dashboard@signout');
	Route::run('/settings' , 'dashboard@settings');


	/* Admin page roues */

	Route::run('/academicyear' , 'academicyear@index');
	Route::run('/api/add/academicyear' , 'academicyear@addyear', 'POST');
	Route::run('/api/get/academicyear' , 'academicyear@getyear', 'POST');
	Route::run('/api/update/academicyear' , 'academicyear@updateyear','POST');
	Route::run('/api/add/academicterm' , 'academicyear@addterm', 'POST');
	Route::run('/api/get/academicterm' , 'academicyear@getterm', 'POST');
	Route::run('/api/update/academicterm' , 'academicyear@updateterm','POST');

	Route::run('/courseselectionop' , 'courseselectionop@index');
	Route::run('/api/add/courseselectiondate' , 'courseselectionop@add', 'POST');
	Route::run('/api/update/courseselectiondate' , 'courseselectionop@update' , 'POST');
	Route::run('/api/get/courseselectiondate' , 'courseselectionop@get' , 'POST');
	
	Route::run('/faculties', 'faculties@index');
	Route::run('/api/add/faculty' , 'faculties@add','POST');
	Route::run('/api/get/faculty' , 'faculties@get','POST');
	Route::run('/api/update/faculty' , 'faculties@update','POST');

	Route::run('/departments', 'departments@index');
	Route::run('/api/add/department', 'departments@add','POST');
	Route::run('/api/get/department', 'departments@get','POST');
	Route::run('/api/update/department', 'departments@update','POST');

	Route::run('/lessons', 'lessons@index');
	Route::run('/api/add/lesson', 'lessons@add','POST');
	Route::run('/api/get/lesson', 'lessons@get','POST');
	Route::run('/api/update/lesson', 'lessons@update','POST');
	
	Route::run('/students', 'students@index');
	Route::run('/students/approved', 'students@approved');
	Route::run('/students/unapproved', 'students@unapproved');
	Route::run('/api/update/student', 'students@update','POST');
	Route::run('/api/get/student', 'students@get','POST');

	Route::run('/academicians', 'academicians@index');
	Route::run('/academicians/approved', 'academicians@approved');
	Route::run('/academicians/unapproved', 'academicians@unapproved');
	Route::run('/api/update/academician', 'academicians@update','POST');
	Route::run('/api/get/academician', 'academicians@get','POST');

	/* Academician page roues */

	Route::run('/mylessons' , 'mylessons@index');

	Route::run('/addgrade' , 'gradestatus@addgrade');
	Route::run('/addgrade/{id}' , 'gradestatus@add');
	Route::run('/api/add/grade' , 'gradestatus@addorupdate' , 'POST');


	Route::run('/addattendance' , 'attendancestatus@addattedance');
	Route::run('/addattendance/{id}' , 'attendancestatus@add');
	Route::run('/api/add/attendance' , 'attendancestatus@addorupdate' , 'POST');




	/* student page routes */
	Route::run('/courseselection' , 'courseselection@index');
	Route::run('/api/select/courses' , 'courseselection@select' , 'POST');

	Route::run('/gradestatus' , 'gradestatus@index');
	Route::run('/attendancestatus' , 'attendancestatus@index');

	Route::run('/api/change/password', 'settings@changepassword', 'POST');
?>