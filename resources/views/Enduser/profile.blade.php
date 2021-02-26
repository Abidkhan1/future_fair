@extends('Enduser.layouts.app')

@section('content')
  <user-profile :id="{{$id}}" csrf="{!! csrf_token() !!}"></user-profile>
@endsection
