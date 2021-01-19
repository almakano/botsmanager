@extends('botsmanager::index')

@section('title', 'Подписчики')

@section('content')

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
			<li class="breadcrumb-item active"><a href="/botsmanager/subscribermessages">Подписчики</a></li>
		</ol>
	</nav>

	<h1>Подписчики <a class="btn btn-link" href="/botsmanager/subscribers/add">Добавить</a></h1>

	<div class="table-responsive">
		<table class="table table-inverse">
			<thead>
				<tr>
					<th>Id</th>
					<th>Подписчик</th>
					<th>Статус</th>
					<th>Формат</th>
					<th>Текст</th>
					<th>Дата</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($list as $i)
				<tr>
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