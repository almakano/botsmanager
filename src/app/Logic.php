<?php 

namespace almakano\botsmanager\app;

use Illuminate\Database\Eloquent\Model;

class Logic extends Model
{
	protected $table = 'bots_logic';
	protected $casts = [
		'data' => 'array',
	];

	function run() {

		$controller = 'almakano\botsmanager\app\Logics\\'.$this->controller;
		$controller = new $controller();

		$controller->run();
	}

	function messages() {

		return SubscriberMessage::whereIn('bot_id', [Bot::where('logic_id', $this->id)->pluck('id')]);
	}
}
