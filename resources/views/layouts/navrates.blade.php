<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/home') }}">
          <span style="font-size: 20px; color: #FFF; cursor: pointer;"><i class="fas fa-home"></i></span>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/ratesdashboard') }}">
          <span style="font-size: 20px; color: #FFF; cursor: pointer;" ><i class="fas fa-calendar-times"></i></span>Calendar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/ratecalculator') }}">
          <span style="font-size: 20px; color: #FFF; cursor: pointer;"><i class="fas fa-calculator"></i></span>Calculator</a>
        </li>

        <li class="nav-item dropdown">
          @guest
            <a href="{{ route('login') }}"><i class="fas fa-user-circle">{{ __('login') }}</i></a>
          @else
            <span style="font-size: 30px; color: #FFF; cursor: pointer;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i></span>
            <div class="dropdown-menu" >
              <a class="dropdown-item" href="#"><span style="font-size: 14px; padding-right: 10px; text-align: center;"><i class="far fa-user"></i></span>{{ Auth::user()->name }}</a>
              <a class="dropdown-item" href="#"><span style="font-size: 14px; padding-right: 10px; text-align: center;"><i class="fas fa-cog"></i></span>Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span style="font-size: 14px; padding-right: 10px; text-align: center;"<i class="fas fa-sign-out-alt"></i></span>{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          @endguest
        </li>
      </ul>
  </nav>
</header>
