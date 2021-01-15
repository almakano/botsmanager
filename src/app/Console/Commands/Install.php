<?php 
namespace almakano\botsmanager\app\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
	use Traits\PrettyCommandOutput;

	protected $progressBar;

	protected $signature = 'botsmanager:install
								{--timeout=300} : How many seconds to allow each process to run.
								{--debug} : Show process output or not. Useful for debugging';

	public function handle()
	{
		$this->progressBar = $this->output->createProgressBar(5);
		$this->progressBar->minSecondsBetweenRedraws(0);
		$this->progressBar->maxSecondsBetweenRedraws(120);
		$this->progressBar->setRedrawFrequency(1);

		$this->progressBar->start();

		$this->info(' BotsManager installation started. Please wait...');
		$this->progressBar->advance();

		$this->line(' Publishing configs, views, js and css files');
		$this->executeArtisanProcess('vendor:publish', [
			'--provider' => 'almakano\botsmanager\ManagerServiceProvider',
			'--tag' => 'minimum',
		]);

		$this->line(" Creating users table (using Laravel's default migration)");
		$this->executeArtisanProcess('migrate');

		$this->line(" Creating App\Http\Middleware\CheckIfAdmin.php");
		$this->executeArtisanProcess('botsmanager:publish-middleware');

		$this->progressBar->finish();
		$this->info(' BotsManager installation finished.');
	}
}
?>