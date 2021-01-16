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
		Route::any('bots/add', 'BotController@edit');
		Route::any('bots/{id}/edit', 'BotController@edit');
		Route::any('bots/{id}/delete', 'BotController@delete');
		Route::any('bots/{id}/subscribers', 'BotController@subscribers');

		Route::any('subscribers', 'SubscriberController@index');
		Route::any('subscribers/add', 'SubscriberController@edit');
		Route::any('subscribers/{id}/edit', 'SubscriberController@edit');
		Route::any('subscribers/{id}/delete', 'SubscriberController@delete');

		Route::any('logics', 'LogicController@index');
		Route::any('logics/add', 'LogicController@edit');
		Route::any('logics/{id}/edit', 'LogicController@edit');
		Route::any('logics/{id}/delete', 'LogicController@delete');
	});

?>