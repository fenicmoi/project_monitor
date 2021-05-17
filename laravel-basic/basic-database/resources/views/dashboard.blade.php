<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี {{Auth::user()->name}} 
            <b class="float-end">จำนวนผู้ใช้ระบบ  {{count($users)}} คน</b>
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">email</th>
                    <th scope="col">เริ่มใช้ระบบ</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($users as $row )
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}/td>
                        <td>{{Carbon\carbon::parse($row->created_at)->diffForHumans()}}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
