<!doctype html>
<html lang="en">

<head>

    <title>@yield('title')</title>

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

    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                width: '350px'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'error',
                html: `

        <ul style="margin:0;padding-left:18px;text-align:left;line-height:1.8">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    `,
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                width: '420px',
                background: '#fff',
                color: '#333',
            });
        </script>
    @endif

</body>

</html>
