<?php 

namespace almakano\botsmanager;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
	protected $table = 'bots_users';

	function bot() {
		return $this->hasOne('Bot', 'id', 'bot_id');
	}

	function platform() {

		$classname = 'platforms\\'.$this->platform_name;
		$item = new $classname();

		return $item;
	}

}
