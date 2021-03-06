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
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img src="{{ $user->avatar }}" height="100" width="100" alt=""></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('users.show', $user->id) }}">View</a>
                                <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                <a class="btn btn-sm btn-danger text-light" 
                                    onclick="event.preventDefault();
                                            document.getElementById('delete-form').action = '{{ route('users.destroy', $user->id) }}';" 
                                    data-toggle="modal" 
                                    data-target="#confirmDeleteModal">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('components.delete-modal')
@endsection