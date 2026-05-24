@extends('dashboard.master')

@section('title', 'Consultations')

@section('Main-content', 'Consultations')
@section('breadcrumb-main', 'Consultations')
@section('breadcrumb-sub', 'Consultations')

@section('content')

    <div class="app-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Consultations Table
                </h3>
                <a href="#" class="btn btn-primary ms-auto">
                    + Create Consultation
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Provider</th>
                            <th>Type</th>
                            <th>Question</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                Mahmoud Akram
                            </td>
                            <td>
                                Dr. Ahmad Ali
                            </td>
                            <td>
                                Doctor
                            </td>
                            <td>
                                Chest pain
                            </td>
                            <td>
                                <span class="badge bg-warning">
                                    Pending
                                </span>
                            </td>
                            <td>
                                2026-05-20
                            </td>
                            <td>
                                <a href="{{ route('consultations.show', 1) }}" class="btn btn-primary btn-sm">
                                    Open Chat
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // function deleteAdmin(id, reference) {
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to Delete this Admin!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, delete it!',
        //         cancelButtonText: 'No',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             axios.delete(`/admin/admins/${id}`)
        //                 .then((response) => {

        //                     reference.closest('tr').remove();

        //                     Swal.fire({
        //                         icon: response.data.icon,
        //                         title: response.data.title,
        //                         text: response.data.text,
        //                     });

        //                 })
        //                 .catch((error) => {
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'Failed!',
        //                         text: 'Delete failed.',
        //                     });
        //                     console.log(error.response);
        //                 });
        //         }
        //     });
        // }
    </script>
@endsection
