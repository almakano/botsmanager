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
		$date = time();
		$this->info('Logics queue: started '.date('Y-m-d H:i:s', $date));

		while(true){

			$list = Logic::get();
			foreach($list as $i) {
				$i->run();
			}

			usleep(1 * 1000000);
		}

		$this->info('Logics queue: finished after '.(time() - $date).'s');
	}
}
?>