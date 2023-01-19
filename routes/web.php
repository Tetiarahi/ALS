<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Employee
    Route::delete('employees/destroy', 'EmployeeController@massDestroy')->name('employees.massDestroy');
    Route::resource('employees', 'EmployeeController');

    // Qualification
    Route::delete('qualifications/destroy', 'QualificationController@massDestroy')->name('qualifications.massDestroy');
    Route::resource('qualifications', 'QualificationController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Spa
    Route::delete('spas/destroy', 'SpaController@massDestroy')->name('spas.massDestroy');
    Route::post('spas/media', 'SpaController@storeMedia')->name('spas.storeMedia');
    Route::post('spas/ckmedia', 'SpaController@storeCKEditorImages')->name('spas.storeCKEditorImages');
    Route::resource('spas', 'SpaController');

    // Emp Work Status
    Route::delete('emp-work-statuses/destroy', 'EmpWorkStatusController@massDestroy')->name('emp-work-statuses.massDestroy');
    Route::resource('emp-work-statuses', 'EmpWorkStatusController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Employee
    Route::delete('employees/destroy', 'EmployeeController@massDestroy')->name('employees.massDestroy');
    Route::resource('employees', 'EmployeeController');

    // Qualification
    Route::delete('qualifications/destroy', 'QualificationController@massDestroy')->name('qualifications.massDestroy');
    Route::resource('qualifications', 'QualificationController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Spa
    Route::delete('spas/destroy', 'SpaController@massDestroy')->name('spas.massDestroy');
    Route::post('spas/media', 'SpaController@storeMedia')->name('spas.storeMedia');
    Route::post('spas/ckmedia', 'SpaController@storeCKEditorImages')->name('spas.storeCKEditorImages');
    Route::resource('spas', 'SpaController');

    // Emp Work Status
    Route::delete('emp-work-statuses/destroy', 'EmpWorkStatusController@massDestroy')->name('emp-work-statuses.massDestroy');
    Route::resource('emp-work-statuses', 'EmpWorkStatusController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
