<?php 

namespace almakano\botsmanager\app;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{

	function logic() {
		return $this->hasOne(Logic::class, 'id', 'logic_id');
	}

	function subscribers() {
		return $this->hasMany(Subscriber::class, 'bot_id', 'id');
	}
}
