<?php
namespace App\Http\Controllers;

use App\Http\Controllers\SourceCtrl;
use App\Users;

class MapController extends Controller
{
    public function index()
    {
      $customers = $status = [];
      $active = $new = $expire = $online = $offline = $cancel = 0;

      $source = new SourceCtrl;
      $routerUsers = $source->routerActiveUsers();
      $routerUsersIndex = array_keys($routerUsers);

      // get all customers with lat/lng and by the status
      $customers = Users::whereNotNull('lat')
      ->whereNotNull('lng')
      ->whereIn('status', ['Active', 'Expire', 'New'])
      ->select('id', 'name', 'username', 'status', 'lat', 'lng');
      $customers = $customers->get();

      $dbUserIndex = Users::pluck('username')->toArray();

      $activeUsersIndex = array_intersect($dbUserIndex, $routerUsersIndex);
      $online = count($activeUsersIndex);

      foreach($customers as $key => $customer)
      {
        if($customer->status == 'Active')
        {
          if(array_key_exists($customer->username, $routerUsers) )
          {
            $customer->ip = $routerUsers[$customer->username]['address'];
            $customer->uptime = $routerUsers[$customer->username]['uptime'];
          }
          else
          {
            $customer->status = 'Offline';
            $offline ++;
          }
          $active ++;
        }
        elseif($customer->status == 'Expire')
        {
          $expire ++;
        }elseif($customer->status == 'New')
        {
          $new ++;
        }

      }

      $status = [
        'active' => $active,
        'new' => $new,
        'expire' => $expire,
        'cancel' => $cancel,
        'offline' => $offline,
        'online' => $online
      ];

      return $data = [
        'customers' => $customers,
        'status' => $status,
      ];
    }
}
