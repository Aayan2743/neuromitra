<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ApiHelper
{
    public static function sendMessage($phoneNumber, $text)
    {
        
       
        $token = env('MSG360KEY'); // Replace with your actual token
        // $token = '7EuB39eezbFJvVvzlzRnPAv6WHCjukxxPbm'; // Replace with your actual token

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post('https://api.360messenger.com/v2/sendMessage', [
            'phonenumber' => $phoneNumber,
            'text' => $text,
            
        ]);

        //dd($response->json());
        return $response->json();
    }
}
