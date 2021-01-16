@extends('botsmanager::index')

@section('title', 'Логика')

@section('content')

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/botsmanager">Ботменеджер</a></li>
		<li class="breadcrumb-item active"><a href="/botsmanager/logics">Логика</a></li>
	</ol>

	<h1>Логика <a class="btn btn-link" href="/botsmanager/logics/add">Добавить</a></h1>

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
						<a class="btn" href="/botsmanager/logics/{{ $i->id }}/edit">Изменить</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

@stop