@extends('dashboard.master')

@section('title', 'Lawyers')

@section('Main-content', 'Lawyers')
@section('breadcrumb-main', 'Lawyers')
@section('breadcrumb-sub', 'Lawyers')

@section('content')

    <div class="app-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Lawyers Table
                </h3>
                <a href="{{ route('lawyers.create') }}" class="btn btn-primary ms-auto">
                    + Create Lawyer
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Image</th>
                            <th>Specialization</th>
                            <th>Experience</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($lawyers as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset('storage/lawyers/' . $item->image) }}" alt="Lawyer Image"
                                            class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td>{{ $item->specialization->name }}</td>
                                <td>{{ $item->experience }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('lawyers.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-danger "
                                        onclick="deleteLawyer({{ $item->id }} , this)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $lawyers->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        function deleteLawyer(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to Delete this Lawyer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/lawyers/${id}`)
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
    </script>
@endsection
