@extends('layouts.partials.client.meta')

    <div class="front-wrapper">
      @include('layouts.partials.client.nav')
      <!-- Page Content -->
      <div id="page-content-wrapper">
      	@include('layouts.partials.client.notification')
        @yield('content')
      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
      
