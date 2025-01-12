<?php

namespace App\Console\Commands;

use App\Helpers\Common;
use Illuminate\Console\Command;

class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pig:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update pig status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Common::updateAllStatus($this->signature, $this->description);
        Common::updateAllPigBreedStatus($this->signature, $this->description);
        $this->info('Success');
    }
}
