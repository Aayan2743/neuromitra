<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

use App\Models\appointments;
class DataController extends Controller
{
    //


    public function bookappointment(Request $req){
        
        try{
            $validator=Validator::make($req->all(),[
                'Full_Name'=>'required',
                'phone_Number'=>'required|numeric|digits:10',
                'appointment'=>'required',
                'age'=>'required|numeric|max:99',
                'appointment_type'=>'required',
                'Date_of_appointment'=>'required|date|after_or_equal:today',
                'location'=>'required',
                'page_source'=>'required',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    $validator->errors()
                ],500);
            }
    
            $create_appointment=appointments::create([
                'Full_Name'=>$req->Full_Name,
                'phone_Number'=>$req->Full_Name,
                'appointment'=>$req->Full_Name,
                'age'=>$req->Full_Name,
                'appointment_type'=>$req->Full_Name,
                'Date_of_appointment'=>$req->Full_Name,
                'location'=>$req->Full_Name,
                'page_source'=>$req->Full_Name,
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
    



        }catch(\Exception $e)
        {
            return response()->json([
                'message'=>'error found'.$e->getMessage(),
                'status'=>false
            ]);
        }
        
        

        

    }
}
