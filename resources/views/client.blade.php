@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Client Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Welcome  Client !') }}
                    </div>
                </div>
            </div>
            <div class="col-md-8 ">
                <table class="table table-bordered ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($clients as $client)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>
                                     @if ($client->role == 1){{ 'Admin' }}
                                    @else{{ 'Employee' }}
                                    @endif
                                </td>
                                </th>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
@endsection
