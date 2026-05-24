 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Dashboard | @yield('title')</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
 <meta name="color-scheme" content="light dark" />
 <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
 <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

 <meta name="title" content="AdminLTE v4 | Dashboard" />
 <meta name="author" content="ColorlibHQ" />
 <meta name="description"
     content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
 <meta name="keywords"
     content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
 <meta name="supported-color-schemes" content="light dark" />
 <link rel="preload" href="{{ asset('adminlte/./css/adminlte.css') }}" as="style" />

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
     integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
     onload="this.media = 'all'" />

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
     crossorigin="anonymous" />

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
     crossorigin="anonymous" />
 <link rel="stylesheet" href="{{ asset('adminlte/./css/adminlte.css') }}" />
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
     integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
     integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />

 {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"> --}}

 <link rel="stylesheet" href="{{ asset('adminlte/fonts/all.min.css') }}">
 <link rel="stylesheet" href="{{ asset('adminlte/css/sweet.min.css') }}">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
 <link rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0-6/css/tempusdominus-bootstrap-4.min.css">
 <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">


 @yield('css')
