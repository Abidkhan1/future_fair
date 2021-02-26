<!doctype html>
<html lang="en-US">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="format-detection" content="telephone=no">
  <title>Virtual Expo</title>
  <!-- bootstrap -->
  <!-- <link rel="stylesheet" href="{{asset('future_html/')}}"> -->
  <link rel="stylesheet" href="{{asset('future_html/css/bootstrap.min.css')}}">
  <!-- custom css -->
  <link rel="stylesheet " href="{{asset('future_html/css/style.css')}} ">
  <link rel="stylesheet " href="{{asset('future_html/css/responcive.css')}} ">

  <!-- slick slider -->
  <link rel=" stylesheet " type="text/css " href="{{asset('future_html/css/slick.css')}} ">
  <link rel="stylesheet " type="text/css " href="{{asset('future_html/css/slick-theme.css')}} ">
  <!-- animation -->
  <link rel="stylesheet" href="{{asset('future_html/css/animate_wow.css')}}" media="(prefers-reduced-motion: no-preference)">
  <!-- font awesome-->
  <link rel="stylesheet " href="{{asset('future_html/css/font-awesome.min.css')}} ">
  <!-- owl-carousal -->
  <link rel="stylesheet " href="{{asset('future_html/css/owl.carousel.min.css')}} ">


</head>

<body>
  <div class="wrapper">


    <!-- header start -->
    <header>
      <div class="header">
        <div class="auto_container">
          <div class="header_main">
            <div class="logo">
              <a href="index.html">Virtual Expo</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- header end -->


    <!-- main container start -->
    <main>
      <div class="main_container padding_top">


        <!-- banner secton start -->
        <div class="banner">
          <figure><img src="{{asset('future_html/images/home_final.jpg')}}" alt="banner"></figure>
          <div class="banner_content">
            <div class="auto_container">
              <div class="main_banner">
                <!-- <div class="top_logos">
                  <ul>
                    <li>
                      <a href="javascript:void(0);">
                        <img src="{{asset('future_html/images/future_fair.png')}}" alt="logo">
                      </a>
                    </li>
                    <li>
                      <a href="javascript:void(0);">
                        <img src="{{asset('future_html/images/steph_logo.png')}}" alt="logo">
                      </a>
                    </li>
                  </ul>
                </div> -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="custom_form">
                  <div class="custom_formMain">
                    <div class="form_data">
                      <ul>
                        <li>
                          <div class="form_content">
                            <title>Email:</title>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!-- <input type="text" name="" id=""> -->
                          </div>
                        </li>
                        <li>
                          <div class="form_content">
                            <title>Password:</title>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!-- <input type="text" name="" id=""> -->
                          </div>
                        </li>
                      </ul>
                    </div>

                    <div class="">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                      <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                      </label>
                    </div>

                    <div class="form_btn">
                      <ul>
                        <li>
                          <a class="my_btn" href="{{route('register')}}">Register</a>
                        </li>
                        <li>
                          <button type="submit" class="my_btn">Login</button>

                          <!-- <a class="my_btn" href="login.html">Login</a> -->
                        </li>
                      </ul>
                      <p class="mb-1">
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                      </p>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- banner secton end -->
      </div>
    </main>
    <!-- main container start -->
    <!-- footer -->
    <footer>
      <div class="footer_main">
        <div class="auto_container">

        </div>
      </div>
    </footer>


  </div>



  <script src="{{asset('future_html/js/jquery-3.4.1.min.js')}}"></script>
  <!-- animation -->
  <script src="{{asset('future_html/js/wow.js')}} "></script>
  <script src="{{asset('future_html/js/owl.carousel.js')}} "></script>
  <script src="{{asset('future_html/js/slick.js')}} " type="text/javascript " charset="utf-8 "></script>
  <!-- parallax -->
  <script src="{{asset('future_html/js/myscript.js')}}"></script>
  <!-- bootstrap -->
  <script src="{{asset('future_html/js/bootstrap.min.js')}}"></script>
  <!-- animation -->
  <script src="{{asset('future_html/js/wow.js')}} "></script>

</body>

</html>
