<?php
namespace App\Http\Controllers;

use App\Http\Controllers\SourceCtrl;
use App\Users;

class MapController extends Controller
{
    public function index()
    {
      // $array1 = [1,2,3,4,5,6,7,8,9,10];
      // $array2 = [13,4,18,5,15,12,6,11];
      // $mached_arrays = array_intersect($array2, $array1);

      // dd($mached_arrays);

      $source = new SourceCtrl;
      $routerUsers = $source->routerActiveUsers();


        // get all customers with lat/lng
        $customers = Users::whereNotNull('lat')
        ->whereNotNull('lng')
        ->whereIn('status', ['Active', 'Expire'])
        ->select('id', 'name', 'username', 'status', 'lat', 'lng');

        $dbActiveUsers = $customers->pluck('username')->toArray();
        $customers = $customers->get();

        $activeUsersArray = array_intersect($dbActiveUsers, $routerUsers);
        foreach($customers as $customer)
        {
          if(in_array($customer->username, $activeUsersArray))
          {
            $customer->status = 'Active';
          }
          else
          {
            $customer->status = 'Offline';
          }
        }
        return $customers;
    }
}
