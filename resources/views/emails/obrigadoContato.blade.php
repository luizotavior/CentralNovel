@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Obrigado por entrar em contato',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>Olá {{$nome}}, Tudo Bom ?</p>
        <p>Ficamos contentes em receber a sua mensagem, estaremos respondendo ela o mais rapido possivel.</p>
        <br>
        <p>Atensiosamente,</p>
        <p>Império Huang Long, Central Novel.</p>

    @include('beautymail::templates.sunny.contentEnd')


@stop