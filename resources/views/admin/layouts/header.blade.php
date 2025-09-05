  <!-- Main Header -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <ul class="navbar-nav ml-auto">

          <li class="nav-item dropdown user-menu">

              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <img src="{{ URL::to('/') }}/AdminLTELogo.png" class="user-image img-circle elevation-2"
                      alt="User Image">
                  <span class="d-none d-md-inline">{{ Auth::user()->name }} </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <!-- User image -->
                  <li class="user-header bg-primary">
                      <img src="{{ URL::to('/') }}/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
                      <p>
                          {{ Auth::user()->name }} -- {{ Auth::user()->id }}
                          <!--    <small>Member since {{ Auth::user()->created_at }}</small>-->
                      </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                      <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Profile</a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      @if (Auth::user()->colour == 1)
                      <a onclick="bgfavorites(this,2)" class="btn btn-danger"><i class="fa fa-moon"></i></a>
                      @else
                      <a onclick="bgfavorites(this,1)" class="btn btn-success"><i class="fas fa-moon"></i></a>
                      @endif
                      <a href="#" class="btn btn-default btn-flat float-right"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          Sign out
                      </a>
                      <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </li>
              </ul>
          </li>
      </ul>
  </nav>