@extends('layouts.partials.client.meta')

@section('master')
  <div class="front-wrapper">

    <div id="page-content-wrapper">

    @include('layouts.partials.admin.notification')
      @yield('content')

    </div>
  </div>
@endsection