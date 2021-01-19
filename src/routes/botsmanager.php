<?php
	Route::group(
	[
		'namespace'  => 'almakano\botsmanager\app\Http\Controllers',
		// 'middleware' => 'web',
		'prefix'     => 'botsmanager',
	],
	function () {
		Route::any('/', 'BotController@index');
		Route::any('bots', 'BotController@index');
		Route::any('bots/autocomplete', 'BotController@autocomplete');
		Route::any('bots/add', 'BotController@edit');
		Route::any('bots/{id}/edit', 'BotController@edit');
		Route::any('bots/{id}/delete', 'BotController@delete');
		Route::any('bots/{id}/receive/{platform_name}', 'BotController@receive')->withoutMiddleware('VerifyCsrfToken');
		Route::any('bots/{id}/activate/{platform_name}', 'BotController@activate');
		Route::any('bots/{id}/deactivate/{platform_name}', 'BotController@deactivate');

		Route::any('subscribers', 'SubscriberController@index');
		Route::any('subscribers/autocomplete', 'SubscriberController@autocomplete');
		Route::any('subscribers/add', 'SubscriberController@edit');
		Route::any('subscribers/{id}/edit', 'SubscriberController@edit');
		Route::any('subscribers/{id}/delete', 'SubscriberController@delete');
		Route::any('subscribers/{id}/sendmessage', 'SubscriberController@sendmessage');

		Route::any('subscribermessages', 'SubscriberMessageController@index');
		Route::any('subscribermessages/autocomplete', 'SubscriberMessageController@autocomplete');
		Route::any('subscribermessages/add', 'SubscriberMessageController@edit');
		Route::any('subscribermessages/{id}/edit', 'SubscriberMessageController@edit');
		Route::any('subscribermessages/{id}/delete', 'SubscriberMessageController@delete');

		Route::any('logics', 'LogicController@index');
		Route::any('logics/autocomplete', 'LogicController@autocomplete');
		Route::any('logics/add', 'LogicController@edit');
		Route::any('logics/{id}/edit', 'LogicController@edit');
		Route::any('logics/{id}/delete', 'LogicController@delete');
		Route::any('logics/{id}/run', 'LogicController@run');
	});
?>