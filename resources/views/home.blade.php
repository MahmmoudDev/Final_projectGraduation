@extends('dashboard.master')
@section('title', 'Home')
@section('Main-content', 'Main-Dashborad')
@section('breadcrumb-main', 'Home')
@section('breadcrumb-sub', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $count }}</h3>

                    <p>Admin</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                    </path>
                </svg>
                <a href="{{ route('admins.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $doctor_count }}</h3>

                    <p>Doctor</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                    </path>
                </svg>
                <a href="{{ route('doctors.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>

        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ $lawyerCount }}</h3>

                    <p>Lawyer</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                    </path>
                </svg>
                <a href="{{ route('doctors.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-secondary">
                <div class="inner">
                    <h3>{{ $specializationCount }}</h3>

                    <p>Specialization</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                        d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                    </path>
                </svg>
                <a href="{{ route('doctors.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $appointmetCount }}</h3>

                    <p>Appointment</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                    </path>
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                    </path>
                </svg>
                <a href="{{ route('appointments.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-info">
                <div class="inner">
                    <h3>{{ $UserCount }}</h3>

                    <p>User</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                    </path>
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                    </path>
                </svg>
                <a href="{{ route('users.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>



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

                                    @if ($item->status == 'pending')
                                        <span class="badge bg-warning">
                                            Pending
                                        </span>
                                    @elseif($item->status == 'approved')
                                        <span class="badge bg-success">
                                            Approved
                                        </span>
                                    @elseif($item->status == 'rejected')
                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>
                                    @elseif($item->status == 'cancelled')
                                        <span class="badge bg-secondary">
                                            Cancelled
                                        </span>
                                    @else
                                        <span class="badge bg-dark">
                                            {{ ucfirst($item->status) }}
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

                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $appointment->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>



        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Contact Table
                </h3>
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

                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
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
                                            <button class="btn btn-danger btn-sm rounded-pill px-3">
                                                Unread
                                            </button>
                                        @else
                                            <button class="btn btn-success btn-sm rounded-pill px-3">
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
                        {{ $appointment->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
