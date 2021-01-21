@extends('botsmanager::index')

@section('title', 'Боты')

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item active">
			<a href="/botsmanager/bots" class="dropdown-toggle">Боты</a>
			<div class="drop collapse">
				<a href="/botsmanager/subscribers">Подписчики</a>
				<a href="/botsmanager/logics">Поведения</a>
				<a href="/botsmanager/subscribermessages">Сообщения</a>
			</div>
		</li>
	</ol>

	<h1>
		<span>Боты</span>
		<a class="btn btn-link" href="/botsmanager/bots/add">Добавить</a>
		<span class="collapse dropdown multiple-actions">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Выберите действие</button>
			<div class="dropdown-menu">
				<form action="/botsmanager/bots/multiple/delete" method="POST" data-ajax class="form-multiple">
					<input type="hidden" name="id">
					<button type="button" class="dropdown-item text-danger">Удалить</button>
				</form>
			</div>
		</span>
	</h1>

	<form action="" id="form-filter" style="display: none">
		<input type="hidden" name="sort" value="{{ $sort }}">
		<button></button>
	</form>

	<div class="table-responsive">
		<table class="table table-inverse">
			<thead>
				<tr>
					<th style="width: 30px">
						<input type="checkbox" data-checkall>
					</th>
					<th style="width: 100px">
						@if($sort == 1 && $sort != 0) <a href="?">Id &uarr;</a>
						@elseif($sort == 0 && $sort != 1) <a href="?sort=1">Id &darr;</a>
						@else <a href="?">Id</a>
						@endif
						<input type="text" name="id" class="form-control form-control-sm" form="form-filter" value="{{ \Request::input('id') }}">
					</th>
					<th>
						@if($sort == 3 && $sort != 2) <a href="?sort=2">Название &uarr;</a>
						@elseif($sort == 2 && $sort != 3) <a href="?sort=3">Название &darr;</a>
						@else <a href="?sort=2">Название</a>
						@endif
						<input type="text" name="name" class="form-control form-control-sm" form="form-filter" value="{{ \Request::input('name') }}">
					</th>
					<th>
						@if($sort == 5 && $sort != 4) <a href="?sort=4">Логика &uarr;</a>
						@elseif($sort == 4 && $sort != 5) <a href="?sort=5">Логика &darr;</a>
						@else <a href="?sort=4">Логика</a>
						@endif
						<input type="text" name="logic" class="form-control form-control-sm" form="form-filter" value="{{ \Request::input('logic') }}">
					</th>
					<th style="width: 50px">Подписчики<br></th>
					<th style="width: 300px; text-align: right"><br>Действия
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
					<td>
						<a href="/botsmanager/logics/{{ $i->logic_id }}/edit">{{ $i->logic->name }}</a>
					</td>
					<td><a class="btn btn-sm badge badge-secondary" href="/botsmanager/subscribers?bot_id={{ $i->id }}">{{ $i->subscribers()->count() }}</a></td>
					<td align="right">
						<a class="btn btn-sm" href="/botsmanager/bots/{{ $i->id }}/edit">Изменить</a>
						<a class="btn btn-sm btn-danger" href="/botsmanager/bots/{{ $i->id }}/delete">Удалить</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@stop
