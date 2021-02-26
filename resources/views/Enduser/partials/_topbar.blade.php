<header>
        <div class="header">
            <div class="auto_container">
                <div class="header_main">
                    <div class="header_left">
                        <div class="menu_btn">
                            <a href="javascript:void(0);"><img src="{{asset('future_html/images/menu-icon.png')}}" alt="menu"></a>
                        </div>
                        <div class="logo">

                            <a href="{{route('home')}}">
                                <!-- Virtual Expo test -->
                                <img src="{{asset('future_html/images/futerLogo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="header_right">
                        <div class="logout">
                            <a href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                            <!-- <a href="login.html">Logout</a> -->
                        </div>
                    </div>
                </div>
              <!-- Sidebar -->
              @include('Enduser.partials._sidebar')
              <!-- Sidebar -->
            </div>
        </div>
    </header>
