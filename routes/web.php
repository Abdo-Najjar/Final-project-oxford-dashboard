<?php

use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Prologue\Alerts\Facades\Alert;

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
// Route::get('teacher/disable/{entry}', 'Admin\TeacherCrudController@disable');

Route::get('application/{application}/accept', function (Application $application) {


    Alert::success('Student Added Successfully!')->flash();

    User::create([
        'first_name' => $application->first_name,
        'last_name' => $application->last_name,
        'email' => $application->email,
        'gender' => $application->gender,
        'phone_number' => $application->phone_number,
        'password' => bcrypt('password'),
        'address' => $application->address,
        'gender' => $application->gender,
        'dob'=>$application->dob
    ]);
    $application->delete();

    return redirect('/application');
});
