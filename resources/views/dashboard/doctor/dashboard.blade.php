@extends('dashboard.master')

@section('title', 'Doctor Dashboard')
@section('Main-content', 'Doctor')
@section('breadcrumb-main', 'Doctor')
@section('breadcrumb-sub', 'Doctor')


@section('content')

    <div class="app-content">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    My Appointments
                </h3>

            </div>

            <div class="card-body">

                <table class="table table-bordered text-center">

                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($appointments as $appointment)
                            <tr>

                                <td>
                                    {{ $appointment->user->name ?? 'Unknown' }}
                                </td>

                                <td>
                                    {{ $appointment->appointment_date }}
                                </td>

                                <td>
                                    {{ $appointment->appointment_time }}
                                </td>

                                <td>
                                    @if ($appointment->status == 'pending')
                                        <form
                                            action="{{ Auth::guard('doctor')->check() ? route('doctor.appointment.approve', $appointment->id) : route('doctor.appointment.approve', $appointment->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success me-1">
                                                <i class="bi bi-check-circle"></i> قبول
                                            </button>
                                        </form>

                                        <form
                                            action="{{ Auth::guard('doctor')->check() ? route('doctor.appointment.reject', $appointment->id) : route('doctor.appointment.reject', $appointment->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-x-circle"></i> رفض
                                            </button>
                                        </form>
                                    @elseif($appointment->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4">
                                    No Appointments
                                </td>
                            </tr>
                        @endforelse

                    </tbody>


                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $appointments->links('pagination::bootstrap-5') }}
                </div>

            </div>

        </div>

    </div>

@endsection
