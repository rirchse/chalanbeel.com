<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SNMP;
use App\Services\VsolSnmpService;
use Illuminate\Http\JsonResponse;
// use App\Http\Controllers\UserController;
use App\User;

class OltController extends Controller
{
  public function test()
    {
        $host = '103.7.4.250';
        $community = 'public';

        try {

            $snmp = new SNMP(
                SNMP::VERSION_2c,
                $host,
                $community
            );

            $snmp->valueretrieval = SNMP_VALUE_PLAIN;

            // System Description OID
            $result = $snmp->get('1.3.6.1.2.1.1.1.0');

            return response()->json([
                'success' => true,
                'data' => $result
            ]);

        }
        catch (\Exception $e)
        {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
  
    public function listOnus(VsolSnmpService $oltService)
    {
        try {
            $onus = $oltService->getAllOnus();
            // dd($onus);

            // return response()->json([
            //     'success' => true,
            //     'total_onus' => count($onus),
            //     'data' => $onus
            // ]);

            //database users
            $users = User::whereIn('status', ['Active', 'Expire'])
            ->select('name', 'contact', 'mac', 'lat','lng')
            ->get();

            $users = json_decode(json_encode($users));

            $objects = collect($users);
            $statuses = collect($onus);

            $customers = $objects->map(function ($item) use ($statuses) {
                $itemArray = (array) $item;
                
                // Find matching status
                $status = $statuses->firstWhere(function ($s) use ($item) {
                    return strtolower($s['mac_address']) === strtolower($item->mac);
                });

                return (object) array_merge($itemArray, $status ?? []);
            });

            return view('map.index-olt', compact('customers'));

        }
        catch (\Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
