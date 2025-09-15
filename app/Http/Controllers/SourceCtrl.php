<?php
namespace App\Http\Controllers;

class SourceCtrl extends Controller
{
  public function dtformat($date)
  {
    $formated_date = '';
    if($date)
    {
      $formated_date = date('d M Y', strtotime($date));
    }
    return $formated_date;
  }
}