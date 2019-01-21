@extends('layouts.dashboard')
@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->
<link href="{{asset('dist/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
<!-- /Header Personalizado [Modelo] -->
@endpush

@section('content')
    <!-- Conteudo Principal [Modelo] -->
    <div id="main">
        <div class="form_dashboard painel">
            @if(isset($novel))
                <h2>Formulario de Alteração de Novel</h2>
            @else
                <h2>Formulario de Inscrição de Novel</h2>
            @endif
            <form class="form_default" action="{{ isset($novel) ? route('dashboard.novel.alt',['id'=>$novel->id]) : route('dashboard.novel.add')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset class="capa">
                        <div class="form_element{{ $errors->has('capa') ? ' has-error' : '' }}">
                            @if ($errors->has('capa'))
                                <span class="help-capa">
                                    {{ $errors->first('capa') }}
                                </span>
                            @endif
                            <label class="click" for="capa">
                            @if(isset($novel) and Storage::disk('public')->exists($novel->capa))
                                <img class="capa" src="{{asset("storage/".$novel->capa)}}" alt="{{$novel->titulo}}">
                            @else        
                                <img class="capa" src="{{asset('images/novels/default.jpg')}}" alt="Novel sem capa">
                            @endif
                            </label>
                            <input type="file" name="capa" id="capa"  accept="image/jpeg" />
                            <span class="legenda">Tamanho Máximo: 50kb.</span>
                            <span class="legenda">Dimensões: 300x400.</span>
                            <span class="legenda">Formato: jpg.</span>
                        </div>
                </fieldset>
                <fieldset class="info-principal">
                    <div class="form_element{{ $errors->has('titulo') ? ' has-error' : '' }}">
                        <label for="">Titulo</label>
                        @if ($errors->has('titulo'))
                            <span class="help-titulo">
                                {{ $errors->first('titulo') }}
                            </span>
                        @endif
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') != null ? old('titulo') : (isset($novel) ? $novel->titulo : '')}}" required autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('sigla') ? ' has-error' : '' }}">
                        <label for="">Sigla</label>
                        @if ($errors->has('sigla'))
                            <span class="help-sigla">
                                {{ $errors->first('sigla') }}
                            </span>
                        @endif
                        <input type="text" name="sigla" id="sigla" value="{{ old('sigla') != null ? old('sigla') : (isset($novel) ? $novel->sigla : '')}}" autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('genero[]') ? ' has-error' : '' }}">
                        <label for="">Genero</label>
                        @if ($errors->has('genero'))
                            <span class="help-genero">
                                {{ $errors->first('genero') }}
                            </span>
                        @endif
                        
                        <select class="js-genero-basic-multiple" name="genero[]" multiple="multiple"  autofocus>
                            @foreach($generos as $genero)
                                <option value="{{$genero->id}}" {{ (old('genero') != null) ? (in_array($genero->id,old('genero')) ? 'selected=selected' : '') : ((isset($novel) and in_array($genero->id,$novel->genero->pluck('id')->toArray())) ? 'selected=selected' : '')}}>{{$genero->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_element{{ $errors->has('autor') ? ' has-error' : '' }}">
                        <label for="">Autor</label>
                        @if ($errors->has('autor'))
                            <span class="help-autor">
                                {{ $errors->first('autor') }}
                            </span>
                        @endif
                        <input type="text" name="autor" id="autor" value="{{ old('autor') != null ? old('autor') : (isset($novel) ? $novel->autor : '')}}" autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('tradutor') ? ' has-error' : '' }}">
                        <label for="">Tradutor</label>
                        @if ($errors->has('tradutor'))
                            <span class="help-tradutor">
                                {{ $errors->first('tradutor') }}
                            </span>
                        @endif
                        <input type="text" name="tradutor" id="tradutor" value="{{ old('tradutor') != null ? old('tradutor') : (isset($novel) ? $novel->tradutor : '')}}" autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('editor') ? ' has-error' : '' }}">
                        <label for="">Editor</label>
                        @if ($errors->has('editor'))
                            <span class="help-editor">
                                {{ $errors->first('editor') }}
                            </span>
                        @endif
                        <input type="text" name="editor" id="editor" value="{{ old('editor') != null ? old('editor') : (isset($novel) ? $novel->editor : '')}}" autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('linguagem') ? ' has-error' : '' }}">
                        <label for="">Linguagem Original</label>
                        @if ($errors->has('linguagem'))
                            <span class="help-linguagem">
                                {{ $errors->first('linguagem') }}
                            </span>
                        @endif
                        <select class="js-linguagem-basic-single" name="linguagem" id="linguagem">
                            <option value=""></option>
                            @foreach($linguagens as $linguagem)
                            <option value="{{$linguagem->id}}" {{ old('linguagem') != null ? (old('linguagem') == $linguagem->id ? 'selected' : ''): (isset($novel) ? ($novel->linguagem_id == $linguagem->id ? 'selected' : '') : '')}}>{{$linguagem->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_element{{ $errors->has('tipo') ? ' has-error' : '' }}">
                        <label for="">Tipo</label>
                        @if ($errors->has('tipo'))
                            <span class="help-tipo">
                                {{ $errors->first('tipo') }}
                            </span>
                        @endif
                        <select class="js-tipo-basic-single" name="tipo" id="tipo">
                            <option value=""></option>
                            @foreach($tipos as $tipo)
                            <option value="{{$tipo->id}}" {{ old('tipo') != null ? (old('tipo') == $tipo->id ? 'selected' : ''): (isset($novel) ? ($novel->tipo_id == $tipo->id ? 'selected' : '') : '')}}>{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_element{{ $errors->has('status') ? ' has-error' : '' }}">
                        <label for="">Status</label>
                        @if ($errors->has('status'))
                            <span class="help-linguagem">
                                {{ $errors->first('status') }}
                            </span>
                        @endif
                        <select class="js-status-basic-single" name="status" id="status">
                            <option value=""></option>
                            @foreach($array_status as $status)
                            <option value="{{$status}}" {{ old('status') != null ? (old('status') == $status ? 'selected' : ''): (isset($novel) ? ($novel->status == $status ? 'selected' : '') : '')}}>{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                </fieldset>
                <fieldset class="info-geral">
                    <div class="form_element{{ $errors->has('sinopse') ? ' has-error' : '' }}">
                        <label for="">Sinopse</label>
                        @if ($errors->has('sinopse'))
                            <span class="help-sinopse">
                                {{ $errors->first('sinopse') }}
                            </span>
                        @endif
                        <textarea name="sinopse" id="sinopse">{{ old('sinopse') != null ? old('sinopse') : (isset($novel) ? $novel->sinopse : '')}}</textarea>
                    </div>
                </fieldset>
                <fieldset class="action">
                    <div class="form_element">
                        <input class="btn-submit" type="submit" value="Enviar">
                    </div>
                </fieldset>


            </form>
        </div>
    </div>
    <!-- /Conteudo Principal [Modelo] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Modelo] -->
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('dist/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.js-genero-basic-multiple').select2({
                tags: true
            })
            $('.js-linguagem-basic-single').select2({
                tags: true
            })
            $('.js-status-basic-single').select2({
                tags: true
            })
            $('.js-tipo-basic-single').select2({
                tags: true
            })
            function readURL(input) {        
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('img.capa').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#capa").change(function(){
                readURL(this);
            });
        });
    </script>
<!-- /Footer Personalizado [Modelo] -->
@endpush