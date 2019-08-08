<!-- Sidebar -->
<div class="border-right" id="sidebar-wrapper">
  <div class="sidebar-heading d-flex"><img src="{{ asset('images/user-default.jpg') }}"><span class="align-self-center">John Doe</span></div>
  <div class="list-group list-group-flush">
    <a href="/home" class="list-group-item list-group-item-action {{ is_active('home') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>

    <a href="{{ route('trials.questions') }}" class="list-group-item list-group-item-action {{ is_active('trials') }}"><i class="fas fa-bars"></i> Trial</a>

    <a href="{{ route('quizzes.topics') }}" class="list-group-item list-group-item-action {{ is_active('quizzes') }}"><i class="fas fa-question-circle"></i> Quiz</a>
    
    <a href="/mcq-exam" class="list-group-item list-group-item-action {{ is_active('mcq-exam') }}"><i class="fas fa-clipboard-list"></i> MCQ Exam</a>
    
    <a href="{{ route('client.logout') }}" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i> Log out</a>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark front-navbar">
  <a class="navbar-brand" href="#"><img src="{{ asset('images/user-default.jpg') }}"><span>John Doe</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ is_active('home') }}">
        <a class="nav-link" href="/home"><i class="fas fa-chart-pie"></i> Dashboard</a>
      </li>

      <li class="nav-item {{ is_active('trials') }}">
        <a class="nav-link" href="{{ route('trials.questions') }}"><i class="fas fa-bars"></i> Trial</a>
      </li>

      <li class="nav-item  {{ is_active('quizzes') }}">
        <a class="nav-link" href="{{ route('quizzes.topics') }}"><i class="fas fa-question-circle"></i> Quiz</a>
      </li>
      
      <li class="nav-item {{ is_active('mcq-exam') }}">
        <a class="nav-link" href="/mcq-exam"><i class="fas fa-clipboard-list"></i> MCQ Exam</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="{{ route('client.logout') }}"><i class="fas fa-sign-out-alt"></i> Log out</a>
      </li>
    </ul>
  </div>
</nav>

