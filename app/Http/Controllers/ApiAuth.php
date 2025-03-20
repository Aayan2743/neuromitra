<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\appointments;
use App\Models\customerreview;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;
use Illuminate\Support\Facades\Artisan;
use App\Models\useraddressdetail;
use App\Models\patientData;
use App\Models\behaviroval_tracker;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendOtp;
use Carbon\Carbon;
use App\Helpers\ApiHelper;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\health_daily_reports;
class ApiAuth extends Controller
{
    //
    
     public function randomQuote(): JsonResponse
    {
     
       $quotes = [
            "Your mental health is a priority. Your happiness is essential. Your self-care is a necessity. — Unknown",
            "You don't have to control your thoughts. You just have to stop letting them control you. — Dan Millman", 
            "Healing takes time, and asking for help is a courageous step. — Mariska Hargitay",
            "Self-care is how you take your power back. — Lalah Delia",
            "You are stronger than you think, and you are not alone. — Unknown",
            "Mental health… is not a destination, but a process. It's about how you drive, not where you're going. — Noam Shpancer",
            "Your illness does not define you. Your strength and courage do. — Unknown",
            "Rest when you're weary. Refresh and renew yourself, your body, your mind, your spirit. Then get back to work. — Ralph Marston",
            "It's okay to not be okay, as long as you are not giving up. — Karen Salmansohn",
            "You, yourself, as much as anybody in the entire universe, deserve your love and affection. — Buddha",
        ];

        $randomQuote = $quotes[array_rand($quotes)];

        // Convert to UTF-8 to prevent encoding issues
        $randomQuote = mb_convert_encoding($randomQuote, 'UTF-8', 'UTF-8');

        return response()->json(['quote' => $randomQuote], 200, [], JSON_UNESCAPED_UNICODE);
     
     
    }
    
    
    
    public function forgotpassworduser(Request $req){
        
        
        // dd($req->all());
        
         
           $validator = Validator::make($req->all(), [
                 'email' => 'required|email|exists:users,email',
  
            ],[
                 'email.exists'=>'The following email not exist in our records'   
                    
                ]);



                if ($validator->fails()) {
                    $firstError = $validator->errors()->first();
                    
                    return response()->json([
                        'message' => $firstError,
                        'status'=>false
                    ], 400);
                }
                
                $randomNumber = rand(100000, 999999);
                
                      $update=user::where('email',$req->email)->update([
                            'code'=>$randomNumber,
                            'codeexp'=> now()->addMinutes(5),
                            'codestatus'=>true
                    
                     ]);
                     
                       $data = [
                        'code' => $randomNumber,
                        'time' => '5 min',
                    ];
                
                    Mail::to($req->email)->send(new sendOtp($data));


                     
                    
                    if($update==1){
                            return response()->json(['status'=>'code send']);
                    }
                
                //dd(  $randomNumber);



        
        
    }
    
    
    public function resetpassword(Request $req){
        
  $validator = Validator::make($req->all(), [
                 'code' => 'required|exists:users,code',
                 'password' => 'required|min:6'
  
            ],[
                 'code.exists'=>'Invalid Otp'   
                    
                ]);



                if ($validator->fails()) {
                    $firstError = $validator->errors()->first();
                    
                    return response()->json([
                        'message' => $firstError,
                        'status'=>false
                    ], 400);
                }
                
                
                $gettime=user::where('code',$req->code)->get();
                
                if(count($gettime)>0){
                    
                        $exp_time=$gettime[0]->codeexp;
                    
                     $timestamp = Carbon::createFromFormat('Y-m-d H:i:s', $exp_time);
                       $currentTime = Carbon::now();
                      if ($timestamp->isPast()) {
                        return response()->json(['message' => 'Time Expired.']);
                    } elseif ($timestamp->isFuture()) {
                        
                        $updatepassword=user::where('code',$req->code)->update([
                           
                             'password' => Hash::make($req->password),
                            
                            ]);
                            
                            if($updatepassword==1){
                                return response()->json(['message' => 'Password updated successfully.']); 
                            }
                        
                       
                    }
//dd($timestamp);
                       // dd("dfgjdfg");
                }else{
                    dd("no data");
                }
                
                dd($gettime);
                
                 $specificTimestamp = '2024-10-21 16:03:36';
    
                    // Create a Carbon instance from the specific timestamp
                    $timestamp = Carbon::createFromFormat('Y-m-d H:i:s', $specificTimestamp);
                
                    // Get the current time
                    $currentTime = Carbon::now();
                
                    // Compare the timestamps
                    if ($timestamp->isPast()) {
                        return response()->json(['message' => 'The timestamp is in the past.']);
                    } elseif ($timestamp->isFuture()) {
                        return response()->json(['message' => 'The timestamp is in the future.']);
                    } else {
                        return response()->json(['message' => 'The timestamp is now.']);
                    }
                
               // dd($req->code);
                
                
                
        
    }
    
    
    public function get_therapy_traking($pid,$slag){
        //dd($aid);
        
        // $get_data_for_selected_appointment=appointments::where('id',$aid)->get();
       
        //dd($get_data_for_selected_appointment[0]->pid);
       
       
        // $get_behavirual=behaviroval_tracker::where('aid',$aid)->where('page_source',$get_data_for_selected_appointment[0]->page_source)->get();
        $get_behavirual=behaviroval_tracker::where('pid',$pid)->where('page_source', 'like', '%' . $slag . '%')->get();
        
      //  dd($get_behavirual);
        // $get_behavirual = behaviroval_tracker::where('aid', $aid)->get();
        
    // ->where('page_source', 'like', '%' . $get_data_for_selected_appointment[0]->page_source . '%')
    // ->get();

    
       
    // dd($get_behavirual);
        if(count($get_behavirual)>0){
            return response()->json([
                'status'=>true,
                'details'=>$get_behavirual
                
                ]);
        }else{
            
            return response()->json([
                'status'=>false]);
        }
        
        
    }

    public function get_profile(){
        // return response()->json(auth('api')->user());

        $user = Auth::guard('api')->user();

    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Get today's date
    $today = Carbon::today();

    // Fetch today's health feedback
    $healthFeedback = health_daily_reports::where('uid', $user->id)
                        ->whereDate('dateoffeedback', $today)
                        ->exists();

    return response()->json([
        'user' => $user,
        'health_feedback' =>  ['status' => $healthFeedback]
    ]);
    
    


    }
    
    public function check_previous_bookings($slag){
            
        
 Artisan::call('optimize:clear');
        $user_id = auth('api')->user()->id;
        
        // dd($user_id);  
        $get_booking_details=appointments::where('user_id',$user_id)->where('page_source',$slag)->get(); 

        if(count($get_booking_details)>0){
        $all_patients = [];
            foreach($get_booking_details as $patient){
                $get_patient = patientData::where('pid', operator: $patient->pid)->first(); // Retrieve single patient
                if ($get_patient) {
                    $all_patients[] = $get_patient; // Collecting patient details directly
                }
            }
        
        return response()->json(['status' => true, 'patients' => $all_patients]);
        
        
        
        //     $all_patients = [];
        //   foreach($get_booking_details as $patient){
        //             $get_patinet=patientData::where('pid',$patient->pid)->get();
        //             $all_patients[] = $get_patinet; // Collecting patient details

                 

        //   }

        //   return response()->json(['status' => true, 'patients' => $all_patients]);


        }else{
            return response()->json(['status'=>false,'message'=>'No Data']);
        }


      //  dd($get_booking_details);

    }
    
   
    
    public function downloadfile($fid){
         //$user_id = auth('api')->user()->id;
         
         //dd($fid);
                    $filename=appointments::where('id',$fid)->get();
         
           $relativePath = 'public/' . $filename[0]->file_path;
        
        if (Storage::exists($relativePath)) {
            // Get the file from storage and return it as a download response
            return Storage::download($relativePath);
        } else {
            // Return a 404 response if the file is not found
            return response()->json(['message' => 'File not found.'], Response::HTTP_NOT_FOUND);
        }
        
        
        
         

       




    }


    public function download($filename)
    {
        // Construct the file path
        $path = storage_path('app/public/uploads/' . $filename);

        // Check if the file exists
        if (file_exists($path)) {
            // Return the file as a download response
            return response()->download($path);
        }

        // If file doesn't exist, redirect back with an error message
        return redirect()->back()->with('error', 'File not found.');
    }

    public function userlogin(Request $request)
    {
        //dd($request->all());
         //  Artisan::call('optimize:clear');
           
           
     $validator = Validator::make($request->all(), [
    'email' => 'required|email',
    'password' => 'required',
    'fcm_token' => 'nullable|string', // FCM token is optional
]);

if ($validator->fails()) {
    return response()->json([
        'message' => $validator->errors()->first(),
        'status' => false
    ], 400);
}


$credentials = $validator->validated();
$emailPasswordOnly = collect($credentials)->only(['email', 'password'])->toArray();

// Check if user exists and is of type 1 before attempting login
$user = User::where('email', $credentials['email'])->where('user_type', 1)->first();

if (!$user) {
    return response()->json([
        'error' => 'Access denied. Only user type 1 is allowed.'
    ], 403);
}


auth()->logout(true);

// Authenticate the user (Only user_type 1 can proceed)
if (!$token = auth('api')->attempt($emailPasswordOnly)) {
    return response()->json([
        'error' => 'Invalid Credentials'
    ], 401);
}



// ✅ If authenticated, update the FCM token if provided
if ($request->filled('fcm_token')) {
    $user->update([
        'fcm_token' => $request->fcm_token
    ]);
}

// ✅ Return success response with token
return $this->resondedJwtToken($token);


















    



       
    }


    protected function resondedJwtToken($token){
    
        return response()->json([
        
        'access_token'=>$token,
        'token_type'=>'bearer',
        'expires_in' => auth('api')->factory()->getTTL() * 1
        //'expires_in'=> auth()->factory()->getTTL()*60
        
        ]);
    
    }
    
    public function refresh(){
  
  
  

  
  
  
        
return $this->resondedJwtToken(auth('api')->refresh());
}

    

    public function forgotpassword(Request $request){

        // $request->validate(['email' => 'required|email']);
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            // 'password'=>'required',
        ]);

        if($validator->fails()){
            
              $firstError = $validator->errors()->first();
    
                    return response()->json([
                        'message' => $firstError,
                        'status'=>false
                    ], 400);
            
            
            //return response()->json([$validator->errors()],500);
        }
        

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? response()->json(['message' => __($status)], 200)
                : response()->json(['message' => __($status)], 400);

    }

    public function bookappointment_for_new_user(Request $req){
     
         Artisan::call('optimize:clear');
        $user_id = auth('api')->user()->id;

        try{
            $validator=Validator::make($req->all(),[
              //  'user_id'=>'required',
                'Full_Name'=>'required',
                'phone_Number'=>'required|numeric|digits:10',
                'appointment'=>'required',
                'age'=>'required|numeric|max:99',
                'appointment_type'=>'required',
                'Date_of_appointment'=>'required|date|after_or_equal:today',
                'location'=>'required',
                'page_source'=>'required',
                'time_of_appointment' => 'required|date_format:H:i',
               
            ]);
    
          if ($validator->fails()) {
    $firstError = $validator->errors()->first();
    
    return response()->json([
        'error' => $firstError
    ], 400);
}

            $create_patient=patientData::create([
                'pname'=>$req->Full_Name,
                'page'=>$req->age,
                'assigned_user'=>$user_id,
                
                ]);

                if($create_patient){

                        $pid=$create_patient->id;
                          $create_appointment=appointments::create([
                        
                        'Full_Name'=>$req->Full_Name,
                        'phone_Number'=>$req->phone_Number,
                        'appointment'=>$req->appointment,
                        'age'=>$req->age,
                        'appointment_type'=>$req->appointment_type,
                        'Date_of_appointment'=>$req->Date_of_appointment,
                        'time_of_appointment'=>$req->time_of_appointment,
                        'location'=>$req->location,
                        'page_source'=>$req->page_source,
                        'user_id'=>$user_id,
                        'pid'=>$pid,
                    ]);
            
                    if($create_appointment){
                        
                            
                        
                        return response()->json([
                            'message'=>'Appointment Booked Successfully',
                            'status'=>true
                        ]);
                    }else{
            
                        return response()->json([
                            'message'=>'Appointment Not Booked Successfully',
                            'status'=>false
                        ]);
                    }

                    
                }


             
            
         
           
            
            
            
         
  
        

    
           
    



        }
        
        
        catch(\Exception $e)
        {
            return response()->json([
                'message'=>'error found'.$e->getMessage(),
                'status'=>false
            ]);
        }
        
        

        

    }
    
        public function bookappointment_exesting(Request $req){
     
         Artisan::call('optimize:clear');
        $user_id = auth('api')->user()->id;

        try{
            $validator=Validator::make($req->all(),[
              //  'user_id'=>'required',
                'Full_Name'=>'required',
                'phone_Number'=>'required|numeric|digits:10',
                'appointment'=>'required',
                'age'=>'required|numeric|max:99',
                'appointment_type'=>'required',
                'Date_of_appointment'=>'required|date|after_or_equal:today',
                'location'=>'required',
                'page_source'=>'required',
                'time_of_appointment' => 'required|date_format:H:i',
                // 'registration_type' => 'required|in:0,1',
                 'patient_id' => 'required',
            ]);
    
          if ($validator->fails()) {
    $firstError = $validator->errors()->first();
    
    return response()->json([
        'error' => $firstError
    ], 400);
}

  
                
              $create_appointment=appointments::create([
                
                'Full_Name'=>$req->Full_Name,
                'phone_Number'=>$req->phone_Number,
                'appointment'=>$req->appointment,
                'age'=>$req->age,
                'appointment_type'=>$req->appointment_type,
                'Date_of_appointment'=>$req->Date_of_appointment,
                'time_of_appointment'=>$req->time_of_appointment,
                'location'=>$req->location,
                'page_source'=>$req->page_source,
                'user_id'=>$user_id,
                'pid'=>$req->patient_id,
            ]);
    
            if($create_appointment){
                
                    
                
                return response()->json([
                    'message'=>'Appointment Booked Successfully',
                    'status'=>true
                ]);
            }else{
    
                return response()->json([
                    'message'=>'Appointment Not Booked Successfully',
                    'status'=>false
                ]);
            }
            
            
            
            
         
           
            
            
            
         
      
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message'=>'error found'.$e->getMessage(),
                'status'=>false
            ]);
        }
        
        

        

    }
    
    
    // existing 
    
        public function bookappointment_new1(Request $req){
     
         Artisan::call('optimize:clear');
        $user_id = auth('api')->user()->id;

        try{
            $validator=Validator::make($req->all(),[
              //  'user_id'=>'required',
                'Full_Name'=>'required',
                'phone_Number'=>'required|numeric|digits:10',
                'appointment'=>'required',
                'age'=>'required|numeric|max:99',
                'appointment_type'=>'required',
                'Date_of_appointment'=>'required|date|after_or_equal:today',
                'location'=>'required',
                'page_source'=>'required',
                'time_of_appointment' => 'required|date_format:H:i',
                // 'registration_type' => 'required|in:0,1',
                 'patient_id' => 'required',
            ]);
    
          if ($validator->fails()) {
    $firstError = $validator->errors()->first();
    
    return response()->json([
        'error' => $firstError
    ], 400);
}

  
                
              $create_appointment=appointments::create([
                
                'Full_Name'=>$req->Full_Name,
                'phone_Number'=>$req->phone_Number,
                'appointment'=>$req->appointment,
                'age'=>$req->age,
                'appointment_type'=>$req->appointment_type,
                'Date_of_appointment'=>$req->Date_of_appointment,
                'time_of_appointment'=>$req->time_of_appointment,
                'location'=>$req->location,
                'page_source'=>$req->page_source,
                'user_id'=>$user_id,
                'pid'=>$req->patient_id,
            ]);
    
            if($create_appointment){
                
                    
                
                return response()->json([
                    'message'=>'Appointment Booked Successfully',
                    'status'=>true
                ]);
            }else{
    
                return response()->json([
                    'message'=>'Appointment Not Booked Successfully',
                    'status'=>false
                ]);
            }
            
            
            
            
         
           
            
            
            
         
      
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message'=>'error found'.$e->getMessage(),
                'status'=>false
            ]);
        }
        
        

        

    }
    
    
    

    public function test(Request $request)
{
    if (!$request->user()) {
        \Log::info('Unauthorized request', [
            'headers' => $request->headers->all(),
            'token' => $request->bearerToken(),
        ]);
        return response()->json([
            'message' => 'Unauthorized. Please provide a valid token.',
            'status' => false
        ], 401); // Unauthorized
    }

    return response()->json([
        'message' => 'Request is authenticated and passes custom auth',
        'status' => true
    ]);
}


public function index(Request $request)
{
    // $query = User::query();
    $query = appointments::query();

    if ($request->has('appointment_type')) {
        if($request->input('appointment_type')=='online'){
            $status="1";
            $query->where('appointment_type', 'like', '%' . $status . '%');      
        }elseif($request->input('appointment_type')=='offline'){
            $status="0";
            $query->where('appointment_type', 'like', '%' . $status . '%');      
        }
    }

    if ($request->has('appointment_status')) {
        if($request->input('appointment_status')=='closed'){
            $status="2";
            $query->where('appointment_status', 'like', '%' . $status . '%');      
        }elseif($request->input('appointment_status')=='opened'){
            $status="0";
            $query->where('appointment_status', 'like', '%' . $status . '%');      
        }
        elseif($request->input('appointment_status')=='InProcess'){
            $status="1";
            $query->where('appointment_status', 'like', '%' . $status . '%');      
        }
    }

    


    if ($request->has('appointment_page')) {

        
        
            $query->where('page_source', 'like', '%' . $request->input('appointment_page') . '%');      
        
    }

   

    if ($request->has('appointment_date') && !empty($request->input('appointment_date'))) {
        $query->whereDate('Date_of_appointment', $request->input('appointment_date'));
    }






    // $get_details = $query->get();
    $get_details = $query->paginate(10);
    $page_source1 = appointments::select('page_source')
    ->distinct()
    ->pluck('page_source');

    return view('home2', compact('get_details','page_source1'));
}

public function index1(Request $request)
{
    // $query = User::query();
    $query = appointments::query();

    if ($request->has('appointment_type')) {
        if($request->input('appointment_type')=='online'){
            $status="1";
            $query->where('appointment_type', 'like', '%' . $status . '%');      
        }elseif($request->input('appointment_type')=='offline'){
            $status="0";
            $query->where('appointment_type', 'like', '%' . $status . '%');      
        }
    }

    if ($request->has('appointment_status')) {
        if($request->input('appointment_status')=='closed'){
            $status="1";
            $query->where('appointment_status', 'like', '%' . $status . '%');      
        }elseif($request->input('appointment_status')=='opened'){
            $status="0";
            $query->where('appointment_status', 'like', '%' . $status . '%');      
        }
    }

    if ($request->has('appointment_page')) {

        
        
            $query->where('page_source', 'like', '%' . $request->input('appointment_page') . '%');      
        
    }

   

    if ($request->has('appointment_date') && !empty($request->input('appointment_date'))) {
        $query->whereDate('Date_of_appointment', $request->input('appointment_date'));
    }






    // $get_details = $query->get();
    $get_details = $query->paginate(10);
    $page_source1 = appointments::select('page_source')
    ->distinct()
    ->pluck('page_source');

    return view('home3', compact('get_details','page_source1'));
}


public function changeStatus($id)
{

    //dd(Auth()->user()->id);
    $appointment = appointments::find($id);
  
    if ($appointment) {
        // Toggle the appointment_type between 1 (Online) and 0 (Offline)
        $appointment->appointment_status = 1;
        $appointment->therapist_id = Auth()->user()->id;
        
        $appointment->save();

        return redirect()->route('dashboard')->with('success', 'Appointment status updated successfully.');
    }

    return redirect()->route('dashboard')->with('error', 'Appointment not found.');
}

public function changeStatus_to_Close(Request $request,$id)
{

    //dd($request->all());

    $appointment = appointments::find($id);
    // dd($appointment);
    // Check if the appointment status is closed
    // if ($appointment->appointment_status == '1') {
        
          if ($appointment->appointment_status == '1' || $appointment->appointment_status == '0' ||$appointment->appointment_status == '2'  ) {
        // Apply validation for file upload
        // $validatedData = $request->validate([
        //     'uploadFile' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // max size: 2MB
        // ], [
        //     'uploadFile.required' => 'You must upload a file when the session is closed.',
        //     'uploadFile.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
        //     'uploadFile.max' => 'File size must not exceed 2MB.',
        // ]);

        $validatedData = $request->validate([
            'uploadFile' => 'required|file|mimes:doc,docx|max:2048', // max size: 2MB
        ], [
            'uploadFile.required' => 'You must upload a file when the session is closed.',
            'uploadFile.mimes' => 'Only  doc, and docx files are allowed.',
            'uploadFile.max' => 'File size must not exceed 2MB.',
        ]);
        
        // Store the uploaded file if validation passes
        if ($request->hasFile('uploadFile')) {
            $path = $request->file('uploadFile')->store('uploads', 'public');

            // Save the file path in the appointment
            $appointment->file_path = $path;
            $appointment->appointment_status = 2;
            $appointment->save();
        }
       
        session()->flash('success',  'File uploaded successfully');
        return redirect()->back()->with('uccess', 'File uploaded successfully.');
    }
 
    return redirect()->back()->with('error', 'Appointment is not closed, no file required.');



    //dd(Auth()->user()->id);
    // $appointment = appointments::find($id);
  
    // if ($appointment) {
    //     // Toggle the appointment_type between 1 (Online) and 0 (Offline)
    //     $appointment->appointment_status = 2;
    //     $appointment->therapist_id = Auth()->user()->id;
        
    //     $appointment->save();

    //     return redirect()->route('dashboard')->with('success', 'Appointment status updated successfully.');
    // }

    // return redirect()->route('dashboard')->with('error', 'Appointment not found.');
}

public function userregister(Request $req){
     Artisan::call('optimize:clear');
     
     
     $validator = Validator::make($req->all(), [
    'name' => 'required',
    'email' => 'required|email|unique:users,email',
    'phone' => 'required|numeric|unique:users,phone',
    'sos_1' => 'required|numeric',
    'password' => 'required|min:6',
    'fcm_token' => 'required|string', // Adding fcm_token as optional
]);

// Validate the request
// if ($validator->fails()) {
//     return response()->json([$validator->errors()], 400);
// }
if ($validator->fails()) {
    $firstError = $validator->errors()->first();
    
    return response()->json([
        'message' => $firstError,
        'status'=>false
    ], 400);
}



// Create a new user
$add_therapist = User::create([
    'name' => $req->name,
    'email' => $req->email,
    'password' => Hash::make($req->password),
    'phone' => $req->phone,
    'sos_1' => $req->sos_1,
    'user_type' => 1, // for user
    'fcm_token' => $req->input('fcm_token') // Store fcm_token if provided
]);

if ($add_therapist) {
    return response()->json([
        'message' => 'User Registered Successfully',
        'status' => true
    ]);
}

    
    // $validator=Validator::make($req->all(),[
    //     'name'=>'required',
    //     'email' => 'required|email|unique:users,email',
    //     'phone' => 'required|numeric|unique:users,phone',
    //     'password'=>'required|min:6',
    // ]);

    // if ($validator->fails()) {
    //     //return redirect()->back()->withErrors($validator)->withInput();
    //     return response()->json([$validator->errors()],400);
    
    // }
    
    // $add_therapist= User::create([
    //     'name' => $req->name,
    //     'email' => $req->email,
    //     'password' => Hash::make($req->password),
    //     'phone' => $req->phone,
    //     'user_type' => 1, // for user
    // ]);

    // if ($add_therapist) {
    //   // return redirect()->route('home')->with('success', 'Therapist added successfully!');
    //     return response()->json([
    //         'message'=>'User Registered Sucessfully',
    //         'status'=>true
    //     ]);
    
    // }
}


//23-09-2024

public function get_user_details($id){
   

//dd($id);

$get_user_details = User::where('id', $id)
    ->where('user_type', 1)
    ->get()
    ->map(function($user) {
        // Check if user_profile is not empty or null
        $user->user_profile = !empty($user->user_profile) 
            ? asset('storage/' . $user->user_profile) 
            : asset('assets/images/avatar/avatar.jpeg'); // Default image path
        return $user;
    });

if (count($get_user_details) > 0) {
    return response()->json(['profile_picture' => $get_user_details, 'status' => true], 200);
} else {
    return response()->json(['profile_picture' => $get_user_details, 'status' => false], 200);
}


   
  
 

}

public function get_profile_image(){

    $user = auth('api')->user();

    // Set the user profile image or default avatar
    $user->user_profile = !empty($user->user_profile) 
        ? asset('storage/' . $user->user_profile) 
        : asset('assets/images/avatar/avatar.jpeg');

    // Return only the id and profile image
    return response()->json([
        'id' => $user->id,
        'profile_image' => $user->user_profile,
    ]);
    



}



public function update_user_details2(Request $request){
    
    dd("dsgkjhsdfkll");
    
}



public function update_user_details1(Request $request)
{
    //  return response()->json(['message' => 'Method accessed'], 200);
    
    
    $get_user = auth('api')->user();
    
    if (!$get_user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $get_user->id,
        'phone' => 'required|numeric|digits:10|unique:users,phone,' . $get_user->id,
        'sos_1' => 'nullable|numeric|digits:10',
        'sos_2' => 'nullable|numeric|digits:10',
        'sos_3' => 'nullable|numeric|digits:10',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->messages()], 400);
    }

    $data = $request->except('password'); 

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $result = $get_user->update($data);

    return $result
        ? response()->json(['message' => 'User updated successfully'], 200)
        : response()->json(['message' => 'Failed to update user'], 500);
}


public function sos_call(Request $request){
    
    
      $validator = Validator::make($request->all(), [
        'location' => 'required',
      
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->messages()], 400);
    }
     
      $get_user = auth('api')->user();
      
      
      $sosNumbers = array_filter([$get_user->sos_1, $get_user->sos_2, $get_user->sos_3]); // Remove null values
      
     
      
      $sosNumbers = array_map(fn($num) => "91" . $num, $sosNumbers);

//  dd($sosNumbers);
    $patientName = $get_user->name; // Assuming user name is available
    $location =$request->location ; // Replace with actual location if available
    
    // $text = "ðŸš¨ *Medical Emergency Alert* ðŸš¨\n\n"
    //       . "Patient: *$patientName*\n"
    //       . "Location: *$location*\n"
    //       . "Please respond immediately! ðŸš‘";
          
    $text = env('SOS_ALERT_MESSAGE', 'Default emergency message');

    // Replace placeholders dynamically
    $text = str_replace(
        ['{patient_name}', '{location}'], 
        [$patientName, $location], 
        $text
    );
    
  
    foreach ($sosNumbers as $phoneNumber) {
        
        // dd($phoneNumber);
        // dd(ApiHelper::sendMessage($phoneNumber, $text));
        
          $response = ApiHelper::sendMessage($phoneNumber, $text);
    
         \Log::info("Message sent to $phoneNumber", $response);
         sleep(1);
    }
    
    return response()->json(['message' => 'Emergency message sent to available contacts']);

      
      
      
      
      
      
      
      
      
      
     $patientName=$get_user->name;
     
     $sos1=$get_user->sos_1;
     $sos2=$get_user->sos_2;
     $sos3=$get_user->sos_3;
     
    $phoneNumber = '07674952516';
    $text =  "ðŸš¨ *Medical Emergency Alert* ðŸš¨\n\n"
              . "Patient: *$patientName*\n"
              . "Location: *$location*\n"
              . "Please respond immediately! ðŸš‘";;
   
  

    $response = ApiHelper::sendMessage($phoneNumber, $text);

    return response()->json($response);
     
     
     
     dd($sos3,$sos2,$sos1,$name);
}


public function update_user_details(Request $request){


       
    // $get_user = user::findOrFail($id);
    $get_user = auth('api')->user();
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $get_user->id,
        'phone' => 'required|numeric|digits:10|unique:users,phone,' . $get_user->id,
        'sos_1' => 'nullable|numeric|digits:10',
        'sos_2' => 'nullable|numeric|digits:10',
        'sos_3' => 'nullable|numeric|digits:10',
    ]);
    
    if ($validator->fails()) {

        return response()->json([
            'errors' => $validator->errors()->messages()

        ]);
       
    }
    
  
    // Handle password hashing only if it's filled, otherwise leave it unchanged
    $data = $request->except('password'); // Exclude password initially
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }
    
    // Update the user details
    $result = $get_user->update($data);
    
    if ($result) {
        return response()->json(['message' => 'User updated successfully'], 200);
    } else {
        return response()->json(['message' => 'Failed to update user'], 500);
    }
    

    
 
    
//dd($result);




    // return redirect()->route('add.therapist')->with('success', 'Therapist updated successfully');
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // $validator=Validator::make($req->all(),[
    //     'name'=>'required',
    //     'email' => 'required|email|unique:users,email',
    //     'phone' => 'required|numeric|unique:users,phone',
    //     'password'=>'required|min:6',
    // ]);

    // if ($validator->fails()) {
    //     //return redirect()->back()->withErrors($validator)->withInput();
    //     return response()->json([$validator->errors()],400);
    
    // }
    
    // $add_therapist= User::create([
    //     'name' => $req->name,
    //     'email' => $req->email,
    //     'password' => Hash::make($req->password),
    //     'phone' => $req->phone,
    //     'user_type' => 1, // for user
    // ]);

    // if ($add_therapist) {
    //    // return redirect()->route('home')->with('success', 'Therapist added successfully!');
    //     return response()->json([
    //         'message'=>'User Registered Sucessfully',
    //         'status'=>true
    //     ]);
    
    // }

}

public function update_profile_image(Request $request){

   // $user = User::findOrFail($id);
    

    // Validation for image and other fields
    $validator = Validator::make($request->all(), [
        'user_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
    ]);
    
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }
    
    $user = auth('api')->user();

    // Update user data
    $data = $request->all();
    
    // Handle image upload
    if ($request->hasFile('user_profile')) {
        // Get the uploaded file
        $file = $request->file('user_profile');
    
        // Check if the user already has a profile image and delete it from storage
        if (!empty($user->user_profile)) {
            // Delete the old image from the storage
            Storage::disk('public')->delete($user->user_profile);
        }
    
        // Store the new file in the public directory and get the path
        $filePath = $file->store('assets/images/avatar', 'public');
    
        // Save the new file path in the database
        $data['user_profile'] = $filePath;
    }
    
    // Update the user
    $user->update($data);
    
    // Return a success response with the updated user profile
    return response()->json([
        'message' => 'Profile updated successfully',
        'user' => [
            'id' => $user->id,
          
            'user_profile' => asset('storage/' . $data['user_profile']), // Return the full URL of the profile image
        ]
    ], 200);
    
    


}


public function delete_profile_image(){
  
    $user = auth('api')->user();

    // Check if the user has a profile image
    if (!empty($user->user_profile)) {
        // Delete the image from storage
        Storage::disk('public')->delete($user->user_profile);

        // Optionally, remove the file path from the database
        $user->user_profile = null;
        $user->save(); // Save the changes
    }

    // Return a success response
    return response()->json([
        'message' => 'Profile image deleted successfully',
        'status' => true,
    ], 200);
}


// booking hsitory fetch

public function get_user_booking_hisrory(){
   

    $user_id = auth('api')->user()->id;
    
  

    // Fetch all appointments for the user
    $get_booking_details = appointments::where('user_id', $user_id)->get();
    
    //dd($get_booking_details);
    
      return response()->json([
            'booking_history'=>$get_booking_details,
            'status'=>true
        ],200);

//dd($get_booking_details[0]->location);
    // Initialize an array to hold the combined results
    $booking_details = [];

    // Loop through each appointment and fetch the location address
    foreach ($get_booking_details as $booking) {
        
       
        // Fetch the address based on the location id from the appointment
        $address = useraddressdetail::where('id', $booking->location)->first();
    //dd($address);
        // Prepare the combined data
        $booking_details[] = [
            'appointment_id' => $booking->id,
            'appointment_time' => $booking->time_of_appointment,
            'date_of_appointment' => $booking->Date_of_appointment,
            'location_address' => $address ? $address->address : 'Address not found',
            // Add more fields as needed
        ];
    }

    // Return the merged data as a JSON response
    return response()->json([
        'status' => true,
        'message' => 'Booking details fetched successfully',
        'data' => $booking_details
    ]);
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 
      $get_booking_details = appointments::where('user_id', $user_id)
    ->get();

      dd($get_booking_details);
    
    $get_address_by_location_id=useraddressdetail::where('id',$get_booking_details[0]->location)->get();
    dd($get_address_by_location_id);

$booking_details = [];

foreach ($get_booking_details as $booking) {
    $booking_details[] = [
        'appointment_id' => $booking->id,
        'appointment_time' => $booking->time_of_appointment,
        'date_of_appointment' => $booking->Date_of_appointment,
        'location_address' => $booking->location ? $booking->location->address : 'Address not found',
        // You can add other fields as needed
    ];
}

// Return the response in JSON format
return response()->json([
    'status' => true,
    'message' => 'Booking details fetched successfully',
    'data' => $booking_details
]);

   
   
   

    if(count($get_booking_details)>0){
        return response()->json([
            'booking_history'=>$get_booking_details,
            'status'=>true
        ],200);
    }else{
        return response()->json([
            'booking_history'=>$get_booking_details,
            'status'=>false
        ],200);
    }

}


// create cusomer review

public function create_review(Request $req){

    $user_id = auth('api')->user()->id;
    $user_name = auth('api')->user()->name;
    
    //dd($user_name);

    $validator=Validator::make($req->all(),[
        'app_id'=>'required|numeric|unique:customer_reviwes',
        'rating' => 'required|numeric|between:1,5',
        'details' => 'required',
        'page_source' => 'required',
       
    ],[
        'app_id.unique'=>'Review Alredy Given'
    ]);

    if ($validator->fails()) {
        //return redirect()->back()->withErrors($validator)->withInput();
        return response()->json([$validator->errors()],400);
    
    }

    $create_review=customerreview::create([
        'app_id'=>$req->app_id,
        'rating'=>$req->rating,
        'details'=>$req->details,
        'page_source'=>$req->page_source,
        'user_id'=>$user_id,
        'user_name'=>$user_name,
    ]);

    if($create_review){
        
         $update_rating_status=appointments::where('id',$req->app_id)->update(
             [
                'rating_status'=>1
                ]
             );
        
        return response()->json([
            'status'=>true,
            'message'=>'Customer Review Submited Successfully'
        ]);
    }else{
        return response()->json([
            'status'=>false,
            'message'=>'Customer Review Not Submited Successfully'
        ]);
    }

}

public function get_review($slag){

    $get_review=customerreview::where('page_source',$slag)->get();
    
   // dd($get_review);

    if(count($get_review)>0){
        return response()->json([
            'status'=>true,
            'review'=>$get_review
        ],200);
    }else{
        return response()->json([
            'status'=>false,
            'review'=>$get_review
        ],200);
    }

}

}
    

