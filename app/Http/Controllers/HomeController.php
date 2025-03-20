<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\appointments;
use Validator;
use Auth;
use App\Models\User;
use App\Models\behaviroval_tracker;
use Illuminate\Support\Facades\Hash;
use App\Models\patientData;
use App\Models\useraddressdetail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     public function addmyfamilylist(Request $req){

          
           $create_patients=patientData::create([
            'pname'=>$req->fullname,
            'page'=>$req->age,
            'assigned_user'=>request()->id,
           ]);

           if($create_patients){
            session()->flash('success','Family list created');
            return redirect()->back();
           }

       // dd($req->all());


     }
     
     
    public function bookappointment(Request $req){

        //dd(request()->id);

       // dd($req->all());

        $pid = $req->input('fullname');
        $get_p_name = patientData::where('pid', $pid)->first();

       //dd($get_p_name->page);


       // dd($pname);


       $create_appointment=appointments::create([
                        
                                'Full_Name'=>$get_p_name->pname,
                                'phone_Number'=>$req->Phone,
                                'appointment'=>$req->appointmentfor,
                                'age'=>$get_p_name->page,
                                'appointment_type'=>$req->appointmenttype,
                                'Date_of_appointment'=>$req->dateofappointment,
                                'time_of_appointment'=>$req->Appointmenttime,
                                'location'=>$req->selectlocation,
                                'page_source'=>$req->therapytype,
                                'user_id'=>$req->user_id,
                                'pid'=>$req->fullname,
                            ]);


                            if($create_appointment){
                                session()->flash('success','Appointment  created');
                                return redirect()->back();
                               }
                    
        



//         try{
//             $validator=Validator::make($req->all(),[
//               //  'user_id'=>'required',
//                 'fullname'=>'required',
//                 'Phone'=>'required|numeric|digits:10',
//                 'appointmentfor'=>'required',
//                 'age'=>'required|numeric|max:99',
//                 'appointmenttype'=>'required',
//                 'dateofappointment'=>'required|date|after_or_equal:today',
//                 'selectlocation'=>'required',
//                 'therapytype'=>'required',
//                 'Appointmenttime' => 'required|date_format:H:i',
               
//             ]);
    
//           if ($validator->fails()) {
//     $firstError = $validator->errors()->first();
    
//     return response()->json([
//         'error' => $firstError
//     ], 400);
// }

//             $create_patient=patientData::create([
//                 'pname'=>$req->Full_Name,
//                 'page'=>$req->age,
//                 'assigned_user'=>$user_id,
                
//                 ]);

//                 if($create_patient){

//                         $pid=$create_patient->id;
//                           $create_appointment=appointments::create([
                        
//                         'Full_Name'=>$req->Full_Name,
//                         'phone_Number'=>$req->phone_Number,
//                         'appointment'=>$req->appointment,
//                         'age'=>$req->age,
//                         'appointment_type'=>$req->appointment_type,
//                         'Date_of_appointment'=>$req->Date_of_appointment,
//                         'time_of_appointment'=>$req->time_of_appointment,
//                         'location'=>$req->location,
//                         'page_source'=>$req->page_source,
//                         'user_id'=>$user_id,
//                         'pid'=>$pid,
//                     ]);
            
//                     if($create_appointment){
                        
                            
                        
//                         return response()->json([
//                             'message'=>'Appointment Booked Successfully',
//                             'status'=>true
//                         ]);
//                     }else{
            
//                         return response()->json([
//                             'message'=>'Appointment Not Booked Successfully',
//                             'status'=>false
//                         ]);
//                     }

                    
//                 }


             
            
         
           
            
            
            
         
  
        

    
           
    



//         }
        
        
//         catch(\Exception $e)
//         {
//             return response()->json([
//                 'message'=>'error found'.$e->getMessage(),
//                 'status'=>false
//             ]);
//         }


    }

     
      public function addbehaviour($aid){
       // dd($aid);
        $get_data_for_selected_appointment=appointments::where('id',$aid)->get();

        //dd($get_data_for_selected_appointment[0]->pid);
        //dd($get_data_for_selected_appointment[0]->page_source);
        // $get_behavirual=behaviroval_tracker::where('aid',$aid)->where('page_source',$get_data_for_selected_appointment[0]->page_source)->get();
        $get_behavirual=behaviroval_tracker::where('pid',$get_data_for_selected_appointment[0]->pid)->where('page_source',$get_data_for_selected_appointment[0]->page_source)->get();




       // dd($get_data_for_selected_appointment);
        return view('home4',compact('get_behavirual'));
     }

     public function addbehaviourdetails($id){
      
        $get_data_for_selected_appointment=appointments::where('id',$id)->get();
        //dd($get_data_for_selected_appointment);
        return view('home5',compact('get_data_for_selected_appointment'));
     }

     public function addnewbehaviour(Request $req){
            
        //    dd($req->all());    
            
        $uid=Auth::user()->id;
        //dd($uid);
        $add_behaviour=behaviroval_tracker::create([
            'pid'=>$req->pid,
            'uid'=>$uid,
            'data_details'=>$req->oppdate,
            'details'=>$req->client_notes,
            'page_source'=>$req->Therapisttype,
            'aid'=>$req->aid,
            'pname'=>$req->clientName,
            'uname'=>$req->therapistname,
        ]);

        if($add_behaviour){

            //uuid
            session()->flash('success','Behaviours Added successfully....!');
            return redirect()->route('addbehavioursss',$req->uuid);
        }

     }
     
     
     
    public function index()
    {

        $user_type=Auth('web')->user()->user_type;
        // dd($user_id);
        // for therapist
        if($user_type==3){
           
           
             $user_id=Auth('web')->user()->id;
            $get_details=appointments::where('therapist_id',$user_id)->orderBy('id', 'desc')->paginate(10);
    
            //dd($user_id);
    
            $page_source1 = appointments::select('page_source')
            ->distinct()
            ->pluck('page_source');
            
           // session()->flash('welcome', 'Welcome to your dashboard, ' . Auth()->user()->name . '!');

            return view('home3', compact('get_details','page_source1'));
           
          
          
    
            // return view('home2', compact('get_details','page_source1'));
            
        }elseif($user_type==2){
            // for admin
            $get_details=appointments::orderBy('id', 'desc')->paginate(10);

            $page_source1 = appointments::select('page_source')
            ->distinct()
            ->pluck('page_source');
           
      $list_of_therapist=User::where('user_type',3)->get();
            //dd($get_details->id);
    
            //session()->flash('welcome', 'Welcome to your dashboard, ' . Auth()->user()->name . '!');
    
            return view('home2', compact('get_details','page_source1','list_of_therapist'));



        }
        
        
       
        
        //return view('home');
    }
    
      public function assign_therapist(Request $req){

      // dd($req->therapistname);
        $validator = Validator::make($req->all(), [
            'therapist_id' => 'required',  // Ensure therapist_id is provided
        ]);

        if ($validator->fails()) {
            // Return a custom error response with the error messages
            session()->flash('error', 'Please Select Therapist. ' );
            return redirect()->back()->with('error', 'Please Select Therapist.'); 
        }



    

      
        $assign_therapist=appointments::where('id',operator: $req->bookingid)->update([
            'therapist_id'=>$req->therapist_id,
            'appointment_status'=>1,
        ]);

        if($assign_therapist==1){

            session()->flash('success', 'Therapist assigned successfully! ' . $req->therapistname . '!');
             return redirect()->back()->with('successs', 'Therapist assigned successfully!'); 
            // return response()->json(['success' => 'Therapist assigned successfully!']);
        }else{
            session()->flash('error', 'Therapist Not assigned successfully! ');
            return redirect()->back()->with('successsss', 'Therapist Not assigned successfully!y!'); 
         
        }
          

    }
    
    
    public function index2()
    {

        
        $user_id=Auth('web')->user()->id;
        $get_details=appointments::where('therapist_id',$user_id)->orderBy('id', 'desc')->paginate(10);

        //dd($user_id);

        $page_source1 = appointments::select('page_source')
        ->distinct()
        ->pluck('page_source');
       
        return view('home3', compact('get_details','page_source1'));
        
        //return view('home');
    }

    public function searchclients(Request $request){

        $query = $request->input('query');

// Search for a user by phone and user_type = 1
$results = User::where('phone', 'LIKE', "%$query%")->where('user_type', 1)->get();
// dd($query);

if ($results->count() > 0) {
    // Fetch appointments for the first user found
    $appoitment = appointments::where('user_id', $results[0]->id)->get();

    // Check if appointments exist for the user
    if ($appoitment->count() > 0) {
        return view('search_clients', compact('appoitment'));     
    } else {
        // If no appointments found, return the view with an empty $appointments variable
        return view('search_clients', compact('appoitment'));
    }
} else {
    // If no user found, return the view with an empty $appointments variable
    $appoitment = [];
    return view('search_clients', compact('appoitment'));
}

        


    }

    public function search(Request $request)
    {
        // Validate the input
        // $request->validate([
        //     'query' => 'required|string',
        // ]);

        // // Get the search query
        // $query = $request->input('query');

        // // Search in the patients table by phone number
        // $results = User::where('phone', 'LIKE', "%$query%")->get();

        // dd($results);

        // // Return the results to a view
        // return view('search_results', compact(var_name: 'results'));
    }

    public function get_user_details(){
        $users_details=user::where('user_type',1)->paginate(10);
        // $get_patients=user::where('user_type',1)->paginate(10);
        return view('users',compact('users_details'));   
    }

    public function get_partient_appointment($id){

     //   dd($id);
        // $get_patient_details=appointments::where('user_id',$id)->where('appointment_status','!=','0')->paginate(10);
        $get_patient_details=appointments::where('user_id',$id)->where('appointment_status','!=','0')->paginate(10);

        return view('patient_appointment',compact('get_patient_details'));

    }
    public function get_partient_appointment1($id){

         // dd($id);
           // $get_patient_details=appointments::where('user_id',$id)->where('appointment_status','!=','0')->paginate(10);
           $get_patient_details=appointments::where('pid',$id)->paginate(10);

           
   
           return view('patient_appointment_id',compact('get_patient_details'));
   
       }

    


    public function getmydetails(){

        $mydetails=User::where('id',Auth('web')->User()->id)->get();

      //  dd($mydetails);

        return view('mydetails',compact('mydetails'));

    }

    public function updatemydetails(Request $request,$id){
           
        
        $mydetails = user::findOrFail($id);

       
    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $mydetails->id,
            'phone' => 'required|numeric|digits:10|unique:users,phone,' . $mydetails->id,
            'password' => 'nullable|min:9',
        ]);
        
        // If a password is provided, hash it; otherwise, keep the existing password
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']); // Exclude the password from the update if it's not provided
        }
        
        // Update the therapist's details
        $mydetails->update($data);

        return redirect()->route('getmydetails')->with('success', 'My Details updated successfully');
        
        // $validator=Validator::make($req->all(),[
        //     'name'=>'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password'=>'required|min:6',
        //     'phone'=>'required|digits:10|numeric|unique:users,phone',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        
        //dd($id);
    }

    

    public function adduser(){
     
        $get_all_therapists=user::where('user_type',3)->orderBy('id','desc')->paginate(perPage: 3);
        // dd($get_all_therapists);
        return view('addtherapist',compact('get_all_therapists'));
    }


    public function addpatient(){

        $get_all_therapists=user::where('user_type',1)->orderBy('id','desc')->paginate(perPage: 3);
        // dd($get_all_therapists);
        return view('addpatinet',compact('get_all_therapists'));


    }

    public function registeruser(Request $req){

        $validator=Validator::make($req->all(),[
            'name'=>'required',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|min:6',
            'phone'=>'required|digits:10|numeric|unique:users,phone',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $add_therapist= User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'user_type' => 3, // for theripist
            'phone' => $req->phone, // for theripist
        ]);

        if ($add_therapist) {


            session()->flash('success', 'Therapist added successfully! ' . $req->name . '!');

            return redirect()->route('add.therapist')->with('successsss', 'Therapist added successfully!');
        }


        


    }


    //registerclinet

    public function registerclinet(Request $req){

        $validator=Validator::make($req->all(),[
            'name'=>'required',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|min:6',
            'phone'=>'required|digits:10|numeric|unique:users,phone',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $add_therapist= User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'user_type' => 1, // for users
            'phone' => $req->phone, // for user
        ]);

        if ($add_therapist) {


            session()->flash('success', 'Client added successfully! ' . $req->name . '!');

            return redirect()->route('add.addpatient')->with('successsss', 'Therapist added successfully!');
        }


        


    }


    

    public function therapistsedit($id){
        $therapist=user::where('id',$id)->get();
        //dd($get_therapist_details);

      //  $therapist = Therapist::findOrFail($id); // Retrieve the therapist record by ID

        return view('edit', compact('therapist'));
    }

    public function editclient($id){
        $therapist=user::where('id',$id)->get();
        //dd($get_therapist_details);

      //  $therapist = Therapist::findOrFail($id); // Retrieve the therapist record by ID

        return view('editclient', compact('therapist'));
    }

    // editclient

// Route::get('/view_details/{id}', [App\Http\Controllers\HomeController::class, 'viewdetails'])->name('viewdetails');
//

public function adduserclients(){

//dd(request()->id);

    $get_all_therapists=patientData::where('assigned_user',request()->id)->orderBy('pid','desc')->paginate(perPage: 3);
  //  return view('add_patients');  
    return view('add_patients', compact('get_all_therapists'));
}


public function adduseraddressdetails(Request $req){

            

   // dd($req->addresstype);

    if($req->addresstype==0){
        // check present address

        $check_present_address= useraddressdetail::where('uid',request()->id)->where('type_of_address',operator: 0)->get();
        if(count($check_present_address)>0){

       
            session()->flash('error','The Following User already added present Address ');   
            return back();  
           }

           $add_address=useraddressdetail::create([
            'uid'=>request()->id,
            'Flat_no'=>$req->flatno,
            'street'=>$req->street,
            'area'=>$req->area,
            'landmark'=>$req->landmark,
            'pincode'=>$req->pincode,
            'type_of_address'=>$req->addresstype,

        ]);



        if($add_address){
            session()->flash('success','Address Added Successfully');
            return back();
        }else{
            session()->flash('error','Address Not Added Successfully');
            return back();
        }

           

    }elseif($req->addresstype==1){
        // check perement address
        $check_perement_address= useraddressdetail::where('uid',request()->id)->where('type_of_address',operator: 1)->get();
        if(count($check_perement_address)>0){

       
            session()->flash('error','The Following User already added perement Address ');   
            return back();  
           }

           $add_address=useraddressdetail::create([
            'uid'=>request()->id,
            'Flat_no'=>$req->flatno,
            'street'=>$req->street,
            'area'=>$req->area,
            'landmark'=>$req->landmark,
            'pincode'=>$req->pincode,
            'type_of_address'=>$req->addresstype,

        ]);



        if($add_address){
            session()->flash('success','Address Added Successfully');
            return back();
        }else{
            session()->flash('error','Address Not Added Successfully');
            return back();
        }

    }


  


       }
      
      

     //  dd("stop");

     



      



    // "addresstype" => "0"
    // "flatno" => "dsgdfg"
    // "area" => "dfgf"
    // "landmark" => "dfgdf"
    // "pincode" => "dfgdfg"

    // "addresstype" => "0"
    // "flatno" => "sdfgsdf"
    // "street" => "dsfgdfsg"
    // "area" => "dfgdf"
    // "landmark" => "dfgdf"
    // "pincode" => "dfgfd"
     //   dd($req->all());
//}


public function adduseraddress(){

    //dd(request()->id);
    //$therapist=user::where('id',$id)->get();
    $myfamily=patientData::where('assigned_user',request()->id)->get();

    $get_my_address=useraddressdetail::where('uid',request()->id)->get();

    //dd($get_therapist_details);
 //   dd(request()->id);


  //  $therapist = Therapist::findOrFail($id); // Retrieve the therapist record by ID
    $get_all_therapists=patientData::where('assigned_user',request()->id)->orderBy('pid','desc')->paginate(perPage: 3);
    $get_all_therapists=user::where('user_type',3)->orderBy('id','desc')->paginate(perPage: 3);

    


    return view('add_patients_address', compact('get_all_therapists','myfamily','get_my_address'));
    
     
      //  return view('add_patients');  
        return view('add_patients_address', compact('get_all_therapists'));
    }


public function viewdetails($id){
    $therapist=user::where('id',$id)->get();
    $myfamily=patientData::where('assigned_user',request()->id)->get();
    //dd($get_therapist_details);
 //   dd(request()->id);


  //  $therapist = Therapist::findOrFail($id); // Retrieve the therapist record by ID
  $get_all_therapists=user::where('user_type',3)->orderBy('id','desc')->paginate(perPage: 3);
    return view('view_my_details', compact('therapist','get_all_therapists','myfamily'));
}

    public function therapistsupdate(Request $request, $id)
{

    
   
    $therapist = user::findOrFail($id);

//dd($therapist->user_type);

    // // Validate and update the therapist's details
    // $therapist->update($request->all());


    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $therapist->id,
        'phone' => 'required|numeric|digits:10|unique:users,phone,' . $therapist->id,
        'password' => 'nullable|min:9',
    ]);
    
    // If a password is provided, hash it; otherwise, keep the existing password
    $data = $request->all();
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    } else {
        unset($data['password']); // Exclude the password from the update if it's not provided
    }
    
    // Update the therapist's details
    $therapist->update($data);
    


    if($therapist->user_type==1){
        // for patient
        return redirect()->route('add.addpatient')->with('success', 'User updated successfully');
    }else if($therapist->user_type==3){
        // therapist
        return redirect()->route('add.therapist')->with('success', 'Therapist updated successfully');
    }


    
}

public function destroy($id)
{
    //dd($id);
    // Find the therapist by ID or fail with a 404 error
    $therapist = User::findOrFail($id);

    // Delete the therapist
    $therapist->delete();

    // return redirect()->route('adduser')->with('success', 'Therapist updated successfully');
    // Redirect with a success message
    return response()->json(['success' => true, 'message' => 'Therapist deleted successfully!']);
    return redirect()->route('add.therapist')->with('successss', 'Therapist deleted successfully!');
}

public function get_patients(){
    $get_patients=user::where('user_type',1)->paginate(10);
    return view('get_patient',compact('get_patients'));
}


  
}
