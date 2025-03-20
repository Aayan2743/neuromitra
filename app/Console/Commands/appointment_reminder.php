<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\appointments; // Adjust according to your model
use App\Models\User; // Adjust according to your model
use App\Notifications\FcmNotification; // Ensure this is imported
use Carbon\Carbon;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;



class appointment_reminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   
     protected $signature = 'send:reminders';
    protected $description = 'Send FCM reminders 30 minutes before an appointment';

    public function handle()
    {
        // Get current time and calculate reminder time
        $now = Carbon::now();
        $reminderTime = $now->copy()->addMinutes(30);

       
//         // Retrieve appointments happening in the next 30 minutes
//         //$appointments = appointments::whereBetween('time_of_appointment', [$now, $reminderTime])->get();
//         $currentDate = $now->format('Y-m-d');
// $startTime = $now->format('H:i:s'); // current time
// $endTime = $reminderTime->format('H:i:s'); // time 30 minutes from now

// // Query the appointments
// $appointments = appointments::whereDate('Date_of_appointment', $currentDate)
//     //->whereBetween('time_of_appointment', [$startTime, $endTime])
//     ->get();
    
    
//     $currentDate = $now->format('Y-m-d');
// $currentTime = $now->format('H:i:s'); // Current time
// $reminderTimeFormatted = $reminderTime->format('H:i:s'); // Time 30 minutes from now

// // Query appointments that are today and before 30 minutes from now
// $appointments = appointments::whereDate('Date_of_appointment', $currentDate)
//     ->where('time_of_appointment', '<=', $reminderTimeFormatted)
//     ->get();
    
    
    // $now = Carbon::now();
$currentDate = $now->format('Y-m-d'); // Today's date
$reminderTime = $now->copy()->subMinutes(30); // Time exactly 30 minutes ago
$reminderTimeFormatted = $reminderTime->format('H:i:s'); // Format for time comparison

// Query appointments for today that are exactly 30 minutes before the current time
$appointments = appointments::whereDate('Date_of_appointment', $currentDate)
    ->where('time_of_appointment', '=', $reminderTimeFormatted) // Check for exact match
    ->get();
        
        
  \Log::info('TestCronCommand executed at ' .  $appointments);
 
        foreach ($appointments as $appointment) {
            // Fetch the user associated with the appointment
            $user = User::find($appointment->user_id);
            $fcm = $user->fcm_token;
//\Log::info('TestCronCommand executed at appointment ' .  $appointment->time_of_appointment);

            if ($user) {
                // Prepare the notification title and body
                // $title = "Upcoming Appointment Reminder";
                $title = "Upcoming Appointment Reminder";
              
                  $description = "You have an appointment scheduled at ". $appointment->time_of_appointment. ".";
                // $description = "You have an appointment scheduled at ";

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
        $this->info('Curl Error: ' . $err); // Use console output instead
        return 1; // Return a non-zero code for error
    } else {
        $this->info('Notification has been sent'); // Use console output instead
        return 0; // Return zero for success
    }

        // if ($err) {
        //     return response()->json([
        //         'message' => 'Curl Error: ' . $err
        //     ], 500);
        // } else {
         
        //     return response()->json([
        //         'message' => 'Notification has been sent',
              
                
        //     ]);
        // }
                


                // Send the notification
               // $user->notify(new FcmNotification($title, $body));
            }
        }

        $this->info('Reminders sent for upcoming appointments.');
    }
   
   
}
