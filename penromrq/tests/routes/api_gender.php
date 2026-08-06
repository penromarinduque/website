<?php 

Route::prefix('gender')->middleware('auth:api')->group(function(){

	Route::get('/{path}/{action?}/{id?}', 'Website\GenderWebsiteController@activenavbar');

});