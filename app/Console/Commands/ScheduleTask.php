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
      // Let Laravel build the controller instance safely
      $expireCtrl = app(\App\Http\Controllers\ExpireController::class);

      // This will work fine assuming 'expiredCheck' is a public static method 
      // and 'expiredUsers' is a public method that doesn't rely on an HTTP Request.
      \App\Http\Controllers\ExpireController::expiredCheck();
      $expireCtrl->expiredUsers();
      
        // return Command::SUCCESS;
    }
}
