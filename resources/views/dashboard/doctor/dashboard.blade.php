@extends('dashboard.master')

@section('title', 'Doctor Dashboard')
@section('Main-content', 'Doctor')
@section('breadcrumb-main', 'Doctor')
@section('breadcrumb-sub', 'Doctor')

@section('css')

    <style>
        .stat-card {
            border-radius: 18px;
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, .15) !important;
        }

        .stat-card h2 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: #6c757d;
            margin: 0;
            font-size: 14px;
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 28px;
        }
    </style>

@endsection


@section('content')

    <div class="app-content">

        <div class="row g-4 mb-4">

            <div class="col-lg col-md-6">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2>{{ $totalAppointments }}</h2>
                            <p>Total Appointments</p>
                        </div>
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg col-md-6">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2>{{ $pendingAppointments }}</h2>
                            <p>Pending</p>
                        </div>
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg col-md-6">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2>{{ $approvedAppointments }}</h2>
                            <p>Approved</p>
                        </div>
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg col-md-6">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2>{{ $rejectedAppointments }}</h2>
                            <p>Rejected</p>
                        </div>
                        <div class="stat-icon bg-danger">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg col-md-6">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2>{{ $cancelledAppointments }}</h2>
                            <p>Cancelled</p>
                        </div>
                        <div class="stat-icon bg-secondary">
                            <i class="fas fa-ban"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

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
                                        <form action="{{ route('doctor.appointment.approve', $appointment->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="btn btn-sm btn-success me-1">
                                                <i class="bi bi-check-circle"></i> قبول
                                            </button>

                                        </form>

                                        <form action="{{ route('doctor.appointment.reject', $appointment->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-x-circle"></i> رفض
                                            </button>

                                        </form>
                                    @elseif($appointment->status == 'approved')
                                        <span class="badge bg-success">
                                            Approved
                                        </span>
                                    @elseif($appointment->status == 'rejected')
                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>
                                    @elseif($appointment->status == 'cancelled')
                                        <span class="badge bg-secondary">
                                            Cancelled
                                        </span>
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
