@extends('front.layouts.master')
@section('title', 'Lawyer Profile')

<body class="page-with-navbar">


    <!-- Hero -->

    @section('content')

        <section class="profile-hero">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Image -->
                    <div class="col-lg-4">
                        @if ($lawyer->image)
                            <img src="{{ asset('storage/lawyers/' . $lawyer->image) }}"
                                class="profile-image" alt="laywer Image" />
                        @else
                            <img src="{{ asset('assetsFront/assets/img/Lawyers/law1.jpg') }}"
                                class="profile-image" alt="Default Image" />
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="col-lg-8">
                        <h1 class="doctor-name">Law. {{ $lawyer->name }}</h1>

                        <p class="doctor-speciality">{{ $lawyer->specialization->name }}</p>



                        <div class="doctor-info">
                            <p>
                                <strong>Experience:</strong>
                                {{ $lawyer->experience }}
                            </p>
                            <p>
                                <strong>Mobile:</strong>
                                {{ $lawyer->mobile }}
                            </p>
                            <p>
                                <strong>Email:</strong>
                                {{ $lawyer->email }}
                            </p>
                        </div>

                        <a href="{{ route('front.booking_lawyer', $lawyer->id) }}" class="book-btn profile-book-btn">
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </section>



        <section class="container py-5">
            <h2 class="section-title">About Lawyer</h2>

            <p class="about-text">
                {{ $lawyer->about_lawyers }}
            </p>
        </section>

        <!-- Available Times -->

        <section class="container py-5">
            <h2 class="section-title">
                Available Times
            </h2>

            <div class="time-slots">
                {{-- {{ $lawyer->id }} --}}
                {{-- {{ dd($lawyer->availabilities) }} --}}

                @foreach ($lawyer->availabilities as $availability)
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
