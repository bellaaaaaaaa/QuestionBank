<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/client.css') }}" rel="stylesheet">

  </head>
  <body>

    <div class="front-wrapper">

      <!-- Sidebar -->
      <div class="border-right" id="sidebar-wrapper">
        <div class="sidebar-heading"><img src="{{ asset('images/user-default.jpg') }}"><span>John Doe</span></div>
        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
          <a class="list-group-item list-group-item-action dropdown-btn">Learning Materials</a>
          <div class="dropdown-container">
            <a href="#">Chapter 1</a>
            <a href="#">Chapter 2</a>
            <a href="#">Chapter 3</a>
          </div>
          <a href="#" class="list-group-item list-group-item-action">Quiz</a>
          <a href="#" class="list-group-item list-group-item-action">Articles</a>
          <a href="#" class="list-group-item list-group-item-action">MCQ Exam</a>
          <a href="#" class="list-group-item list-group-item-action">Subjective Exam</a>
        </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <nav class="navbar navbar-expand-lg navbar-dark front-navbar">
        <a class="navbar-brand" href="#"><img src="{{ asset('images/user-default.jpg') }}"><span>John Doe</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Learning Materials
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Chapter 1</a>
                <a class="dropdown-item" href="#">Chapter 2</a>
                <a class="dropdown-item" href="#">Chapter 3</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Quiz</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Articles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">MCQ Exam</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Subjective Exam</a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Page Content -->
      <div id="page-content-wrapper">

        @yield('content')

      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scripts -->
    <script src="{{ asset('js/client.js') }}"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>   
  </body>
</html>
