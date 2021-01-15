<?php
	Route::group(
	[
		'namespace'  => 'almakano\botsmanager\app\Http\Controllers',
		'middleware' => 'web',
		'prefix'     => 'botsmanager',
	],
	function () {
		Route::get('bots', 'BotController@index');
		Route::get('bots/{id}/edit', 'BotController@edit');
		Route::post('bots/{id}/edit', 'BotController@edit');
		Route::get('bots/{id}/delete', 'BotController@delete');
		Route::post('bots/{id}/delete', 'BotController@delete');
		Route::get('bots/{id}/subscribers', 'BotController@subscribers');

		Route::get('subscribers', 'SubscriberController@index');
		Route::get('subscribers/{id}/edit', 'SubscriberController@edit');
		Route::post('subscribers/{id}/edit', 'SubscriberController@edit');
		Route::get('subscribers/{id}/delete', 'SubscriberController@delete');
		Route::post('subscribers/{id}/delete', 'SubscriberController@delete');

		Route::get('logics', 'LogicController@index');
		Route::get('logics/{id}/edit', 'LogicController@edit');
		Route::post('logics/{id}/edit', 'LogicController@edit');
		Route::get('logics/{id}/delete', 'LogicController@delete');
		Route::post('logics/{id}/delete', 'LogicController@delete');
	});

?>