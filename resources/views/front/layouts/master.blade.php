<!doctype html>
<html lang="en">

<head>

    <title>
        @yield('title')
    </title>



    @include('front.layouts.header-meta')

</head>



<body class="page-with-navbar">



    @include('front.layouts.navbar')

    @yield('content')

    @include('front.layouts.footer')

    <button id="scrollTopBtn">

        ↑

    </button>

    @include('front.layouts.footer-meta')

</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            width: '350px'
        });
    </script>
@endif

</html>
