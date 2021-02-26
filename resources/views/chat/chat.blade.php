@extends('layouts.app')

@section('outer_style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    window.auth = {!! auth()->user() !!}
</script>

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
<private-chat-component :auth="{{ auth()->user() }}"></private-chat-component>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 grid-margin">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      <div class="row">
                        <private-chat-component :auth="{{ auth()->user() }}"></private-chat-component>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
    <!-- <chat-component :user="{{ auth()->user() }}"></chat-component> -->

@endsection
