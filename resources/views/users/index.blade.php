@extends('layouts.master')

@section('title')
    All Users
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">All Users</h1>
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
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img src="" height="100" width="100" alt=""></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('users.show', $user->id) }}">View</a>
                                <a class="btn btn-sm btn-success" href="#">Edit</a>
                                <a class="btn btn-sm btn-danger text-light" href="#">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection