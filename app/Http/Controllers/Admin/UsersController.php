<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function viewUsers($type)
    {
        $status = '';
        if ($type == 'new'){
            $status = 0;
        }elseif ($type == 'active') {
            $status = 1;
        }elseif ($type == 'free') {
            $status = 2;
        }elseif ($type == 'cancel') {
            $status = 3;
        }

        $users = User::leftJoin('locations', 'users.location_id', 'locations.id')
        ->where('users.status', $status)
        ->orderBy('users.id', 'DESC')
        ->select('users.*', 'locations.station')
        ->get();
        return view('admins.users.index')->withUsers($users)->withType($type);
    }

    public function activeUsersMikrotik(){
        $pppoe_active_users = Router::Connect()->setMenu('/ppp active')->getAll();
        return view('admins.users.view_active_users_mikrotik')->withUsers($pppoe_active_users);
    }
    public function getRouterUsers()
    {
        $user_id = Auth::guard('admin')->user()->id;

        $pppoe_users = Router::Connect()->setMenu('/ppp secret')->getAll();
        foreach($pppoe_users as $user){

            if(count(User::where('contact', $user('name'))->get()) < 1) {
                $create = New User;
                $create->full_name   = $user('comment') == ''?$user('name'):$user('comment');
                $create->username    = $user('name');
                $create->password    = bcrypt($user('password'));
                $create->contact     = $user('name');
                $create->join_date   = date('Y-m-d');
                $create->location_id = 1;
                $create->status      = $user('disabled') == 'yes'?0:1;
                // $create->service  = $user('service');
                $create->details     = $user('comment');
                $create->save();

                $lastuser = User::orderBy('id', 'DESC')->first();
                $package = Package::where('speed', $user('profile'))->first();

                $service = New Service;
                $service->user_id = $lastuser->id;
                $service->package_id = count($package) < 1 ? 0 : $package->id;
                $service->password = $user('password');
                $service->billing_date = date('Y-m-d');
                $service->details = $user('comment');
                $service->location_id = 1;
                $service->status = 1;
                $service->created_by = $user_id;
                $service->save();
            }
        }

        Session::flash('success', 'Users updated from router.');
        return redirect('/admin/view_users');
    }
    public function active_users()
    {
        // Get all users from database
        $users = User::leftJoin('locations', 'users.location_id', 'locations.id')
        ->orderBy('users.id', 'DESC')
        ->where('users.status', 1)
        ->select('users.*', 'locations.station')
        ->get();
        return view('admins.users.view_active_users')->withUsers($users);
    }

    public function index()
    {
        // Get all users from database
        $users = User::leftJoin('locations', 'users.location_id', 'locations.id')
        ->orderBy('users.id', 'DESC')
        ->select('users.*', 'locations.station')
        ->get();
        return view('admins.users.index')->withUsers($users);
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
        // $services = Service::orderBy('service')->groupBy('service', 'connection', 'speed', 'time_limit')
        // ->select('service', 'connection', 'speed', 'time_limit')->get();
        //->all();
        //$areas = $areas::lists('station', 'id');
        return view('admins.users.create_user')->withLocations($areas);
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
            'full_name'     => 'required|min:2|max:32',
            'email'         => 'unique:users|email|max:50|nullable',
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

        if (User::where('contact', $request->contact)->first()) {
            
            //session flashing
            Session::flash('error', 'The user already signed up.');

            //return to the show page
            return redirect('/admin/create_user');

        } else {

            //store in the database
            $customer = new User;
            $customer->full_name    = $request->full_name;
            $customer->contact      = $request->contact;
            $customer->email        = $request->email;
            $customer->username     = $request->contact;
            $customer->password     = bcrypt($request->contact);
            $customer->work_at      = $request->work_at;
            $customer->profession   = $request->profession;
            $customer->location_id  = $request->location;
            $customer->join_date    = date('Y-m-d', strtotime($request->join_date));
            $customer->details      = $request->details;
            $customer->mac_address  = $request->mac_address;
            $customer->left_long    = $request->left_long;
            $customer->date_of_birth= $request->date_of_birth;
            $customer->nid_no       = $request->NID;
            $customer->created_by   = $user_id;
            $customer->status       = $request->status;

            //save image//
            if($request->hasFile('profile_image')) {
                $image    = $request->file('profile_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = ('images/profile/' . $filename);
                Image::make($image)->resize(600, 600)->save($location);

                $customer->image = $filename;
            }

            if($request->hasFile('nid_image')) {
                $image    = $request->file('nid_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = ('images/nid/' . $filename);
                Image::make($image)->resize(600, 360)->save($location);

                $customer->nid_image = $filename;
            }

            $customer->save();

            $customer = User::orderBy('id', 'DESC')->first()->id;

            //session flashing
            Session::flash('success', 'New user successfully created!');

            //return to the show page
            return redirect('/admin/user/'.$customer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Grab user data by id
        $user = User::leftJoin('locations', 'users.location_id', 'locations.id')
        ->select('users.*', 'locations.station', 'locations.area')
        ->find($id);

        return response()->json([
          'user' => $user
        ], 200);
        // return view('admins.users.read_user')->withUser($user);
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
        return view('admins.users.edit_user')->withUser($user)->withLocations($locations);
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
            'mac_address'   => 'max:255|nullable',
            'left_long'     => 'max:255|nullable',
            'date_of_birth' => 'max:30|nullable',
            'NID'           => 'max:17|nullable',
            'details'       => 'max:999|nullable',
            'nid_image'     => 'image|nullable',
            'profile_image' => 'image|nullable'

        ));

        //get exists image
        $exuser = User::find($id);

        $lat = $long = null;

        if(isset($request->lat_long))
        {
          $arr = explode(',', str_replace(' ', '', $request->lat_long));
          $lat = $arr[0];
          $long = $arr[1];
        }

        //save the data to the database
        $update = User::find($id);
        $update->name       = $request->input('name');
        $update->contact         = $request->input('contact');
        $update->email           = $request->input('email');
        $update->username        = $request->input('contact');
        $update->work_at         = $request->input('work_at');
        $update->profession      = $request->input('profession');
        $update->join_date       = date('Y-m-d', strtotime($request->join_date));
        $update->location_id     = $request->input('location');
        $update->details         = $request->input('details');
        $update->mac_address     = $request->input('mac_address');
        $update->left_long       = $request->input('left_long');
        $update->date_of_birth   = $request->date_of_birth;
        $update->nid_no          = $request->NID;
        $update->updated_by      = $user_id;
        $update->status          = $request->status;
        $update->lat          = $lat;
        $update->lng          = $long;

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

        $update->save();

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

        return response()->json([
          'result' => 'success'
        ], 200);

        //set flash data with success message
        Session::flash('success', 'User Information successfully updated.');

        //redirect with flash data to posts.show
        // return redirect('/admin/user/'.$id);
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
        return back()->with('The user deleted.');
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
                'full_name' => $data['C Name'],
                'contact' => $data['username'],
                'password' => bcrypt($data['username']),
                'address' => $data['Area']
              ]
            );

            // DB::table('your_table')->insert([
            //     'name'  => $data['name'],
            //     'email' => $data['email'],
            //     'phone' => $data['phone'],
            //     // map other columns
            // ]);
        }

        fclose($handle);

        return back()->with('success', 'CSV imported successfully!');
    }
}