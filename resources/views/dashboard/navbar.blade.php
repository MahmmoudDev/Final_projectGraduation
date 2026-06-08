 <nav class="app-header navbar navbar-expand bg-body">
     <!--begin::Container-->
     <div class="container-fluid">
         <!--begin::Start Navbar Links-->
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                     <i class="bi bi-list"></i>
                 </a>
             </li>
             <li class="nav-item d-none d-md-block">
                 <a href="#" class="nav-link">Home</a>
             </li>
             <li class="nav-item d-none d-md-block">
                 <a href="#" class="nav-link">@yield('title')</a>
             </li>
         </ul>
         <!--end::Start Navbar Links-->

         <!--begin::End Navbar Links-->
         <ul class="navbar-nav ms-auto">
             <!--begin::Navbar Search-->
             @if (Auth::guard('doctor')->check())
                 <form action="{{ route('doctor.search') }}" method="GET">
                 @elseif(Auth::guard('lawyer')->check())
                     <form action="{{ route('lawyer.search') }}" method="GET">
                     @else
                         <form action="{{ route('admin.search') }}" method="GET">
             @endif

             <input type="text" name="search" class="form-control" placeholder="Search...">

             </form>


             @php

                 $user = null;

                 if (Auth::guard('admin')->check()) {
                     $user = Auth::guard('admin')->user();
                 } elseif (Auth::guard('doctor')->check()) {
                     $user = Auth::guard('doctor')->user();
                 } elseif (Auth::guard('lawyer')->check()) {
                     $user = Auth::guard('lawyer')->user();
                 }

             @endphp
             <li class="nav-item dropdown">
                 <a class="nav-link" data-bs-toggle="dropdown" href="#">
                     <i class="bi bi-bell-fill"></i>
                     @if ($user->unreadNotifications()->count() > 0)
                         <span
                             class="navbar-badge badge text-bg-warning">{{ $user->unreadNotifications()->count() }}</span>
                     @endif
                 </a>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <span class="dropdown-item dropdown-header">{{ $user->unreadNotifications()->count() }}
                         إشعارات جديدة</span>
                     <div class="dropdown-divider"></div>

                     @forelse($user->unreadNotifications as $notification)
                         <a href="#" class="dropdown-item d-flex align-items-center justify-content-between"
                             style="white-space: normal;">
                             <div>
                                 <i class="bi bi-calendar-check-fill me-2 text-primary"></i>
                                 {{ $notification->data['message'] }}
                             </div>
                             <span class="float-end text-secondary fs-7 ms-2" style="min-width: fit-content;">
                                 {{ $notification->created_at->diffForHumans(null, true) }}
                             </span>
                         </a>
                         <div class="dropdown-divider"></div>
                     @empty
                         <div class="dropdown-item text-center text-secondary py-3">
                             لا توجد إشعارات جديدة بانتظارك
                         </div>
                         <div class="dropdown-divider"></div>
                     @endforelse

                     <a href="#" class="dropdown-item dropdown-footer"> عرض جميع الإشعارات </a>
                 </div>
             </li>
             <li class="nav-item dropdown user-menu">
                 <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                     @if (Auth::guard('doctor')->check())
                         @php
                             $img = Auth::guard('doctor')->user()->image;
                             $path = Str::contains($img, 'doctors') ? $img : 'doctors/' . $img;
                         @endphp
                         <img src="{{ $img ? asset('storage/' . $path) : asset('front/assets/images/default-avatar.png') }}"
                             class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;"
                             alt="Doctor">
                     @elseif(Auth::guard('lawyer')->check())
                         @php
                             $img = Auth::guard('lawyer')->user()->image;
                             $path = Str::contains($img, 'lawyers') ? $img : 'lawyers/' . $img;
                         @endphp
                         <img src="{{ $img ? asset('storage/' . $path) : asset('front/assets/images/default-avatar.png') }}"
                             class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;"
                             alt="Lawyer">
                     @endif

                     <span class="fw-bold">
                         @if (Auth::guard('doctor')->check())
                             Dr. {{ Auth::guard('doctor')->user()->name }}
                         @elseif(Auth::guard('lawyer')->check())
                             Lawyer {{ Auth::guard('lawyer')->user()->name }}
                         @elseif(Auth::guard('admin')->check())
                             {{ Auth::guard('admin')->user()->name }}
                         @endif
                     </span>
                 </a>
             </li>
             <!--end::User Menu Dropdown-->
         </ul>
         <!--end::End Navbar Links-->



     </div>
     <!--end::Container-->
 </nav>
