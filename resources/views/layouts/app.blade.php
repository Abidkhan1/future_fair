<!DOCTYPE html>
<html lang="en">
<head>
  @include('dashboard_partials._header')
  @yield('outer_style')
</head>
<body class="hold-transition sidebar-mini">
  <!-- <div id="app"> -->
   <div class="wrapper">
    @include('dashboard_partials._topbar')
    @include('dashboard_partials._sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid" >
        <div id="app">
          <main class="py-4" v-cloak  style="background-color:#f4f6f9;">
            @yield('content')
          </main>
        </div>
      </div>
    </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  @include('dashboard_partials._footer')
 </div>
<!-- </div> -->
<!-- vue app -->

@include('dashboard_partials._scripts')
@yield('outer_script')
</body>
</html>
