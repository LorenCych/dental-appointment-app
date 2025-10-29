  <div class="offcanvas offcanvas-start bg-body" tabindex="-1" id="offcanvas-menu">
    <div class="offcanvas-header"><a
        class="link-body-emphasis d-flex align-items-center me-md-auto mb-3 mb-md-0 text-decoration-none" href="{{ route('registrant.dashboard',  ['user_id' => $user->id]) }}"><svg
          xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
          class="bi bi-check-circle-fill text-primary me-3" style="font-size: 25px;width: 30px;height: 30px;">
          <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
          </path>
        </svg><span class="fs-5"><strong>LC HAPPY CARE DENTAL CLINIC</strong></span></a><button class="btn-close"
        type="button" aria-label="Close" data-bs-dismiss="offcanvas"></button></div>
    <div class="offcanvas-body d-flex flex-column justify-content-between pt-0">
      <div>
        <hr class="mt-0">
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a class="nav-link link-dark" href="{{ route('registrant.dashboard',  ['user_id' => $user->id]) }}" aria-current="page">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                class="bi bi-person-fill text-primary me-1 mb-1">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"></path>
              </svg> Profile
            </a>
          </li>
          <li class="nav-item dropdown mt-1 mb-1"><a class="dropdown-toggle nav-link link-dark ps-3"
              aria-expanded="false" data-bs-toggle="dropdown" href="#" style="color: var(--bs-black);"><svg
                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                class="bi bi-duffle-fill text-primary me-2 mb-1">
                <path
                  d="M5.007 4.097c.008-.097.016-.197.027-.298.05-.464.141-.979.313-1.45.169-.465.432-.933.853-1.249 1.115-.836 2.485-.836 3.6 0 .42.316.684.784.853 1.25.171.47.263.985.313 1.449.01.1.02.2.027.298 1.401.194 2.65.531 3.525 1.012 2.126 1.169 1.446 6.095 1.089 8.018a.954.954 0 0 1-.95.772H1.343a.954.954 0 0 1-.95-.772c-.357-1.923-1.037-6.85 1.09-8.018.873-.48 2.123-.818 3.524-1.012ZM4.05 5.633a21.876 21.876 0 0 0-1.565.352l-.091.026-.034.01a.5.5 0 0 0 .282.959l.005-.002.02-.005.08-.023a20.874 20.874 0 0 1 1.486-.334A20.942 20.942 0 0 1 8 6.25c1.439 0 2.781.183 3.767.367a20.854 20.854 0 0 1 1.567.356l.02.005.004.001a.5.5 0 0 0 .283-.959h-.003l-.006-.002-.025-.007a14.787 14.787 0 0 0-.43-.113 21.87 21.87 0 0 0-1.226-.265A21.939 21.939 0 0 0 8 5.25c-1.518 0-2.926.192-3.95.383M6.8 1.9c-.203.153-.377.42-.513.791a5.258 5.258 0 0 0-.265 1.292 34.54 34.54 0 0 1 1.374-.076c.866-.022 1.742.003 2.584.076a5.258 5.258 0 0 0-.266-1.292c-.135-.372-.309-.638-.513-.791-.76-.57-1.64-.57-2.4 0Z">
                </path>
              </svg>Appointments</a>

            <div class="dropdown-menu"><a class="dropdown-item link-dark"
                href="{{ route('registrant.appointments.book', ['user_id' => $user->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                  height="1em" fill="currentColor" viewBox="0 0 16 16"
                  class="bi bi-calendar-heart-fill text-primary me-2 mb-1">
                  <path
                    d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132">
                  </path>
                </svg>Create New Appointment...</a>

                
                 <a class="dropdown-item link-dark"
                href="{{ route('registrant.appointments.upcoming', ['user_id' => $user->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                  height="1em" fill="currentColor" viewBox="0 0 16 16"
                  class="bi bi-calendar2-week-fill text-primary me-2 mb-1">
                  <path
                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5m9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5M8.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM3 10.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z">
                  </path>
                </svg>View Upcoming</a>

                <a class="dropdown-item link-dark"
                href="{{ route('registrant.appointments.history', ['user_id' => $user->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                  height="1em" fill="currentColor" viewBox="0 0 16 16"
                  class="bi bi-calendar2-week-fill text-primary me-2 mb-1">
                  <path
                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5m9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5M8.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM3 10.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z">
                  </path>
                </svg>View History</a>              
              </div>
          </li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
        </ul>
      </div>
      <div>
        <hr>

       @php
          // Get the first initial of the user's first name
          $initial = strtoupper(substr($user->first_name, 0, 1));
       @endphp


        <div class="dropdown">
          <a class="dropdown-toggle link-body-emphasis d-flex align-items-center text-decoration-none"
   aria-expanded="false" data-bs-toggle="dropdown" role="button">
  <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2"
       style="width: 32px; height: 32px; font-size: 1rem;">
    {{ $initial }}
  </div>
  <strong>{{ $user->first_name }}</strong>&nbsp;
</a>

          <div class="dropdown-menu shadow" data-popper-placement="top-start"><a class="dropdown-item"
              href="{{ route('registrant.appointments.book', ['user_id' => $user->id]) }}">New Appointment...</a><a class="dropdown-item"
              href="{{ route('registrant.account.manage', ['user_id' => $user->id]) }}">Manage Account</a><a class="dropdown-item"
              href="{{ route('registrant.account.update-info', ['user_id' => $user->id]) }}">Update Profile Info</a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('registrant.logout') }}" method="post">
              @csrf
              <button type="submit" class="dropdown-item">Sign out</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>