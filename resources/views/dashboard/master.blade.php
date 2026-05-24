<!doctype html>
<html lang="en">

<head>
    @include('dashboard.header-meta')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        @include('dashboard.navbar')

        @include('dashboard.aside')

        <main class="app-main">

            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('Main-content')</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">@yield('breadcrumb-main')</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    @yield('breadcrumb-sub')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>


            </div>


            <div class="app-content">

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>



        </main>

        @include('dashboard.footer')
    </div>
    @include('dashboard.footer-meta')

</body>

</html>
