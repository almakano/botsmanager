<?php 

namespace almakano\botsmanager\app;

use Illuminate\Database\Eloquent\Model;

class SubscriberMessage extends Model
{
	protected $table = 'bots_users_messages';
	protected $casts = [
		'data' => 'array',
	];

	function subscriber() {
		return $this->hasOne(Subscriber::class, 'id', 'botuser_id');
	}

	function bot() {
		return $this->hasOne(Bot::class, 'id', 'bot_id');
	}

	function platform() {

		$classname = 'almakano\botsmanager\app\Platforms\\'.ucfirst($this->subscriber->platform_name);
		$item = new $classname([
			'bot' => $this->bot
		]);

		return $item;
	}
}
