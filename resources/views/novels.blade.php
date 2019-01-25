@extends('layouts.default')
@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->

<link href="{{ asset(mix('css/novels.min.css')) }}" rel="stylesheet">
<!-- /Header Personalizado [Modelo] -->
@endpush
@section('title', "Novels - ")
@section('content')
	<!-- Conteudo Principal [Modelo] -->
	<main id="novels">
		<div id="options" class="painel">
			<form id="search" method="GET" action="{{route('novels')}}">
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
						<h2>Por Gênero:</h2>
						<div class="form-options">
							<input id="genero-todos" value="" type="radio" name="genero" checked>
							<label for="genero-todos">Todos</label>
							@foreach($generos as $genero)
							<input id="genero-{{$genero->nome}}" value="{{$genero->id}}" type="radio" name="genero" {{(isset($_GET['genero']) and $_GET['genero'] == $genero->id )?'checked': ''}}>
							<label for="genero-{{$genero->nome}}">{{$genero->nome}}</label>
							@endforeach
						</div>
					</div>
					<div class="form-content">
						<h2>Por Lingua Original:</h2>
						<div class="form-options">
							<input id="linguagem-todos" value="" type="radio" name="linguagem" checked>
							<label for="linguagem-todos">Todos</label>
							@foreach($linguagens as $linguagem)
							<input id="linguagem-{{$linguagem->nome}}" value="{{$linguagem->id}}" type="radio" name="linguagem" {{(isset($_GET['linguagem']) and $_GET['linguagem'] == $linguagem->id )?'checked': ''}}>
							<label for="linguagem-{{$linguagem->nome}}">{{$linguagem->nome}}</label>
							@endforeach
						</div>
					</div>
					<div class="form-content">
						<h2>Por Tipos:</h2>
						<div class="form-options">
							<input id="tipo-todos" value="" type="radio" name="tipo" checked>
							<label for="tipo-todos">Todos</label>
							@foreach($tipos as $tipo)
							<input id="tipo-{{$tipo->nome}}" value="{{$tipo->id}}" type="radio" name="tipo" {{(isset($_GET['tipo']) and $_GET['tipo'] == $tipo->id )?'checked': ''}}>
							<label for="tipo-{{$tipo->nome}}">{{$tipo->nome}}</label>
							@endforeach
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
		<div id="novels" class="painel">
			<div id="result-novels">
				<h2>Buscando Novels <small> Exibindo {{(count($novels) < $novels->perPage() ) ? (count($novels)) : ($novels->perPage())}} de {{$novels->total()}}</small></h2>
				<ul class="recomend-novels">
					@foreach($novels as $novel)
					<li class="recomend-item">
						<div class="card-novel">
							<a href="{{route("novel",$novel->url)}}">
								@if(Storage::disk('gcs')->exists($novel->capa))
									<img src="{{ Storage::disk('gcs')->url($novel->capa) }}" alt="{{$novel->titulo}}">
								@else        
									<img src="{{ Storage::disk('gcs')->url('novels/default.jpg')}}" alt="Novel sem capa">
								@endif
								<h2>{{$novel->titulo}}</h2>
							</a>
							@if($novel->genero->count() >0)
							<a href="{{route('novels')}}?genero={{$novel->genero->shuffle()->first()->id}}">
								<span class="tag">{{$novel->genero->shuffle()->first()->nome}}</span>
							</a>
							@endif
							<div id="rating">
								<fieldset class="rating">
										<input type="radio" id="star5-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="5" {{($novel->avgRating >= 5.0)?'checked':''}}/>
										<label class = "full" title="Impressionante - 5 stars"></label>
										<input type="radio" id="star4half-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="4 and a half" {{($novel->avgRating >=4.5 and $novel->avgRating < 5)?'checked':''}}/>
										<label class="half" title="Muito bom - 4.5 stars"></label>
										<input type="radio" id="star4-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="4" {{($novel->avgRating >=4.0 and $novel->avgRating < 4.5)?'checked':''}}/>
										<label class = "full" title="Muito bom - 4 stars"></label>
										<input type="radio" id="star3half-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="3 and a half" {{($novel->avgRating >=3.5 and $novel->avgRating < 4)?'checked':''}}/>
										<label class="half" title="Um pouco bom - 3.5 stars"></label>
										<input type="radio" id="star3-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="3" {{($novel->avgRating >=3.0 and $novel->avgRating < 3.5)?'checked':''}}/>
										<label class = "full" title="Razoável - 3 stars"></label>
										<input type="radio" id="star2half-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="2 and a half" {{($novel->avgRating >=2.5 and $novel->avgRating < 3)?'checked':''}}/>
										<label class="half" title="Um pouco ruim - 2.5 stars"></label>
										<input type="radio" id="star2-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="2" {{($novel->avgRating >=2.0 and $novel->avgRating < 2.5)?'checked':''}}/>
										<label class = "full"  title="Um pouco ruim - 2 stars"></label>
										<input type="radio" id="star1half-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="1 and a half" {{($novel->avgRating >=1.5 and $novel->avgRating < 2)?'checked':''}}/>
										<label class="half"  title="Muito ruim - 1.5 stars"></label>
										<input type="radio" id="star1-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="1" {{($novel->avgRating >=1.0 and $novel->avgRating < 1.5)?'checked':''}}/>
										<label class = "full" title="Muito ruim - 1 star"></label>
										<input type="radio" id="starhalf-novel-{{$novel->id}}" name="rating-novel-{{$novel->id}}" value="half" {{($novel->avgRating >=0.5 and $novel->avgRating < 1)?'checked':''}}/>
										<label class="half" title="Pessimo - 0.5 stars"></label>
									</fieldset>
								<span class="rating-value">{{number_format($novel->avgRating, 1, '.', ',')}}</span>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
				{{ $novels->links() }}
			</div>
		</div>
	</main>
	<!-- /Conteudo Principal [Modelo] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Modelo] -->
<script type="text/javascript" src="{{asset(mix('js/novels.min.js'))}}"></script>

<!-- /Footer Personalizado [Modelo] -->
@endpush