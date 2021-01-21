<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use almakano\botsmanager\app\Subscriber;

class SubscriberController extends DefaultController
{

	protected $_model_class_name = '\almakano\botsmanager\app\Subscriber';
	protected $_views_name = 'subscribers';

	function sendmessage(Request $request, $id = 0)
	{
		$item = Subscriber::where(['id' => $id])->firstOrFail();

		if($request->method() != 'POST') return \Response::json(['error' => 'POST method only']);

		$platform_name = '\almakano\botsmanager\app\Platforms\\'.ucfirst(strtolower($item->platform_name));
		$platform = new $platform_name(['bot' => $item->bot]);

		$platform->sendMessage([
			'chat_id' => $item->platform_id,
			'text' => $request->input('message'),
			'reply_markup' => json_encode([
				'inline_keyboard' => [
					[
						[
							'text' => 'Yes',
							// 'url' => 'https://'.$_SERVER['HTTP_HOST'].'/botsmanager/bots/'.$item->bot->id.'/receive/telegram',
							'callback_data' => 'Yes',
						],
						[
							'text' => 'No',
							// 'url' => 'https://'.$_SERVER['HTTP_HOST'].'/botsmanager/bots/'.$item->bot->id.'/receive/telegram',
							'callback_data' => 'No',
						],
					],
				],
			], JSON_UNESCAPED_UNICODE),
		]);

		if(!empty($request->input('_ajax')))
			return '<script>$("#form-send-'.$item->id.'").collapse("hide").trigger("reset")</script>';

		return redirect();
	}
}