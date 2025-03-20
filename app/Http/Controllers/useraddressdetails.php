<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\useraddressdetail;
use App\Models\user;
use Illuminate\Support\Facades\Validator;


class useraddressdetails extends Controller
{
    //
    
    public function addaddress(Request $req){
        
         $user_id = auth('api')->user()->id;

        try{
            $validator=Validator::make($req->all(),[
              //  'user_id'=>'required',
               //'uid'=>'required',
                'Flat_no'=>'required|string',
                'street'=>'required|string',
                'area'=>'required|string',
                'landmark'=>'required|string',
                'pincode'=>'required|numeric',
                'type_of_address'=>'required|in:0,1,2',
                
                  'p_Flat_no'=>'nullable|string',
                'p_street'=>'nullable|string',
                'p_area'=>'nullable|string',
                'p_landmark'=>'nullable|string',
                'p_pincode'=>'nullable|numeric',
                'p_type_of_address'=>'nullable|in:0,1,2',
                
            ]);
    
           if ($validator->fails()) {
                $firstError = $validator->errors()->first();
                
                return response()->json([
                    'error' => $firstError
                ], 400);
            }
    
            $existing_prement_address = useraddressdetail::where('uid',$user_id)->where('type_of_address',0)
            ->first();
            
            $existing_present_address = useraddressdetail::where('uid',$user_id)->where('type_of_address',1)
            ->first();
            
               $existing_both = useraddressdetail::where('uid',$user_id)->where('type_of_address',2)
            ->first();
            
            
            
           // dd($existingAppointment);
    
        if ($existing_prement_address || $existing_present_address ||$existing_both) {
            return response()->json([
                'message' => 'Already Address Added.',
                'status' => false
            ], 503); // 409 Conflict
        }


            if($req->type_of_address==0 || $req->type_of_address==1){
                
                 $create_address_present=useraddressdetail::create([
                
                'uid'=>$user_id,
                'Flat_no'=>$req->Flat_no,
                'street'=>$req->street,
                'area'=>$req->area,
                'landmark'=>$req->landmark,
                'pincode'=>$req->pincode,
                'type_of_address'=>$req->type_of_address,
               
            ]);
            
            
             $create_address_prement=useraddressdetail::create([
                
                'uid'=>$user_id,
                'Flat_no'=>$req->p_Flat_no,
                'street'=>$req->p_street,
                'area'=>$req->p_area,
                'landmark'=>$req->p_landmark,
                'pincode'=>$req->p_pincode,
                'type_of_address'=>$req->type_of_address+1,
               
            ]);
            
            
            $lastInsertedId = $create_address_present->id;
    
            if($create_address_present && $create_address_prement ){
                
                $update_in_user_table=user::where('id',$user_id)->update([
                    'address_id'=>$lastInsertedId
                    
                    ]);
                
                return response()->json([
                    'message'=>'Address Added Successfully',
                    'status'=>true
                ]);
            }else{
    
                return response()->json([
                    'message'=>'Address Not Added Successfully',
                    'status'=>false
                ]);
            }
                
            }elseif($req->type_of_address==2){
                
                  $create_address=useraddressdetail::create([
                
                'uid'=>$user_id,
                'Flat_no'=>$req->Flat_no,
                'street'=>$req->street,
                'area'=>$req->area,
                'landmark'=>$req->landmark,
                'pincode'=>$req->pincode,
                'type_of_address'=>$req->type_of_address,
               
            ]);
            
            $lastInsertedId = $create_address->id;
    
            if($create_address){
                
                $update_in_user_table=user::where('id',$user_id)->update([
                    'address_id'=>$lastInsertedId
                    
                    ]);
                
                return response()->json([
                    'message'=>'Address Added Successfully',
                    'status'=>true
                ]);
            }else{
    
                return response()->json([
                    'message'=>'Address Not Added Successfully',
                    'status'=>false
                ]);
            }
                
                
                
            }


          
    



        }catch(\Exception $e)
        {
            return response()->json([
                'message'=>'error found'.$e->getMessage(),
                'status'=>false
            ]);
        }
        
    }
    
    
    public function getuseraddress(){
        
         $user_id = auth('api')->user()->id;
         
         
         $get_user_address=useraddressdetail::where('uid',$user_id)->get();
         
         if(count($get_user_address)>0){
             return response()->json([
                 'address'=>$get_user_address,
                 'status'=>true
                 
                 ]);
         }else{
              return response()->json([
                 'address'=>$get_user_address,
                 'status'=>false
                 
                 ]);
         }
         
        
    }
    
    
    public function updateuseraddress(){
          $user_id = auth('api')->user()->id;
          
          
          
           $get_user_address=useraddressdetail::where('uid',$user_id)->get();
        
            if(count($get_user_address)==1){
                dd("one");
            }elseif(count($get_user_address)>1){
                foreach($get_user_address as $user){
                    
                    
                    // dd($user->id);
                }
                
                
                
                dd("two");
            }
            
        //   dd(count($get_user_address));         
            
       
    }
    
    
    // new approach
    
    public function adduseraddress(Request $req){
        
    $user_id = auth('api')->user()->id;

try {
    $validator = Validator::make($req->all(), [
        'Flat_no' => 'required|string',
        'street' => 'required|string',
        'area' => 'required|string',
        'landmark' => 'required|string',
        'pincode' => 'required|numeric',
        'type_of_address' => 'required|in:0,1,2',
    ]);

    if ($validator->fails()) {
        $firstError = $validator->errors()->first();
        return response()->json([
            'error' => $firstError
        ], 400);
    }

    // Check if the user has already added the maximum number of addresses
    $existing_prement_address = useraddressdetail::where('uid', $user_id)->count();
    $existing_present = useraddressdetail::where('uid', $user_id)->where('type_of_address', 0)->count();
    $existing_perement = useraddressdetail::where('uid', $user_id)->where('type_of_address', 1)->count();

    // Conditions for limiting addresses
    if ($existing_prement_address >= 2) {
        return response()->json([
            'message' => 'User can only add two addresses.',
            'status' => false
        ], 503); // 503 Service Unavailable (Can change to 409 Conflict)
    } elseif ($existing_present > 0 && $req->type_of_address == 0) {
        return response()->json([
            'message' => 'Present address already added.',
            'status' => false
        ], 503); 
    } elseif ($existing_perement > 0 && $req->type_of_address == 1) {
        return response()->json([
            'message' => 'Permanent address already added.',
            'status' => false
        ], 503);
    }

    // Create the new address if validations pass
    $create_address_present = useraddressdetail::create([
        'uid' => $user_id,
        'Flat_no' => $req->Flat_no,
        'street' => $req->street,
        'area' => $req->area,
        'landmark' => $req->landmark,
        'pincode' => $req->pincode,
        'type_of_address' => $req->type_of_address,
    ]);

    // Success response
    return response()->json([
        'message' => 'Address added successfully',
        'status' => true,
        'address_id' => $create_address_present->id, // Returning the ID of the created address
    ], 200);

} catch (\Exception $e) {
    // Catch any exception and return an error response
    return response()->json([
        'message' => 'Error found: ' . $e->getMessage(),
        'status' => false
    ], 500);
}
    
    
    
    
    }
    
    
    public function getuseraddressbyid($id)
    {
       $get_address_details=useraddressdetail::where('id',$id)->get();
       
       
      // dd($get_address_details);
       
       if(count($get_address_details)>0){
           return response()->json([
               'address'=>$get_address_details,
               'status'=>true
               
               
               ]);
       }else{
           
            return response()->json([
               'address'=>$get_address_details,
               'status'=>false
               
               
               ]);
       }
           
       }
       
       
       public function updateuseraddressbyid(Request $req,$id){
          // dd("dsghkdf");
            $user_id = auth('api')->user()->id;
            $validator = Validator::make($req->all(), [
        'Flat_no' => 'required|string',
        'street' => 'required|string',
        'area' => 'required|string',
        'landmark' => 'required|string',
        'pincode' => 'required|numeric',
        'type_of_address' => 'required|in:0,1,2',
    ]);

    if ($validator->fails()) {
        $firstError = $validator->errors()->first();
        return response()->json([
            'error' => $firstError
        ], 400);
    }
           
           
           
           $update_user_address=useraddressdetail::where('id',$id)->update([
                'uid' => $user_id,
                'Flat_no' => $req->Flat_no,
                'street' => $req->street,
                'area' => $req->area,
                'landmark' => $req->landmark,
                'pincode' => $req->pincode,
                'type_of_address' => $req->type_of_address,
               
               
               
               ]);
               
             if($update_user_address==1){
                 return response()->json([
                     'status'=>true,
                     'message'=>'Updated Successfully'
                     ]);
             }else{
                  return response()->json([
                     'status'=>false,
                     'message'=>'Nothing Updated'
                     ]);
                 
             }  
               
       }
        
      
       
    
    
    
    
}
