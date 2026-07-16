<?php

namespace App\Http\Controllers;
use RouterOS\Client;
use RouterOS\Query;

use Illuminate\Http\Request;
use App\Users;
use App\Paymethod;
use App\ActiveService;
use App\Service;
use App\PaymentReceive;
use App\Location;
use App\Device;
use App\User;
// use App\Router;
use Redirect;
use DB;
use Session;
use Auth;

class Router extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    static function Connect()
    {
      $router_host = config('services.mikrotik.host');
      $router_user = config('services.mikrotik.user');
      $router_password = config('services.mikrotik.pass');
      $router_port = config('services.mikrotik.port');

      $client = new Client([
        'host' => $router_host,
        'user' => $router_user,
        'pass' => $router_password,
        'port' => $router_port,
      ]);

      return $client;
    }

    public function activeArp()
    {
      $query = new Query('/ip/arp/print');
      $response = $this->connect()->query($query)->read();
      return $response;
    }

    static function pppuser($name)
    {
        return Router::Connect()->setMenu('/ppp secret')->getAll(array(), RouterOS\Query::where('name', $name));
    }

    static function hpuser($name)
    {
        return Router::Connect()->setMenu('/ip hotspot user')->getAll(array(), RouterOS\Query::where('name', $name));
    }

    static function pppActiveUsers()
    {
        return Router::Connect()->setMenu('/ppp active')->getAll();
    }
    
    // add ip address to the firewall address list
    public function addExpireIP($users, $list = 'Expired')
    {
      $results = '';
      foreach($users as $user)
      {
        $query = (new Query('/ip/firewall/address-list/add'))
                  ->equal('address', $user->ip)
                  ->equal('list', 'Expired')
                  ->equal('comment', $user->name);
  
        $response = $this->connect()->query($query)->read();
        $results = array_push($response, $results);
      }

      return $results;
    }

    public function getExpireIP($ip, $list = 'Expired')
    {
      $listName = $list;
      $ipAddress = $ip;

      // 1. Target the precise IP inside the precise list
      $findQuery = (new Query('/ip/firewall/address-list/print'))
      ->where('list', $listName)
      ->where('address', $ipAddress);

      $entries = $this->connect()->query($findQuery)->read();

      // 2. If it exists, remove it using its ID
    if (!empty($entries) && isset($entries[0]['.id'])) {
      $removeQuery = (new Query('/ip/firewall/address-list/remove'))
          ->equal('.id', $entries[0]['.id']);
      
        $this->connect()->query($removeQuery)->read();

      return response()->json(['success' => true, 'message' => "{$ipAddress} removed from {$listName}."]);
    }

    return response()->json(['success' => false, 'message' => "IP not found in that list."]);
    }
}