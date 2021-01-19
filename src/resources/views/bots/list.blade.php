@extends('botsmanager::index')

@section('title', 'Боты')

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item active"><a href="/botsmanager/bots">Боты</a></li>
	</ol>

	<h1>Боты <a class="btn btn-link" href="/botsmanager/bots/add">Добавить</a></h1>

	<form action="" id="form-filter" style="display: none">
		<input type="hidden" name="sort" value="{{ $sort }}">
		<button></button>
	</form>

	<div class="table-responsive">
		<table class="table table-inverse">
			<thead>
				<tr>
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
					<th style="width: 300px; text-align: right"><br>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach($list as $i)
				<tr>
					<td>{{ $i->id }}</td>
					<td>{{ $i->name }}</td>
					<td>{{ $i->logic->name }}</td>
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