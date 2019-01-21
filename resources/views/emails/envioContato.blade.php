@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Obrigado por entrar em Contato',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>Olá Imperador, Tudo Bom ?</p>
        <p>Acabamos de receber uma mensagem.</p>
        <br>

        <p><strong>Nome: </strong>{{$nome}}</p>
        <p><strong>Email: </strong>{{$email}}</p>
        <p><strong>Assunto: </strong>{{$assunto}}</p>
        <p><strong>Mensagem: </strong></p>
        <br>
        <p style="text-align:justify;">{{$mensagem}}</p>
        <br>
        <p> - - - -</p>
        <br>
        <p>Atensiosamente,</p>
        <p>Império Huang Long, Central Novel.</p>

    @include('beautymail::templates.sunny.contentEnd')

@stop