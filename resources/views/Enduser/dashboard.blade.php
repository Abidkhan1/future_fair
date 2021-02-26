@extends('Enduser.layouts.app')

@section('content')
  <enduser-dashboard csrf="{!! csrf_token() !!}" :events="{{$events}}"></enduser-dashboard>
@endsection
