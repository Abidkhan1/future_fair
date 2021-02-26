@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      <div class="row">
                        <comp-banner-poster csrf="{!! csrf_token() !!}" :id="{{$id}}">
                        </comp-banner-poster>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
