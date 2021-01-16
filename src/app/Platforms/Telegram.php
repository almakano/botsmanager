<?php 

namespace almakano\botsmanager\app\Platforms;

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

	function receive() {

		$input = file_get_contents('php://input');
		file_put_contents(storage_path().'/logs/telegram.log', date('Y-m-d H:i:s').' '.$input.PHP_EOL, FILE_APPEND);

		try {

			$json = json_decode($input, 1);

		} catch(\Exception $e) {

		}
	}

	function sendMessage() {

		return $this->send('POST', 'sendMessage', ['']);
	}
}
