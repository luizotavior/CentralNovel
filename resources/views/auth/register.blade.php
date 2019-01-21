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
                <a class="back" href="{{route('login')}}"><i class="fa fa-angle-double-left" aria-hidden="true"></i>
                    Voltar</a>
                <div class="formulario">
                    <div class="form_header">
                        <h1>Crie uma Conta</h1>
                        <a href="{{route('login')}}"><i class="fa fa-user-o" aria-hidden="true"></i>
                             Login</a>
                    </div>
                    <form class="form_body" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form_group">
                            @if (session('confirmation-success'))
                                <div class="form_element">
                                    <div class="help-block">
                                        {{ session('confirmation-success') }}
                                    </div>
                                </div>
                            @endif
                            <div class="form_element{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="nome">
                                    Nome
                                </label> 
                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        {{ $errors->first('nome') }}
                                    </span>
                                @endif
                                <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required autofocus>
                            </div>
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
                            <div class="form_element{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">
                                    E-mail 
                                </label>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="form_element{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">
                                    Repetir E-mail 
                                </label>
                                <input type="email" name="email_confirmation" id="email_confirmation" required autofocus>
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
                            <div class="form_element{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">
                                    Repetir senha
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required autofocus>
                            </div>
                        </div>
                        <div class="form_group">
                            <div class="form_element submit">
                                <input type="submit" name="signup" value="Registrar">
                            </div>
                        </div>
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