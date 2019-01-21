@extends('layouts.auth')
@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->
<link href="{{ asset(mix('css/auth.min.css')) }}" rel="stylesheet">
<!-- /Header Personalizado [Modelo] -->
@endpush

@section('content')
    <!-- Conteudo Principal [Modelo] -->
    <main id="auth">
        <div class="container">
            <div id="informacoes">
                <div class="content">
                        <a href="{{route('home')}}"><img class="logo" src="{{asset('images/logo/white-logo.png')}}" alt=""></a>
                </div>
            </div>
            <div id="painel">
                <div class="formulario">
                    <div class="form_header">
                        <h1><a href="{{route('login')}}">Faça o login</a></h1>
                        <a href="{{route('register')}}"><i class="fa fa-user-o" aria-hidden="true"></i>
                             Registrar</a>
                    </div>
                    <form class="form_body" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        @if (session('confirmation-success') or session('confirmation-danger'))
                        <div class="form_group">
                                @if (session('confirmation-success'))
                                    <div class="form_element">
                                        <div class="help-block">
                                            {!! session('confirmation-success') !!}
                                        </div>
                                    </div>
                                @endif
                                @if (session('confirmation-danger'))
                                    <div class="form_element">
                                        <div class="help-block">
                                            {!! session('confirmation-danger') !!}
                                        </div>
                                    </div>
                                @endif
                        </div>
                        @else
                        <div class="form_group">
                            <div class="form_element{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username">
                                    Usuário 
                                </label>
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    {{ $errors->first('username') }}
                                </span>
                                @endif
                                <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus>
                            </div>
                            <div class="form_element{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">
                                    Senha
                                </label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                                <input type="password" name="password" id="password" value="{{ old('password') }}" required autofocus>
                            </div>
                            <div class="form_element horizontal">
                                <label for="remember">Lembrar-me</label>
                                <input type="checkbox" name="#" id="remember">
                            </div>
                            <div class="form_element horizontal">
                                <a href="{{ route('password.request') }}">Esqueceu sua Senha ?</a>
                            </div>
                        </div>
                        <div class="form_group">
                            <div class="form_element submit">
                                <input type="submit" name="signup" value="Login">
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- /Conteudo Principal [Modelo] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Modelo] -->

<!-- /Footer Personalizado [Modelo] -->
@endpush