<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\childernAssement;
use App\Http\Controllers\Adults_assesement_contoller;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    return view('auth.login');
    
    
});
// Route::get('/tt', function () {
//     // return view('welcome');
//     // return view('dashboard.index');
//     return view('home2');
// });


// Route::get('/add-therapist', function () {
//     // return view('welcome');
//     // return view('dashboard.index');
//     return view('addtherapist');
// })->name('add.therapist');


// Auth::routes();
Auth::routes([
    'login' => false, // Disables default login route
    'register' => false, // Disables default register route
    'reset' => false, // Disables password reset routes
    'verify' => false, // Disables email verification routes
]);


Route::get('/user-login', [LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/user-login', [LoginController::class, 'login'])->name('user.login.submit');

// Custom Register Route
Route::get('/user-register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/user-register', [RegisterController::class, 'register'])->name('user.register.submit');

// Custom Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

// Custom Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('user.password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('user.password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('user.password.update');


// Auth::routes(['login' => false]);


Route::get('/view-behaviour/{id}', [App\Http\Controllers\HomeController::class, 'addbehaviour'])->name('addbehavioursss');
Route::get('/add-behaviour/{aid}', [App\Http\Controllers\HomeController::class, 'addbehaviourdetails'])->name('addbehaviourdetails');
Route::post('/add-new-behaviour', [App\Http\Controllers\HomeController::class, 'addnewbehaviour'])->name('addnewbehaviour');




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/get-my-patients', [App\Http\Controllers\HomeController::class, 'index2'])->name('getmypatients');
//23.09.2024
Route::get('/search-clients', [App\Http\Controllers\HomeController::class, 'searchclients'])->name('searchclients');
// Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');






Route::get('/list-therapist', [App\Http\Controllers\HomeController::class, 'adduser'])->name('add.therapist')->middleware('checkadmin');



Route::get('/add-user', [App\Http\Controllers\HomeController::class, 'addpatient'])->name('add.addpatient')->middleware('checkadmin');
Route::get('/add-user-client/{id}', [App\Http\Controllers\HomeController::class, 'adduserclients'])->name('adduserclients')->middleware('checkadmin');
Route::get('/add-user-address/{id}', [App\Http\Controllers\HomeController::class, 'adduseraddress'])->name('adduseraddress')->middleware('checkadmin');
Route::post('/add-user-address/{id}', [App\Http\Controllers\HomeController::class, 'adduseraddressdetails'])->name('adduseraddressdetails')->middleware('checkadmin');
Route::get('/get_patients', [App\Http\Controllers\HomeController::class, 'get_patients'])->name('get_patients')->middleware('checkadmin');
Route::get('/get_user_details', [App\Http\Controllers\HomeController::class, 'get_user_details'])->name('get_users')->middleware('checkadmin');
Route::get('/get_partient_appointment/{id}', [App\Http\Controllers\HomeController::class, 'get_partient_appointment'])->name('get_partient_appointment')->middleware('checkadmin');
Route::get('/get_appointment/{id}', [App\Http\Controllers\HomeController::class, 'get_partient_appointment1'])->name('get_partient_appointment1')->middleware('checkadmin');

// Assement module for childerns

Route::resource('/create_assessment', childernAssement::class)
    ->middleware('checkadmin');
Route::get('view-kids-results',[childernAssement::class,'viewChildAssesement'])->middleware('checkadmin')->name('kids.result');
Route::get('view-kids-assement-result/{id}',[childernAssement::class,'display'])->middleware('checkadmin')->name('kids.result.id');
Route::get('edit-kids-assement-questions/{id}',[childernAssement::class,'updatequestions'])->middleware('checkadmin')->name('kids.question.update');

// Adults Assesemnt Module
Route::resource('create_assesement_for_adults',Adults_assesement_contoller::class)->middleware('checkadmin');
Route::get('view-adults-results',[Adults_assesement_contoller::class,'viewAdultsAssesement'])->middleware('checkadmin')->name('adults.result');
Route::get('view-adults-result/{id}',[Adults_assesement_contoller::class,'display'])->middleware('checkadmin')->name('adults.result.id');

Route::get('/getmydetails', [App\Http\Controllers\HomeController::class, 'getmydetails'])->name('getmydetails');
Route::POST('/updatemydetails/{id}', [App\Http\Controllers\HomeController::class, 'updatemydetails'])->name('updatemydetails');
Route::POST('/add_my_family_list/{id}', [App\Http\Controllers\HomeController::class, 'addmyfamilylist'])->name('addmyfamilylist');
Route::get('/addtherapist', [App\Http\Controllers\HomeController::class, 'addtherapist'])->name('addtherapist');
Route::POST('/registeruser', [App\Http\Controllers\HomeController::class, 'registeruser'])->name('registeruser');
Route::POST('/registerclinet', [App\Http\Controllers\HomeController::class, 'registerclinet'])->name('registerclinet');
Route::get('/edit-therapist/{id}', [App\Http\Controllers\HomeController::class, 'therapistsedit'])->name('therapists.edit');
Route::get('/edit-client/{id}', [App\Http\Controllers\HomeController::class, 'editclient'])->name('editclient');
Route::get('/view_details/{id}', [App\Http\Controllers\HomeController::class, 'viewdetails'])->name('viewdetails');
Route::put('/update-therapist/{id}', [App\Http\Controllers\HomeController::class, 'therapistsupdate'])->name('therapists.update');
Route::delete('/therapists/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('therapists.destroy');

Route::POST('/bookappointments', [App\Http\Controllers\HomeController::class, 'bookappointment'])->name('bookappointment');


Route::post('/assign_therapist',[App\Http\Controllers\HomeController::class,'assign_therapist'])->name('assign_therapist');

Route::patch('/appointments/{id}/change-status', [ApiAuth::class, 'changeStatus'])
    ->name('appointments.changeStatus')
    ->middleware('auth');

    
Route::patch('/appointments/{id}/close-status', [ApiAuth::class, 'changeStatus_to_Close'])
->name('appointments.changeCloseStatus')
->middleware('auth');

// web.php
Route::get('download/{filename}', [ApiAuth::class, 'download'])->name('file.download');



Route::get('/users', [ApiAuth::class, 'index'])->name('users.index');
Route::get('/users_get', [ApiAuth::class, 'index1'])->name('users1.index');



