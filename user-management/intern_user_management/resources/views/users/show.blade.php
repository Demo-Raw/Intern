@extends('layouts.app')

@section('style')
@endsection

@section('title', 'User Details')

@section('head-title', 'Users')

@section('page-title', 'User Details')

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
    <table class="table">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ $user->role_name }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $user->address }}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>{{ $user->gender == 1? "Male" : "Female"  }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $user->status == 1? "Active" : "Inactive"  }}</td>
            </tr>
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('a[href="http://localhost:8000/users"]').addClass('active');
        })
    </script>
@endsection