@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
@endsection

@section('title', 'Roles List')

@section('page-title', 'Roles List')

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
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td class="text-center">
                        @can('update-role', $role)
                            <a href="{{ url('/roles/' . $role->id . '/edit') }}" class="btn btn-secondary me-1"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                        @endcan
                        @can('view-role', $role)
                            <a href="{{ url('/roles/' . $role->id) }}" class="btn btn-info me-1"><i class="fa-solid fa-circle-info me-2"></i>Details</a>
                        @endcan
                        @can('delete-role', $role)
                            <button class="btn btn-danger me-1 delete" data-id="{{ $role->id }}"><i class="fa-solid fa-trash me-2"></i>Delete</button>
                        @endcan
                    </td>
                    <td class="text-center">{{ $role->name }}</td>
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
                let deletedRoleId = clickedDeleteBtn.data('id');
                
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
                                url: '/roles/' + deletedRoleId,
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