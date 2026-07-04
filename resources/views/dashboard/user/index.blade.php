@extends('dashboard.master')

@section('title', 'Users')

@section('Main-content', 'User')
@section('breadcrumb-main', 'Dashboard')
@section('breadcrumb-sub', 'User')

@section('content')

    <div class="app-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    User Table
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>

                                <td>
                                    <form id="toggle-status-{{ $item->id }}"
                                        action="{{ route('users.toggleStatus', $item->id) }}" method="POST" class="d-inline">

                                        @csrf
                                        @method('PUT')

                                        @if ($item->status)
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="toggleStatus({{ $item->id }}, 'تعطيل')">

                                                <i class="fas fa-user-slash"></i>

                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="toggleStatus({{ $item->id }}, 'تفعيل')">

                                                <i class="fas fa-user-check"></i>

                                            </button>
                                        @endif

                                    </form>

                                    <button type="button" class="btn btn-sm btn-danger "
                                        onclick="deleteUser({{ $item->id }} , this)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        function deleteUser(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to Delete this User!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/users/${id}`)
                        .then((response) => {

                            reference.closest('tr').remove();

                            Swal.fire({
                                icon: response.data.icon,
                                title: response.data.title,
                                text: response.data.text,
                            });

                        })
                        .catch((error) => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                text: 'Delete failed.',
                            });
                            console.log(error.response);
                        });
                }
            });


        }

        function toggleStatus(id, action) {

            Swal.fire({
                title: `هل أنت متأكد؟`,
                text: `هل تريد ${action} هذا الحساب؟`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم',
                cancelButtonText: 'إلغاء'
            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('toggle-status-' + id).submit();

                }

            });

        }
    </script>
@endsection
