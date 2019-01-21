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
                        <h1>Recupere sua Senha</h1>
                        <a href="{{route('login')}}"><i class="fa fa-user-o" aria-hidden="true"></i>
                             Login</a>
                    </div>
                    <form class="form_body" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                        <div class="form_group">
                            @if (session('status'))
                                <div class="form_element alert alert-success">
                                    <label>{{ session('status') }}</label>
                                </div>
                            @endif
                            <div class="form_element{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">
                                    E-mail 
                                </label>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form_group">
                            <div class="form_element submit">
                                <input type="submit" name="signup" value="Solicitar Recuperação">
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