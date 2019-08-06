@extends('layouts.partials.client.meta')

@section('master')
  <div class="front-wrapper">
    @include('layouts.partials.client.nav')
    <div id="page-content-wrapper">
      @include('layouts.partials.client.notification')
      @yield('content')
    </div>
  </div>
@endsection      