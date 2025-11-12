<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }
  
  public function downloadRawSql()
  {
    $dbName = env('DB_DATABASE');
    $fileName = "backup-{$dbName}-" . date('Ymd_His') . ".sql";

    $command = "mysqldump -u" . env('DB_USERNAME') .
              " -p'" . env('DB_PASSWORD') . "' " .
              $dbName . " > " . storage_path("app/{$fileName}");

    exec($command);

    return response()->download(storage_path("app/{$fileName}"))->deleteFileAfterSend();
  }
}
