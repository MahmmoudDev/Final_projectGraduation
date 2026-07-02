  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
      <div class="container">
          <a class="navbar-brand d-flex align-items-center gap-2" href="#">
              <img src="{{ asset('assetsFront/assets/img/MedLaw.png') }}" width="100" />
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
              <!-- Center Menu -->
              <ul class="navbar-nav mx-auto gap-4">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('front.index') }}">Home</a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('front.doctors') }}">Doctors</a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('front.lawyers') }}">Lawyers</a>
                  </li>

                  {{-- <li class="nav-item">
                      <a class="nav-link" href="{{ route('front.consultations') }}">Consultations</a>
                  </li> --}}

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('front.contact') }}">Contact</a>
                  </li>
                  {{-- <li class="nav-item">
                      <a class="nav-link" href=""> Profile </a>
                  </li> --}}
              </ul>
              <button onclick="toggleDarkMode()" class="dark-mode-btn mr-2" id="darkModeToggle">
                  🌙
              </button>



              @php
                  $user = Auth::guard('web')->user();
              @endphp

              @if ($user)

                  <div class="dropdown me-2">


                      <button class="notifaction-btn position-relative" type="button" data-bs-toggle="dropdown"
                          aria-expanded="false">

                          <img src="{{ asset('assetsFront/assets/img/Icon.png') }}" alt="">

                          @if ($user->unreadNotifications->count() > 0)
                              <span class="notification-count">

                                  {{ $user->unreadNotifications->count() }}

                              </span>
                          @endif



                      </button>

                      <ul class="dropdown-menu dropdown-menu-end notification-dropdown shadow border-0">

                          <li class="dropdown-header">
                              Notifications
                          </li>



                          @forelse($user->unreadNotifications as $notification)
                              <li>

                                  <a class="dropdown-item notification-item"
                                      href="{{ route('notification.read', $notification->id) }}">

                                      @php
                                          $approved = $notification->data['title'] == 'Appointment Approved';
                                      @endphp

                                      <div class="notification-item">

                                          <span class="badge {{ $approved ? 'bg-success' : 'bg-danger' }}">
                                              {{ $notification->data['title'] }}
                                          </span>

                                          <div class="mt-2">
                                              {{ $notification->data['message'] }}
                                          </div>

                                          <small class="text-muted">
                                              {{ $notification->created_at->diffForHumans() }}
                                          </small>

                                      </div>

                                  </a>

                              </li>

                          @empty

                              <li class="dropdown-item text-center">

                                  No Notifications

                              </li>
                          @endforelse

                      </ul>

                  </div>

              @endif


              @guest

                  <div class="d-flex gap-3 ps-2">

                      <a href="{{ route('login') }}" class="custom-btn login-btn">

                          Login

                      </a>

                      <a href="{{ route('register') }}" class="custom-btn register-btn">

                          Register

                      </a>

                  </div>

              @endguest


              @auth

                  <div class="dropdown">
                      <button class="custom-btn register-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">

                          {{ auth()->user()->name }}

                      </button>

                      <ul class="dropdown-menu">

                          <li>

                              <a class="dropdown-item" href="{{ route('profile.edit', auth()->user()->id) }}">

                                  Profile

                              </a>

                          </li>

                          <li>

                              <a class="dropdown-item" href="{{ route('myAppiontments') }}">

                                  My Appointments

                              </a>

                          </li>

                          <li>

                              <form method="POST" action="{{ route('logout') }}">

                                  @csrf

                                  <button type="submit" class="dropdown-item">

                                      Logout

                                  </button>

                              </form>

                          </li>

                      </ul>

                  </div>

              @endauth



          </div>
  </nav>
