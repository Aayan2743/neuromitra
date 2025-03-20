<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\appointments;
use App\Models\health_daily_reports;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class FcmController extends Controller
{
    //
 
 
    public function feedbackHealth(Request $request){
         
        
        
        
        $userid= auth('api')->user();
        
       try {
        // Validate the request
        $validatedData = $request->validate([
            'message' => 'required|string|max:500', // Ensure message is required and within limit
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'status' => false,
            'message' => collect($e->errors())->flatten()->first(),
            // 'errors' => $e->errors(), // Get detailed validation errors
        ],200);
    }
        
        
        $existingFeedback = health_daily_reports::where('uid', $userid->id)
            ->whereDate('dateoffeedback', Carbon::today()) // Check if entry exists today
            ->exists();
        
        if ($existingFeedback) {
            return response()->json([
                
                'status'=>false,
                'message' => 'You can submit feedback only once per day.'], 200);
        }
        
        // If no feedback exists today, create a new one
        $createfeedback = health_daily_reports::create([
            'uid' => $userid->id,
            'message'=>$request->message,
            'status' => 1,
        ]);
        
        return response()->json([
            'status'=>true,
            'message' => 'Feedback submitted successfully.']);
        
        
        
        
        // $createfeedback=health_daily_reports::create([
        //     'uid'=> $userid->id,
        //     'status'=>1,
            
        //     ]);
            
            
            
        
        
        // dd( $createfeedback);
        
    }
 
 
    
     public function sendFcmNotification(Request $request)
    {
           $bookappointments = auth('api')->user();
           $booking_details=appointments::where('user_id',$bookappointments->id)->get();
           
           if(count($booking_details)>0){
               
               if (Carbon::parse($booking_details[0]->Date_of_appointment)->isToday()) {
                    // The date is today
                    return response()->json(['message' => 'The date is today.']);
                } else {
                    // The date is not today
                    return response()->json(['message' => 'The date is not today.']);
                }
               
                 //dd($booking_details[0]->Date_of_appointment); 
                 
                 
           }else{
               dd("dsfjhfg");
           }
           
          
           
           dd($bookappointments->id);
           
           $fcm = auth('api')->user()->fcm_token;
           
           
   
//   dd($fcm);
        $request->validate([
           
            'title' => 'required|string',
            'body' => 'required|string',
        ]);


        // $user = \App\Models\User::find($request->user_id);
        // $fcm = $user->fcm_token;

        if (!$fcm) {
            return response()->json(['message' => 'User does not have a device token'], 400);
        }

        $title = $request->title;
        $description = $request->body;
         $projectId = "neuromithra";
      

      
          $credentialsFilePath = Storage::disk('public')->path('neuromithra-firebase-adminsdk-eva65-c8aed024ac.json');

//dd($credentialsFilePath);
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();

        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];

        $data = [
            "message" => [
                "token" => $fcm,
                "notification" => [
                    "title" => $title,
                    "body" => $description,
                ],
            ]
        ];
        $payload = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return response()->json([
                'message' => 'Curl Error: ' . $err
            ], 500);
        } else {
            return response()->json([
                'message' => 'Notification has been sent',
                'response' => json_decode($response, true)
            ]);
        }
    }
    
     public function sendFcmNotification_old(Request $request)
    {
           $bookappointments = auth('api')->user();
           $booking_details=appointments::where('user_id',$bookappointments->id)->get();
           
           if(count($booking_details)>0){
               
               if (Carbon::parse($booking_details[0]->Date_of_appointment)->isToday()) {
                    // The date is today
                    return response()->json(['message' => 'The date is today.']);
                } else {
                    // The date is not today
                    return response()->json(['message' => 'The date is not today.']);
                }
               
                 //dd($booking_details[0]->Date_of_appointment); 
                 
                 
           }else{
               dd("dsfjhfg");
           }
           
          
           
           dd($bookappointments->id);
           
           $fcm = auth('api')->user()->fcm_token;
           
           
   
//   dd($fcm);
        $request->validate([
           
            'title' => 'required|string',
            'body' => 'required|string',
        ]);


        // $user = \App\Models\User::find($request->user_id);
        // $fcm = $user->fcm_token;

        if (!$fcm) {
            return response()->json(['message' => 'User does not have a device token'], 400);
        }

        $title = $request->title;
        $description = $request->body;
         $projectId = "neuromithra";
      

      
          $credentialsFilePath = Storage::disk('public')->path('neuromithra-firebase-adminsdk-eva65-c8aed024ac.json');

//dd($credentialsFilePath);
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();

        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];

        $data = [
            "message" => [
                "token" => $fcm,
                "notification" => [
                    "title" => $title,
                    "body" => $description,
                ],
            ]
        ];
        $payload = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return response()->json([
                'message' => 'Curl Error: ' . $err
            ], 500);
        } else {
            return response()->json([
                'message' => 'Notification has been sent',
                'response' => json_decode($response, true)
            ]);
        }
    }
}
