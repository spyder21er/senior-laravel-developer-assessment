@extends('layouts.master')

@section('title')
    Edit User
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit User</h1>
    @include('components.flash')
    @include('components.error-messages')
    <div class="row">
        <div class="col-md">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="col-md-4 mb-3">
                    <label>Prefix name (Mr/Ms/Mrs):</label>
                    <input type="text" class="form-control" name="prefixname" value="{{ $user->prefixname }}" placeholder="Prefix name">
                </div>
                <div class="col-md-4 mb-3">
                    <label>First name:</label>
                    <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" placeholder="First name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Middle name:</label>
                    <input type="text" class="form-control" name="middlename" value="{{ $user->middlename }}" placeholder="Middle name">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Last name:</label>
                    <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" placeholder="Last name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Suffix name (Jr/Sr/III/etc):</label>
                    <input type="text" class="form-control" name="suffixname" value="{{ $user->suffixname }}" placeholder="Suffix name">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Username:</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" placeholder="Username" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>E-mail:</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="E-mail" required>
                </div>
                <div class="col-md-4 mb-3">
                    <img src="{{ $user->avatar }}" class="img-thumbnail">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Change Photo:</label>
                    <input type="file" class="form-control-file" name="photo" accept="image/*" multiple>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Type:</label>
                    <input type="text" class="form-control" name="type" value="{{ $user->type }}" placeholder="Type">
                </div>
                <div class="col-md-4 mb-3">
                    <input class="btn btn-md btn-success" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection