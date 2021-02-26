@extends('Enduser.layouts.app')

@section('content')
  <reception :company_id="{{$company_id}}" :event_id="{{$event_id}}"></reception>
@endsection
