@extends('botsmanager::index')

@section('title', 'Подписчики')

@section('content')

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/botsmanager/subscribers">Подписчики</a></li>
		</ol>
	</nav>

	<h1>Подписчики <a class="btn btn-link" href="/botsmanager/subscribers/add">Добавить</a></h1>

	<div class="row">
		@foreach($list as $i)
		<div class="col-3">
			<div class="card">
				<div class="card">
					<div class="card-header">
						<div class="name">{{ $i->name }}</div>
					</div>
					<div class="card-body"></div>
					<div class="card-footer">
						<a class="btn" href="/botsmanager/subscribers/{{ $i->id }}/edit">Изменить</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

@stop