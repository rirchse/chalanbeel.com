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
use App\Http\Controllers\Router;
use Auth;
use Image;
use File;
use Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function loginto($id)
    {
        $admin = Auth::guard('admin')->user()->id;
        $admuser = [];
        $user = User::find($id);
        if($user->status == 1){
            $admuser = ['adminId' => $admin, 'userId' => $id];
        }else{
            return redirect()->route('user.index');
        }

        Session::put('_admuser', $admuser);
        return redirect('/admin_loginto');
    }

    public function index(Request $request)
    {
      $status = $date = '';
      // Get all users from database
      $users = User::orderBy('id', 'DESC');
      if($request->status)
      {
        $users = $users->where('status', $request->status);
        $status = $request->status;
      }
      if($request->date)
      {
        $users = $users->where('payment_date', 'like',  '%'.$request->date);
        $date = $request->date;
      }
      $users = $users->get();

      // if($request->ajax())
      // {
      //   return response()->json([
      //     'users' => $users
      //   ], 200);
      // }

      return view('admins.users.index', compact('users', 'status', 'date'));
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
        return view('admins.users.create')->withLocations($areas);
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

        if($data['service_type'] == 'pppoe')
        {
          $data['password'] = $data['password'];
        }        

        try{
          $user = User::updateOrCreate(
            [
              'username' => $data['contact']
            ], 
            $data
          );
        }
        catch(\Exception $e)
        {
          return $e->getMessage();
        }

        // $customer = User::orderBy('id', 'DESC')->first()->id;

        //session flashing
        Session::flash('success', 'New user successfully created!');

        //return to the show page
        return redirect()->route('user.show', $user->id);
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
        $user = User::find($id);

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
        $locations = Location::where('status', 1)->get();
        return view('admins.users.edit')->withUser($user)->withLocations($locations);
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
            'name'     => 'required|min:2|max:32',
            'email'         => 'email|max:50|nullable',
            'contact'       => 'required|min:11|max:11',
            'work_at'       => 'max:255|nullable',
            'profession'    => 'max:255|nullable',
            'join_date'     => 'max:255|nullable',
            'location'      => 'max:255|nullable',
            'details'       => 'max:500|nullable',
            'mac'   => 'max:255|nullable',
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

        try {
          //save image//
          if($request->hasFile('profile_image')){
            $image    = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = ('images/profile/' . $filename);
            Image::make($image)->resize(400, 400)->save($location);

            $update->image = $filename;
          }

          if($request->hasFile('nid_image')) {
              $image    = $request->file('nid_image');
              $filename = time() . '.' . $image->getClientOriginalExtension();
              $location = ('images/nid/' . $filename);
              Image::make($image)->resize(600, 360)->save($location);

              $update->nid_image = $filename;
          }

          //update user data
          User::where('contact', $data['contact'])
          ->update($data);

          if($request->hasFile('profile_image')){
              //delete exists image
              $ex_img = 'images/profile/'.$exuser->image;
              if(File::exists($ex_img)){
                  File::delete($ex_img);
              }
          }

          if($request->hasFile('nid_image')) {
              //delete exists image
              $ex_nid = 'images/nid/'.$exuser->nid_image;
              if(File::exists($ex_nid)){
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
      $user = User::where('username', $username)->first();
      return response()->json([
        'user' => $user
      ], 200);
    }

    public function checkIP($pon)
    {
      $ipBlock = 0;

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
        $ipBlock = 0;
      }
      elseif($pon == 'RADIO')
      {
        $ipBlock = 254;
      }

      $used_ip = User::where('ip', 'like', '%'.$ipBlock.'%')
      ->pluck('ip')
      ->toArray();
      
      $ipFormat = '192.168.';
      $availableIp = [];

      for($i = 2; $i <= 254; $i++)
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
}