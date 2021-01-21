<?php
namespace almakano\botsmanager\app\Logics;

use almakano\botsmanager\app\Bot;
use almakano\botsmanager\app\Logic;
use almakano\botsmanager\app\SubscriberMessage;

class Taxi {

	protected $commands = [
		'start' => ['description' => '/start Begin new session'],
		'help' => ['description' => '/help Show all commands'],
		'talk' => ['description' => '/talk Try get a best conversation'],
		'download' => ['description' => '/download Get a file'],
	];

	function run() {

		$logics		 = Logic::where(['controller' => 'Taxi'])->pluck('id');
		$bots		 = Bot::whereIn('logic_id', $logics)->pluck('id');
		$messages	 = SubscriberMessage::whereRaw('status is NULL')
						->whereIn('bot_id', $bots)
						->orderByRaw('id')
						->lockForUpdate();
		$mids		 = $messages->pluck('id');

		$messages->update(['status' => 'processing']);

		$messages	 = SubscriberMessage::whereIn('id', $mids)->get();
		foreach($messages as $i) {

			$parsed = $this->parseMessage($i);

			$this->${'run'.ucFirst($parsed['command'])}($i);

			$i->status = 'done';
			$i->save();
		}
	}

	function parseMessage(SubscriberMessage $message) {

		if(in_array($message->format, ['video', 'videonote'])) return $this->parseVideo($message);
		else if(in_array($message->format, ['audio'])) return $this->parseAudio($message);
		else if(in_array($message->format, ['file'])) return $this->parseFile($message);
		else if(in_array($message->format, ['location'])) return $this->parseLocation($message);
		else if(in_array($message->format, ['location'])) return $this->parseLocation($message);

		$res = ['command' => 'talk'];

		return $res;
	}

	function parseVideo(SubscriberMessage $message) {
		$res = ['command' => 'talk'];
		return $res;
	}
	function parseAudio(SubscriberMessage $message) {
		$res = ['command' => 'talk'];
		return $res;
	}
	function parseFile(SubscriberMessage $message) {
		$res = ['command' => 'talk'];
		return $res;
	}
	function parseLocation(SubscriberMessage $message) {
		$res = ['command' => 'talk'];
		return $res;
	}
	function runTalk(SubscriberMessage $message) {

		$answers = array_filter([
			'Okay',
			'Accepted',
			'That\'s a good one',
			'Awesome',
			'You deserved it',
			!empty($i->text)?$i->text.' Right ?':'',
		]);

		$choosed_answer = $answers[rand(0, count($answers) - 1)];

		$i->platform()->sendMessage([
			'chat_id' => $i->subscriber->platform_id,
			'text' => $choosed_answer,
		]);
	}
	function runStart(SubscriberMessage $message) {

		$i->platform()->sendMessage([
			'chat_id' => $i->subscriber->platform_id,
			'text' => implode(PHP_EOL, array_filter(
				'Hello'
			)),
		]);

	}
	function runHelp(SubscriberMessage $message) {

		$i->platform()->sendMessage([
			'chat_id' => $i->subscriber->platform_id,
			'text' => implode(PHP_EOL, array_filter($this->commands)),
		]);

	}
	function runDownload(SubscriberMessage $message) {

		// if(preg_match('~youtube~', $message->text)) $file = 

		$i->platform()->sendMessage([
			'chat_id' => $i->subscriber->platform_id,
			'text' => implode(PHP_EOL, ['Link']),
		]);

	}
}

?>