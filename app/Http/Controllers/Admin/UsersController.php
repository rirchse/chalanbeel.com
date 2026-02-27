<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MapController;
use App\User;
use App\Admin;
use App\Location;
use App\Package;
use App\Service;
use App\Payment;
use App\Http\Controllers\Router;
use Auth;
use Image;
use File;
use Session;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
      $status = $date = $service_type = '';
      
      $status = $request->input('status');
      $date = $request->input('date');
      $service_type = $request->input('service_type');
      $name = $request->input('name');
      
      $users = [];

      if($request->method() == 'POST')
      {
        // Get all users from database
        $users = User::orderBy('id', 'DESC')
          ->when($status, function($query, $status)
          {
            $query->where('status', $status);
          })
          ->when($date, function($query, $date)
          {
            $query->where('payment_date', 'like',  '%'.$date);
          })
          ->when($service_type, function($query, $service_type)
          {
            $query->where('service_type', $service_type);
          })
          ->when($name, function($query, $name)
          {
            $query->where('name', 'like', '%'.$name.'%')
            ->orWhere('contact', 'like', '%'.$name.'%')
            ->orWhere('ip', 'like', '%'.$name.'%');
          })
          ->get();
      }

      $packages = Package::where('status', 'Active')
      ->select('id', 'speed')
      ->get();

      // if($request->ajax())
      // {
      //   return response()->json([
      //     'users' => $users
      //   ], 200);
      // }

      return view('admins.users.index', compact('users', 'status', 'date', 'service_type', 'name', 'packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Location::where('status', 1)
        ->orderBy('id', 'ASC')
        ->select('station', 'id')
        ->get();
        $packages = Package::where('status', 'Active')->get();
        return view('admins.users.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::guard('admin')->user()->id;
        //validate the data
        $this->validate($request, array(
            'name'     => 'required|min:2|max:32',
            'email'         => 'email|max:50|nullable',
            'contact'       => 'required|min:11|max:11',
            'work_at'       => 'max:255|nullable',
            'profession'    => 'max:255|nullable',
            'location'      => 'max:255|nullable',
            'join_date'     => 'max:255|nullable',
            'mac_address'   => 'max:255|nullable',
            'left_long'     => 'max:255|nullable',
            'date_of_birth' => 'max:30|nullable',
            'NID'           => 'max:17|nullable',
            'details'       => 'max:999|nullable',
            'nid_image'     => 'image|nullable',
            'profile_image' => 'image|nullable'

        ));

        $data = $request->all();

        if(isset($data['_token']))
        {
          unset($data['_token']);
        }

        $lat = $long = null;

        if(isset($request->lat_long))
        {
          $arr = explode(',', str_replace(' ', '', $request->lat_long));
          $lat = $arr[0];
          $long = $arr[1];
        }

        $data['lat'] = $lat;
        $data['lng'] = $long;
        $data['created_by'] = auth()->id();

        //save image//
        if($request->hasFile('profile_image'))
        {
          $image    = $request->file('profile_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = ('images/profile/' . $filename);
          Image::make($image)->resize(600, 600)->save($location);

          $data['image'] = $filename;
        }

        if($request->hasFile('nid_image')) 
        {
          $image    = $request->file('nid_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = ('images/nid/' . $filename);
          Image::make($image)->resize(600, 360)->save($location);

          $data['nid_image'] = $filename;
        }
        
        $data['password'] = bcrypt($data['contact']);

        try{
          $user = User::updateOrCreate(
            [
              'username' => $data['contact']
            ], 
            $data
          );

        //session flashing
        Session::flash('success', 'New user successfully created!');

        //return to the show page
        return redirect()->route('user.show', $user->id);
        }
        catch(\Exception $e)
        {
          return $e->getMessage();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //Grab user data by id
        $user = User::with(['package:id,speed,price'])->find($id);

        if($request->ajax())
        {
          return response()->json([
            'user' => $user
          ], 200);
        }

        return view('admins.users.read_user')->withUser($user);
        // ->withServices($services);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $packages = Package::where('status', 'Active')->get();

        return view('admins.users.edit', compact('user', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::guard('admin')->user()->id;
        //validate the data
        $this->validate($request, array(
            'name'          => 'required|min:2|max:32',
            'email'         => 'email|max:50|nullable',
            'contact'       => 'required|min:11|max:11',
            'work_at'       => 'max:255|nullable',
            'profession'    => 'max:255|nullable',
            'join_date'     => 'max:255|nullable',
            'location'      => 'max:255|nullable',
            'details'       => 'max:500|nullable',
            'mac'           => 'max:255|nullable',
            'left_long'     => 'max:255|nullable',
            'date_of_birth' => 'max:30|nullable',
            'nid_no'        => 'max:17|nullable',
            'details'       => 'max:999|nullable',
            'nid_image'     => 'image|nullable',
            'profile_image' => 'image|nullable'

        ));

        $data = $request->all();
        if(isset($data['_token']))
        {
          unset($data['_token']);
        }
        if(isset($data['_method']))
        {
          unset($data['_method']);
        }

        //get exists image
        $exuser = User::find($id);

        $lat = $long = null;

        if(isset($request->lat_long))
        {
          $arr = explode(',', str_replace(' ', '', $request->lat_long));
          $lat = $arr[0];
          $long = $arr[1];
        }

        $data['lat'] = $lat;
        $data['lng'] = $long;
        $data['updated_by'] = auth()->id();
        $data['password'] = bcrypt($data['contact']);

        try {
          //save image//
          if($request->hasFile('profile_image'))
          {
            $image    = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = ('images/profile/' . $filename);
            Image::make($image)->resize(400, 400)->save($location);

            $data['image'] = $filename;
          }

          if($request->hasFile('nid_image'))
          {
            $image    = $request->file('nid_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = ('images/nid/' . $filename);
            Image::make($image)->resize(600, 360)->save($location);

            $data['nid_image'] = $filename;
          }

          // update user data
          User::where('id', $id)
          ->update($data);

          if($request->hasFile('profile_image'))
          {
            //delete exists image
            $ex_img = 'images/profile/'.$exuser->image;
            if(File::exists($ex_img))
            {
              File::delete($ex_img);
            }
          }

          if($request->hasFile('nid_image'))
          {
            //delete exists image
            $ex_nid = 'images/nid/'.$exuser->nid_image;
            if(File::exists($ex_nid))
            {
              File::delete($ex_nid);
            }
          }
        }
        catch(\Exception $e)
        {
          return $e->getMessage();
        }

        if($request->ajax())
        {
          return response()->json([
            'message' => 'success'
          ], 200);
        }        

        //set flash data with success message
        Session::flash('success', 'User Information successfully updated.');
        return back();
    }

    public function permitAdmin(Request $request, $id)
    {
        $user_id = Auth::guard('admin')->user()->id;
        $user = User::find($id);

        $admin = new Admin;
        $admin->first_name   = $user->first_name;
        $admin->last_name    = $user->last_name;
        $admin->email        = $user->email;
        $admin->contact      = $user->contact;
        $admin->type         = 'admin';
        $admin->password     = $user->password;
        $admin->dob          = $user->dob;
        $admin->job_title    = $user->job_title;
        $admin->image        = $user->image;
        $admin->created_by   = $user_id;
        $admin->creator_role = 'admin';

        $admin->save();

        //set flash data with success message
        Session::flash('success', 'The User permitted as admin.');

        //redirect with flash data to posts.show
        return redirect('/admin/user/'.$id.'/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find the container
        $user = User::find($id);

        //delete the container
        $user->delete();

        //flash the message
        Session::flash('success', 'The user was successfully deleted.');

        //return to the index page
        return redirect()->route('user.index')->with('The user deleted.');
    }

    // upload users list
    public function uploadList()
    {
      return view('admins.users.upload-list');
    }

    public function userListStore(Request $request)
    {
        $request->validate([
            'user_list' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('user_list');
        $handle = fopen($file->getRealPath(), 'r');

        $header = fgetcsv($handle); // First row as header

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            // dd($data);

            User::updateOrInsert(
              [
                'username' => $data['username']
              ],
              [
                'name' => $data['C Name'],
                'contact' => $data['username'],
                'password' => bcrypt($data['username']),
                'address' => $data['Area']
              ]
            );
        }

        fclose($handle);

        return back()->with('success', 'CSV imported successfully!');
    }

    public function userOnMap()
    {
      $map = new MapController;
      $data = $map->index();
      $customers = $data['customers'];
      // dd($customers);
      $status = $data['status'];
      return view('map.index', compact('customers', 'status'));
    }

    public function byUsername($username)
    {
      $user = User::where('username', $username)
      ->with(['package:id,speed'])
      ->first();

      return response()->json([
        'user' => $user
      ], 200);
    }

    public function checkIP($pon)
    {
      $ipBlock = 0;
      $addr = 2;
      $i = 254;

      if($pon == 'PON1')
      {
        $ipBlock = 249;
      }
      elseif($pon == 'PON2')
      {
        $ipBlock = 247;
      }
      elseif($pon == 'PON3')
      {
        $ipBlock = 250;
      }
      elseif($pon == 'PON4')
      {
        $ipBlock = 248;
      }
      elseif($pon == 'RADIO')
      {
        $ipBlock = 254;
        $addr = 101;
      }

      $used_ip = User::where('ip', 'like', '%'.$ipBlock.'%')
      ->pluck('ip')
      ->toArray();
      
      $ipFormat = '192.168.';
      $availableIp = [];

      for($i; $i >= $addr; $i--)
      {
        $ip = $ipFormat.$ipBlock.'.'.$i;
        if(!in_array($ip, $used_ip))
        {
          array_push($availableIp, $ip);
        }
      }

      return response()->json([
        'ip' => $availableIp
      ], 200);
    }

    public function getPayment(Request $request)
    {
      $data = $request->all();
      $user = User::find($data['user_id']);
      $price = $user->package ? $user->package->price : 0;
      $package_id = $user->package ? $user->package->id : 0;
      $balance = $user->balance + $data['amount'];

      try {
        $payment = Payment::where('user_id', $data['user_id'])
        ->where('receive_date', $data['payment_receive'])
        ->where('package_id', $package_id)
        ->first();

        if($balance >= $price && !$payment)
        {          
          User::where('id', $data['user_id'])->update(
            [
              'payment_date' => $data['payment_date'],
              'balance' => DB::raw("balance + ".intval($data['amount'])),
              'status' => 'Active'
            ]
          );

          // add to the payment
          Payment::create(
            [
              'receive' => $data['amount'],
              'receive_date' => $data['payment_receive'],
              'package_id' => $package_id,
              'user_id' => $data['user_id'],
              'status' => 'Paid'
            ]
          );
          
          Session::flash('success', 'Payment successfully received.');
        }
        else
        {
          Session::flash('error', 'Insufficient balance or already got the payment for this package');
        }

        return back();
      }
      catch(\Exception $e)
      {
        return $e->getMessage();
      }
    }

  public function activeUsers()
  {
    $url = 'https://chalanbeel.com/api/user?service_type=Static&iparray=true';
    // $url = 'http://dev.cbt/api/user?service_type=Static&iparray=true';
    // cURL request
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // if self-signed cert
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // seconds to connect
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);       // total seconds to execute
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $ips = json_decode($response, true);

    $router = new Router;
    $arp_users = $router->activeArp();

    foreach($arp_users as $key => $ip)
    {
      if(in_array($ip['address'], $ips))
      {
        $arp_users[$key]['status'] = 'Entry';
      }
      else
      {
        $arp_users[$key]['status'] = 'No Entry';
      }
    }
    
    // for($u = 0; $u < count($arp_users); $u++)
    // {
    //   $array_found = array_search($arp_users[$u]['address'], array_column($users, 'ip'));
    //   if($array_found)
    //   {
    //     $user = $users[$array_found];
    //     $arp_users[$u]['status'] = 'Entry';
    //     $arp_users[$u]['name'] = $user['name'];
    //     $arp_users[$u]['contact'] = $user['contact'];
    //   }
    //   else
    //   {
    //     $arp_users[$u]['status'] = 'Unknown';
    //     $arp_users[$u]['name'] = '';
    //     $arp_users[$u]['contact'] = '';
    //   }
    // }

    // dd($users);

    return view('admins.users.active-user', compact('arp_users'));
  }

  public function loginto($id)
  {
    $admin = Auth::guard('admin')->user()->id;
    $admuser = [];
    $user = User::find($id);
    if($user->status == 1)
    {
      $admuser = ['adminId' => $admin, 'userId' => $id];
    }
    else
    {
      return redirect()->route('user.index');
    }

    Session::put('_admuser', $admuser);
    return redirect('/admin_loginto');
  }
}