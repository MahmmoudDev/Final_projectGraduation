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

                        @foreach ($consultations as $item)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $item->user->name }}</td>

                                <td>
                                    @if ($item->service_type == 'doctor')
                                        Dr. {{ $item->doctor->name }}
                                    @else
                                        {{ $item->lawyer->name }}
                                    @endif
                                </td>

                                <td>{{ ucfirst($item->service_type) }}</td>

                                <td>{{ Str::limit($item->question, 30) }}</td>

                                <td>
                                    <span
                                        class="badge bg-{{ $item->status == 'pending' ? 'warning' : ($item->status == 'answered' ? 'success' : 'secondary') }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td>{{ $item->created_at->format('Y-m-d') }}</td>

                                <td>

                                    @if (auth('doctor')->check())
                                        <a href="{{ route('doctor.consultations.show', $item->id) }}"
                                            class="btn btn-primary btn-sm">
                                            Open Chat
                                        </a>
                                    @else
                                        <a href="{{ route('lawyer.consultations.show', $item->id) }}"
                                            class="btn btn-primary btn-sm">
                                            Open Chat
                                        </a>
                                    @endif

                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
