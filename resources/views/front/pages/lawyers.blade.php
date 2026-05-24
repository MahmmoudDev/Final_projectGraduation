@extends('front.layouts.master')
@section('title', 'Lawyers')

<body class="page-with-navbar">


    @section('content')

        <section class="container py-5">
            <div class="filter-box">
                <div class="row g-3">
                    <h1 class="text-center">All Lawyers</h1>
                </div>
            </div>
        </section>

        <section class="container pb-5">
            <div class="row g-4">
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



                                <!-- Buttons -->
                                <div class="d-flex gap-3">
                                    <a href="{{ route('front.booking_lawyer', $item->id) }}"
                                        class="book-btn w-50 text-center">
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
            </div>
        </section>

    @endsection
</body>

</html>
