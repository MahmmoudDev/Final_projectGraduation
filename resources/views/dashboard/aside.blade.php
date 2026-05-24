<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <div class="sidebar-brand">

        <a href="#" class="brand-link">

            <img src="{{ asset('adminlte/assets/img/MedLaw.png') }}" alt="Logo"
                class="brand-image opacity-75 shadow" />

            <span class="brand-text fw-light">
                MadLaw
            </span>

        </a>

    </div>

    <div class="sidebar-wrapper">

        <nav class="mt-2">

            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">

                {{-- ===================== --}}
                {{-- ADMIN SIDEBAR --}}
                {{-- ===================== --}}

                @if (Auth::guard('admin')->check())
                    <li class="nav-item">

                        <a href="{{ route('admin.dashboard') }}" class="nav-link">

                            <i class="nav-icon bi bi-speedometer"></i>

                            <p>
                                Dashboard
                            </p>

                        </a>

                    </li>

                    <li class="nav-header">
                        Content
                    </li>

                    {{-- Admins --}}
                    <li class="nav-item">

                        <a href="#" class="nav-link">

                            <i class="nav-icon bi bi-person"></i>

                            <p>

                                Admins

                                <i class="nav-arrow bi bi-chevron-right"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="{{ route('admins.index') }}" class="nav-link">

                                    <i class="nav-icon bi bi-circle"></i>

                                    <p>Read</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="{{ route('admins.create') }}" class="nav-link">

                                    <i class="nav-icon bi bi-circle"></i>

                                    <p>Create</p>

                                </a>

                            </li>

                        </ul>

                    </li>

                    {{-- Users --}}
                    <li class="nav-item">

                        <a href="{{ route('users.index') }}" class="nav-link">

                            <i class="nav-icon bi bi-people"></i>

                            <p>
                                Users
                            </p>

                        </a>

                    </li>

                    {{-- Doctors --}}
                    <li class="nav-item">

                        <a href="#" class="nav-link">

                            <i class="nav-icon bi bi-hospital"></i>

                            <p>

                                Doctors

                                <i class="nav-arrow bi bi-chevron-right"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="{{ route('doctors.index') }}" class="nav-link">

                                    <i class="nav-icon bi bi-circle"></i>

                                    <p>Read</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="{{ route('doctors.create') }}" class="nav-link">

                                    <i class="nav-icon bi bi-circle"></i>

                                    <p>Create</p>

                                </a>

                            </li>

                        </ul>

                    </li>

                    {{-- Lawyers --}}
                    <li class="nav-item">

                        <a href="#" class="nav-link">

                            <i class="nav-icon bi bi-briefcase"></i>

                            <p>

                                Lawyers

                                <i class="nav-arrow bi bi-chevron-right"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="{{ route('lawyers.index') }}" class="nav-link">

                                    <i class="nav-icon bi bi-circle"></i>

                                    <p>Read</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="{{ route('lawyers.create') }}" class="nav-link">

                                    <i class="nav-icon bi bi-circle"></i>

                                    <p>Create</p>

                                </a>

                            </li>

                        </ul>

                    </li>

                    {{-- Appointments --}}
                    <li class="nav-item">

                        <a href="{{ route('appointments.index') }}" class="nav-link">

                            <i class="nav-icon bi bi-calendar-check"></i>

                            <p>
                                Appointments
                            </p>

                        </a>

                    </li>

                    {{-- Specialty --}}
                    <li class="nav-item">

                        <a href="{{ route('specializations.index') }}" class="nav-link">

                            <i class="nav-icon bi bi-tag"></i>

                            <p>
                                Specialty
                            </p>

                        </a>

                    </li>

                    {{-- Contact --}}
                    <li class="nav-item">

                        <a href="{{ route('contacts.index') }}" class="nav-link">

                            <i class="nav-icon bi bi-chat-left-text"></i>

                            <p>
                                Contact
                            </p>

                        </a>

                    </li>

                    {{-- Availability --}}
                    <li class="nav-item">

                        <a href="{{ route('availabilities.index') }}" class="nav-link">

                            <i class="nav-icon bi bi-clock"></i>

                            <p>
                                Availabilities
                            </p>

                        </a>

                    </li>

                    {{-- Consultation --}}
                    <li class="nav-item">

                        <a href="{{ route('consultations.index') }}" class="nav-link">

                            <i class="nav-icon bi bi-camera-video"></i>

                            <p>
                                Consultations
                            </p>

                        </a>

                    </li>
                @endif


                {{-- ===================== --}}
                {{-- DOCTOR / LAWYER --}}
                {{-- ===================== --}}

                @if (Auth::guard('doctor')->check() || Auth::guard('lawyer')->check())
                    <li class="nav-item">

                        <a href="#" class="nav-link active">

                            <i class="nav-icon bi bi-speedometer"></i>

                            <p>
                                Dashboard
                            </p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="#" class="nav-link">

                            <i class="nav-icon bi bi-calendar-check"></i>

                            <p>
                                My Appointments
                            </p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="#" class="nav-link">

                            <i class="nav-icon bi bi-person-circle"></i>

                            <p>
                                My Profile
                            </p>

                        </a>

                    </li>
                @endif


                {{-- ===================== --}}
                {{-- LOGOUT --}}
                {{-- ===================== --}}

                <li class="nav-header">
                    Auth
                </li>

                <li class="nav-item">

                    <form action="{{ route('dashboard.logout') }}" method="POST">

                        @csrf

                        <button type="submit" class="nav-link btn border-0 bg-transparent w-100 text-start">

                            <i class="nav-icon bi bi-box-arrow-right"></i>

                            <span>
                                Logout
                            </span>

                        </button>

                    </form>

                </li>

            </ul>

        </nav>

    </div>

</aside>
