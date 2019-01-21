@extends('layouts.default')
@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->
    <link href="{{asset(mix('css/alianca.min.css'))}}" rel="stylesheet" type="text/css">

<!-- /Header Personalizado [Modelo] -->
@endpush

@section('title', 'Aliança - ')
@section('content')
    <!-- Conteudo Principal [Modelo] -->
    <main id="alianca">
        <div id="principal" class="painel">
            <h1>Aliança Novel</h1>
            <hr>
            <div class="alianca-logo">
                <img src="{{asset('images/selo-alianca.png')}}" alt="Simbolo Aliança Novel">
            </div>
            <div class="sobre">
                <div class="esquerdo">
                <div class="linha">
                    <hr>
                    <hr>
                    <hr>
                </div>
                    <p>Os Grupos de tradução sentiram a necessidade de ter um canal de comunicação, um local onde pudessem ajudar e ser ajudados.</p>
                </div>
                <div class="direito">
                    <p>Para</p>
                    <p>levar as</p>
                    <p>novels</p>
                    <p>ainda mais</p>
                    <p>longe</p>
                </div>
                <div class="inferior">
                    <h2>Um pouco sobre nós</h2>
                    <hr>
                    <p>
                    Há muitos anos o Brasil vem testemunhando o nascimento de diversos grupos e indivíduos que dedicam o seu tempo para traduzir aquilo que gostam, e assim, muitas webnovels e lightnovels puderam ser apreciadas com o nosso bom português-brasileiro.
                    </p><p>
                    Dantes confinadas ao seu idioma original, ou quiçá traduzidas para o inglês, hoje estas histórias estão sendo traduzidas e revisadas por pessoas apaixonadas por aquilo que fazem. Com este movimento de tradução, também testemunhamos o nascimento de novels brasileiras, provando a força que as web e lightnovels alcançou nos últimos tempos.
                    </p><p>
                    Por conseguinte, os grupos de tradução sentiram a necessidade de ter um canal de comunicação, um local onde pudessem ajudar e ser ajudados. E assim, nasceu a Aliança Novel Brasil.
                    </p><p>
                    A Aliança não dita regras, não estabelece diretrizes, tão pouco lhe fora outorgado o poder para interferir nos projetos ou modus operandi dos grupos de tradução.
                    A proposta da Aliança é ser um canal direto com o representante de cada grupo de tradução, visando aproximar as equipes, seja na divulgação de eventos, projetos ou mesmo em dúvidas técnicas ou operacionais.
                    </p><p>
                    Você representa um grupo ou possui um projeto de tradução, mas ainda não participa da Aliança? Saiba que a Aliança está de portas abertas e todos os grupos são bem-vindos.
                    </p><p>
                    Você pode conferir abaixo os grupos que fazem parte da Aliança Novel Brasil, bem como um rápido resumo de suas propostas.
                    </p>
                </div>
            </div>
            <div class="membros">
                <h2>Membros da Aliança</h2>
                <hr>
                <div class="lista-membros">
                @foreach($membros as $group)
                    <div id="group-{{$group->id}}" class="membro">
                        <a href="{{$group->site}}?utm_source=centralnovel&utm_medium=aliancanovel" target="_blank" title="{{$group->nome}}">
                        @if(Storage::disk('public')->exists($group->capa))
                            <img src="{{asset("storage/".$group->capa)}}" alt="{{$group->titulo}}" alt="{{$group->nome}}">
                        @else        
                            <img src="{{asset('images/grupos/default.jpg')}}" alt="{{$group->nome}}">
                        @endif
                        <span>{{$group->nome}}</span>
                        </a>
                    </div>

                @endforeach
                </div>
                <a class="btn" href="{{route('contato')}}">Seja um Membro</a>
            </div>
        </div>
    </main>
    <!-- /Conteudo Principal [Modelo] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Modelo] -->

<!-- /Footer Personalizado [Modelo] -->
@endpush