@extends('front.layouts.master')
@section('title', 'Login')


<body>
    @section('content')

        <section class="auth-section">
            <div class="container">
                <div class="row justify-content-center align-items-center min-vh-100">
                    <div class="col-lg-5 col-md-8">
                        <div class="auth-card">

                            <div class="text-center mb-4">
                                <img src="{{ asset('assetsFront/assets/img/MedLaw.png') }}" width="120" />
                            </div>

                            <h2 class="text-center mb-2">Welcome Back</h2>

                            <p class="text-center auth-text mb-4">Login to your account</p>


                            <form method="POST" action="{{ route('login') }}">

                                @csrf

                                <div class="mb-3">

                                    <label class="form-label">
                                        Email Address
                                    </label>

                                    <input type="email" name="email" class="form-control auth-input"
                                        placeholder="Enter email" required>

                                </div>


                                <div class="mb-3">

                                    <label class="form-label">
                                        Password
                                    </label>

                                    <input type="password" name="password" class="form-control auth-input"
                                        placeholder="Enter password" required>

                                </div>


                                <div class="d-flex
    justify-content-between
    mb-4">

                                    <div>

                                        <input type="checkbox" name="remember">

                                        Remember me

                                    </div>



                                </div>

                                <div>

                                    <p class="text mt-4">

                                        forgot your password?
                                        <a href="{{ route('password.request') }}" class="register-link">

                                            Reset Password

                                        </a>

                                    </p>

                                </div>

                                <button type="submit" class="auth-btn">

                                    Login

                                </button>

                            </form>


                            <p class="text-center mt-4">

                                Don’t have
                                an account?

                                <a href="{{ route('register') }}" class="register-link">

                                    Register

                                </a>

                            </p>


                        </div>
                    </div>
                </div>
            </div>
        </section>


    @endsection

    {{-- @extends('front.layouts.footer')
    @extends('front.layouts.footer-meta') --}}


</body>

</html>
