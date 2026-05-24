<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Dashboard Login
    </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
</head>

<body class="login-page bg-body-secondary">

    <div class="login-box">

        <div class="login-logo">

            <a href="#">

                <b>Med</b>Law

            </a>

        </div>

        <div class="card shadow-lg">

            <div class="card-body login-card-body">

                <p class="login-box-msg">

                    Sign in to start your session

                </p>

                @if (session('error'))
                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>
                @endif

                <form action="{{ route('dashboard.login.post') }}" method="POST">

                    @csrf

                    <div class="input-group mb-3">

                        <input type="email" name="email" class="form-control" placeholder="Email" required>

                        <div class="input-group-text">

                            <span class="bi bi-envelope"></span>

                        </div>

                    </div>

                    <div class="input-group mb-3">

                        <input type="password" name="password" class="form-control" placeholder="Password" required>

                        <div class="input-group-text">

                            <span class="bi bi-lock-fill"></span>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">

                            <button type="submit" class="btn btn-primary w-100">

                                Sign In

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script src="{{ asset('adminlte/js/adminlte.js') }}"></script>

</body>

</html>
