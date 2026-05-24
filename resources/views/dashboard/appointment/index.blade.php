    @extends('dashboard.master')

    @section('title', 'Appointment')

    @section('Main-content', 'Appointment')
    @section('breadcrumb-main', 'Dashboard')
    @section('breadcrumb-sub', 'Appointment')

    @section('css')

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">

    @endsection

    @section('content')

        <div class="app-content">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        Appointment Table
                    </h3>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover text-center align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Provider</th>
                                <th>Type</th>
                                <th>Appointment Day</th>
                                <th>Appointment Time</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        <tbody>

                            @foreach ($appointment as $item)
                                <tr>

                                    <td>
                                        {{ $item->id }}
                                    </td>

                                    <td>
                                        {{ $item->user?->name }}
                                    </td>

                                    <td>
                                        {{ $item->provider_name }}
                                    </td>

                                    <td>
                                        {{ $item->service_type }}
                                    </td>

                                    <td>
                                        {{ $item->appointment_date }}
                                    </td>

                                    <td>
                                        {{ $item->appointment_time }}
                                    </td>

                                    <td>
                                        @if ($item->status == 'cancelled')
                                            <span class="badge bg-danger">
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="badge bg-warning">

                                                {{ $item->status }}

                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ $item->created_at }}
                                    </td>

                                    <td>

                                        <button type="button" class="btn btn-sm btn-danger">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>



                        {{-- @foreach ($doctors as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ asset('storage/doctors/' . $item->image) }}" alt="Doctor Image"
                                                class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->specialization->name }}</td>
                                    <td>{{ $item->experience }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ route('doctors.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-danger "
                                            onclick="deleteDoctor({{ $item->id }} , this)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach --}}
                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    @endsection

    @section('js')
        {{-- <script>
            function changeStatus(id, status) {
                axios.put(
                        '/admin/appointments/change-status/' + id, {
                            status: status
                        }
                    )

                    .then(function(response) {

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: response.data.icon,
                            title: response.data.text,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    });
            }
        </script> --}}
    @endsection
