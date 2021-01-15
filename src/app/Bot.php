<?php 

namespace almakano\botsmanager\app;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{

	function logic() {
		return $this->hasOne('Logic', 'id', 'logic_id');
	}

	function subscribers() {
		return $this->hasMany('Subscriber', 'bot_id', 'id');
	}
}
