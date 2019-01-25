@extends('layouts.default')
@push('HeaderScripts')
<!-- Header Personalizado [Home] -->

<link href="{{ asset(mix('css/grupo.min.css')) }}" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- /Header Personalizado [Home] -->
@endpush
@section('title', $grupo->nome." - ")
@section('content')
	<!-- Conteudo Principal [Home] -->
	<main id="grupo">
		<div id="principal">
			<div id="grupo">
				<div class="painel grupo_header">
					<div class="capa">
					@if(Storage::disk('gcs')->exists($grupo->capa))
                        <img src="{{ Storage::disk('gcs')->url($grupo->capa) }}" alt="{{$grupo->titulo}}">
                    @else        
                        <img src="{{ Storage::disk('gcs')->url('grupos/default.jpg')}}" alt="Grupo sem capa">
                    @endif
					</div>
					<div class="dados">
						<h1 class="titulo">{{$grupo->nome}}
							<!-- <span>Membro Aliança</span> -->
						</h1>
                        <form id="ratingForm" method="POST" action="{{route('rating.grupo', ['id' => $grupo->id])}}" ajax="true">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div id="rating">
                                <fieldset class="rating">
                                        <input onclick="sendRating()" type="radio" id="star5-grupo-{{$grupo->id}}" name="rating" value="5" {{($grupo->avgRating >= 5.0)?'checked':''}}/>
                                        <label for="star5-grupo-{{$grupo->id}}" class = "full" title="Impressionante - 5 stars"></label>
                                        <input onclick="sendRating()" type="radio" id="star4-grupo-{{$grupo->id}}" name="rating" value="4" {{($grupo->avgRating >=4.0 and $grupo->avgRating < 5.0)?'checked':''}}/>
                                        <label for="star4-grupo-{{$grupo->id}}" class ="full" title="Muito bom - 4 stars"></label>
                                        <input onclick="sendRating()" type="radio" id="star3-grupo-{{$grupo->id}}" name="rating" value="3" {{($grupo->avgRating >=3.0 and $grupo->avgRating < 4.0)?'checked':''}}/>
                                        <label for="star3-grupo-{{$grupo->id}}" class ="full" title="Razoável - 3 stars"></label>
                                        <input onclick="sendRating()" type="radio" id="star2-grupo-{{$grupo->id}}" name="rating" value="2" {{($grupo->avgRating >=2.0 and $grupo->avgRating < 3.0)?'checked':''}}/>
                                        <label for="star2-grupo-{{$grupo->id}}" class ="full"  title="Um pouco ruim - 2 stars"></label>
                                        <input onclick="sendRating()" type="radio" id="star1-grupo-{{$grupo->id}}" name="rating" value="1" {{($grupo->avgRating >=1.0 and $grupo->avgRating < 2.0)?'checked':''}}/>
                                        <label for="star1-grupo-{{$grupo->id}}" class ="full" title="Muito ruim - 1 star"></label>
                                        </fieldset>
                                <span class="rating-value">{{number_format($grupo->avgRating, 1, '.', ',')}}</span>
                                <span class="rating-total">({{$grupo->nota_count}} Avaliações)</span>
                            </div>
                        </form>
						<p class="descricao">
						@if($grupo->descricao != null and $grupo->descricao != '')
                                {!! $grupo->descricao !!}
                            @else
                                Não há informações sobre este Grupo.
                            @endif
						</p>
						<div class="acao">
							<a class="btn ler" href="{{$grupo->site}}?utm=centralnovel" target="_blank">Site</a>
							@if(isset($grupo->patrocinar))
							<a class="btn patrocinar" href="{{$grupo->patrocinar}}" target="_blank"><i class="fa fa-money"></i> Patrocinar</a>
							@endif
						</div>
                        @guest
                        @else
                        @if(Auth::user()->hasAnyRoles(['Admin']))
                        <div class="action-admin">
                            <a href="{{route('dashboard.grupo.alt',[$grupo->id])}}" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </div>
                        @endif
                        @endguest
					</div>
				</div>
				<div class="painel grupo_body">
                    <h2>Lançamentos</h2>
                    <div class="table-responsive">
                        <table id="feeding" class="display feed-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Novel</th>
                                    <th>Release</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
			@component('components.ads.principal-01'))
			@endcomponent
			
			@component('components.disqus',['url' => route('grupo',['id'=> $grupo->url]),'identifier' => "grupo_".$grupo->url]))
			@endcomponent
		</div>
		<div id="lateral">
			@component('components.noticia',['noticia' => $noticia]))
			@endcomponent

			@component('components.ads.lateral-01'))
			@endcomponent

			@component('components.recomend-novels',['titulo' => 'As Melhores Deles','novels' => $recomendados,]))
			@endcomponent
		</div>
	</main>
	
	<!-- /Conteudo Principal [Grupo] -->
    <!-- Conteudo Modal [Modal] --> 
    @component('components.modals.rating'))
	@endcomponent
    @component('components.modals.notAuth'))
	@endcomponent
    <!-- /Conteudo Modal [Modal] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Grupo] -->
<script type="text/javascript" src="{{asset('dist/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js')}}"></script>
<script id="dsq-count-scr" src="//centralnovel.disqus.com/count.js" async></script>
<script type="text/javascript" src="{{asset(mix('js/grupo.min.js'))}}"></script>
<!-- Datatables -->
<script>
	$(document).ready(function() {
		$('#feeding').dataTable( {
			responsive: true,
			responsive: {
				details: false
			},
			
			ajax: '{!! route('datatables.grupo',['id'=> $grupo->id]) !!}',
			columns: [
				{ data: 'novel.titulo', name: 'novel'},
				{ data: 'capitulo', name: 'capitulo'},
				{ data: 'published_at_diff', name: 'published_at'},
			],
			"paging":   true,
			"ordering": false,
			"info":     false,
			"searching": false,
			"bLengthChange": false,
			"pagingType": "simple_numbers",
			"language": {
					"lengthMenu": "Mostrando _MENU_ entradas",
					"search": "Pesquisar:",
					"info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
					"emptyTable": "Sem dados disponíveis",
					"paginate": {
								"next": "<i class='fa fa-arrow-right'></i>",
								"previous": "<i class='fa fa-arrow-left'></i>"
								}
			},"columnDefs": [
				{
					"render": function ( data, type, row ) {
						return '<a  href="{{URL::to('/')}}/novel/'+row['novel']['url']+'">'+data+'</a>';
					},
					"targets": [0]
				},
				{
					"render": function ( data, type, row ) {
						return '<a  href="{{URL::to('/')}}/extcn/'+row['id']+'/" target="_blank">'+
						(row['volume'] != null ? 'v'+row['volume'] : '')+
						(row['capitulo'] != null && row['capitulo'] != 'Prologo' ? 'c'+row['capitulo'] : '')+
						(row['capitulo'] == 'Prologo' ? 'Prólogo' : '')+
						(row['parte'] != null ? ' parte '+row['parte'] : '')+
						'</a>';
					},
					"targets": [1]
				}
			]
		} );
	} );
</script>
<!-- /Footer Personalizado [Grupo] -->
@endpush