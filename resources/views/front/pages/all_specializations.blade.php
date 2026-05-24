@extends('front.layouts.master')
@section('title', 'All Specializations')


@section('content')
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
    </section>

@endsection
