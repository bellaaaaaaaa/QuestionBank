<div class="sidebar">
  <div class="logo">
		<a href="{{ route('admin.dashboard') }}" class="simple-text logo-mini">
      QB
    </a>
    <a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">
      Question Bank
    </a>
  </div>

  <div class="sidebar-wrapper">
    <div class="logo">
      <a href="{{ route('admin.dashboard') }}" class="simple-text logo-mini">
        TH
      </a>
      <a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">
        The Techy Hub
      </a>
    </div>

    <div class="user">
			<div class="info">
        <div class="photo">
          <img src="{{ avatar_picture_url(current_user()->avatar) }}" >
        </div>
        <a href="{{ route('admin.account.show') }}">
        <span>{{ str_limit(current_user()->name, 20) }}</span>
      </a>
      </div>
		</div>

    <ul class="nav">
      <li class="nav-item {{ is_active('admin.dashboard') }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-chart-pie" aria-hidden="true"></i>
          <p>Dashboard</p>
        </a>
      </li>

      <li class="nav-item {{ is_active('subjects') }}">
        <a class="nav-link" href="{{ route('subjects.index') }}">
          <i class="fa fa-book" aria-hidden="true"></i>
          <p>Subjects</p>
        </a>
      </li>

      <li class="nav-item {{ is_active('topics') }}">
        <a class="nav-link" href="{{ route('topics.index') }}">
          <i class="fa fa-pencil-alt" aria-hidden="true"></i>
          <p>Topics</p>
        </a>
      </li>

      <li class="nav-item {{ is_active('questions') }}">
        <a class="nav-link" href="{{ route('questions.index') }}">
          <i class="fa fa-question" aria-hidden="true"></i>
          <p>Questions</p>
        </a>
      </li>

      <li class="nav-item {{ is_active('guardians') }}">
        <a class="nav-link" href="{{ route('guardians.index') }}">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
          <p>Parents</p>
        </a>
      </li>

      <li class="nav-item {{ is_active('students') }}">
        <a class="nav-link" href="{{ route('students.index') }}">
          <i class="fas fa-graduation-cap" aria-hidden="true"></i>
          <p>Students</p>
        </a>
      </li>
    </ul>
  </div>
</div>