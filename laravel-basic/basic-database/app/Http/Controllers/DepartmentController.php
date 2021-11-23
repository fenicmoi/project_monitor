<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        $departments=Department::paginate(3);   
        $trashDepartment = Department::onlyTrashed()->paginate(2);

        /*
        $departments=DB::table('departments')
        ->join('users','departments.user_id','users.id')
        ->select('departments.*','users.name')->paginate(3);
        */
        return view('admin.department.index',compact('departments','trashDepartment'));
    }

    public function store(Request $request){
           // validate data;
           $request->validate(
               [
               'department_name'=>'required|unique:departments|max:10'
               ],
               [
                'department_name.required' => "กรุณาป้อนชื่อ",
                'department_name.max' => "ห้ามเกิน 10  ตัวอักษร",
                'department_name.unique' => "มีข้อมูลอยู่แล้ว"
                ]
               );
  
            $data = array();
            $data["department_name"] = $request -> department_name;
            $data["user_id"] = $request = Auth::user()->id;

            //query Builder
            DB::table('departments')->insert($data);
            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }
    
    public function edit($id){
        $department=Department::find($id);
        return view('admin.department.edit',compact('department'));
    }

    public function update(Request $request,$id){
        // validate data;
        $request->validate(
            [
            'department_name'=>'required|unique:departments|max:20'
            ],
            [
             'department_name.required' => "กรุณาป้อนชื่อ",
             'department_name.max' => "ห้ามเกิน 10  ตัวอักษร",
             'department_name.unique' => "มีข้อมูลอยู่แล้ว"
             ]
            );

        $update = Department::find($id)->update([
            'department_name'=>$request->department_name,
            'user_id'=>Auth::user()->id
        ]);

        return redirect()->route('department')->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    public function softdelete($id){
        $delete = Department::find($id)->delete();
        return redirect()->route('department')->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function restore($id){
       $restore= Department::withTrashed()->find($id)->restore();
       return redirect()->back()->with('success',"Restore success");

    }
}
