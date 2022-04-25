<?php

include 'routes/Route.php';
include 'config/env.php';
include 'config/database.php';
include 'Model/Model.php';
include 'Controller/Controller.php';

// Set PHP default timezone to Malaysia timezone
date_default_timezone_set("Asia/Kuala_Lumpur");

// Include all the controller files into index.php.
foreach (glob("Controller/*.php") as $filename)
{
    // Prevent the controller parent class being include again.
    if($filename == 'Controller/Controller.php')
        continue;
    include $filename;
}

// Include all the model files into index.php.
foreach (glob("Model/*.php") as $filename)
{
    // Prevent the model parent class being include again.
    if($filename == 'Model/Model.php')
        continue;
        
    include $filename;
}

// Non login-required routes
    Route::add('GET', '/', 'LoginController@default1', false);
    // Route::add('GET', '/', 'LoginController@default', false);
    Route::add('GET', '/login', 'LoginController@loginPage', false);
    Route::add('POST', '/login', 'LoginController@login', false);

// Authenticated routes
    Route::add('GET', '/logout', 'LoginController@logout');

    Route::add('GET', '/dashboard', 'DashboardController@dashboard');
    Route::add('POST', '/checkin', 'DashboardController@checkIn');
    Route::add('GET', '/code', 'DashboardController@generateCode');
    Route::add('GET', '/codeView', 'DashboardController@codeDisplay');

    Route::add('GET', '/employeeList', 'EmployeeController@employeeList');
    Route::add('GET', '/employeeCreate', 'EmployeeController@employeeCreatePage');
    Route::add('POST', '/employeeCreate', 'EmployeeController@employeeCreate');
    Route::add('GET', '/employeeDetails', 'EmployeeController@employeeDetails');
    Route::add('POST', '/employeeUpdate', 'EmployeeController@employeeUpdate');
    Route::add('GET', '/employeeDelete', 'EmployeeController@employeeDelete');

    Route::add('GET', '/profile', 'ProfileController@profile');
    Route::add('POST', '/updateProfile', 'ProfileController@updateProfile');

    Route::add('GET', '/shiftList', 'ShiftController@shiftList');
    Route::add('GET', '/shiftDetails', 'ShiftController@shiftDetails');
    Route::add('POST', '/shiftUpdate', 'ShiftController@shiftUpdate');

Route::route();

?>