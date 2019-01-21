@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Seja Bem Vindo ao Império',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>Olá {{$nome}}, Tudo Bom ?</p>
		<p>Obrigado por criar a sua Conta na Central Novel.</p>
		<p>Nós estamos muito felizes por você ter se interessado em nossas atualizações. Por favor, caso você tenha sugestões entre em <a href="{{route('contato')}}">Contato</a> conosco, se você gosta das traduçoes disponiveis em nosso Sistema, não esqueça de agradecer ou ajudar os <a href="{{route('grupos')}}">Grupos</a> que fazem isso estar disponível.</p>
		<p>E não deixe de entrar em <a href="{{route('contato')}}">Contato</a> se houver qualquer coisa que possamos fazer por você!</p>
		<br>
        <p>Atensiosamente,</p>
        <p>Imperador K, "O Primeiro e Único", do Império Huang Long, Central Novel.</p>

    @include('beautymail::templates.sunny.contentEnd')


@stop