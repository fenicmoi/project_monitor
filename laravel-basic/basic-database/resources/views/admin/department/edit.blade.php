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
                            Edit data
                        </div>
                        <div class="card-body">
                            <form action="{{ '/department/update/'.$department->id }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input type="text" class="form-control" name="department_name" id="department_name" value="{{$department->department_name}}">
                                </div>
                                @error('department_name')
                                <span class="text-danger my-2">{{$message}}</span>
                                @enderror
                                <br>
                                <input type="submit" value="Update" class="btn btn-primary">
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
