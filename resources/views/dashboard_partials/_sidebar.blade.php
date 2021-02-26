<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Virtual Expo</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('AdminLTE/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
      @if(Auth::user()->hasRole('admin'))

       <li class="nav-item">
         <a href="{{ url('/home') }}" class="nav-link">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>Dashboard</p>
         </a>
       </li>

        <li class="nav-item">
          <a href="{{ route('companies.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Companies Managment
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('events.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Events Managment
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pavillions.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Pavillions Managment
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('user_dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              End-user Settings
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('create_notification')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Notifications
            </p>
          </a>
        </li>

        @elseif(Auth::user()->hasRole('company'))
        <li class="nav-item has-treeview">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Profile
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('company_profile.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Company Details</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('comp_banner_poster') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Banner, Logo, and Poster</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('design')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Design</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('comp_documents')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Documents</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('gallery.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Gallery</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('comp_videos')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Videos</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('company_events') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Events
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('staff.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Staff Managment
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('offer.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Offers Managment
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('visitor.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Visitors Managment
            </p>
          </a>
        </li>
         <li class="nav-item">
          <a href="{{ route('chat') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Chat & Video Call
            </p>
          </a>
        </li>
        <!--<li class="nav-item">
          <a href="{{ route('video_chat') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Video Chat
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('company_video') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Test Video Call
            </p>
          </a>
        </li> -->

        @elseif(Auth::user()->hasRole('staff'))
        <li class="nav-item">
          <a href="{{ route('chat') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Chat & Video Call
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ route('video_chat') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Video Chat
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('staff_video_chat') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Test Video Call
            </p>
          </a>
        </li> -->
        @else
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              No role
            </p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
