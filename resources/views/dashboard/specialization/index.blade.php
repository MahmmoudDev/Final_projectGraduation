@extends('dashboard.master')

@section('title', 'Specializations')

@section('Main-content', 'Specializations')
@section('breadcrumb-main', 'Specializations')
@section('breadcrumb-sub', 'Specializations')

@section('content')

    <div class="app-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Specializations Table
                </h3>
                <a href="{{ route('specializations.create') }}" class="btn btn-primary ms-auto">
                    + Create Specialization
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Actions</th>

                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($specializations as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset('storage/specialization/' . $item->image) }}" alt="specialization Image"
                                            class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td>{{ $item->type }}</td>
                                <td>
                                    <a href="{{ route('specializations.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-danger "
                                        onclick="deleteSpecialization({{ $item->id }} , this)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        function deleteSpecialization(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to Delete this Specialization!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/specializations/${id}`)
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
