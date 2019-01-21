@extends('layouts.default')

@section('title', "Contato - ")


@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->
    <link href="{{asset(mix('css/contato.min.css'))}}" rel="stylesheet" type="text/css">

<!-- /Header Personalizado [Modelo] -->
@endpush

@section('content')
    <!-- Conteudo Principal [Contato] -->
    <main id="contato">
        <div id="principal" class="painel">
            <h1 class="titulo" >Fale Conosco</h1>
            <form class="form_default" action="{{route('contato.send')}}" method="POST">
                {{ csrf_field() }}
                <fieldset class="info-principal">
                    <div class="form_element{{ $errors->has('nome') ? ' has-error' : '' }}">
                        <label for="">Nome Completo</label>
                        @if ($errors->has('nome'))
                            <span class="help-nome">
                                {{ $errors->first('nome') }}
                            </span>
                        @endif
                        <input type="text" name="nome" id="nome" value="{{ old('nome')}}" required autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="">E-mail</label>
                        @if ($errors->has('email'))
                            <span class="help-email">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                        <input type="email" name="email" id="email" value="{{ old('email')}}" required autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('assunto') ? ' has-error' : '' }}">
                        <label for="">Assunto</label>
                        @if ($errors->has('assunto'))
                            <span class="help-assunto">
                                {{ $errors->first('assunto') }}
                            </span>
                        @endif
                        <input type="text" name="assunto" id="assunto" value="{{old('assunto')}}" required autofocus>
                    </div>
                </fieldset>
                <fieldset class="info-geral">
                    <div class="form_element{{ $errors->has('mensagem') ? ' has-error' : '' }}">
                        <label for="">Mensagem</label>
                        @if ($errors->has('mensagem'))
                            <span class="help-mensagem">
                                {{ $errors->first('mensagem') }}
                            </span>
                        @endif
                        <textarea name="mensagem" id="mensagem">{{ old('mensagem') }}</textarea>
                    </div>
                </fieldset>
                <fieldset class="action">
                    <div class="form_element">
                        <input class="btn-submit" type="submit" value="Enviar">
                    </div>
                </fieldset>
            </form>
        </div>
    </main>
    <!-- /Conteudo Principal [Contato] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Contato] -->

<!-- /Footer Personalizado [Contato] -->
@endpush