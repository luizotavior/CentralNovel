@extends('layouts.default')

@push('opengraph')
    @component('components.seo.opengraph',[
        'titulo' => $novel->titulo,
        'imagem' => Storage::disk('public')->exists($novel->capa) ? 'x' : 's'
    ])
    @endcomponent
@endpush

@push('HeaderScripts')
    <!-- Header Personalizado [Novel] -->
    <link href="{{ asset(mix('css/novel.min.css')) }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- /Header Personalizado [Novel] -->
    @endpush
@section('title', $novel->titulo." - ")
@section('content')
    <!-- Conteudo Principal [Novel] -->
    <main id="novel">
        <div id="principal">
            <div id="series">
                <div class="painel series_header">
                    <div class="capa">
                    @if(Storage::disk('public')->exists($novel->capa))
                        <img src="{{asset("storage/".$novel->capa)}}" alt="{{$novel->titulo}}">
                    @else        
                        <img src="{{asset('images/novels/default.jpg')}}" alt="Novel sem capa">
                    @endif
                        </div>
                    <div class="dados">
                        <h1 class="titulo">{{$novel->titulo}}
                            <!-- <span class="sigla"></span>-->
                        </h1>
                        <ul class="lista-tags">
                            @foreach($novel->genero->sortBy('nome') as $tag)
                                <li class="item-tag"><a href="{{route('novels')}}?genero={{$tag->nome}}" class="tag">{{$tag->nome}}</a></li>
                            @endforeach
                        </ul>
                        <form id="ratingForm" method="POST" action="{{route('rating.novel', ['id' => $novel->id])}}" ajax="true">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div id="rating">
                                <fieldset class="rating">
                                        <input onclick="sendRating()" type="radio" id="star5-novel-{{$novel->id}}" name="rating" value="5" {{($novel->avgRating >= 5.0)?'checked':''}}/>
                                        <label for="star5-novel-{{$novel->id}}" class = "full" title="Impressionante - 5 stars"></label>
                                        <input onclick="sendRating()" type="radio" id="star4-novel-{{$novel->id}}" name="rating" value="4" {{($novel->avgRating >=4.0 and $novel->avgRating < 5.0)?'checked':''}}/>
                                        <label for="star4-novel-{{$novel->id}}" class ="full" title="Muito bom - 4 stars"></label>
                                        <input onclick="sendRating()" type="radio" id="star3-novel-{{$novel->id}}" name="rating" value="3" {{($novel->avgRating >=3.0 and $novel->avgRating < 4.0)?'checked':''}}/>
                                        <label for="star3-novel-{{$novel->id}}" class ="full" title="Razoável - 3 stars"></label>
                                        <input onclick="sendRating()" type="radio" id="star2-novel-{{$novel->id}}" name="rating" value="2" {{($novel->avgRating >=2.0 and $novel->avgRating < 3.0)?'checked':''}}/>
                                        <label for="star2-novel-{{$novel->id}}" class ="full"  title="Um pouco ruim - 2 stars"></label>
                                        <input onclick="sendRating()" type="radio" id="star1-novel-{{$novel->id}}" name="rating" value="1" {{($novel->avgRating >=1.0 and $novel->avgRating < 2.0)?'checked':''}}/>
                                        <label for="star1-novel-{{$novel->id}}" class ="full" title="Muito ruim - 1 star"></label>
                                        </fieldset>
								<span class="rating-value">{{number_format($novel->avgRating, 1, '.', ',')}}</span>
                                <span class="rating-total">({{$novel->nota_count}} Avaliações)</span>
                            </div>
                        </form>
                        <div class="info-capitulos">
                            <span><i class="fa fa-book"></i> {{$novel->feed->where('categoria_id','1')->count()}} Capitulos</span>
                        </div>
                        <ul class="lista-detalhes">
                            <li class="detalhe">
                                <p><span>Autor:</span>
                                @if(isset($novel->autor))
                                    @foreach(explode(';',$novel->autor) as $autor)
                                        <a href="#{{$autor}}">{{$autor}}</a>
                                    @endforeach
                                @else
                                    <a href="#">N/I</a>
                                @endif
                                </p>
                            </li>
                            <li class="detalhe">
                                <p><span>Tradutor:</span>
                                @if(isset($novel->tradutor))
                                    @foreach(explode(';',$novel->tradutor) as $tradutor)
                                        <a href="#{{$tradutor}}">{{$tradutor}}</a>
                                    @endforeach
                                @else
                                    <a href="#">N/I</a>
                                @endif
                                </p>
                            </li>
                            <li class="detalhe">
                                <p><span>Editor:</span>
                                @if(isset($novel->editor))
                                    @foreach(explode(';',$novel->editor) as $editor)
                                        <a href="#{{$editor}}">{{$editor}}</a>
                                    @endforeach
                                @else
                                    <a href="#">N/I</a>
                                @endif
                                </p>
                            </li>
                        </ul>
                        <div class="acao">
                            <a class="btn ler" href="#feeding">Ler</a>
                            <a class="btn favoritar" ajax-url="{{route('favorite.novel', ['id' => $novel->id])}}" onclick="sendFavorite()" href="javascript:void(0)" ajax="true"><i class="fa fa-heart"></i> Favoritar</a>
                        </div>
                        @guest
                        @else
                        @if(Auth::user()->hasAnyRoles(['Admin']))
                        <div class="action-admin">
                            <a href="{{route('dashboard.novel.alt',[$novel->id])}}" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </div>
                        @endif
                        @endguest
                    </div>
                </div>
                <div class="painel series_body">
                    <div class="sinopse">
                        <h2>Sinopse</h2>
                        <div class="sinopse-content">
                            <p>
                            @if($novel->sinopse != null and $novel->sinopse != '')
                                {!! $novel->sinopse !!}
                            @else
                                Não há informações sobre esta Novel.
                            @endif
                            </p>
                        </div>
                    </div>
                    @if(isset($novel->linguagem->nome))
                    <div class="raw">
                        <h2>RAW</h2>
                        <ul class="lista-raws">
                            <li class="item-raw">
                                <a href="#" class="raw">{{$novel->linguagem->nome}}</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <h2>Capitulos</h2>
                    <div class="table-responsive">
                        <table id="feeding" class="display feed-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Novel</th>
                                    <th>Release</th>
                                    <th>Grupo</th>
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

			@component('components.disqus',['url' => route('novel',['id'=> $novel->url]),'identifier' => "novel_".$novel->url]))
			@endcomponent
        </div>
        <div id="lateral">
            @component('components.noticia',['noticia' => $noticia]))
            @endcomponent
            
			@component('components.ads.lateral-01'))
			@endcomponent

			@component('components.recomend-novels',['titulo' => 'Recomendados','novels' => $recomendados,]))
			@endcomponent
        </div>
    </main>
    
    <!-- /Conteudo Principal [Novel] -->
	<!-- /Conteudo Principal [Grupo] -->
    <!-- Conteudo Modal [Modal] --> 
    @component('components.modals.rating'))
	@endcomponent
    @component('components.modals.favorite'))
	@endcomponent
    @component('components.modals.notAuth'))
	@endcomponent
    <!-- /Conteudo Modal [Modal] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Novel] -->
<script type="text/javascript" src="{{asset('dist/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js')}}"></script>
<script id="dsq-count-scr" src="//centralnovel.disqus.com/count.js" async></script>
<script type="text/javascript" src="{{asset(mix('js/novel.min.js'))}}"></script>
<!-- Datatables -->
<script>
	$(document).ready(function() {
		$('#feeding').dataTable( {
			responsive: true,
			responsive: {
				details: false
			},
			
			ajax: '{!! route('datatables.novel',['id'=> $novel->id]) !!}',
			columns: [
				{ data: 'novel.titulo', name: 'novel'},
				{ data: 'capitulo', name: 'capitulo'},
				{ data: 'grupo.nome', name: 'grupo'},
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
				},
				{
					"render": function ( data, type, row ) {
						return '<a  href="{{URL::to('/')}}/grupo/'+row['grupo']['url']+'" >'+data+'</a>';
					},
					"targets": [2]
				}
			]
		} );
	} );
</script>
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Book",
    @if(Storage::disk('public')->exists($novel->capa))
  "image": "{{asset("storage/".$novel->capa)}}",
    @endif
  "name": "{{$novel->titulo}}",
  "description": "{{$novel->sinopse}}",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "{{number_format($novel->avgRating, 1, '.', ',')}}",
    "bestRating": "5",
    "ratingCount": "{{$novel->nota_count}}"
  }
}
</script>
<!-- /Footer Personalizado [Novel] -->
@endpush