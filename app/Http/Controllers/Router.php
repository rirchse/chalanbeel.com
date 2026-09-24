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

      try{
        $client = new Client([
          'host' => $router_host,
          'user' => $router_user,
          'pass' => $router_password,
          'port' => (int)$router_port,
        ]);

        return $client;
      }
      catch(\Exception $e)
      {
        echo "Could not connect to the router: ";
      }
    }

    public function pppSecretAdd($secret)
    {
      $client = $this->Connect();
      if($client)
      {
        $query = new Query('/ppp/secret/add');
        $query->equal('name', $secret['name'])
        ->equal('password', $secret['password'])
        ->equal('service', $secret['service'])
        ->equal('profile', $secret['profile'])
        ->equal('comment', $secret['comment']);
        $secret = $client->query($query)->read();
        return $secret;
      }
    }

    public function pppSecretDelete($name)
    {
      $client = $this->Connect();
      if($client)
      {
        $findActive = (new Query('/ppp/active/print'))
        ->where('name', $name);
        $activeResult = $client->query($findActive)->read();

        if(!empty($activeResult) && isset($activeResult['.id']))
        {
          $removeActive = (new Query('/ppp/active/remove'))
          ->equal('.id', $activeResult['.id']);

          //
          $client->query($removeActive)->read();
          $response['active'] = 'Disconnected';
        }
        else
        {
          $response['active'] = 'No active session found';
        }

        $findSecret =(new Query('/ppp/secret/print'))
        ->where('name', $name);

        $result = $client->query($findSecret)->read();
        if(!empty($result) && isset($result[0]['.id']))
        {
          $secretId = $result[0]['.id'];
          
          $removeQuery = (new Query('/ppp/secret/remove'))
          ->equal('.id', $secretId);
          $client->query($removeQuery)->read();
          $response['secret'] = 'Deleted successfully';
        }
        else
        {
          $response['secret'] = 'Secret not found';
        }
        return $response;
      }
    }

    public function pppProfileChange($secrets)
    {
      $client = $this->Connect();
      if($client)
      {
        foreach($secrets as $secret)
        {
          $findSecret =(new Query('/ppp/secret/print'))
          ->where('name', $secret['name']);

          $result = $client->query($findSecret)->read();
          if(!empty($result) && isset($result[0]['.id']))
          {
            $secretId = $result[0]['.id'];
            
            $updateQuery = (new Query('/ppp/secret/set'))
            ->equal('.id', $secretId)
            ->equal('profile', $secret['profile']);
            $client->query($updateQuery)->read();
            $response['secret'] = 'Profile changed successfully';
          }
          else
          {
            $response['secret'] = 'Secret not found';
          }

          $findActive = (new Query('/ppp/active/print'))
          ->where('name', $secret['name']);
          $activeResult = $client->query($findActive)->read();

          if(!empty($activeResult) && isset($activeResult['.id']))
          {
            $removeActive = (new Query('/ppp/active/remove'))
            ->equal('.id', $activeResult['.id']);

            //
            $client->query($removeActive)->read();
            $response['active'] = 'Disconnected';
          }
          else
          {
            $response['active'] = 'No active session found';
          }
        }

        // return $response;
      }
      return [];
    }

    public function pppSecrets()
    {
      $client = $this->connect();
      if($client)
      {
        $query = new Query('/ppp/secret/print');
        $secrets = $client->query($query)->read();
        return $secrets;
      }
      return [];
    }

    public function pppSecret($name)
    {
      $client = $this->connect();
      if($client)
      {
        $query = (new Query('/ppp/secret/print'))
        ->where('name', $name);
        $secret = $client->query($query)->read();
        return $secret;
      }
      return [];
    }

    public function pppActives()
    {
      $client = $this->connect();
      if($client)
      {
        $query = new Query('/ppp/active/print');
        $actives = $client->query($query)->read();
        return $actives;
      }
      return [];
    }

    public function addARP()
    {
      //
    }

    public function getARP($ip)
    {
      $query = (new Query('/ip/arp/print'))
      ->where('address', $ip);
      $response = $this->connect()->query($query)->read();
      return $response;
    }

    public function updateARP($ip, $data = null)
    {
      $entry = $this->getARP($ip);

      if(empty($entry))
      {
        return response()->json([
          'success' => false,
          'message' => 'Entry not exists',
        ]);
      }
      else
      {
        $arpId = $entry[0]['.id'];

        //make use static
        // $makeStaticQuery = (new Query('/ip/arp/make-static'))
        // ->equal('.id', $arpId);
        // $response = $this->connect()->query($makeStaticQuery)->read();
        // dd($response);

        //update user details
        $updateQuery = (new Query('/ip/arp/set'))
        ->equal('.id', $arpId);

        if(isset($data['mac-address']))
        {
          $updateQuery->equal('mac-address', $data['mac-address']);
        }

        if(isset($data['comment']))
        {
          $updateQuery->equal('comment', $data['comment']);
        }

        $response = $this->connect()->query($updateQuery)->read();

        return response()->json([
            'success' => true,
            'message' => "ARP entry for {$ip} updated successfully.",
            'details' => $response
        ]);

      }
    }

    public function activeArp()
    {
      $query = new Query('/ip/arp/print');
      $response = $this->connect()->query($query)->read();
      return $response;
    }
    
    // add ip address to the firewall address list
    public function addExpireIP($arps, $list = 'Expired')
    {
      $client = $this->connect();
      foreach($arps as $arp)
      {
        $query = (new Query('/ip/firewall/address-list/add'))
                    ->equal('address', $arp['ip'])
                    ->equal('list', 'Expired')
                    ->equal('comment', $arp['name']);
    
          $response = $client->query($query)->read();
      }

      return [];
    }

    public function delExpireList($ip, $list = 'Expired')
    {
      $listName = $list;
      $ipAddress = $ip;
      $client = $this->connect();

      if($client)
      {
        // 1. Target the precise IP inside the precise list
        $findQuery = (new Query('/ip/firewall/address-list/print'))
        ->where('list', $listName)
        ->where('address', $ipAddress);

        $entries = $client->query($findQuery)->read();

        // 2. If it exists, remove it using its ID
        if (!empty($entries) && isset($entries[0]['.id']))
        {
          $removeQuery = (new Query('/ip/firewall/address-list/remove'))
              ->equal('.id', $entries[0]['.id']);
          
            $client->query($removeQuery)->read();

          return response()->json(['success' => true, 'message' => "{$ipAddress} removed from {$listName}."]);
        }

        return response()->json(['success' => false, 'message' => "IP not found in that list."]);
      }
      return [];
  }
}