@extends('front.layouts.master')
@section('title', 'Contact')

<body class="page-with-navbar">

    @section('content')

        <section class="contact-hero text-center text-white">
            <div class="container">
                <h1 class="fw-bold">Contact Us</h1>
                <p class="mt-3">
                    We are here to help you with medical and legal consultations.
                </p>
            </div>
        </section>

        <section class="container py-5">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="contact-card text-center">
                        <div class="contact-icon">📞</div>

                        <h5>Phone</h5>

                        <p>+970 59 123 4567</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="contact-card text-center">
                        <div class="contact-icon">📧</div>

                        <h5>Email</h5>

                        <p>support@madlaw.com</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="contact-card text-center">
                        <div class="contact-icon">📍</div>

                        <h5>Location</h5>

                        <p>Palestine, Gaza</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="contact-card text-center">
                        <div class="contact-icon">⏰</div>

                        <h5>Working Hours</h5>

                        <p>9:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="container pb-5">
            <div class="contact-box">
                <div class="row align-items-center g-5">
                    <!-- Left -->

                    <div class="col-lg-6">
                        <h2 class="mb-4">Send Us a Message</h2>

                        @if (session('success'))
                            <div class="alert
    alert-success">

                                {{ session('success') }}

                            </div>
                        @endif

                        <form method="POST" action="{{ route('front.contact.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label"> Full Name </label>

                                <input type="text" name="name" value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                    class="form-control
                                    contact-input"
                                    placeholder="Enter your name" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Email Address </label>

                                <input type="email" value="{{ auth()->check() ? auth()->user()->email : '' }}" name="email"
                                    class="form-control contact-input" placeholder="Enter your email" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Subject </label>

                                <input type="text" name="subject" class="form-control contact-input"
                                    placeholder="Enter subject" />
                            </div>

                            <div class="mb-4">
                                <label class="form-label"> Message </label>

                                <textarea rows="5" name="message" class="form-control contact-input" placeholder="Write your message">
                </textarea>
                            </div>

                            <button class="contact-btn">Send Message</button>
                        </form>
                    </div>

                    <!-- Right -->

                    <div class="col-lg-6">
                        <div class="contact-side-box">
                            <h2>Need Help?</h2>

                            <p class="mt-3">
                                Our medical and legal team is always ready to assist you with
                                your questions.
                            </p>

                            <img src="{{ asset('assetsFront/assets/img/MedLaw.png') }}" class="img-fluid mt-4"
                                alt="Contact" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endsection


</body>

</html>
