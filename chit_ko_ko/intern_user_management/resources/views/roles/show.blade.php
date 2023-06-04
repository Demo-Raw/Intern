@extends('layouts.app')

@section('style')
@endsection

@section('title', 'Role Details')

@section('page-title', 'Role Details')

@section('topbar')
    @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <a href="{{ url('/roles') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-2"></i>
        Back
    </a>
    <hr>
    <table class="table">
        <tbody>
            <tr>
                <th>Role Name</th>
                <td>{{ $role_name }}</td>
            </tr>
            <tr>
                <th>Permission</th>
                <td>{{ $permission_names }}</td>
            </tr>
        </tbody>
    </table>
@endsection

@section('script')
@endsection