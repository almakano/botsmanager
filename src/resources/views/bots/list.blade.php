@extends('botsmanager::index')

@section('title', 'Боты')

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item active"><a href="/botsmanager/bots">Боты</a></li>
	</ol>

	<h1>Боты <a class="btn btn-link" href="/botsmanager/bots/add">Добавить</a></h1>

	<div class="row">
		@foreach($list as $i)
		<div class="col-3">
			<div class="card">
				<div class="card">
					<div class="card-header">
						<span class="name">{{ $i->name }}</span>
						<span class="float-right">{{ $i->logic->name }}</span>
					</div>
					<div class="card-body"></div>
					<div class="card-footer">
						<a class="btn btn-sm" href="/botsmanager/subscribers?bot_id={{ $i->id }}">Подписчики ({{ $i->subscribers()->count() }})</a>
						<a class="btn btn-sm" href="/botsmanager/bots/{{ $i->id }}/edit">Изменить</a>
						<a class="btn btn-sm btn-danger" href="/botsmanager/bots/{{ $i->id }}/delete">Удалить</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

@stop