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

		<div id="client-app">
			@yield('master')
		</div>

	  <!-- Scripts -->
		<script src="{{ asset('js/client.js') }}"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script> 
	  @yield('scripts')

	</body>
</html>
