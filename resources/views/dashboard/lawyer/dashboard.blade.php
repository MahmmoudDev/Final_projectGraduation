@extends('dashboard.master')

@section('title', 'Lawyer Dashboard')
@section('Main-content', 'Lawyer')
@section('breadcrumb-main', 'Lawyer')
@section('breadcrumb-sub', 'Lawyer')


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
                                        <span class="badge bg-warning">
                                            Pending
                                        </span>
                                    @elseif($appointment->status == 'approved')
                                        <span class="badge bg-success">
                                            Approved
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Rejected
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

            </div>

        </div>

    </div>

@endsection
