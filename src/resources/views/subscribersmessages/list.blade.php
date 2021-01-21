@extends('botsmanager::index')

@section('title', 'Сообщения')

@section('content')

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
			<li class="breadcrumb-item active"><a href="/botsmanager/subscribermessages">Подписчики</a></li>
		</ol>
	</nav>

	<h1>
		<span>@yield('title')</span>
		<a class="btn btn-link" href="/botsmanager/subscribermessages/add">Добавить</a>
		<span class="collapse multiple-actions">
			<span class="dropdown">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Выберите действие</button>
				<div class="dropdown-menu">
					<button type="button" class="dropdown-item text-danger" href="/botsmanager/subscribermessages/delete" data-ajax>Удалить</button>
				</div>
			</span>
		</span>
	</h1>

	<div class="table-responsive">
		<table class="table table-inverse table-condensed">
			<thead>
				<tr>
					<th><input type="checkbox" data-checkall></th>
					<th>Id</th>
					<th>Подписчик</th>
					<th>Статус</th>
					<th>Формат</th>
					<th>Текст</th>
					<th>Дата</th>
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
					<td>{{ $i->subscriber->name }}</td>
					<td>{{ $i->status }}</td>
					<td>{{ $i->format }}</td>
					<td>{{ $i->text }}</td>
					<td>{{ $i->created_at }}</td>
					<td align="right">
						<a class="btn btn-sm" href="/botsmanager/subscribermessages/{{ $i->id }}/edit">Изменить</a>
						<a class="btn btn-sm btn-danger" href="/botsmanager/subscribermessages/{{ $i->id }}/delete">Удалить</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@stop