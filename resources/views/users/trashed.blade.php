@extends('layouts.master')

@section('title')
    Trashed Users
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Trashed Users</h1>
    @include('components.flash')
    <div class="row">
        <div class="col-md">
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img src="{{ $user->avatar }}" height="100" width="100" alt=""></td>
                            <td>
                                <button class="btn btn-sm btn-success">Restore</button>
                                <button class="btn btn-sm btn-danger text-light">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection