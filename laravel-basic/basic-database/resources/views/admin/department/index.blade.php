<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี {{Auth::user()->name}}             
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">
                            ตารางข้อมูลแผนก
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">ตารางข้อมูลแผนก</h4>
                           
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>ชื่อแผนก</th>
                                        <th>พนักงาน</th>
                                        <th>Login</th>
                                        <th>edit</th>
                                        <th>Del</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                   @foreach($departments as $row)
                                   <tr>
                                       <td>{{$departments->firstItem()+$loop->index}}</td>
                                       <td>{{$row->department_name}}</td>
                                       <td>{{$row->user->name}}</td>
                                       <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                                       <td><a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-primary">edit</a></td>
                                       <td><a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-danger">del</a></td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer text-muted">
                            {{$departments -> links()}}
                            </div>
                        </div>
                    </div>

                    <div class="card my-2">
                        <div class="card-header">
                            ถังขยะ
                        </div>
                        <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ชื่อแผนก</th>
                                                <th>พนักงาน</th>
                                                <th>Create</th>
                                                <th>Restore</th>
                                                <th>True Del</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach($departments as $row)
                                        <tr>
                                            <td>{{$departments->firstItem()+$loop->index}}</td>
                                            <td>{{$row->department_name}}</td>
                                            <td>{{$row->user->name}}</td>
                                            <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                                            <td><a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-primary">edit</a></td>
                                            <td><a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-danger">del</a></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                        </div>
                        <div class="card-footer text-muted">
                            footer
                        </div>
                    </div>                           
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                         @if(session("success"))
                            <div class="alert alert-success">{{session('success')}}</div>
                         @endif
                        </div>
                        <div class="card-body">
                            <form action="{{route('addDepartment')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input type="text" class="form-control" name="department_name" id="department_name">
                                </div>
                                @error('department_name')
                                <span class="text-danger my-2">{{$message}}</span>
                                @enderror
                                <br>
                                <input type="submit" value="บันทึก" class="btn btn-primary">
                            </form>
                        </div>
                        <div class="card-footer text-muted">
                            Footer
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
