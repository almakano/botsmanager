<?php 

namespace almakano\botsmanager\app;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
	protected $table = 'bots_users';
	protected $casts = [
		'data' => 'array',
		'data_session' => 'array',
	];

	function bot() {
		return $this->hasOne(Bot::class, 'id', 'bot_id');
	}

	function platform() {

		$classname = 'almakano\botsmanager\app\Platforms\\'.ucfirst($this->platform_name);
		$item = new $classname([
			'bot' => $this->bot
		]);

		return $item;
	}

}
