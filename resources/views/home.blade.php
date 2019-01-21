@extends('layouts.default')
@push('HeaderScripts')
<!-- Header Personalizado [Home] -->
<link href="{{ asset(mix('css/home.min.css')) }}" rel="stylesheet">
<!-- /Header Personalizado [Home] -->
@endpush
@section('title', '')
@section('content')
	<!-- Conteudo Principal [Home] -->
	<div id="recomend-popular" class="painel">
		<h2>Melhores Avaliadas de {{ \Carbon::now()->formatLocalized('%B') }} <small><a href="{{route('novels')}}">Mais <i class="fa fa-angle-double-right"></i></a></small></h2>
		<ul class="recomend-novels recomend-popular">
			@foreach($votadas as $votada)
			<li class="recomend-item">
				@component('components.novel',['novel' => $votada,'class' => 'votadas']))
				@endcomponent
			</li>
			@endforeach
		</ul>
	</div>
	<div id="recomend-tag" class="painel">
		<h2>Gêneros <small><a href="{{route('novels')}}">Mais <i class="fa fa-angle-double-right"></i></a></small></h2>
		<ul class="recomend-tags">
			@foreach($generos as $genero)
			<li class="recomend-item">
				<a href="{{route('novels')}}?genero={{$genero->id}}">{{$genero->nome}}</a>
			</li>
			@endforeach
		</ul>
	</div>
	<main id="home">
		<div id="principal">
			<div id="lancamentos" class="painel">
				<h2>Lançamentos</h2>
				<div class="table-responsive">
					<central-feed></central-feed>
				</div>
			</div>
			@component('components.ads.principal-01'))
			@endcomponent
		</div>
		<div id="lateral">

			@component('components.noticia',['noticia' => $noticia]))
			@endcomponent
			@component('components.recomend-novels',['titulo' => 'Recomendados','novels' => $recomendados,]))
			@endcomponent
			
			@component('components.ads.lateral-02'))
			@endcomponent
			<!--<div id="cadastro" class="painel">
				<h2>Cadastre-se</h2>
				<form class="form_default" action="">
					<div class="form_element">
						<label for="">Nome</label>
						<input type="text" name="nome">
					</div>
					<div class="form_element">
						<label for="">Nickname</label>
						<input type="text" name="nome">
					</div>
					<div class="form_element">
						<label for="">Email</label>
						<input type="text" name="nome">
					</div>
					<div class="form_element">
						<label for="">Senha</label>
						<input type="password" name="senha">
					</div>
					<div class="form_element">
						<input type="submit" class="btn-submit" value="Enviar">
					</div>
				</form>
			</div> -->
		</div>
	</main>
	
	<!-- /Conteudo Principal [Home] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Home] -->


<script type="text/javascript" src="{{asset(mix('js/home.min.js'))}}"></script>
<script>
$(document).ready(function() {
   $('.recomend-popular').slick({
        infinite: false,
        speed: 300,
        arrows: false,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
        {
            breakpoint: 959,
            settings: {
            slidesToShow: 5,
            slidesToScroll: 1,
            infinite: true,
            }
        },
        {
            breakpoint: 767,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1
            }
        }
        ]
    });
});

</script>
<!-- /Footer Personalizado [Home] -->
@endpush