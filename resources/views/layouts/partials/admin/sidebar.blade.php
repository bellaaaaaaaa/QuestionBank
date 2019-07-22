<div class="sidebar" data-color="blue" data-image="{{ asset('images/sidebar_bg.jpg') }}">

  <div class="logo">
		<a href="{{ route('dashboard') }}" class="simple-text logo-mini">
      TH
    </a>
    <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
      The Techy Hub
    </a>
  </div>

  <div class="sidebar-wrapper">
    <div class="user">
			<div class="info">
      <div class="photo">
        <img src="{{ avatar_picture_url(current_user()->avatar) }}" >
      </div>
			<a data-toggle="collapse" href="#collapseExample" class="collapsed">
				<span>{{ str_limit(current_user()->name, 20) }}</span>
      </a>
			</div>
    </div>

    <ul class="nav">
      <li class="nav-item {{ is_active('dashboard') }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fa fa-pie-chart"></i>
          <p>Dashboard</p>
        </a>
      </li>
			<li class="nav-item {{ is_active('teams') }}">
				<a class="nav-link" href="{{ route('teams.index') }}">
					<i class="fa fa-users"></i>
					<p>Teams</p>
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
          <i class="fa fa-pencil" aria-hidden="true"></i>
        <p>Topics</p>
      </a>
    </li>
      <li class="nav-item {{ is_active('questions') }}">
        <a class="nav-link" href="{{ route('questions.index') }}">
          <i class="fa fa-question" aria-hidden="true"></i>
        <p>Questions</p>
        </a>
      <li class="nav-item {{ is_active('guardians') }}">
        <a class="nav-link" href="{{ route('guardians.index') }}">
          <i class="fa fa-user-o" aria-hidden="true"></i>
        <p>Parents</p>
        </a>
			</li>
    </ul>
  </div>
</div>
