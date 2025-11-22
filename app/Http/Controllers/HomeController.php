<?php

namespace App\Http\Controllers;

use PEAR2\Net\RouterOS;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Router;
use App\Http\Controllers\MapController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Users;
use App\Paymethod;
use App\ActiveService;
use App\Service;
use App\Package;
use App\PaymentReceive;
use App\Location;
use App\Device;
use App\User;
use Redirect;
use DB;
use Auth;

class HomeController extends Controller
{
  public function postCheck(Request $request)
  {
    $user = [];

    $this->validate($request, [
      'contact' => 'required|min:11|max:11'
    ]);

    if($request->contact)
    {
      $user = User::where('contact', $request->contact)->first();
    }
    
    // If AJAX request, return JSON
    if ($request->ajax() || $request->wantsJson()) {
      if ($user) {
        $source = new \App\Http\Controllers\SourceCtrl;
        return response()->json([
          'success' => true,
          'user' => [
            'name' => $user->name,
            'status' => $user->status,
            'payment_date' => $source->dtformat($user->payment_date),
            'payment_date_raw' => $user->payment_date
          ]
        ]);
      } else {
        return response()->json([
          'success' => false,
          'message' => __('messages.search.error_not_found')
        ]);
      }
    }
    
    // For non-AJAX requests, return view (backward compatibility)
    return view('homes.index', compact('user'));
  }

  public function services()
  {
    return view('homes.services');
  }

  public function about()
  {
    return view('homes.about');
  }

  public function highSpeedInternet()
  {
    return view('homes.service-high-speed-internet');
  }

  public function stableConnection()
  {
    return view('homes.service-stable-connection');
  }

  public function support247()
  {
    return view('homes.service-24-7-support');
  }

  public function secureNetwork()
  {
    return view('homes.service-secure-network');
  }

  public function fastInstallation()
  {
    return view('homes.service-fast-installation');
  }

  public function trustedService()
  {
    return view('homes.service-trusted-service');
  }

  public function speedTest()
  {
    return view('homes.speed-test');
  }

  public function careers()
  {
    $careers = \App\Career::where('status', 1)
      ->orderBy('created_at', 'DESC')
      ->get();
    return view('homes.careers', compact('careers'));
  }

  public function career($id)
  {
    $career = \App\Career::where('status', 1)->findOrFail($id);
    return view('homes.career', compact('career'));
  }

  public function submitCareerApplication(Request $request, $id)
  {
    $career = \App\Career::where('status', 1)->findOrFail($id);
    
    // Validate the form data
    $this->validate($request, [
      'applicant_name' => 'required|max:255',
      'applicant_email' => 'required|email|max:255',
      'applicant_phone' => 'required|max:20',
      'applicant_address' => 'nullable|max:500',
      'applicant_experience' => 'nullable|max:2000',
      'applicant_cover_letter' => 'nullable|max:3000',
      'applicant_resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120' // 5MB max
    ]);

    try {
      // Use PHPMailer to send email
      require_once base_path('vendor/autoload.php');
      
      $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
      
      // Server settings
      $mail->isSMTP();
      $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
      $mail->SMTPAuth = true;
      $mail->Username = env('MAIL_USERNAME');
      $mail->Password = env('MAIL_PASSWORD');
      $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
      $mail->Port = env('MAIL_PORT', 587);
      $mail->CharSet = 'UTF-8';
      
      // Recipients
      $mail->setFrom(env('MAIL_FROM_ADDRESS', 'noreply@chalanbeel.com'), env('MAIL_FROM_NAME', 'Chalanbeel Technology'));
      $mail->addAddress('career@chalanbeel.com', 'Career Department');
      
      // Attach resume if uploaded
      if ($request->hasFile('applicant_resume')) {
        $resume = $request->file('applicant_resume');
        $mail->addAttachment($resume->getRealPath(), $resume->getClientOriginalName());
      }
      
      // Content
      $mail->isHTML(true);
      $mail->Subject = 'Job Application: ' . $career->title;
      
      $mail->Body = '
        <html>
        <head>
          <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #000; color: #fff; padding: 20px; text-align: center; }
            .content { background: #f9f9f9; padding: 20px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #000; }
            .value { margin-top: 5px; }
          </style>
        </head>
        <body>
          <div class="container">
            <div class="header">
              <h2>New Job Application</h2>
            </div>
            <div class="content">
              <div class="field">
                <div class="label">Position Applied For:</div>
                <div class="value">' . htmlspecialchars($career->title) . '</div>
              </div>
              <div class="field">
                <div class="label">Applicant Name:</div>
                <div class="value">' . htmlspecialchars($request->applicant_name) . '</div>
              </div>
              <div class="field">
                <div class="label">Email:</div>
                <div class="value">' . htmlspecialchars($request->applicant_email) . '</div>
              </div>
              <div class="field">
                <div class="label">Phone:</div>
                <div class="value">' . htmlspecialchars($request->applicant_phone) . '</div>
              </div>
              <div class="field">
                <div class="label">Address:</div>
                <div class="value">' . htmlspecialchars($request->applicant_address ?? 'N/A') . '</div>
              </div>
              <div class="field">
                <div class="label">Experience:</div>
                <div class="value">' . nl2br(htmlspecialchars($request->applicant_experience ?? 'N/A')) . '</div>
              </div>
              <div class="field">
                <div class="label">Cover Letter:</div>
                <div class="value">' . nl2br(htmlspecialchars($request->applicant_cover_letter ?? 'N/A')) . '</div>
              </div>
              <div class="field">
                <div class="label">Resume:</div>
                <div class="value">' . ($request->hasFile('applicant_resume') ? $request->file('applicant_resume')->getClientOriginalName() : 'Not attached') . '</div>
              </div>
              <div class="field">
                <div class="label">Application Date:</div>
                <div class="value">' . date('F d, Y h:i A') . '</div>
              </div>
            </div>
          </div>
        </body>
        </html>
      ';
      
      $mail->AltBody = "
        New Job Application
        
        Position: {$career->title}
        Name: {$request->applicant_name}
        Email: {$request->applicant_email}
        Phone: {$request->applicant_phone}
        Address: " . ($request->applicant_address ?? 'N/A') . "
        Experience: " . ($request->applicant_experience ?? 'N/A') . "
        Cover Letter: " . ($request->applicant_cover_letter ?? 'N/A') . "
        Application Date: " . date('F d, Y h:i A') . "
      ";
      
      $mail->send();
      
      return response()->json([
        'success' => true,
        'message' => __('messages.careers.application_submitted')
      ]);
      
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => __('messages.careers.submission_error') . ': ' . $e->getMessage()
      ], 500);
    }
  }

  public function speedTestDownload(Request $request)
  {
    // Generate a test file of specified size (in MB)
    $size = $request->input('size', 1); // Default 1MB
    $sizeInBytes = $size * 1024 * 1024;
    
    // Generate random binary data
    $data = random_bytes($sizeInBytes);
    
    return response($data)
      ->header('Content-Type', 'application/octet-stream')
      ->header('Content-Length', $sizeInBytes)
      ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
      ->header('Pragma', 'no-cache')
      ->header('Expires', '0');
  }

  public function speedTestUpload(Request $request)
  {
    // Receive uploaded data and return size
    // Read the actual content to ensure it's received
    $content = $request->getContent();
    $size = strlen($content);
    
    return response()->json([
      'received' => $size,
      'timestamp' => microtime(true)
    ]);
  }

  public function speedTestPing()
  {
    return response()->json([
      'timestamp' => microtime(true)
    ]);
  }

    public function checkAccount()
    {
        $user = User::find(1);
        return view('homes.check_account', compact('user'));
    }

    public function checkAccountDetails(Request $request)
    {
        $service = Service::leftJoin('service_plans', 'service_plans.service_id', 'services.id')
        ->where('services.username', $request->username)->get();
        return view('homes.check_account_details', compact('service'));
    }
    //user dashboard login by admin
    public function adminLoginTo()
    {
      if(!empty(Session::get('_admuser'))){
          $admuser = Session::get('_admuser');

          if(Auth::guard('admin')->check() == true){

              if(Auth::loginUsingId($admuser['userId'])){
                  Session::forget('_admuser');
                  return redirect('/home');
              }
          }
      }

      return redirect('admin/view_users/active');
    }

    public function ConnectTest()
    {
        return Router::connect();
    }

    public function index()
    {
        $message = Lang::get('messages.welcome');
        $packages = Package::where(function($query) {
                $query->where('status', 'Active');
            })
            ->orderBy('price', 'ASC')
            ->limit(6)
            ->get();
        // dd($message);
        // $pppoe_users = Router::Connect()->setMenu('/ppp secret')->getAll();
        return view('homes.index', ['message' => $message, 'packages' => $packages]);
    }

    public function check_package()
    {
        $packages = Service::where('status', 1)
        ->select('package')
        ->groupBy('package')
        ->orderBy('id', 'ASC')
        ->get();
        $limits = Service::where('status', 1)
        ->select('time_limit')
        ->groupBy('time_limit')
        ->orderBy('time_limit')
        ->get();
        return view('homes.check_package')->withPackages($packages)->withLimits($limits);
    }

    public function checkPackage(Request $request)
    {
        //data validation
        $this->validate($request, array(
            'package'      => 'required|max:50',
            'time_limit'   => 'required|max:50'
        ));
        $service = Service::where('package', $request->package)->where('time_limit', $request->time_limit)->where('status', 1)->first();
        $packages = Service::where('status', 1)
        ->select('package')
        ->groupBy('package')
        ->orderBy('id', 'ASC')
        ->get();
        $limits = Service::where('status', 1)
        ->select('time_limit')
        ->groupBy('time_limit')
        ->orderBy('time_limit')
        ->get();
        return view('homes.check_package')->withPackages($packages)->withLimits($limits)->withService($service);
    }

    public function check_payment()
    {
        $payments = Paymethod::where('status', 1)->get();
        return view('homes.check_payment')->withPayments($payments);
    }

    public function checkPayment(Request $request)
    {
        //validate the data
        $this->validate($request, array(
            'payment_method' => 'required|max:255',
            'paid_mobile_no' => 'required|max:11',
            'transaction_id' => 'required|max:32',
        ));

        $payments = PaymentReceive::where('payment_method', $request->payment_method)
        ->where('account_number', $request->paid_mobile_no)
        ->where('transaction_id', $request->transaction_id)
        ->first();

        $services = '';
        if(empty($payments)) {
            Session::flash('error', 'Payment information does not match!');
            return redirect('/check_payment');
        } elseif ($payments->status != 0) {
            Session::flash('error', 'You are already registered by this payment!');
            return redirect('/check_payment');
        } else {
            $services = Service::where('status', 1)
            ->where('category', 'Internet')
            ->where('price', $payments->receive_amount)
            ->get();
        }

        Session::put('services', $services);
        Session::put('payment_id', $payments->id);
        return redirect('/registration');
    }

    public function create()
    {
        $area = Location::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('homes.register')->withAreas($area);
    }

    public function store(Request $request)
    {

        //validate the data
        $this->validate($request, array(

            'full_name'    => 'required|min:2|max:32',
            'email'         => 'unique:users|email|max:50|nullable',
            'contact'       => 'required|min:11|max:11|confirmed',
            'service'       => 'required|max:255',
            'connection'    => 'required|max:255',
            'speed'         => 'required|max:255',
            'time_limit'    => 'required|max:255',
            'area'          => 'required|max:255'

        ));

        if ( !empty(Users::where('contact', $request->contact)->first()) ) {
            Session::flash('error', 'The contact number already registered. Please complete the payment');
            return redirect('/user_payment');

        } else if( empty(Service::where('service', $request->service)->where('connection', $request->connection)->where('speed', $request->speed)->where('time_limit', $request->time_limit)->first()) ) {
            Session::flash('error', 'Service, connection, speed not match as package!');
            return redirect('/registration');

        } else {

            // mac addr generator
            function GetMAC() {
                ob_start();
                system('getmac');
                $Content = ob_get_contents();
                ob_clean();
                return substr($Content, strpos($Content,'\\')-20, 17);
            }

            $service_id = Service::where('service', $request->service)->where('connection', $request->connection)->where('speed', $request->speed)->where('time_limit', $request->time_limit)->first()->id;

            //store in the database
            $user = new Users;
            $user->full_name    = $request->full_name;
            $user->username     = $request->contact;
            $user->email        = $request->email;
            $user->password     = bcrypt($request->contact);
            $user->int_password = $request->contact;
            $user->contact      = $request->contact;
            $user->mac_address  = GetMAC();
            $user->left_long    = '';
            $user->service_id   = $service_id;
            $user->location_id  = $request->area;
            $user->join_date    = date('Y-m-d');
            $user->save();

            $user_id = Users::orderBy('id', 'DESC')->first()->id;

            // create active service
            $service = new ActiveService;
            $service->reference     = 'cbtepay';
            $service->service_id    = $service_id;
            $service->location_id   = $request->area;
            $service->user_id       = $user_id;
            $service->password      = $request->contact;
            $service->creator_role  = 'user';
            $service->created_by    = $user_id;
            $service->status        = 0;

            //session flashing
            Session::flash('success', 'New account successfully created! <br> You will get a confirmation message to this mobile number: <b>'.$request->contact.'</b>');
            
            //return to the show page
            return redirect('/create/'.$user_id.'/payment/'.$service_id);
        }
    }

    public function create_payment($user, $service)
    {
        //
        $user = User::leftJoin('active_services', 'users.id', 'active_services.user_id')
        ->leftJoin('services', 'active_services.service_id', 'services.id')
        ->leftJoin('locations', 'active_services.location_id', 'locations.id')
        ->find($user);
        return view('homes.create_payment')->withUser($user);
    }

    public function userOnMap()
    {
      $map = new MapController;
      $data = $map->index();
      $customers = $data['customers'];
      $status = $data['status'];
      return view('dashboard.map', compact('customers', 'status'));
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'bn'])) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}