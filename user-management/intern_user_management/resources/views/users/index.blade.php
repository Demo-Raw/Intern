@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2.css" rel="stylesheet">
@endsection

@section('title', 'Users List')

@section('head-title', 'Users')

@section('page-title', 'Users List')

@section('topbar')
    @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body py-4" style="width: 100%; overflow: auto;">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Username</th>
                        <th class="min-w-125px">Role</th>
                        <th class="min-w-125px">Phone</th>
                        <th class="min-w-125px">Email</th>
                        <th class="text-end min-w-100px">Actions</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                    <!--begin::Table row-->
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <div class="badge badge-light fw-bold">{{ $user->role_name }}</div>	
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-end">
                                <!--begin::Dropdown Actions Btn-->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                        @can('update-user', $user)
                                            @php
                                                $hasPermission = true;
                                            @endphp
                                        @elsecan('view-user', $user)
                                            @php
                                                $hasPermission = true;
                                            @endphp
                                        @elsecan('delete-user', $user)
                                            @php
                                                $hasPermission = true;
                                            @endphp
                                        @else
                                            @php
                                                $hasPermission = false;
                                            @endphp
                                        @endcan
                                        @can('update-user', $user)
                                            <li><a class="dropdown-item" href="{{ url('/users/' . $user->id . '/edit') }}">
                                                    <i class="fa-solid fa-user-pen me-2"></i>
                                                    Edit
                                                </a>
                                            </li>
                                        @endcan
                                        @can('view-user', $user)
                                            <li><a class="dropdown-item" href="{{ url('/users/' . $user->id) }}">
                                                    <i class="fa-solid fa-circle-info me-2"></i>
                                                    Details
                                                </a>
                                            </li>
                                        @endcan
                                        @can('delete-user', $user)
                                            <li><button class="dropdown-item delete" data-id="{{ $user->id }}">
                                                    <i class="fa-solid fa-trash-can me-2 text-danger"></i>
                                                    Delete
                                                </button>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                                <!--end::Dropdown Actions Btn-->
                            </td>
                        </tr>
                    @endforeach
                    <!--end::Table row-->
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#kt_table_users').DataTable();
            $('#kt_table_users_filter').children().children().css("color", "#565674");
			$('select[name="kt_table_users_length"]').css("color", "#565674");
            $('a[href="http://localhost:8000/users"]').addClass('active');

            let message = "{{ session()->get('message') }}";
            if (message) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            $(document).on('click', '.delete', (e) => {
                let clickedDeleteBtn = $(e.currentTarget);
                let deletedRecord = clickedDeleteBtn.parent().parent().parent().parent().parent();
                let deletedUserId = clickedDeleteBtn.data('id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/users/' + deletedUserId,
                                type: 'DELETE',
                                data: {
                                    '_token': '{{ csrf_token() }}'
                                },
                                success: (message) => {
                                    deletedRecord.remove();
                                    Swal.fire(
                                        'Deleted!',
                                        message,
                                        'success'
                                    )
                                },
                                error: (err) => {
                                    console.log(err);
                                }
                            });
                        }
                })
            })
        });
    </script>
@endsection