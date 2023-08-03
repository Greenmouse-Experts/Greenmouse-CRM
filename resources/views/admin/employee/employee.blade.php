@extends('layouts.admin_dashboard_frontend')

@section('page-content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @includeIf('layouts.admin_topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="app-title">
                <div>
                    <h1><i class="fas fa-user"></i> Employee</h1>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                </ul>
            </div>
            <!-- DataTales Example -->
            <div class="row">
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <span class="m-0 font-weight-bold text-primary">Employees</span>

                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus" aria-hidden="true"></i> Add employee</button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Phone Number</th>
                                            <th>Date of Birth</th>
                                            <th>Sex</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Date Joined</th>
                                            <th style="width:20%">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td style="display: flex; justify-content: center;">
                                                @if($employee->photo)
                                                <img src="{{$employee->photo}}" alt="{{$employee->last_name}}" width="100" />
                                                @else
                                                <span class="rounded-circle header-profile-user" style="width: 50px; height: 50px; vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">{{ ucfirst(substr($employee->first_name, 0, 1)) }} {{ ucfirst(substr($employee->last_name, 0, 1)) }}</span>
                                                @endif
                                            </td>
                                            <td>{{$employee->last_name}} {{$employee->first_name}} {{$employee->middle_name}}
                                                <p>{{$employee->email}}</p>
                                            </td>
                                            <td>{{$employee->phone_number}}</td>
                                            <td>{{$employee->dob}}</td>
                                            <td>{{$employee->sex}}</td>
                                            <td>{{$employee->address}}</td>
                                            <td>{{App\Models\Role::find($employee->role)->name}}</td>
                                            <td>{{$employee->join_date}}</td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-{{$employee->id}}"><i class="fas fa-edit"></i> </button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$employee->id}}"><i class="fas fa-trash"></i> </button>

                                                <div id="delete-modal-{{$employee->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Delete {{$employee->first_name}} {{$employee->last_name}}</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('delete.employee', Crypt::encrypt($employee->id)) }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <h2">Are you sure want to delete this record?</h2>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-success float-right">Delete</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="edit-modal-{{$employee->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="my-modal-title">Edit {{$employee->first_name}} {{$employee->last_name}}</h5>
                                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('update.employee', Crypt::encrypt($employee->id)) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="card-body">
                                                                        <fieldset >
                                                                            <div class="form-group text-left">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <label for="">First Name</label>
                                                                                        <input type="text" name="first_name" value="{{$employee->first_name}}" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <label for="">Middle Name</label>
                                                                                        <input type="text" name="middle_name" value="{{$employee->middle_name}}"  class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <label for="">Last Name</label>
                                                                                <input type="text" name="last_name" value="{{$employee->last_name}}" class="form-control">
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <label for="">Email</label>
                                                                                <input type="text" name="email" value="{{$employee->email}}"  class="form-control">
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <label for="">Phone Number</label>
                                                                                <input type="text" name="phone_number" value="{{$employee->phone_number}}"  class="form-control">
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <label for="dob">Date of Birth</label>
                                                                                <input type="text" name="dob" id="dob" value="{{$employee->dob}}"  class="form-control">
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <label for="address">Address</label>
                                                                                <textarea type="text" name="address" value="{{$employee->address}}"  class="form-control">{{$employee->address}}</textarea>
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label for="">Gender</label>
                                                                                        <select name="sex" class="form-control">
                                                                                            <option selected="" value="{{$employee->sex}}">{{$employee->sex}}</option>
                                                                                            <option hidden="" disabled="" value=""> -- Select an option -- </option>
                                                                                            <option value="Male">Male</option>
                                                                                            <option value="Female">Female</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label for="">Role</label>
                                                                                        <select name="role" class="form-control">
                                                                                            <option selected="" value="{{App\Models\Role::find($employee->role)->id}}">{{App\Models\Role::find($employee->role)->name}}</option>
                                                                                            <option hidden="" disabled="" value=""> -- Select an option -- </option>
                                                                                            @foreach(App\Models\Role::latest()->get() as $role)
                                                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <label for="join_date">Join Date</label>
                                                                                <input type="text" name="join_date" id="join_date" value="{{$employee->join_date}}" class="form-control">
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <label for="">Salary</label>
                                                                                @forelse(App\Models\EmployeeSalary::where('employee_id', $employee->id)->get() as $salary)
                                                                                <input type="text" name="salary" value="{{$salary->salary}}" class="form-control">
                                                                                @empty
                                                                                <input type="text" name="salary" class="form-control">
                                                                                @endforelse
                                                                            </div>
                                                                            <div class="form-group text-left">
                                                                                <label for="">Photo</label>
                                                                                <input type="file" name="photo" class="form-control">
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    <button type="submit" name="submit_add_employee" class="btn btn-success float-right">Update</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="my-modal-title">Add employee</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('add.employee')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="">First Name</label>
                                                        <input type="text" name="first_name" class="form-control">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">Middle Name</label>
                                                        <input type="text" name="middle_name" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input type="text" name="last_name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" name="email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input type="text" name="phone_number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="dob">Date of Birth</label>
                                                <input type="text" name="dob" id="dob" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea type="text" name="address" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="">Gender</label>
                                                        <select name="sex" class="form-control">
                                                            <option hidden="" disabled="" selected="" value=""> -- Select an option -- </option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Role</label>
                                                        <select name="role" class="form-control">
                                                            <option hidden="" disabled="" selected="" value=""> -- Select an option -- </option>
                                                            @foreach(App\Models\Role::latest()->get() as $role)
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="join_date">Join Date</label>
                                                <input type="text" name="join_date" id="join_date" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Salary</label>
                                                <input type="text" name="salary" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Photo</label>
                                                <input type="file" name="photo" class="form-control">
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="password" name="password" value="" class="form-control" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Confirm Password</label>
                                                <input type="password" name="password_confirmation" value="" class="form-control" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                            </div> -->
                                        </fieldset>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-flat btn-success" style="width: 40%; font-size:1.3rem">Add</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

<script>
    // initialize the DatePicker component
    var datepickerDOB = new ej.calendars.DatePicker();
    var datepickerJoindate = new ej.calendars.DatePicker();
    // Render the initialized DatePicker.
    datepickerDOB.appendTo('#dob');
    datepickerJoindate.appendTo('#join_date');
</script>
@endsection