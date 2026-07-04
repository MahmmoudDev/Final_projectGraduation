@extends('front.layouts.master')
@section('title', 'Register')

@section('content')

    <section class="auth-section">

        <div class="container">

            <div class="row
        justify-content-center
        align-items-center
        ">

                <div class="col-lg-6
            col-md-8">

                    <div class="auth-card">

                        <div class="text-center
                    mb-4">

                            <img src="{{ asset('assetsFront/assets/img/MedLaw.png') }}" width="120" />

                        </div>

                        <h2 class="text-center
                    mb-2">

                            Create Account

                        </h2>

                        <p class="text-center
                    auth-text
                    mb-4">

                            Register to
                            MadLaw platform

                        </p>



                        <form method="POST" action="{{ route('register') }}">

                            @csrf

                           


                            <div class="mb-3">

                                <label>
                                    Full Name
                                </label>

                                <input type="text" name="name" class="form-control auth-input"
                                    placeholder="Enter full name" >

                            </div>


                            <div class="mb-3">

                                <label>
                                    Email Address
                                </label>

                                <input type="email" name="email" class="form-control auth-input"
                                    placeholder="Enter email" >

                            </div>

                            <div class="mb-3">

                                <label>
                                    Mobile Number
                                </label>

                                <input type="text" name="mobile" class="form-control auth-input"
                                    placeholder="Enter mobile number">

                            </div>


                            <div class="mb-3">

                                <label>
                                    Password
                                </label>

                                <input type="password" name="password" class="form-control auth-input"
                                    placeholder="Enter password">

                            </div>


                            <div class="mb-4">

                                <label>
                                    Confirm Password
                                </label>

                                <input type="password" name="password_confirmation" class="form-control auth-input"
                                    placeholder="Confirm password">

                            </div>


                            <button type="submit" class="auth-btn">

                                Create Account

                            </button>

                        </form>

                        <p class="text-center
                    mt-4">

                            Already have
                            an account?

                            <a href="{{ route('login') }}" class="register-link">

                                Login

                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
