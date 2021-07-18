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
                                <button onclick="event.preventDefault();
                                            var restoreForm = document.getElementById('restore-form')
                                            restoreForm.action = '{{ route('users.restore', $user->id) }}';
                                            restoreForm.submit();" 
                                    class="btn btn-sm btn-success">Restore</button>
                                <button class="btn btn-sm btn-danger text-light" 
                                    onclick="event.preventDefault();
                                            document.getElementById('delete-form').action = '{{ route('users.delete', $user->id) }}';" 
                                    data-toggle="modal" 
                                    data-target="#confirmDeleteModal">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('components.delete-modal')
    <form id="restore-form" action="#" method="POST">
        @csrf
        @method('PATCH')
    </form>
@endsection