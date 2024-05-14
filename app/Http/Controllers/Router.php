<?php

namespace App\Http\Controllers;
use PEAR2\Net\RouterOS;

use Illuminate\Http\Request;
use App\Users;
use App\PaymentMethod;
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
        require_once 'PEAR2/Autoload.php';
        try { 
        // return $util = new RouterOS\Util($client = new RouterOS\Client('160.202.145.78', 'rocky', 'rockyadmin'));// echo 'Router Connected!';
        return $util = new RouterOS\Util($client = new RouterOS\Client('172.17.0.1', 'phpadmin', 'adm!n@AP!'));// echo 'Router Connected!';
        // return $util = new RouterOS\Util($client = new RouterOS\Client('192.168.11.1', 'admin', 'admin'));
        echo 'Router Connected!';
        } catch (Exception $e) { echo 'Unable to connect to RouterOS.';}
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