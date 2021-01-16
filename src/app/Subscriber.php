<?php 

namespace almakano\botsmanager\app;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
	protected $table = 'bots_users';

	function bot() {
		return $this->hasOne(Bot::class, 'id', 'bot_id');
	}

	function platform() {

		$classname = 'platforms\\'.$this->platform_name;
		$item = new $classname();

		return $item;
	}

}
