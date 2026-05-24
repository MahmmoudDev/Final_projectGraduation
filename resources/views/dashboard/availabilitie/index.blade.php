@extends('dashboard.master')

@section('title', 'Availabilities')

@section('Main-content', 'Availabilities')
@section('breadcrumb-main', 'Dashboard')
@section('breadcrumb-sub', 'Availabilities')

@section('content')

    <div class="app-content">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Availabilities Table
                </h3>

                <a href="{{ route('availabilities.create') }}" class="btn btn-primary ms-auto">

                    + Create Availability

                </a>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover text-center align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Provider ID</th>
                            <th>Service Type</th>
                            <th>Day From</th>
                            <th>Day To</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($availabilitie as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td> {{ $item->service_provider_id }}</td>
                                <td>{{ ucfirst($item->service_type) }}</td>
                                <td>{{ $item->day_from }}</td>
                                <td>{{ $item->day_to }}</td>
                                <td>{{ date('g:i A', strtotime($item->start_time)) }}</td>
                                <td>{{ date('g:i A', strtotime($item->end_time)) }}</td>
                                <td>
                                    @if ($item->is_available)
                                        <span class="badge bg-success">
                                            Available
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Unavailable
                                        </span>
                                    @endif
                                </td>
                                <td>

                                    <a href="{{ route('availabilities.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="deleteAvailability({{ $item->id }}, this)">
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
        function deleteAvailability(
            id,
            reference
        ) {

            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to delete this availability!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                })

                .then((result) => {

                    if (
                        !result.isConfirmed
                    ) return;

                    axios.delete(
                            `/admin/availabilities/${id}`
                        )

                        .then((response) => {

                            reference
                                .closest('tr')
                                .remove();

                            Swal.fire({
                                icon: response.data.icon,
                                title: response.data.title,
                                text: response.data.text,
                            });

                        })

                        .catch((error) => {

                            console.log(
                                error.response
                            );

                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                text: error.response
                                    ?.data?.text ||
                                    'Delete failed.',
                            });
                        });

                });
        }
    </script>

@endsection
