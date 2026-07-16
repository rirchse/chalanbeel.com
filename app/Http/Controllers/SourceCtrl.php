<?php
namespace App\Http\Controllers;
use Mail;

class SourceCtrl extends Controller
{
  public function fileUpload($file, $path, $size = null)
  {
    $file_name = uniqid().'.'.$file->getClientOriginalExtension();
    $path = 'uploads/'.$path;
    $file->move(public_path($path), $file_name);
    $fileUrl = '/'.$path.$file_name;
    return $fileUrl;
  }

  public function dformat($date)
  {
    if($date)
    {
      return date('d M Y', strtotime($date));
    }
  }

  public function dtformat($date)
  {
    if($date)
    {
      return date('d M Y H:i:s', strtotime($date));
    }
  }

  public function sendMail(array $data)
  {
    $data1 = [
      'email_from' => 'chalanbeeltechnology1@gmail.com',
      'from_name' => 'Chalanbeel Technology'
    ];

    $data = array_merge($data, $data1);

    try {
      Mail::send('emails.default', $data, function($message) use ($data) {
          $message->to($data['email_to']);
  
          if (isset($data['email_bcc'])) {
              $message->bcc($data['email_bcc']);
          }
  
          $message->subject($data['subject']);
          $message->from($data['email_from'], $data['from_name']);
      });
  
    } catch (Swift_TransportException $e) {
  
      // Check if Gmail is temporarily rejecting (450-4.2.1)
      if (strpos($e->getMessage(), '450-4.2.1') !== false) {
          Log::warning('Gmail rate limit hit for ' . $data['email_to']);
  
          // Retry after some delay (example: 1 minute)
          sleep(60);
  
          // Optionally, try sending again once
          try {
              Mail::send('emails.default', $data, function($message) use ($data) {
                  $message->to($data['email_to']);
                  if (isset($data['email_bcc'])) {
                      $message->bcc($data['email_bcc']);
                  }
                  $message->subject($data['subject']);
                  $message->from($data['email_from'], $data['from_name']);
              });
          } catch (Swift_TransportException $e2) {
              Log::error('Retry failed for ' . $data['email_to'] . ': ' . $e2->getMessage());
          }
  
      } else {
          // Other mail transport error
          Log::error('Mail send failed for ' . $data['email_to'] . ': ' . $e->getMessage());
      }
    }
  }

  public function host()
  {    
    $protocol = isset($_SERVER['HTTPS'])?'https://':'http://';
    $host = $protocol.$_SERVER['HTTP_HOST'];
    if(empty($_SERVER['HTTP_HOST']))
    {
        $host = '/';
    }
    return $host;
  }

  public function sms($server, $numbers, $message)
  {
    // $server = config('services.sms.server');
    $username = config('services.sms.user');
    $password = config('services.sms.pass');

    $response = Http::get($server, [
      'user'     => $username,
      'password' => $password,
      'to'       => $numbers,
      'text'     => $message,
    ]);

    return $response;
  }
}