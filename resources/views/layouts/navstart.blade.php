<header>
  <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarCollapse">

      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/home') }}">Start</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link " href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">Active</a>
        </li> -->
        <li class="nav-item dropdown">
          @guest
            <a href="{{ route('login') }}">{{ __('login') }}</a>
          @else
            <a class="nav-link dropdown-toggle" href="#" id="dropdownSettings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
            <div class="dropdown-menu" aria-labelledby="dropdownSettings">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          @endguest
        </li>
      </ul>

    </div>
  </nav>
</header>
