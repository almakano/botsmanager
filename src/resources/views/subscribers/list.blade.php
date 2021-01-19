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
						<span class="float-right">
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">Menu</button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="/botsmanager/subscribers/{{ $i->id }}/edit">Изменить</a>
									<a class="dropdown-item text-danger" href="/botsmanager/subscribers/{{ $i->id }}/delete">Удалить</a>
									<a class="dropdown-item" href="#form-send-{{ $i->id }}" data-toggle="collapse">Отправить</a>
								</div>
							</div>
						</span>
						<form method="POST" action="/botsmanager/subscribers/{{ $i->id }}/sendmessage" id="form-send-{{ $i->id }}" class="collapse" data-ajax>
							<textarea name="message" rows="5" class="form-control"></textarea>
							<button class="btn btn-primary">Отправить</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

@stop