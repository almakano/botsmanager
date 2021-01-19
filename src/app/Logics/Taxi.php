<?php
namespace almakano\botsmanager\app\Logics;

use almakano\botsmanager\app\Bot;
use almakano\botsmanager\app\Logic;
use almakano\botsmanager\app\Subscriber;
use almakano\botsmanager\app\SubscriberMessage;

class Taxi {

	function run() {

		$logics		 = Logic::where(['controller' => 'Taxi'])->pluck('id');
		$bots		 = Bot::whereIn('logic_id', $logics)->pluck('id');
		$messages	 = SubscriberMessage::whereRaw('status is NULL')
						->whereIn('bot_id', $bots)
						->orderByRaw('id')
						->lockForUpdate();
		$mids		 = $messages->pluck('id');

		$messages->update(['status' => 'processing']);
		foreach($messages as $i) {
			$i->update(['status' => 'done']);
		}
	}
}

?>