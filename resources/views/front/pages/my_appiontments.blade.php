@extends('front.layouts.master')
@section('title')
    My Appointments
@endsection

<body class="page-with-navbar">


    @section('content')
        <section class="appointments-hero text-center">

            <div class="container">

                <h1 class="fw-bold">

                    My Appointments

                </h1>

                <p>

                    Manage your medical
                    and legal bookings

                </p>

            </div>

        </section>


        <section class="container py-5">

            <div class="appointments-table-card">

                <div class="table-responsive">

                    <table class="table
            align-middle
            appointment-table">

                        <thead>

                            <tr>

                                <th>
                                    Provider
                                </th>

                                <th>
                                    Type
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Time
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($appointments as $appointment)
                                <tr>

                                    <td>

                                        <div>

                                            <h6 class="mb-1">

                                                {{ $appointment->provider_name }}

                                            </h6>

                                            <small>

                                                {{ $appointment->service_type }}

                                            </small>

                                        </div>

                                    </td>

                                    <td>

                                        @if ($appointment->service_type == 'doctor')
                                            Medical
                                        @else
                                            Legal
                                        @endif

                                    </td>

                                    <td>

                                        {{ $appointment->appointment_date }}

                                    </td>

                                    <td>

                                        {{ $appointment->appointment_time }}

                                    </td>

                                    <td>

                                        @if ($appointment->status == 'pending')
                                            <span class="badge
                    bg-warning
                    text-dark">

                                                Pending

                                            </span>
                                        @elseif($appointment->status == 'approved')
                                            <span class="badge
                    bg-success">

                                                Approved

                                            </span>
                                        @else
                                            <span class="badge
                    bg-danger">

                                                Rejected

                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        <button onclick="cancelAppointment({{ $appointment->id }},this)"
                                            class="btn btn-danger btn-sm rounded-pill px-3">
                                            Cancel
                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center
            py-5">

                                        No appointments found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>
    @endsection

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function
    cancelAppointment(id, reference) {
        // alert(id);
        Swal.fire({
                title: 'Cancel appointment?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'

            })
            .then(
                (
                    result
                ) => {

                    if (
                        result
                        .isConfirmed
                    ) {

                        axios.put(
                                '/cancel-appointment/' +
                                id
                            )

                            .then(
                                (
                                    response
                                ) => {

                                    Swal.fire({

                                        icon: response
                                            .data
                                            .icon,

                                        title: response
                                            .data
                                            .title,

                                        text: response
                                            .data
                                            .text,

                                    });

                                    setTimeout(
                                        () => {

                                            location
                                                .reload();

                                        }, 800);
                                });
                    }
                });
    }
</script>
