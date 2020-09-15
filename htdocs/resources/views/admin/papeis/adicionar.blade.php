@extends('layouts.admin.app')

@section('content')
<div class="container">
	<h2 class="center">Adicionar Papel</h2>

	@include('admin._breadcrumb')

	<div class="row">
		<form action="{{ route('papeis.store') }}" method="post">

		{{csrf_field()}}
		@include('admin.papeis.formulario')

		<button class="btn green">Adicionar</button>


		</form>

	</div>

</div>


@endsection
