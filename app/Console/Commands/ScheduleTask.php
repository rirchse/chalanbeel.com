<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ExpireController;

class ScheduleTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      //make expire to the users
      ExpireController::expiredCheck();

      //find expire users and email to the admin
      ExpireController::expiredUsers();
      
        // return Command::SUCCESS;
    }
}
