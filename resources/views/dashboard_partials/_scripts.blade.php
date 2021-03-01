
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}" ></script>

<!-- DataTables -->
<script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


<!-- AdminLTE -->
<script src="{{asset('AdminLTE/dist/js/adminlte.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->


<script src="{{asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('AdminLTE/dist/js/demo.js')}}"></script>
<script src="{{asset('AdminLTE/dist/js/pages/dashboard3.js')}}"></script>

<script>
    window.auth = {!! auth()->user() !!}
</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCR5PFyvraK8Cqbu-vQu7UAR-NkcABHNuw"></script>

<script src="{{ asset('/js/app.js') }}" defer></script>
<script>
   var APP_URL = {!! json_encode(url('/').'/') !!}
   var APP_URL = {!! json_encode(url('/').'/') !!}
   window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
</script>
