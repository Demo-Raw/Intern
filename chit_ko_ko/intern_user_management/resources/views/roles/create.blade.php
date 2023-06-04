@extends('layouts.app')

@section('style')
    <style>
        .border-bottom-dotted {
            border-bottom: 1px dotted lightgray !important;
            padding: 16px !important;
        }
    </style>
@endsection

@section('title', 'Role Create')

@section('page-title', 'Role Create')

@section('topbar')
    @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <form action="{{ url('/roles') }}" method="post">
        @csrf
        <div class="mb-4">
            <label class="form-label">Role Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Enter a role name" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <h4 class="mb-4">Role Permission</h4>
        <div class="row border-bottom-dotted">
            <div class="col-md-3">
                <label class="form-label me-5 pe-5">Administrator Access</label>
            </div>
            <div class="col-md-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="all_access" id="allAccessCheckbox" value="{{ $all_access_permission->id }}">
                    <label class="form-check-label">
                        All access
                    </label>
                </div>
            </div>
        </div>
        <div class="row border-bottom-dotted">
            <div class="col-md-3">
                <label class="form-label me-5 pe-5">{{ $user_feature_permissions[0]['feature_name'] }}</label>
            </div>
            <div class="col-md-9">
                @foreach ($user_feature_permissions as $user_feature_permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $user_feature_permission->name }}" value="{{ $user_feature_permission->id }}">
                        <label class="form-check-label">
                            {{ ucfirst(str_replace('_', ' ', $user_feature_permission->name)) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row border-bottom-dotted">
            <div class="col-md-3">
                <label class="form-label me-5 pe-5">{{ $role_feature_permissions[0]['feature_name'] }}</label>
            </div>
            <div class="col-md-9">
                @foreach ($role_feature_permissions as $role_feature_permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $role_feature_permission->name }}" value="{{ $role_feature_permission->id }}">
                        <label class="form-check-label">
                            {{ ucfirst(str_replace('_', ' ', $role_feature_permission->name)) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-3">
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
            $('#allAccessCheckbox').change(function() {
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').not('#allAccessCheckbox').prop('checked', false);
                $('input[type="checkbox"]').not('#allAccessCheckbox').prop('disabled', true);
            } else {
                $('input[type="checkbox"]').not('#allAccessCheckbox').prop('disabled', false);
            }
            });

            $('input[type="checkbox"]').not('#allAccessCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#allAccessCheckbox').prop('checked', false);
                    $('#allAccessCheckbox').prop('disabled', true);
                } else {
                    var isAnyCheckboxChecked = $('input[type="checkbox"]').not('#allAccessCheckbox').is(':checked');
                    if (!isAnyCheckboxChecked) {
                        $('#allAccessCheckbox').prop('disabled', false);
                    }
                }
            });

            let oldValueForAllAccess = '{{ old('all_access') }}';
            if (oldValueForAllAccess) {
                $('input[name="all_access"]').prop('checked', true);
            }
            
            let oldValueForViewUser = '{{ old('view_user') }}';
            if (oldValueForViewUser) {
                $('input[name="view_user"]').prop('checked', true);
            }
            
            let oldValueForCreateUser = '{{ old('create_user') }}';
            if (oldValueForCreateUser) {
                $('input[name="create_user"]').prop('checked', true);
            }
            
            let oldValueForUpdateUser = '{{ old('update_user') }}';
            if (oldValueForUpdateUser) {
                $('input[name="update_user"]').prop('checked', true);
            }
            
            let oldValueForDeleteUser = '{{ old('delete_user') }}';
            if (oldValueForDeleteUser) {
                $('input[name="delete_user"]').prop('checked', true);
            }
            
            let oldValueForViewRole = '{{ old('view_role') }}';
            if (oldValueForViewRole) {
                $('input[name="view_role"]').prop('checked', true);
            }
            
            let oldValueForCreateRole = '{{ old('create_role') }}';
            if (oldValueForCreateRole) {
                $('input[name="create_role"]').prop('checked', true);
            }
            
            let oldValueForUpdateRole = '{{ old('update_role') }}';
            if (oldValueForUpdateRole) {
                $('input[name="update_role"]').prop('checked', true);
            }
            
            let oldValueForDeleteRole = '{{ old('delete_role') }}';
            if (oldValueForDeleteRole) {
                $('input[name="delete_role"]').prop('checked', true);
            }
        });
    </script>
@endsection