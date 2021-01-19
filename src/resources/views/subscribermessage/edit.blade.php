@extends('botsmanager::index')

@section('title', 'Подписчик #'.$item->id.' '.$item->name)

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item"><a href="/botsmanager/subscribers">Подписчики</a></li>
		<li class="breadcrumb-item active"><a href="/botsmanager/subscribers/{{ $item->id ? $item->id.'/edit':'add' }}">#{{ $item->id }}</a></li>
	</ol>

	<h1>@yield('title')</h1>

	<form action="" method="POST" class="card">

		{{ csrf_field() }}

		<div class="card">
			<div class="card-header">
				<input required name="name" class="form-control" value="{{ $item->name }}" placeholder="Название">
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">Bot</div>
					<div class="col-10">
						<select name="bot_id" data-ajax--url="/botsmanager/bots/autocomplete">
							@if($item->bot_id)
							<option value="{{ $item->bot_id }}" selected>{{ $item->bot->name }}</option>
							@endif
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-2">Platform</div>
					<div class="col-10">
						<input type="text" name="platform_name" value="{{ $item->platform_name }}" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-2">Platform Id</div>
					<div class="col-10">
						<input type="text" name="platform_id" value="{{ $item->platform_id }}" class="form-control">
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary">Сохранить</button>
			</div>
		</div>

	</form>

@stop