@extends('botsmanager::index')

@section('title', 'Логика #'.$item->id)

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item"><a href="/botsmanager/logics">Логика</a></li>
		<li class="breadcrumb-item active"><a href="/botsmanager/logics/{{ $item->id ? $item->id.'/edit':'add' }}">#{{ $item->id }}</a></li>
	</ol>

	<h1>Логика #{{ $item->id }}</h1>

	<form action="" method="POST" class="card">

		<div class="card">
			<div class="card-header">
				<input required name="name" class="form-control" value="{{ $item->name }}" placeholder="Название">
			</div>
			<div class="card-body">
			</div>
			<div class="card-footer">
				<button class="btn btn-primary">Сохранить</button>
			</div>
		</div>

	</form>

@stop