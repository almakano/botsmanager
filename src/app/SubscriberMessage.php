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
}
