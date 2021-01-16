@extends('botsmanager::index')

@section('title', 'Бот #'.$item->id)

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item active"><a href="/botsmanager/bots">Боты</a></li>
		<li class="breadcrumb-item active"><a href="/botsmanager/bots/{{ $item->id ? $item->id.'/edit':'add' }}">#{{ $item->id }}</a></li>
	</ol>

	<h1>Бот #{{ $item->id }}</h1>

	<form action="" method="POST" class="card">

		<div class="card">
			<div class="card-header">
				<input required name="name" class="form-control" value="{{ $item->name }}" placeholder="Название">
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">logic id</div>
					<div class="col-10">
						<input type="text" name="logic_id" value="{{ $item->logic_id }}">
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary">Сохранить</button>
			</div>
		</div>

	</form>

@stop