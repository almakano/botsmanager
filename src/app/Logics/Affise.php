<?php
namespace almakano\botsmanager\app\Logics;

use almakano\botsmanager\app\Bot;
use almakano\botsmanager\app\Logic;
use almakano\botsmanager\app\SubscriberMessage;

class Affise {

	function run() {

		$logics		 = Logic::where(['controller' => 'Affise'])->pluck('id');
		$bots		 = Bot::whereIn('logic_id', $logics)->pluck('id');
		$messages	 = SubscriberMessage::whereRaw('status is NULL')
						->whereIn('bot_id', $bots)
						->orderByRaw('id')
						->lockForUpdate();
		$mids		 = $messages->pluck('id');

		$messages->update(['status' => 'processing']);

		$messages	 = SubscriberMessage::whereIn('id', $mids)->get();
		foreach($messages as $i) {
			$i->status = 'done';
			$i->save();
		}
	}
}

?>