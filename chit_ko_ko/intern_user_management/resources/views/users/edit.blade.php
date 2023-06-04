@extends('layouts.app')

@section('style')
@endsection

@section('title', 'User Edit')

@section('page-title', 'User Edit')

@section('topbar')
    @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <a href="{{ url('/users') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-2"></i>
        Back
    </a>
    <hr>
    <form action="{{ url('/users/' . $user->id) }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name', $user->name) }}">
            @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" name="username" class="form-control" placeholder="Enter your username" value="{{ old('username', $user->username) }}">
            @if ($errors->has('username'))
                <p class="text-danger">{{ $errors->first('username') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Role <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="role">
                <option value="">Open this select role menu</option>
                {{ $selected_role = old('role', $user->role_id) }}
                @foreach ($roles as $role)
                    @if ($role->id == $selected_role)
                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                    @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('role'))
                <p class="text-danger">{{ $errors->first('role') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" name="phone" class="form-control" placeholder="Enter your phone" value="{{ old('phone', $user->phone) }}">
            @if ($errors->has('phone'))
                <p class="text-danger">{{ $errors->first('phone') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email', $user->email) }}">
            @if ($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Address <span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" placeholder="Enter your address">{{ old('address', $user->address) }}</textarea>
            @if ($errors->has('address'))
                <p class="text-danger">{{ $errors->first('address') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Gender <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="gender">
                <option value="">Open this select geneder menu</option>
                {{ $selected_gender = old('gender', $user->gender) }}
                @if ($selected_gender == 1)
                    <option value="1" selected>Male</option>
                    <option value="2">Female</option>
                @elseif($selected_gender == 2)
                    <option value="1">Male</option>
                    <option value="2" selected>Female</option>
                @endif
            </select>
            @if ($errors->has('gender'))
                <p class="text-danger">{{ $errors->first('gender') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="status">
                <option value="">Open this select menu</option>
                {{ $selected_status = old('status', $user->is_active) }}
                @if ($selected_status == 1)
                    <option value="1" selected>Active</option>
                    <option value="2">Inactive</option>
                @elseif($selected_status == 2)
                    <option value="1">Active</option>
                    <option value="2" selected>Inactive</option>
                @endif
            </select>
            @if ($errors->has('status'))
                <p class="text-danger">{{ $errors->first('status') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <button class="btn btn-primary me-3" type="submit">
                <i class="fa-solid fa-file me-2"></i>
                Update
            </button>
            <a href="{{ url('/users') }}" class="btn btn-secondary">
                <i class="fa-solid fa-xmark me-2"></i>
                Cancel
            </a>
        </div>
    </form>
@endsection

@section('script')
@endsection