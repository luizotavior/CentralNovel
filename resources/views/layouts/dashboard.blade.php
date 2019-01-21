<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @component('components.google.analytcs')
    @endcomponent
    @component('components.google.adsense')
    @endcomponent
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:site_name" content="Central Novel" />
	<meta property="og:url" content="https://centralnovel.com.br/" />
    <meta property="og:title" content="Central Novel">
    <meta property="og:image" content="{{asset('images/logo/main-logo.png')}}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="pt_BR">
    <meta property=”fb:app_id” content=”358265851177937″>
    <meta property="og:description" content="Sistema que reune os maiores lancamentos de traduções de Novels Japonesa, Chinesa, Coreana e Brasileira." />

    @component('components.favicon')
    @endcomponent
    @component('components.seo.opengraph',['novel' => (isset($novel) ? $novel : null), 'grupo' => (isset($grupo) ? $grupo : null)])
    @endcomponent
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset(mix('css/dashboard.min.css')) }}" rel="stylesheet">
    @stack('HeaderScripts')
</head>
<body>
    <main id="dashboard">
        <div id="barra-lateral">
            <div class="content">
                <a href="{{route('home')}}"><img class="logo" src="{{asset('images/logo/white-logo.png')}}" alt=""></a>
                <a class="hamburger-open" alt="Abrir Menu"><i class="fa fa-bars fa-2x" ></i></a>
                <a class="hamburger-close" alt="Fechar Menu"><i class="fa fa-close fa-2x" ></i></a>
                <nav id="nav-dashboard">
                    <ul>
                        <li>
                            <a href="{{route('dashboard')}}" class="{{ Request::is('novels') ? 'active' : '' }}">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('novels')}}" class="{{ Request::is('novels') ? 'active' : '' }}">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <span>Novels</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('novels')}}" class="{{ Request::is('novels') ? 'active' : '' }}">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                <span>Anuncios</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('novels')}}" class="{{ Request::is('novels') ? 'active' : '' }}">
                                <i class="fa fa-gavel" aria-hidden="true"></i>
                                <span>Verificação</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('novels')}}" class="{{ Request::is('novels') ? 'active' : '' }}">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <span>Favoritos</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{asset(mix('js/dashboard.min.js'))}}"></script>
    @stack('FooterScripts')
</body>
</html>
