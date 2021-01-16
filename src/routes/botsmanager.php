<?php
	Route::group(
	[
		'namespace'  => 'almakano\botsmanager\app\Http\Controllers',
		'middleware' => 'web',
		'prefix'     => 'botsmanager',
	],
	function () {
		Route::any('/', 'BotController@index');
		Route::any('bots', 'BotController@index');
		Route::any('bots/autocomplete', 'BotController@autocomplete');
		Route::any('bots/add', 'BotController@edit');
		Route::any('bots/{id}/edit', 'BotController@edit');
		Route::any('bots/{id}/delete', 'BotController@delete');
		Route::any('bots/{id}/receive/{platform_name}', 'BotController@receive');

		Route::any('subscribers', 'SubscriberController@index');
		Route::any('subscribers/autocomplete', 'SubscriberController@autocomplete');
		Route::any('subscribers/add', 'SubscriberController@edit');
		Route::any('subscribers/{id}/edit', 'SubscriberController@edit');
		Route::any('subscribers/{id}/delete', 'SubscriberController@delete');

		Route::any('logics', 'LogicController@index');
		Route::any('logics/autocomplete', 'LogicController@autocomplete');
		Route::any('logics/add', 'LogicController@edit');
		Route::any('logics/{id}/edit', 'LogicController@edit');
		Route::any('logics/{id}/delete', 'LogicController@delete');
	});
?>