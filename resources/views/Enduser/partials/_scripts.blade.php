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

<script src="{{ asset('/js/app.js') }}" defer></script>
<script>
   var APP_URL = {!! json_encode(url('/').'/') !!}
</script>
<script>
    window.auth = {!! auth()->user() !!}
</script>
<script>
  var USER_ID = {!! auth()->user() !!}
</script>
