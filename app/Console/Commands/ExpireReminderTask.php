<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ExpireController;

class ExpireReminderTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired_reminder:run';

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
      // Let Laravel build the controller instance safely
      $expireCtrl = app(\App\Http\Controllers\ExpireController::class);
      $expireCtrl->expiredUsers();
      
        // return Command::SUCCESS;
    }
}
