@extends('layouts.default')
@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->

<link href="{{ asset(mix('css/grupos.min.css')) }}" rel="stylesheet">
<!-- /Header Personalizado [Modelo] -->
@endpush
@section('title', "Grupos - ")
@section('content')
	<!-- Conteudo Principal [Modelo] -->
	<main id="grupos">
		<div id="options" class="painel">
			<form id="search" method="GET" action="{{route('grupos')}}">
				<div class="form-content">
					<h2>Por Título:</h2>
					<div class="form-options">
						<input type="text" name="titulo" value="{{(isset($_GET['titulo']))? $_GET['titulo'] : ''}}">
					</div>
				</div>
				<div id="options-advanced" class="form-content">
					<div class="form-content">
						<h2>Por Letra:</h2>
						<div class="form-options">
							<input id="letra-todos" value="" type="radio" name="letra" checked>
							<label for="letra-todos">Todos</label>
							@for($i="A";$i != "AA";$i++)
							<input id="letra-{{$i}}" value="{{$i}}" type="radio" name="letra" {{(isset($_GET['letra']) and $_GET['letra'] == $i)?'checked': ''}}>
							<label for="letra-{{$i}}">{{$i}}</label>
							@endfor
						</div>
					</div>
					<div class="form-content">
						<h2>Por Ordem:</h2>
						<div class="form-options">
							<input id="classificacao-todos" value="" type="radio" name="classificacao" checked>
							<label for="classificacao-todos">Alfabetica</label>
							<input id="classificacao-vistos" value="1" type="radio" name="classificacao" {{(isset($_GET['classificacao']) and $_GET['classificacao'] == 1)?'checked': ''}}>
							<label for="classificacao-vistos">Mais Vistos</label>
							<input id="classificacao-novos" value="2" type="radio" name="classificacao" {{(isset($_GET['classificacao']) and $_GET['classificacao'] == 2)?'checked': ''}}>
							<label for="classificacao-novos">Mais Novos</label>
						</div>
					</div>
					<div class="form-content">
						<h2>Por Página:</h2>
						<div class="form-options">
							<input id="qntp-12" value="12" type="radio" name="qntp"  {{(!(isset($_GET['qntp'])) or isset($_GET['qntp']) and $_GET['qntp'] == 12)?'checked': ''}}>
							<label for="qntp-12">Padrão</label>
							<input id="qntp-24" value="24" type="radio" name="qntp" {{(isset($_GET['qntp']) and $_GET['qntp'] == 24)?'checked': ''}}>
							<label for="qntp-24">24</label>
							<input id="qntp-36" value="36" type="radio" name="qntp" {{(isset($_GET['qntp']) and $_GET['qntp'] == 36)?'checked': ''}}>
							<label for="qntp-36">36</label>
						</div>
					</div>
				</div>
				<div class="form-content controll">
						<input type="submit" value="Pesquisar">
						<input type="button" onclick="resetForm()" value="Limpar">
				</div>
			</form>
		</div>
		<div id="grupos" class="painel">
			<div id="result-grupos">
				<h2>Buscando Grupos <small> Exibindo {{(count($grupos) < $grupos->perPage() ) ? (count($grupos)) : ($grupos->perPage())}} de {{$grupos->total()}}</small></h2>
				<ul class="recomend-grupos">
					@foreach($grupos as $grupo)
					<li class="recomend-item">
						@component('components.grupo',['grupo' => $grupo]))
                        @endcomponent
					</li>
					@endforeach
				</ul>
				{{ $grupos->links() }}
			</div>
		</div>
	</main>
	<!-- /Conteudo Principal [Modelo] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Modelo] -->
<script type="text/javascript" src="{{asset(mix('js/grupos.min.js'))}}"></script>
<!-- /Footer Personalizado [Modelo] -->
@endpush