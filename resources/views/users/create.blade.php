@extends('layouts.master')

@section('title')
    Create User
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Create User</h1>
    @include('components.flash')
    @include('components.error-messages')
    <div class="row">
        <div class="col-md">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4 mb-3">
                    <label>Prefix name (Choose only from the ff: Mr/Ms/Mrs):</label>
                    <input type="text" class="form-control" name="prefixname" value="{{ old('prefixname') }}" placeholder="Prefix name">
                </div>
                <div class="col-md-4 mb-3">
                    <label>First name:</label>
                    <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="First name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Middle name:</label>
                    <input type="text" class="form-control" name="middlename" value="{{ old('middlename') }}" placeholder="Middle name">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Last name:</label>
                    <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Last name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Suffix name (Jr/Sr/III/etc):</label>
                    <input type="text" class="form-control" name="suffixname" value="{{ old('suffixname') }}" placeholder="Suffix name">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Username:</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>E-mail:</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Repeat Password:</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Photo:</label>
                    <input type="file" class="form-control-file" name="photo" accept="image/*" multiple>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Type:</label>
                    <input type="text" class="form-control" name="type" value="{{ old('type') }}" placeholder="Type">
                </div>
                <div class="col-md-4 mb-3">
                    <input class="btn btn-md btn-primary" type="submit" value="Create">
                </div>
            </form>
        </div>
    </div>
@endsection