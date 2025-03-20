<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuth;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FcmController;
use App\Http\Controllers\useraddressdetails;
// use App\Http\Controllers\KidsAssementControllerApi;
use App\Http\Controllers\API\KidsAssementController;
use App\Helpers\ApiHelper;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/send-message', function () {
    $phoneNumber = '07674952516';
    $text = 'Hello World - Asif!';
    $url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Example';
    $token = 'your_bearer_token_here'; // Replace with actual token

    $response = ApiHelper::sendMessage($phoneNumber, $text);

    return response()->json($response);
});


Route::get('/random-quote', [ApiAuth::class, 'randomQuote']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

 Route::get('/downloadfile/{fid}',[ApiAuth::class,'downloadfile']);
//Route::middleware('api')->post('user/login/details', [ApiAuth::class, 'login']);

Route::group(['middleware'=>'api'],function($routes){
   
    Route::Post('user/userlogin',[ApiAuth::class,'userlogin']);

Route::post('user/userregister',[ApiAuth::class,'userregister']);

// Route::Post('forgotpassword',[ApiAuth::class,'forgotpassword']);

Route::Post('forgotpassword',[ApiAuth::class,'forgotpassworduser']);

Route::Post('reset-password',[ApiAuth::class,'resetpassword']);

 Route::post('/refreshToken',[ApiAuth::class,'refresh']);

});


Route::group(['middleware'=>'jwt.verify'],function($routes){
//     Route::post('/profile',[ApiUserController::class,'profile']);
//  Route::post('/refresh',[ApiUserController::class,'refresh']);
//  Route::post('/logout',[ApiUserController::class,'logout']);
Route::get('get_user_details',[ApiAuth::class,'get_profile']);
Route::get('get_profile_image',[ApiAuth::class,'get_profile_image']);
Route::post('update_profile_image',[ApiAuth::class,'update_profile_image']);

Route::post('update_user_details',[ApiAuth::class,'update_user_details']);

Route::post('update_user_details1', [ApiAuth::class, 'update_user_details1']);
Route::get('update_user_details2/{id}', [ApiAuth::class, 'update_user_details2']);

Route::delete('delete_profile_image',[ApiAuth::class,'delete_profile_image']);
Route::get('get_user_booking_hisrory',[ApiAuth::class,'get_user_booking_hisrory']);
Route::post('create_review',[ApiAuth::class,'create_review']);
Route::get('get_review/{slag}',[ApiAuth::class,'get_review']);
Route::post('bookappointments',[ApiAuth::class,'bookappointment']);
Route::post('for_new_bookappointments',[ApiAuth::class,'bookappointment_for_new_user']);
Route::post('for_exesting_bookappointments',[ApiAuth::class,'bookappointment_exesting']);
Route::post('sos-call',[ApiAuth::class,'sos_call']);
 
 Route::get('check_previous_bookings/{slag}',[ApiAuth::class,'check_previous_bookings']);
 Route::get('get_therapy_traking/{aid}/{slag}',[ApiAuth::class,'get_therapy_traking']);

// user address curd

Route::post('add_address',[useraddressdetails::class,'addaddress']);

// Route::put('update_user_address',[useraddressdetails::class,'updateuseraddress']);
// chnages
Route::post('add_user_address',[useraddressdetails::class,'adduseraddress']);
Route::get('get_user_address_details',[useraddressdetails::class,'getuseraddress']);
Route::get('fetch_user_address/{id}',[useraddressdetails::class,'getuseraddressbyid']);
Route::post('update_user_address/{id}',[useraddressdetails::class,'updateuseraddressbyid']);


Route::post('send-fcm-notification', [FcmController::class, 'sendFcmNotification']);

// Daily health feedback

Route::post('feedback-health', [FcmController::class, 'feedbackHealth']);

// Assesment for kids 
Route::get('/list_of_questions',[KidsAssementController::class,'list']);    
Route::get('/list_of_questions_for_adults',[KidsAssementController::class,'list_for_adults']);    
Route::post('/save_assement',[KidsAssementController::class,'store']);    



});




// curd operation  for customer profile 
// Route::get('get_user_details/{id}',[ApiAuth::class,'get_user_details']);
// Route::put('update_user_details/{id}',[ApiAuth::class,'update_user_details']);
// Route::get('get_profile_image/{id}',[ApiAuth::class,'get_profile_image']);
// Route::post('update_profile_image/{id}',[ApiAuth::class,'update_profile_image']);
// Route::delete('delete_profile_image/{id}',[ApiAuth::class,'delete_profile_image']);

// booking history fetch
// Route::get('get_user_booking_hisrory/{id}',[ApiAuth::class,'get_user_booking_hisrory']);

// create_review
// Route::post('create_review',[ApiAuth::class,'create_review']);
// Route::get('get_review/{slag}',[ApiAuth::class,'get_review']);



// Route::post('/bookappointments',[ApiAuth::class,'bookappointment']);

// Route::middleware(['auth:sanctum'])->post('/test', [ApiAuth::class, 'test']);



//  Route::middleware(['custom_auth','auth:sanctum'])->post('/test',[ApiAuth::class,'test']);

// Route::post('/forgot-password', function (Request $request) {
    
// })->name('password.email');





// Route::middleware(['auth:sanctum', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
// });
