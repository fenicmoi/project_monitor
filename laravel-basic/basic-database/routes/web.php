<?php

use App\Http\Controllers\DepartmentController;
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

//Route::get('department/all',[DepartmentController::class,'index']);

Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
    Route::post('department/add', [DepartmentController::class,'store'])->name('addDepartment');

    //crud 
    Route::get('/department/edit/{id}', [DepartmentController::class,'edit']);
    Route::post('/department/update/{id}', [DepartmentController::class,'update']);
    Route::get('/department/softdelete/{id}', [DepartmentController::class,'softdelete']);
    Route::get('/department/restore/{id}', [DepartmentController::class,'restore']);

});
