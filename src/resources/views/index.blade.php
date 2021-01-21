<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'BotsManager')</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{ assets_cached('/vendor/botsmanager/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ assets_cached('/vendor/botsmanager/select2.min.css') }}">
	<link rel="stylesheet" href="{{ assets_cached('/vendor/botsmanager/template.css') }}">
</head>

<body>

	<div class="body-wrapper">
		<div class="container-fluid">

			@yield('content')

		</div>
		<div class="alerts"></div>
	</div>

	<script src="{{ assets_cached('/vendor/botsmanager/jquery.min.js') }}"></script>
	<script src="{{ assets_cached('/vendor/botsmanager/popper.min.js') }}"></script>
	<script src="{{ assets_cached('/vendor/botsmanager/bootstrap.min.js') }}"></script>
	<script src="{{ assets_cached('/vendor/botsmanager/select2.min.js') }}"></script>
	<script src="{{ assets_cached('/vendor/botsmanager/template.js') }}"></script>
	@yield('scripts')

</body>
</html>
