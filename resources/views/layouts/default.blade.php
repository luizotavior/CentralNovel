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
    <title>@yield('title'){{ config('app.name', 'Central Novel') }}</title>
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <meta name="theme-color" content="#b07418">

@stack('opengraph')
    @component('components.favicon')
    @endcomponent
    @component('components.seo.opengraph',['novel' => (isset($novel) ? $novel : null), 'grupo' => (isset($grupo) ? $grupo : null)])
    @endcomponent
    <!-- Styles -->
    {{-- <script charset="UTF-8" src="//cdn.sendpulse.com/9dae6d62c816560a842268bde2cd317d/js/push/5aa20fb280ca751a6f133e535f863b78_1.js" async></script> --}}
    <link href="{{ asset('dist/slick-1.8.0/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/slick-1.8.0/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset(mix('css/main.min.css')) }}" rel="stylesheet">


    
@stack('HeaderScripts')

</head>
<body>
    <div id="nav-topo">
        <ul id="nav-social">
            <li class="discord"><a href="https://discord.gg/qCjSsdX" target="_blank"><img src="{{asset('images/icons/discord.png')}}" alt=""></a></li>
            <li class="facebook"><a href="https://www.facebook.com/centralnovel" target="_blank"><img src="{{asset('images/icons/facebook-logo-outline.png')}}" alt=""></a></li>
        </ul>
        <ul id="nav-login-search">
            <li><a href="{{route('novels')}}"><i class="fa fa-search" aria-hidden="true"></i></a></li>
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endguest
        </ul>
    </div>
    <header>
        <div class="logo">
            <a href="{{route('home')}}"><img class="logo" src="{{asset('images/logo/main-logo.png')}}" alt=""></a>
        </div>
        <nav class="nav-principal">
            <ul>
                <li><a href="{{route('home')}}" class="{{ (Request::is('home') or Request::is('')) ? 'active' : '' }}">Home</a></li>
                <li><a href="{{route('novels')}}" class="{{ Request::is('novels') ? 'active' : '' }}">Novels</a></li>
                <li><a href="{{route('grupos')}}" class="{{ Request::is('grupos') ? 'active' : '' }}">Grupos</a></li>
                <li><a href="https://discordapp.com/invite/qCjSsdX" class="" target="_blank">Discord</a></li>
                <li><a href="{{route('alianca')}}" class="{{ Request::is('alianca') ? 'active' : '' }}">Aliança</a></li>
                <li><a href="{{route('contato')}}" class="{{ Request::is('contato') ? 'active' : '' }}">Contato</a></li>
            </ul>
        </nav>
    </header>
    <div id="app-vue">
        <adblock @passValue="add = $event"/>
    </div>
        @yield('content')

    <div id="legado" class="painel">
        <div class="texto">
            <p>Obtenha o Legado do</p>
            <p class="destaque">Quinto Deus Celestial</p>
            <a href="https://www.facebook.com/centralnovel/" class="btn" target="_blank">Acesse o Facebook</a>
        </div>
        <div class="livro">
            <img src="{{asset('images/bg/book.png')}}" alt="">
        </div>
    </div>
    <div id="ranked-background">
        <div class="container">
            @component('components.ads.inferior-01'))
			@endcomponent
            @if(isset($votadas))
            <div id="ranked" class="painel">
                <h2>Mais Acessadas <small><a href="{{route('novels')}}?classificacao=1">Mais <i class="fa fa-angle-double-right"></i></a></small></h2>
				<ul class="recomend-novels recomend-ranked">
					@foreach($populares as $popular)
					<li class="recomend-item">
                        @component('components.novel',['novel' => $popular,'class' => 'popular']))
                        @endcomponent
					</li>
					@endforeach
				</ul>
            </div>
            @component('components.ads.inferior-02'))
			@endcomponent
            @endif
        </div>
    </div>
    
    <!-- Conteudo Modal [Modal] --> 
    @component('components.modals.fuckAdblock'))
	@endcomponent
    <!-- /Conteudo Modal [Modal] -->
    <footer class="footer ">

		<div class="expandido">
			<div class="listas">
                <div class="lista">
                    <div class="logo">
                        <img class="logo" src="{{asset('images/logo/black-logo100x140.png')}}" alt="Logo Central Novel">
                    </div>
				</div>
				<div class="lista">
					<h2>Central Novel</h2>
					<ul>
						<li>
							<a href="{{route('home')}}">Home</a>
						</li>
						<li>
							<a href="{{route('novels')}}">Novels</a>
						</li>
						<li>
							<a href="{{route('grupos')}}">Grupos</a>
						</li>
						{{-- <li>
							<a href="https://forum.centralnovel.com.br/" target="_blank">Fórum</a>
						</li> --}}
                        <li>
                            <a href="{{route('contato')}}">Contato</a>
                        </li>
					</ul>
				</div>
				<div class="lista">
					<h2>Políticas</h2>
					<ul>
						<li>
							<a href="{{route('politica')}}" class="">Política de Privacidade</a>
						</li>
						<li>
							<a href="{{route('termos')}}" class="">Termos e Condições</a>
						</li>
					</ul>
				</div>
				<!--<div class="lista">
					<h2>Contato</h2>
					<ul>
						<li class="active">E-mail</li>
						<li>
							<a href="mailto:contato@educaevent.org.br">contato@centralnovel.com.br</a>
						</li>
					</ul>
				</div>-->
			</div>

		</div>

		<div class="mini">
			<div class="lado-esquerdo">
				<a href="https://www.facebook.com/centralnovel" target="_blank">
					<i class="fa fa-facebook inverse" aria-hidden="true"></i>
				</a>

			</div>
			<div class="centro">
				<p> CentralNovel &copy; 2018 - Desenvolvido com <span style="color: red;" alt="Amor">♥</span> no <a href="https://www.google.com.br/search?&q=Cidades+Vale+do+Paraiba">Vale do Paraiba</a> </p>
			</div>
			<div class="lado-direito">
				<p>V3.4.0</p>
			</div>
		</div>


	</footer>
    <!-- Scripts -->
    <script src="{{ asset(mix('js/main.min.js')) }}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('dist/slick-1.8.0/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="https://novelmania.com.br/wp-content/plugins/wp-adblock-dedect/js/dedect.js?ver=4.9.8"></script>

    <script>
    $(document).ready(function(){
        $('.recomend-ranked').slick({
            infinite: false,
            speed: 300,
		    arrows: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
            {
                breakpoint: 1130,
                settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                }
            },
            {
                breakpoint: 950,
                settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                }
            },
            {
                breakpoint: 767,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
            ]
        });
        
    });
    </script>
    <script>

        $('.fechar').click(function(){
            $(".modal").fadeOut(750); 
        });
        // Function called if AdBlock is not detected
        function adBlockNotDetected() {
        }
        // Function called if AdBlock is detected
        function adBlockDetected() {
            $('#fuckAdblock.modal .fundo').fadeIn(750); 
            $('#fuckAdblock').fadeIn(750); 
        }
            

        jQuery(document).ready(function(){
            var fuckAdBlock = new FuckAdBlock({
                checkOnLoad: true,
                resetOnEnd: true
            });
            fuckAdBlock.onDetected(adBlockDetected);
            fuckAdBlock.onNotDetected(adBlockNotDetected);
        });
        if ('serviceWorker' in navigator && 'PushManager' in window) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
    @stack('FooterScripts')
</body>
</html>
