@extends('front.layouts.master')
@section('title', 'Srarch Page')
@section('content')
    <div class="container py-5">

        <h2 class="mb-4">
            Search Results
        </h2>

        <div class="row">

            @forelse($results as $item)
                <div class="col-md-4 mb-4">

                    <div class="card h-100">

                        @if ($item->image)
                            <img src="{{ asset('storage/' . ($type == 'doctor' ? 'doctors/' : 'lawyers/') . $item->image) }}"
                                class="card-img-top" style="height:250px;object-fit:cover;">
                        @endif

                        <div class="card-body">

                            <h4>
                                {{ $item->name }}
                            </h4>

                            <p>
                                {{ $item->specialization->name }}
                            </p>

                            <p>
                                Experience:
                                {{ $item->experience }}
                                Years
                            </p>

                            @if ($type == 'doctor')
                                <a href="{{ route('front.booking_doctor', $item->id) }}" class="btn btn-primary">

                                    Book Appointment

                                </a>
                            @else
                                <a href="{{ route('front.booking_lawyer', $item->id) }}" class="btn btn-primary">

                                    Book Appointment

                                </a>
                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-warning">

                        No results found.

                    </div>

                </div>
            @endforelse

        </div>

    </div>
@endsection
