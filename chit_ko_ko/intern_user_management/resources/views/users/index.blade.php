@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
@endsection

@section('title', 'Users List')

@section('page-title', 'Users List')

@section('topbar')
    @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Action</th>
                <th class="text-center">Name</th>
                <th class="text-center">Username</th>
                <th class="text-center">Role</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="text-center">
                        @can('update-user', $user)
                            <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-secondary me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        @endcan
                        @can('view-user', $user)
                            <a href="{{ url('/users/' . $user->id) }}" class="btn btn-info me-1"><i class="fa-solid fa-circle-info"></i></a>
                        @endcan
                        @can('delete-user', $user)
                            <button class="btn btn-danger me-1 delete" data-id="{{ $user->id }}"><i class="fa-solid fa-trash"></i></button>
                        @endcan
                    </td>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->username }}</td>
                    <td class="text-center">{{ $user->role_name }}</td>
                    <td class="text-center">{{ $user->phone }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();

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
                let deletedRecord = clickedDeleteBtn.parent().parent();
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