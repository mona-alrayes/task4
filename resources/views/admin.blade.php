@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Admin Dashboard') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            @if(session('status') == "you can not delete the super admin account" ||session('status')=="you can not change the role of super admin")
                                <div class="alert alert-danger" role="alert">
                                    {{ session('status') }}
                                </div>
                            @else
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        @endif
                        {{ __('Welcome Admin') }}
                    </div>                    
                </div>
            </div>
            <div class="col-md-10 ">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Change Role</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($users as $user)
                        <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 1){{ 'Admin' }}
                                    @else{{ 'Employee' }}
                                    @endif
                                </td>
                            <th><a class="btn btn-primary" href="{{route('role', $user->id)}}" role="button">{{$user->role?'Make client':'Make Admin'}}</a>
                                <th><a class="btn btn-success" href="{{ route('edit', $user->id) }}" role="button">Edit</a></th>
                                <th><a class="btn btn-danger" href="{{ route('delete', $user->id) }}" role="button" onclick="return confrim('are you sure you want to delete this account ?')">Delete</a></th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-10 "> 
                <a class="btn btn-secondary" href="{{url('admin/register')}}" role="button">Add New User</a>
            </div>
        </div>
    </div>
@endsection
