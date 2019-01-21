@isset($noticia)
<div id="lancamento-noticia" class="painel">
    <h2>Noticia <small><a href="{{route("grupo",$noticia->grupo->url)}}">Mais <i class="fa fa-angle-double-right"></i></a></small></h2>
    <ul class="recomend-noticias">
        <li class="recomend-item">
            <div class="card-noticia">
                <a href="{{route('extcn',$noticia->id)}}" class="extcn" target="_blank">
                    <h3 class="noticia-titulo">{{$noticia->titulo}}</h3>
                    {!! $noticia->descricao !!}
                    <span>Continuar Lendo</span>
                </a>
            </div>
        </li>
    </ul>
</div>
@endisset