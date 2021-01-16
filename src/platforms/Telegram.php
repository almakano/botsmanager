<?php 

namespace almakano\botsmanager\platforms;

class Telegram
{

	public $bot;
	public $api_url = 'https://api.telegram.org/bot';

	function __construct($arg = []) {
		foreach($arg as $k => $i) $this->$k = $i;
	}

	function send($method = 'GET', $action = '', $packet = []) {

		try {
			$packet = json_encode($packet, JSON_UNESCAPED_UNICODE);
			$res = file_put_contents($api_url.$this->get_token(), false, stream_context_create([
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

		}

		file_put_contents(storage_path().'/logs/telegram.log', date('Y-m-d H:i:s').' '.$res.' '.$packet.PHP_EOL, FILE_APPEND);
	}

	function get_token() {

		return $this->bot->data['telegram']['token'];
	}

	function activate() {

		$this->send('POST', 'setWebhook', ['url' => 'https://'.$_SERVER['HTTP_HOST'].'/botsmanager/bots/'.$this->bot->id.'/receive/telegram']);
	}

	function deactivate() {

		$this->send('POST', 'deleteWebhook');
	}
}
