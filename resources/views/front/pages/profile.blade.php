@extends('front.layouts.master')
@section('title', 'My Profile')

<body class="page-with-navbar">

    @section('content')


        <section class="profile-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="profile-card">
                            <div class="text-center mb-5">
                                <h1 class="profile-title">My Profile</h1>

                                <p class="profile-subtitle">Manage your personal information</p>
                            </div>

                            <!-- Personal Information -->
                            @if ($errors->any())

                                <div class="alert alert-danger">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{ $error }}
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">

                                    {{ session('success') }}

                                </div>
                            @endif
                            <div class="profile-info-box">
                                <h3 class="mb-4">Personal Information</h3>
                                <form action="{{ route('profile.update', $user->id) }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label"> Full Name </label>

                                            <input type="text" name="name" class="form-control profile-input"
                                                value="{{ $user->name }}" />
                                        </div>

                                        <input type="email" name="email" class="form-control profile-input"
                                            value="{{ $user->email }}" />

                                        <div class="col-md-6">
                                            <label class="form-label"> Phone Number </label>

                                            <input type="text" name="mobile" class="form-control profile-input"
                                                value="{{ $user->mobile }}" />
                                        </div>


                                    </div>
                            </div>

                            <!-- Buttons -->

                            <div class="profile-actions mt-5">
                                <button class="btn btn-primary">Update Profile</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>


    @endsection

</body>

</html>
