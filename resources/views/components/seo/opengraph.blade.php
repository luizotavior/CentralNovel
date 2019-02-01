    <!-- OpenGraph -->
    <meta property="og:site_name" content="Central Novel" />
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:locale" content="pt_BR">
    <meta property=”fb:app_id” content=”358265851177937″>
    <meta name="robot" content="Index,Follow" >
    <meta name="rating" content="general" >
    <meta name="distribution" content="global">
    <meta name="language" CONTENT="pt-br" >
    @if(isset($grupo))
    <meta property="og:title" content="{{$grupo->nome}} - Central Novel">
    @if(Storage::disk('gcs')->exists($grupo->capa))
    <meta property="og:image" content="{{ Storage::disk('gcs')->url($grupo->capa) }}">
    @endif
    <meta property="og:type" content="article">
    <meta property='article:author' content='https://www.facebook.com/centralnovel' />
    <meta property="article:section" content="Grupo">
    <meta property="article:tag" content="WebNovel, Tradução, Novels, Livros, Brasil">
    <meta name="keywords" content="WebNovel, Tradução, Novels, Livros, Brasil">
    <meta property="og:description" content="{{str_limit($grupo->nome." é uma Grupo Tradutor de WebNovel.".(($grupo->descricao != null and $grupo->descricao != '') ? " ".$grupo->descricao : '') ,200)}}"/>
    <meta name="description" content="{{str_limit($grupo->nome." é uma Grupo Tradutor de WebNovel.".(($grupo->descricao != null and $grupo->descricao != '') ? " ".$grupo->descricao : '') ,200)}}"/>
    @elsesif(isset($novel))
    <meta property="og:title" content="{{$novel->titulo}} - Central Novel">
    @if(Storage::disk('gcs')->exists($novel->capa))
    <meta property="og:image" content="{{ Storage::disk('gcs')->url($novel->capa) }}">
    @endif
    <meta property="og:title" content="{{ (isset($titulo) ? $titulo : 'Central Novel') }}">
    <meta property="og:type" content="article">
    <meta property='article:author' content='https://www.facebook.com/centralnovel' />
    <meta property="article:section" content="Novel">
    <meta property="article:tag" content="{{implode(', ',$novel->genero->pluck('nome')->toArray())}}">
    <meta name="keywords" content="{{implode(', ',$novel->genero->pluck('nome')->toArray())}}">
    <meta property="og:description" content="{{str_limit($novel->titulo." é uma ".$novel->tipo->nome." ".( isset($novel->autor) ? "do Autor ".$novel->linguagem->nome." ".$novel->autor."." : $novel->linguagem->nome."." ).(($novel->sinopse != null and $novel->sinopse != '') ? " ".$novel->sinopse : ''),200)}}"/>
    <meta name="description" content="{{str_limit($novel->titulo." é uma ".$novel->tipo->nome." ".( isset($novel->autor) ? "do Autor ".$novel->linguagem->nome." ".$novel->autor."." : $novel->linguagem->nome."." ).(($novel->sinopse != null and $novel->sinopse != '') ? " ".$novel->sinopse : ''),200)}}"/>
    @else
    <meta property="og:title" content="Central Novel">
    <meta property="og:image" content="{{asset('images/logo/capa-seo.png')}}">
    <meta property="og:type" content="website">
    <meta name="keywords" content="WebNovel, Tradução, Novels, Livros, lightnovel, wuxia, manga, anime">
    <meta property="og:description" content="Central de lancamentos de traduções de Novels e Livros, Japoneses, Chineses, Coreanos e Brasileiros." />
    <meta name="description" content="Central de lancamentos de traduções de Novels e Livros, Japoneses, Chineses, Coreanos e Brasileiros." />
    @endif
