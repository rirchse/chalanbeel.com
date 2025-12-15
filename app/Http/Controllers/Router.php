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
      $router_host = 'e14e0dffbae9.sn.mynetname.net';
      $router_user = 'apiadmin';
      $router_password = '@p!@dm!n122025';

      $client = new Client([
        'host' => $router_host,
        'user' => $router_user,
        'pass' => $router_password,
        // 'port' => 8728, // or 8729 if using SSL
      ]);

      return $client;
      
      // $query = (new Query('/ip/arp/print'));
      
      // $response = $client->query($query)->read();
      
      // dd($response);
    }

    public function activeArp()
    {
      $query = (new Query('/ip/arp/print'));      
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


    //test
    public function ConnectTest()
    {
        require_once 'PEAR2/Autoload.php';
        try {
        // $util = new RouterOS\Util(
            // $client = new RouterOS\Client('192.144.84.2', 'kobir', 'kobir3320', '3303'));
            $client = new RouterOS\Client('192.168.0.11', 'phpapi', 'phpapi');
            // );
        // dd($client);

        echo 'Router Connected!';
        } catch (Exception $e) { echo 'Unable to connect to RouterOS.';}

        //add ppp secret
        // $util->setMenu('/ppp secret')->add(array(
        //     'name'         => 'neyamul',
        //     'password'     => 'amijanina',
        //     'service'      => 'pppoe',
        //     'profile'      => '10mbps',
        //     'comment'      => 'This account created by router api'
        // ));

        //disable a user
        // $menu = $util->setMenu('/ppp secret');
        // $query = RouterOS\Query::where('name', 'test1');
        // $disable = $menu->disable($query);
        // $enable  = $menu->enable($query);

        // $get = $menu->get($query);
        // if($get['disabled']){
        //     echo 'Yes was disabled';
        //     $menu->enable($query);
        // }else{
        //     echo 'No, was enabled';
        //     $menu->disable($query);
        // }


        // dd($get['disabled']);
    }
}