<?php
namespace App\Http\Controllers;

class SourceCtrl extends Controller
{
  public function fileUpload($file, $path, $size = null)
  {
    $file_name = uniqid().'.'.$file->getClientOriginalExtension();
    $path = 'uploads/'.$path;
    $file->move(public_path($path), $file_name);
    $fileUrl = '/'.$path.$file_name;
    return $fileUrl;
  }

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