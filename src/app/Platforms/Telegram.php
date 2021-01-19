<?php 

namespace almakano\botsmanager\app\Platforms;

use almakano\botsmanager\app\Subscriber;
use almakano\botsmanager\app\SubscriberMessage;

class Telegram
{

	public $bot;

	function __construct($arg = []) {
		foreach($arg as $k => $i) $this->$k = $i;
	}

	function send($method = 'GET', $action = '', $packet = []) {

		try {
			$packet = json_encode($packet, JSON_UNESCAPED_UNICODE);
			$res = file_get_contents('https://api.telegram.org/bot'.$this->get_token().'/'.$action, false, stream_context_create([
				'http' => [
					'method' => $method,
					'header' => implode(PHP_EOL, [
						'Content-type: application/json',
					]),
					'content' => $packet,
					'ignore_errors' => true,
				],
				'ssl' => [
					'verify_peer' => false,
					'verify_peer_name' => false,
				],
			]));

			$res_json = json_decode($res, 1);
			$res = json_encode($res, JSON_UNESCAPED_UNICODE);

		} catch(\Exception $e) {

			$res = $e->getMessage();
			$res_json = [];

		}

		file_put_contents(storage_path().'/logs/telegram.log', date('Y-m-d H:i:s').' '.$res.' '.$packet.PHP_EOL, FILE_APPEND);

		return $res_json;
	}

	function get_token() {

		return $this->bot->data['telegram']['token'];
	}

	function activate() {

		return $this->send('POST', 'setWebhook', ['url' => 'https://'.$_SERVER['HTTP_HOST'].'/botsmanager/bots/'.$this->bot->id.'/receive/telegram']);
	}

	function deactivate() {

		return $this->send('POST', 'deleteWebhook');
	}

	function sendMessage($arg = []) {

		return $this->send('POST', 'sendMessage', $arg);
	}

	function receive() {

		$input = file_get_contents('php://input');
		$error = '';
		$packet = [''];

		try {

			$json = json_decode($input, 1);
			$input = json_encode($json, JSON_UNESCAPED_UNICODE);

			if(!empty($json['callback_query']['from']['id'])) {

				$subscriber = Subscriber::where([
					'platform_name' => 'telegram',
					'platform_id' => $json['callback_query']['from']['id'],
				])->firstOrFail();

				$packet = [
					'platform_message_id' => $json['callback_query']['id'],
					'text'				  => $json['callback_query']['message']['text'] ?? '',
					'data'				  => $json['callback_query'],
					'format'			  => 'callback',
				];

			} else if(!empty($json['message']['from']['id'])) {

				$subscriber = Subscriber::where([
					'platform_name' => 'telegram',
					'platform_id' => $json['message']['from']['id'],
				])->first();

				if(empty($subscriber->id)) {
					$subscriber = new Subscriber();
					$subscriber->platform_name = 'telegram';
					$subscriber->platform_id = $json['message']['from']['id'];
					$subscriber->save();
				}

				if(isset($json['message']['video'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'data'				  => $json['message']['video'],
						'format'			  => 'video',
					];

				} else if(isset($json['message']['videonote'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'data'				  => $json['message']['videonote'],
						'format'			  => 'videonote',
					];

				} else if(isset($json['message']['audio'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'data'				  => $json['message']['audio'],
						'format'			  => 'audio',
					];

				} else if(isset($json['message']['voice'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'data'				  => $json['message']['voice'],
						'format'			  => 'voice',
					];

				} else if(isset($json['message']['location'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'data'				  => $json['message']['location'],
						'format'			  => 'location',
					];

				} else if(isset($json['message']['document'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'data'				  => $json['message']['document'],
						'format'			  => 'file',
					];

				} else if(isset($json['message']['text'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'text'				  => $json['message']['text'],
						'data'				  => $json['message'],
						'format'			  => 'text',
					];

				} else if(isset($json['message']['contact'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'data'				  => $json['message']['contact'],
						'format'			  => 'contact',
					];

				} else if(isset($json['message']['message_id'])) {

					$packet = [
						'platform_message_id' => $json['message']['message_id'],
						'data'				  => $json['message'],
					];

				}
			}

			// save subscriber respond
			$message 				 = new SubscriberMessage();
			$message->bot_id		 = $this->bot->id;
			$message->botuser_id	 = $subscriber->id;
			foreach($packet as $k => $v) $message->$k = $v;
			$message->save();

		} catch(\Exception $e) {

			$error = ' Error: '.$e->getMessage();
		}

		file_put_contents(storage_path().'/logs/telegram.log', date('Y-m-d H:i:s').' '.$input.$error.PHP_EOL, FILE_APPEND);

	}
}
