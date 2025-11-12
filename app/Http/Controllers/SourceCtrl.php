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

  public function routerActiveUsers()
  {
    // $router = "http://103.7.4.19/rest";
    $router = "http://192.168.254.224/rest";
    $user   = "rocky";
    $pass   = "rocky@cbtadmin";
    
    // Hotspot Active
    // $url = $router . "/ppp/active";
    $url = $router . "/ip/arp";
    
    // // cURL request
    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // if self-signed cert
    // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // seconds to connect
    // curl_setopt($ch, CURLOPT_TIMEOUT, 10);       // total seconds to execute
    
    // $response = curl_exec($ch);
    // curl_close($ch);
    
    // $data = json_decode($response, true);
    // dd($data);
    // // $names = array_column($data, ['name', 'address', 'uptime']);
    // if(!isset($data['error']))
    // {
    //   $result = collect($data)->mapWithKeys(fn($item) => [
    //     $item['name'] => [
    //         'address' => $item['address'],
    //         'uptime'  => $item['uptime'],
    //     ]
    //   ])->toArray();
  
    
    //   // Show as array
    //   return $result = [];
    // }
    return [];
  }
}