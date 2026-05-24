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

</html>
