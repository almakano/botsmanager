<?php 
namespace almakano\botsmanager\app\Console\Commands;

use Illuminate\Console\Command;
use almakano\botsmanager\app\Logic;

class LogicsRun extends Command
{

	protected $signature = 'botsmanager:logicsrun';
	protected $description = 'Run logic';

	public function handle()
	{
		$list = Logic::get();
		foreach($list as $i) {
			$i->run();
		}
		$this->info('Logic done');
	}
}
?>