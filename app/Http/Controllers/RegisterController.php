<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Location;
use App\Package;
use Image;
use Session;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($package_id = null)
    {
        // Static areas array with English and Bengali translations
        $areas = [
            ['english' => 'Khubjipur', 'bangla' => 'খুবজিপুর'],
            ['english' => 'Pipla', 'bangla' => 'পিপলা'],
            ['english' => 'Palshura Patpara', 'bangla' => 'পুয়ালশুরা পাটপাড়া'],
            ['english' => 'Kusumhati', 'bangla' => 'কুসুমহাটি'],
            ['english' => 'Chapila', 'bangla' => 'চাপিলা'],
            ['english' => 'Gopinathpur', 'bangla' => 'গোপীনাথপুর'],
            ['english' => 'Rashidpur', 'bangla' => 'রশিদপুর'],
            ['english' => 'Mokimpur', 'bangla' => 'মকিমপুর'],
            ['english' => 'Chakrantopur', 'bangla' => 'চক্রন্তপুর'],
            ['english' => 'Pablani', 'bangla' => 'পাবলানী'],
            ['english' => 'Raushanpur', 'bangla' => 'রওশনপুর'],
            ['english' => 'Telkupi', 'bangla' => 'তেলকুপী'],
            ['english' => 'Anandanagar', 'bangla' => 'আনন্দনগর'],
            ['english' => 'Shahapur', 'bangla' => 'শাহপুর'],
            ['english' => 'Kalakandor', 'bangla' => 'কালাকান্দর'],
            ['english' => 'Puthimari', 'bangla' => 'পুথিমারি'],
            ['english' => 'Nawpara (East)', 'bangla' => 'নওয়াপাড়া (পূর্ব)'],
            ['english' => 'Khamarpara', 'bangla' => 'খামারপাড়া'],
            ['english' => 'Narayanpur', 'bangla' => 'নারায়ণপুর'],
            ['english' => 'Jogendranagar', 'bangla' => 'জগেন্দ্রনগর'],
            ['english' => 'Ganadanagar', 'bangla' => 'গণদ্রনগর'],
            ['english' => 'Sabgari', 'bangla' => 'সাবগাড়ী'],
            ['english' => 'Mollabazaar', 'bangla' => 'মোল্লাবাজার'],
            ['english' => 'Hamlaikol', 'bangla' => 'হামলাইকোল'],
            ['english' => 'Mamudpur', 'bangla' => 'মামুদপুর'],
            ['english' => 'Jumainagar', 'bangla' => 'জুমাইনগর'],
            ['english' => 'Bergangarampur', 'bangla' => 'বেরগঙ্গারামপুর'],
            ['english' => 'Kumarkhali', 'bangla' => 'কুমারখালী'],
            ['english' => 'Biaghat', 'bangla' => 'বিয়াঘাট'],
            ['english' => 'Dharabarisha', 'bangla' => 'ধারাবরিষা'],
            ['english' => 'Chalanali', 'bangla' => 'চালনালী'],
            ['english' => 'Char Kadaha', 'bangla' => 'চর কদাহা'],
            ['english' => 'Daudia Talbari', 'bangla' => 'দাউদিয়া তালবাড়ী'],
            ['english' => 'Jhakra', 'bangla' => 'ঝাকড়া'],
            ['english' => 'Khakradaha', 'bangla' => 'খাকরাদহ'],
            ['english' => 'Pualsura', 'bangla' => 'পুয়ালসুরা'],
            ['english' => 'Pualsura Arazi', 'bangla' => 'পুয়ালসুরা আরাজি'],
            ['english' => 'Santoshpur', 'bangla' => 'সন্তোষপুর'],
            ['english' => 'Sidhuli', 'bangla' => 'সিধুলি'],
            ['english' => 'Sonabaju', 'bangla' => 'সোনাবাজু'],
            ['english' => 'Udbaria', 'bangla' => 'উদবারিয়া'],
            ['english' => 'Phulbari', 'bangla' => 'ফুলবাড়ী'],
            ['english' => 'Phulchandrapur', 'bangla' => 'ফুলচাঁদ্রপুর'],
            ['english' => 'Moshinda', 'bangla' => 'মশিন্দা'],
            ['english' => 'Nazirpur', 'bangla' => 'নাজিরপুর'],
            ['english' => 'Kusumhati Mosque area', 'bangla' => 'কুসুমহাটি মসজিদ এলাকা'],
            ['english' => 'Bildahar', 'bangla' => 'বিলদহর'],
            ['english' => 'Mohismari', 'bangla' => 'মহিশমারি'],
        ];
        
        $package = null;
        
        if ($package_id) {
            $package = Package::find($package_id);
            if ($package) {
                Session::put('selected_package_id', $package_id);
            }
        }
        
        return view('homes.register', compact('areas', 'package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //validate the data
      $this->validate($request, array(
        'name'          => 'required|min:2|max:32',
        'email'         => 'unique:users|email|max:50|nullable',
        'contact'       => 'unique:users|required|min:11|max:11',
        'address'       => 'max:255',
        'profession'    => 'max:255',
        'join_date'     => 'max:255',
        'details'       => 'max:500',
        'profile_image' => 'image'
      ));

      $lat = $long = null;
      if(isset($request->lat_long))
      {
        $arr = explode(',', str_replace(' ', '', $request->lat_long));
        $lat = $arr[0];
        $long = $arr[1];
      }

      //store in the database
      $user = new User;
      $user->name         = $request->name;
      $user->contact      = $request->contact;
      $user->email        = $request->email;
      $user->username     = $request->contact;
      $user->password     = bcrypt($request->contact);
      $user->work_at      = $request->work_at;
      $user->profession   = $request->profession;
      $user->join_date    = date('Y-m-d');
      $user->details      = $request->details;
      $user->status       = 'New';
      $user->lat          = $lat;
      $user->lng          = $long;
      
      // Store package ID if selected
      if ($request->package_id) {
        $user->package_id = $request->package_id;
        Session::forget('selected_package_id');
      }

      //save image//
      if($request->hasFile('profile_image')){
        $image = $request->file('profile_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = ('images/' . $filename);
        Image::make($image)->resize(400, 400)->save($location);

        $user->image = $filename;
      }
      $user->save();

      //session flashing
      Session::flash('success', 'Thank you for Sign up! <br> Please login to your account using your mobile number and password<br> <b>Default Username & Password your contact number</b>.');

      //return to the show page
      return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $register = User::where('remember_token', $token)->first();
        return view('homes.register-details', compact('register'));
    }

    public function sendSMS(Request $request, $token)
    {
        $register = User::where('remember_token', $token)->first();

        if($register){
            $update = User::find($register->id);
            $update->token = rand('999999', '11111');
            $update->save();

            return redirect('/register/'.$token.'/edit');
        }

        Session::flash('error', 'We could not find your accoutn.');
        return redirect('/register/'.$token);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($token)
    {
        $register = User::where('remember_token', $token)->first();
        return view('homes.register-check-token', compact('register'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $token)
    {
        $this->validate($request, [
            'verification_code' => 'required|max:999999|numeric'
            ]);

        $register = User::where('remember_token', $token)->where('token', $request->verification_code)->first();
        if($register) {
            $update = User::find($register->id);
            $update->remember_token = '';
            $update->token = '';
            $update->status = 1;
            $update->save();

            //auto login to the user account
            if(Auth::loginUsingId($register->id)){
                return redirect('/home');
            }

        }

        Session::flash('error', 'We could not find your accoutn.');
        return redirect('/register/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verify($contact)
    {
        $user = User::where('contact', $contact)->first();
        return view('homes.contact-verify');
        // $update->token = rand(999999, 111111);
        // $update->save();

        // Session::flash('success', 'Contact number successfully verified.');
        // return redirect('/register/verify/confirm');
    }
}
