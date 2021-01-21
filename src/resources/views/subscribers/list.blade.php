@extends('botsmanager::index')

@section('title', 'Подписчики')

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item active">
			<a href="/botsmanager/subscribers" class="dropdown-toggle">Подписчики</a>
			<div class="drop collapse">
				<a href="/botsmanager/bots">Боты</a>
				<a href="/botsmanager/logics">Поведения</a>
				<a href="/botsmanager/subscribermessages">Сообщения</a>
			</div>
		</li>
	</ol>

	<h1>
		<span>Подписчики</span>
		<a class="btn btn-link" href="/botsmanager/subscribers/add">Добавить</a>
		<span class="collapse dropdown multiple-actions">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Выберите действие</button>
			<div class="dropdown-menu">
				<button type="button" class="dropdown-item text-danger" href="/botsmanager/subscribers/multiple/delete" data-ajax>Удалить</button>
			</div>
		</span>
	</h1>

	<div class="table-responsive">
		<table class="table table-inverse table-condensed">
			<thead>
				<tr>
					<th><input type="checkbox" data-checkall></th>
					<th>Id</th>
					<th>Название</th>
					<th>Платформа</th>
					<th>ID платформы</th>
					<th align="right">
						<button type="button" class="btn btn-sm" onclick="app.refreshList()">Refresh</button>
					</th>
				</tr>
			</thead>
			<tbody id="ajax-data">
				@foreach($list as $i)
				<tr>
					<td><input type="checkbox" data-check-id="{{ $i->id }}"></td>
					<td>{{ $i->id }}</td>
					<td>{{ $i->name }}</td>
					<td>{{ $i->platform_name }}</td>
					<td>{{ $i->platform_id }}</td>
					<td>
						<a class="dropdown-item" href="/botsmanager/subscribers/{{ $i->id }}/edit">Изменить</a>
						<a class="dropdown-item text-danger" href="/botsmanager/subscribers/{{ $i->id }}/delete">Удалить</a>
						<a class="dropdown-item" href="#form-send-{{ $i->id }}" data-toggle="collapse">Отправить</a>
						<form method="POST" action="/botsmanager/subscribers/{{ $i->id }}/sendmessage" id="form-send-{{ $i->id }}" class="collapse" data-ajax>
							<textarea name="message" rows="5" class="form-control"></textarea>
							<button class="btn btn-primary">Отправить</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@stop
