<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    ## แบบ eloquen orm  ใช้กับ Model
    // from modal user
    // $users=User::all();
    
    //แบบ query builder  กรณีที่ไม่ผูกกับตัว Model
    $users=DB::table('users')->get();

    return view('dashboard',compact('users'));
})->name('dashboard');