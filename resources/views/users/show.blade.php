@extends('layouts.master')

@section('title')
    Show user {{ $user->id }}
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Show User</h1>
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">User Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Photo</th>
                        <td><img src="{{ $user->avatar }}" height="100" width="100" alt=""></td>
                    </tr>
                    <tr>
                        <th>Prefix Name</th>
                        <td>{{ $user->prefixname }}</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>{{ $user->firstname }}</td>
                    </tr>
                    <tr>
                        <th>Middle Name</th>
                        <td>{{ $user->middlename }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $user->lastname }}</td>
                    </tr>
                    <tr>
                        <th>Suffix Name</th>
                        <td>{{ $user->suffixname }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection