@extends('botsmanager::index')

@section('title', 'Логика #{{ $item->id }}')

@section('content')

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/botsmanager/logic">Логика</a></li>
			<li class="breadcrumb-item"><a href="/botsmanager/logic/{{ $item->id }}">#{{ $item->id }}</a></li>
		</ol>
	</nav>

	<h1>Логика #{{ $item->id }}</h1>

	<form action="" method="POST" class="card">

		<div class="card">
			<div class="card-header">
				<input required name="name" class="form-control" value="{{ $item->name }}">
			</div>
			<div class="card-body">
			</div>
			<div class="card-footer">
				<button class="btn btn-primary">Сохранить</button>
			</div>
		</div>

	</form>

@stop