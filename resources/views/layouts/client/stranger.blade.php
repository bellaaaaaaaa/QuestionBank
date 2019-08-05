@extends('layouts.partials.client.meta')

    <div class="front-wrapper">

      <!-- Page Content -->
      <div id="page-content-wrapper">

      @include('layouts.partials.admin.notification')
        @yield('content')

      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->