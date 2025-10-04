<?php
namespace App\Http\Controllers;

use App\Http\Controllers\SourceCtrl;
use App\Users;

class MapController extends Controller
{
    public function index()
    {
      $customers = $status = [];
      $active = $deactive = $expire = $online = $offline = $cancel = 0;

      $source = new SourceCtrl;
      $routerUsers = $source->routerActiveUsers();

      // get all customers with lat/lng
      $customers = Users::whereNotNull('lat')
      ->whereNotNull('lng')
      // ->whereIn('status', ['Active', 'Expire'])
      ->select('id', 'name', 'username', 'status', 'lat', 'lng');

      $dbActiveUsers = $customers->pluck('username')->toArray();
      $customers = $customers->get();

      $activeUsersArray = array_intersect($dbActiveUsers, $routerUsers);
      foreach($customers as $customer)
      {
        if(!in_array($customer->username, $activeUsersArray) && $customer->status == 'Active')
        {
          $customer->status = 'Offline';
          $offline ++;
        }
        if($customer->status == 'Active')
        {
          $active ++;
        }
        if($customer->status == 'Deactive')
        {
          $deactive ++;
        }
        if($customer->status == 'Cancel')
        {
          $cancel ++;
        }
        if($customer->status == 'Expire')
        {
          $expire ++;
        }

      }

      $status = [
        'active' => $active,
        'deactive' => $deactive,
        'expire' => $expire,
        'cancel' => $cancel,
        'offline' => $offline,
        'online' => count($activeUsersArray)
      ];

      return $data = [
        'customers' => $customers,
        'status' => $status,
      ];
    }
}
