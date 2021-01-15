<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'BotsManager')</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>

<body>

	<div class="body-wrapper">

		@yield('content')

	</div>

</body>
</html>
