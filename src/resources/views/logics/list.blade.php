@extends('botsmanager::index')

@section('title', 'Логика')

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item active">
			<a href="/botsmanager/logics" class="dropdown-toggle">@yield('title')</a>
			<div class="drop collapse">
				<a href="/botsmanager/bots">Боты</a>
				<a href="/botsmanager/subscribers">Подписчики</a>
				<a href="/botsmanager/subscribermessages">Сообщения</a>
			</div>
		</li>
	</ol>

	<h1>
		<span>@yield('title')</span>
		<a class="btn btn-link" href="/botsmanager/logics/add">Добавить</a>
		<span class="collapse dropdown multiple-actions">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Выберите действие</button>
			<div class="dropdown-menu">
				<button type="button" class="dropdown-item text-danger" href="/botsmanager/logics/delete" data-ajax>Удалить</button>
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
					<th>Сообщений</th>
					<th style="text-align: right">
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
					<td>{{ $i->messages()->whereRaw('status is null')->count().' / '.$i->messages()->count() }}</td>
					<td align="right">
						<a class="btn btn-sm" href="/botsmanager/logics/{{ $i->id }}/edit">Изменить</a>
						<a class="btn btn-sm btn-secondary" href="/botsmanager/logics/{{ $i->id }}/run" data-ajax>Запустить</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@stop