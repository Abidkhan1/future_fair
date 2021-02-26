@extends('layouts.app')

@section('outer_style')

<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<!-- Styles -->
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">

<style>
html {
    overflow: scroll;
}
</style>
@endsection

@section('content')
<!-- <h3>Hello</h3> -->
    <private-chat-component :auth="{{ auth()->user() }}"></private-chat-component>
@endsection
