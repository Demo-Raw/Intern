@extends('layouts.app')

@section('style')
@endsection

@section('title', 'User Create')

@section('head-title', 'Users')

@section('page-title', 'User Create')

@section('topbar')
    @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <form action="{{ url('/users') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" name="username" class="form-control" placeholder="Enter your username" value="{{ old('username') }}">
            @if ($errors->has('username'))
                <p class="text-danger">{{ $errors->first('username') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Role <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="role">
                <option value="">Open this select role menu</option>
                @foreach ($roles as $role)
                    @if ($role->id == old('role'))
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
            <input type="text" name="phone" class="form-control" placeholder="Enter your phone" value="{{ old('phone') }}">
            @if ($errors->has('phone'))
                <p class="text-danger">{{ $errors->first('phone') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Address <span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" placeholder="Enter your address">{{ old('address') }}</textarea>
            @if ($errors->has('address'))
                <p class="text-danger">{{ $errors->first('address') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password">
            @if ($errors->has('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password">
        </div>
        <div class="mb-3">
            <label class="form-label">Gender <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="gender">
                <option value="">Open this select geneder menu</option>
                @if (old('gender') == 1)
                    <option value="1" selected>Male</option>
                    <option value="2">Female</option>
                @elseif (old('gender') == 2)
                    <option value="1">Male</option>
                    <option value="2" selected>Female</option>
                @else
                    <option value="1">Male</option>
                    <option value="2">Female</option>
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
                @if (old('status') == 1)
                    <option value="1" selected>Active</option>
                    <option value="2">Inactive</option>
                @elseif (old('status') == 2)
                    <option value="1">Active</option>
                    <option value="2" selected>Inactive</option>
                @else
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                @endif
            </select>
            @if ($errors->has('status'))
                <p class="text-danger">{{ $errors->first('status') }}</p>
            @endif
        </div>
        <hr>
        <div class="mb-3">
            <button class="btn btn-primary">
                <i class="fa-solid fa-file me-2"></i>
                Save
            </button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('a[href="http://localhost:8000/users/create"]').addClass('active');
        })
    </script>
@endsection