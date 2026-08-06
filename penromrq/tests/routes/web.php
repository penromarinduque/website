<?php
/////////////////////////////////////////////////////////////////////////////////
///////////////////////   MODULES  //////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

Route::get('/','Website\WebsiteController@activenavbar');

Route::get('/penro/{path}/{action?}/{id?}', 'Website\WebsiteController@activenavbar')->name('website.page');

Route::get('/login', 'Admin\ModuleController@loginForm');

Auth::routes();

Route::middleware('auth')->group(function(){
	Route::get('/welcome','Admin\ModuleController@moduleDashboard')->name('module.route');
});

Route::prefix('website')->middleware(['auth','admin'])->group(function() {
	Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'Admin\Website\WebsiteController@activeAdmin')->name('website.route');
});	

Route::prefix('gender')->middleware(['auth','admin'])->group(function() {
	Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'Admin\Gender\GenderController@activeAdmin')->name('gender.route');
});

Route::prefix('accounts')->middleware('auth','admin')->group(function(){
	Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'System\Accounts\AccountsController@activeAdmin')->name('accounts.route');
});	

Route::prefix('settings')->middleware('auth','admin')->group(function(){
	Route::match(['get', 'post'],'/{path}/{action?}/{id?}', 'System\Settings\SettingsController@activeAdmin')->name('settings.route');
});

Route::prefix('ajax')->middleware('auth','admin')->group(function(){
	Route::post('/update/users-default-company', 'System\Accounts\AccountsController@updateUsersCompany')->name('update.users.company');
});		

// Route::get('/home', 'HomeController@index')->name('home');
