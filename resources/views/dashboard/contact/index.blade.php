@extends('dashboard.master')

@section('title', 'Contact')

@section('Main-content', 'Contact')
@section('breadcrumb-main', 'Contact')
@section('breadcrumb-sub', 'Contact')

@section('content')
    <div class="app-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Contact Table</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped text-center align-middle" style="min-width: 1400px;">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                {{-- <th>Subject</th> --}}
                                <th>Message</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($contact as $item)
                                <div class="modal fade" id="messageModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Contact Message</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <strong>Name:</strong>
                                                    {{ $item->name }}
                                                </div>

                                                <div class="mb-3">
                                                    <strong>Email:</strong>
                                                    {{ $item->email }}
                                                </div>

                                                <div class="mb-3">
                                                    <strong>Subject:</strong>
                                                    {{ $item->subject }}
                                                </div>

                                                <hr>

                                                <p style="white-space: pre-wrap; word-break: break-word;">
                                                    {{ $item->message }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    {{-- <td>{{ $item->subject }}</td> --}}

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#messageModal{{ $item->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                            View
                                        </button>
                                    </td>

                                    <td>

                                        @if ($item->status == 'unread')
                                            <button
                                                onclick="markAsRead({{ $item->id }})"class="btn btn-danger btn-sm rounded-pill px-3">
                                                Unread
                                            </button>
                                        @else
                                            <button class="btn btn-success btn-sm rounded-pillpx-3" disabled>
                                                Read
                                            </button>
                                        @endif
                                    </td>

                                    <td>{{ $item->created_at }}</td>

                                    <td>
                                        <button type="button" onclick="delete_contact({{ $item->id }}, this)"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $contact->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function delete_contact(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to Delete this Contact!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/contacts/${id}`)
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


        function markAsRead(id) {
            // alert(id)
            axios.put(
                    '/admin/contact-read/' +
                    id
                )

                .then(
                    (
                        response
                    ) => {

                        Swal.fire({

                            toast: true,

                            position: 'top-end',

                            icon: response
                                .data
                                .icon,

                            title: response
                                .data
                                .text,

                            showConfirmButton: false,

                            timer: 1500

                        });

                        setTimeout(
                            () => {

                                location
                                    .reload();

                            }, 600);
                    });
        }
    </script>
    </script>
@endsection
