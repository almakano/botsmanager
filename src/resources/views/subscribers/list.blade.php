@extends('botsmanager::index')

@section('title', 'Подписчики')

@section('content')

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
			<li class="breadcrumb-item active"><a href="/botsmanager/subscribers">Подписчики</a></li>
		</ol>
	</nav>

	<h1>Подписчики <a class="btn btn-link" href="/botsmanager/subscribers/add">Добавить</a></h1>

	<div class="row">
		@foreach($list as $i)
		<div class="col-3">
			<div class="card">
				<div class="card">
					<div class="card-header">
						<span class="name">{{ $i->name }}</span>
						<span class="float-right">
							<span class="platform_name">{{ $i->platform_name }}</span>
							<span class="platform_id">{{ $i->platform_id }}</span>
						</span>
					</div>
					<div class="card-body"></div>
					<div class="card-footer">
						<a class="btn btn-sm" href="/botsmanager/subscribers/{{ $i->id }}/edit">Изменить</a>
						<a class="btn btn-sm btn-danger" href="/botsmanager/subscribers/{{ $i->id }}/delete">Удалить</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

@stop