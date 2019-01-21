@extends('layouts.dashboard')
@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->

<!-- /Header Personalizado [Modelo] -->
@endpush

@section('content')
    <!-- Conteudo Principal [Modelo] -->

    <div id="main">
            <div class="perfil card">
                <div class="esquerda">
                    <div class="informacoes">
                        <span class="username">{{ Auth::user()->username }}</span>
                        <span class="nome">{{ Auth::user()->nome }}</span>
                        <div class="wallet">
                            <span>
                                <i class="fa fa-cubes" aria-hidden="true"></i>
                                42
                            </span>
                            <span>
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                01
                            </span>
                        </div>
                    </div>
                    <div class="identidade">
                        <span>Leitor</span>
                        <span>CentralNovel</span>
                    </div>
                </div>
                <div class="direita">
                    <a href="#">
                        <img src="{{asset('images/users/perfil/keyel__1.jpg')}}" alt="">
                    </a>
                </div>
                <div class="menu">
                    <a href="#">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="favoritos card">
                <div class="card-header">
                    <h1>Favoritos</h1>
                </div>
                <div class="card-body table">
                    <table>
                        <tbody>
                            @for($i=0;$i<10;$i++)
                            <tr>
                                <td>Divine Throne of Primordial Blood</td>
                                <td>c02</td>
                                <td>
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="perfil card">
                
            </div>
            <div class="perfil card">
                
            </div>
            <div class="perfil card">
                
            </div>
    </div>
    <!-- /Conteudo Principal [Modelo] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Modelo] -->
<!-- /Footer Personalizado [Modelo] -->
@endpush