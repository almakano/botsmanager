@extends('botsmanager::index')

@section('title', 'Подписчик #'.$item->id)

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item"><a href="/botsmanager/subscribers">Подписчики</a></li>
		<li class="breadcrumb-item active"><a href="/botsmanager/subscribers/{{ $item->id ? $item->id.'/edit':'add' }}">#{{ $item->id }}</a></li>
	</ol>

	<h1>Подписчик #{{ $item->id.' '.$item->name }}</h1>

	<form action="" method="POST" class="card">

		<div class="card">
			<div class="card-header">
				<input required name="name" class="form-control" value="{{ $item->name }}" placeholder="Название">
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">platform name</div>
					<div class="col-10">
						<input type="text" name="platform_name" value="{{ $item->platform_name }}">
					</div>
				</div>
				<div class="row">
					<div class="col-2">platform id</div>
					<div class="col-10">
						<input type="text" name="platform_id" value="{{ $item->platform_id }}">
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary">Сохранить</button>
			</div>
		</div>

	</form>

@stop