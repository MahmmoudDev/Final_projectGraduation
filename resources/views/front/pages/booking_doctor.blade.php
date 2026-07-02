@extends('front.layouts.master')
@section('title', 'Booking')



<body class="page-with-navbar">

    @section('content')
        <section class="booking-section">
            <div class="container">
                <div class="row g-5">
                    <!-- Doctor Info -->

                    <div class="col-lg-4">
                        <div class="booking-card">
                            @if ($doctor->image)
                                <img src="{{ asset('storage/doctors/' . $doctor->image) }}" alt="specialization Image"
                                    class="professional-img">
                            @else
                                <span>No Image</span>
                            @endif
                            {{-- <img src="{{ asset('assetsFront/assets/img/doctors/doctor-01.jpg') }}" class="booking-image" /> --}}

                            <h3 class="mt-4">{{ $doctor->name }}</h3>

                            <p class="booking-speciality">
                                {{ $doctor->specialization?->name }}</p>



                            <p>{{ $doctor->experience }}+ Years Experience</p>
                        </div>
                    </div>

                    <!-- Booking Form -->

                    <div class="col-lg-8">
                        <div class="booking-form-box">
                            <h2 class="mb-4">Book Appointment</h2>

                            @if (session('error'))
                                <div class="alert alert-danger">

                                    {{ session('error') }}

                                </div>
                            @endif

                            <form method="POST" action="{{ route('doctor.booking.store', $doctor->id) }}">

                                @csrf

                                <!-- User Info -->

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Full Name

                                        </label>

                                        <input type="text" class="form-control
            booking-input"
                                            value="{{ auth()->user()->name }}" readonly>

                                    </div>


                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Email Address

                                        </label>

                                        <input type="email" class="form-control
            booking-input"
                                            value="{{ auth()->user()->email }}" readonly>

                                    </div>


                                    <div class="col-md-6 mb-4">

                                        <label class="form-label">

                                            Phone Number

                                        </label>

                                        <input type="text" class="form-control
            booking-input"
                                            value="{{ auth()->user()->mobile }}" readonly>

                                    </div>

                                </div>


                                <div class="mb-3">

                                    <label>Select Date</label>

                                    <div class="mb-3">



                                        @php
                                            $availability = $doctor->availabilities->first();
                                        @endphp

                                        @if ($availability)

                                            @php
                                                $days = [
                                                    'Sunday',
                                                    'Monday',
                                                    'Tuesday',
                                                    'Wednesday',
                                                    'Thursday',
                                                    'Friday',
                                                    'Saturday',
                                                ];

                                                $from = array_search($availability->day_from, $days);
                                                $to = array_search($availability->day_to, $days);
                                            @endphp

                                            <select name="appointment_day" class="form-control" required>

                                                <option value="">
                                                    Select Day
                                                </option>

                                                @if ($from <= $to)

                                                    @for ($i = $from; $i <= $to; $i++)
                                                        <option value="{{ $days[$i] }}">
                                                            {{ $days[$i] }}
                                                        </option>
                                                    @endfor
                                                @else
                                                    @for ($i = $from; $i < count($days); $i++)
                                                        <option value="{{ $days[$i] }}">
                                                            {{ $days[$i] }}
                                                        </option>
                                                    @endfor

                                                    @for ($i = 0; $i <= $to; $i++)
                                                        <option value="{{ $days[$i] }}">
                                                            {{ $days[$i] }}
                                                        </option>
                                                    @endfor

                                                @endif

                                            </select>
                                        @else
                                            <div class="alert alert-warning">
                                                No appointments are currently available for this doctor.
                                            </div>

                                        @endif

                                    </div>

                                </div>

                                @if ($availability)

                                    <div class="mb-3">

                                        <label>Select Time</label>

                                        <select name="appointment_time" class="form-control" required>

                                            <option value="">
                                                Select Time
                                            </option>

                                            @foreach ($times as $time)
                                                <option value="{{ $time['value'] }}">
                                                    {{ $time['label'] }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <button type="submit" class="confirm-btn">
                                        Confirm Appointment
                                    </button>

                                @endif



                                {{-- <button type="submit" class="confirm-btn">

                                    Confirm Appointment

                                </button> --}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endsection


</body>

</html>
