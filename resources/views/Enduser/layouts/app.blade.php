<!doctype html>
<html lang="en-US">
<head>
    @include('Enduser.partials._header')
    @yield('outer_style')
</head>

<body>
    <div class="wrapper">
        @include('Enduser.partials._topbar')
        <div id="app" v-cloak  style="background-color:#f4f6f9;">
          <main>
              @yield('content')
          </main>
        </div>
        @include('Enduser.partials._footer')
    </div>
      @include('Enduser.partials._scripts')
      @yield('outer_script')
  </body>
</html>
