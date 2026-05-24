@extends('front.layouts.master')
@section('title', 'Doctor Profile')
</head>

<body class="page-with-navbar">

    @section('content')

        <!-- Hero -->

        <section class="profile-hero">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Image -->
                    <div class="col-lg-4">
                        @if ($doctor->image)
                            <img src="{{ asset('storage/doctors/' . $doctor->image) }}"
                                class="profile-image" alt="Doctor Image" />
                        @else
                            <img src="{{ asset('assetsFront/assets/img/default-doctor.png') }}"
                                class="profile-image" alt="Default Image" />
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="col-lg-8">
                        <h1 class="doctor-name">DR. {{ $doctor->name }}</h1>

                        <p class="doctor-speciality">{{ $doctor->specialization->name }}</p>



                        <div class="doctor-info">
                            <p>
                                <strong>Experience:</strong>
                                {{ $doctor->experience }} Years
                            </p>
                            <p>
                                <strong>Mobile:</strong>
                                {{ $doctor->mobile }}
                            </p>

                            <p>
                                <strong>Email:</strong>
                                {{ $doctor->email }}
                            </p>




                        </div>

                        <a href="{{ route('front.booking_doctor', $doctor->id) }}" class="book-btn profile-book-btn">
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Doctor -->

        <section class="container py-5">
            <h2 class="section-title">About Doctor</h2>

            <p class="about-text">
                Dr. Ahmad Ali is a highly experienced cardiologist specializing in heart
                disease diagnosis and treatment. He has over 10 years of experience in
                medical care and patient consultation.
            </p>
        </section>

        <!-- Available Times -->

        <section class="container py-5">
            <h2 class="section-title">
                Available Times
            </h2>

            <div class="time-slots">

                @foreach ($doctor->availabilities as $availability)
                    <button class="time-btn">

                        {{ $availability->day_from }}
                        →
                        {{ $availability->day_to }}

                        <br>

                        {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }}
                        -
                        {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}

                    </button>
                @endforeach
            </div>
        </section>
    @endsection



</body>
