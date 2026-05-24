@extends('front.layouts.master')
@section('title', 'Home')

@section('content')
    <!-- Hero -->
    <section class="hero-section text-white d-flex align-items-center text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">
                MadLaw Medical & Legal Consultation Platform
            </h1>

            <p class="lead mt-4">
                Book appointments with doctors and lawyers through one smart platform.
            </p>
            <div class="hero-search-box mt-5">
                <form class="row g-3 justify-content-center">
                    <!-- Search -->
                    <div class="col-md-4">
                        <input type="text" class="form-control hero-input" placeholder="Search doctor or lawyer" />
                    </div>

                    <!-- Specialization -->
                    <div class="col-md-3">
                        <select class="form-select hero-input">
                            <option selected>Select Specialization</option>

                            <option>Cardiology</option>
                            <option>Dentistry</option>
                            <option>Corporate Law</option>
                            <option>Criminal Law</option>
                        </select>
                    </div>

                    <!-- Button -->
                    <div class="col-md-2">
                        <button class="hero-search-btn w-100">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Specializations -->
    <section class="container py-5">
        <h2 class="text-center mb-5">Specializations</h2>

        <p class="subtitle text-center mb-5">
            Explore a wide range of medical and legal specializations to find the
            right professional for your needs.
        </p>

        <div class="row g-4">
            @foreach ($specialization as $item)
                <div class="col-md-3">
                    <div class="special-card p-5 text-center shadow">
                        @if ($item->image)
                            <img src="{{ asset('storage/specialization/' . $item->image) }}" alt="specialization Image"
                                class="mx-auto mb-3" width="90">
                        @else
                            <span>No Image</span>
                        @endif
                        <h5>{{ $item->name }}</h5>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="text-center mt-5">
            <a href="{{ route('front.allspecializations') }}" class="view-all-btn"> View All Specializations </a>
        </div>
    </section>

    <section class="container py-5">
        <!-- Title -->
        <div class="text-center mb-5">
            <h2 class="section-title">Top Doctors</h2>

            <p class="section-subtitle">
                Find trusted doctors and book appointments easily.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($doctor as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="professional-card">
                        {{-- <img src="{{ asset('assetsFront/assets/img/doctors/doctor-01.jpg') }}" class="professional-img" /> --}}

                        @if ($item->image)
                            <img src="{{ asset('storage/doctors/' . $item->image) }}" alt="specialization Image"
                                class="professional-img">
                        @else
                            <span>No Image</span>
                        @endif

                        <div class="p-4">
                            <h4 class="professional-name">{{ $item->name }}</h4>

                            <p class="professional-speciality">{{ $item->specialization->name }}</p>

                            <!-- Rating -->
                            {{-- <div class="rating mb-4">
                                ⭐⭐⭐⭐⭐
                                <span>(4.9)</span>
                            </div>

                            {{-- <!-- Buttons --> --}}
                            <div class="d-flex gap-3">
                                <a href="{{ route('front.booking_doctor', $item->id) }}" class="book-btn w-50 text-center">
                                    Book
                                </a>

                                <a href="{{ route('front.doctor_profile', $item->id) }}"
                                    class="profile-btn w-50 text-center">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('front.doctors') }}" class="view-all-btn"> View All Doctors </a>
        </div>
    </section>

    <section class="container py-5">
        <!-- Title -->
        <div class="text-center mb-5">
            <h2 class="section-title">Top Lawyers</h2>

            <p class="section-subtitle">
                Find professional lawyers for legal consultations.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($lawyers as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="professional-card">
                        {{-- <img src="{{ asset('assetsFront/assets/img/doctors/doctor-01.jpg') }}" class="professional-img" /> --}}

                        @if ($item->image)
                            <img src="{{ asset('storage/lawyers/' . $item->image) }}" alt="specialization Image"
                                class="professional-img">
                        @else
                            <span>No Image</span>
                        @endif

                        <div class="p-4">
                            <h4 class="professional-name">{{ $item->name }}</h4>

                            <p class="professional-speciality">{{ $item->specialization->name }}</p>

                            <!-- Rating -->
                            {{-- <div class="rating mb-4">
                                ⭐⭐⭐⭐⭐
                                <span>(4.9)</span>
                            </div> --}}

                            <!-- Buttons -->
                            <div class="d-flex gap-3">
                                <a href="{{ route('front.booking_lawyer', $item->id) }}" class="book-btn w-50 text-center">
                                    Book
                                </a>

                                <a href="{{ route('front.lawyer_profile', $item->id) }}"
                                    class="profile-btn w-50 text-center">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-5">
                <a href="{{ route('front.lawyers') }}" class="view-all-btn"> View All Lawyers </a>
            </div>
        </div>
    </section>
@endsection
