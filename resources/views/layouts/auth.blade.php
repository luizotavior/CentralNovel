<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @component('components.google.analytcs')
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
    @stack('HeaderScripts')
</head>
<body>
    @yield('content')
    <!-- Scripts -->
    @stack('FooterScripts')
</body>
</html>
