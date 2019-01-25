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
            @if(isset($grupo))
                <h2>Formulario de Alteração de Grupo</h2>
            @else
                <h2>Formulario de Inscrição de Grupo</h2>
            @endif
            <form class="form_default" action="{{ isset($grupo) ? route('dashboard.grupo.alt',['id'=>$grupo->id]) : route('dashboard.grupo.add')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset class="capa">
                        <div class="form_element{{ $errors->has('capa') ? ' has-error' : '' }}">
                            @if ($errors->has('capa'))
                                <span class="help-capa">
                                    {{ $errors->first('capa') }}
                                </span>
                            @endif
                            <label class="click" for="capa">
                            @if(isset($grupo) and Storage::disk('gcs')->exists($grupo->capa))
                                <img class="capa" src="{{ Storage::disk('gcs')->url($grupo->capa) }}" alt="{{$grupo->titulo}}">
                            @else        
                                <img class="capa" src="{{ Storage::disk('gcs')->url('grupos/default.jpg') }}" alt="Novel sem capa">
                            @endif
                            </label>
                            <input type="file" name="capa" id="capa"  accept=".jpg, .jpeg, .png">
                            <span class="legenda">Tamanho Máximo: 500kb.</span>
                            <span class="legenda">Dimensões: 300x300.</span>
                            <span class="legenda">Formato: jpg/Png.</span>
                        </div>
                </fieldset>
                <fieldset class="info-principal">
                    <div class="form_element{{ $errors->has('nome') ? ' has-error' : '' }}">
                        <label for="">Nome</label>
                        @if ($errors->has('nome'))
                            <span class="help-nome">
                                {{ $errors->first('nome') }}
                            </span>
                        @endif
                        <input type="text" name="nome" id="nome" value="{{ old('nome') != null ? old('nome') : (isset($grupo) ? $grupo->nome : '')}}" required autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('patrocinar') ? ' has-error' : '' }}">
                        <label for="">Patrocinar</label>
                        @if ($errors->has('patrocinar'))
                            <span class="help-patrocinar">
                                {{ $errors->first('patrocinar') }}
                            </span>
                        @endif
                        <input type="text" name="patrocinar" id="patrocinar" value="{{ old('patrocinar') != null ? old('patrocinar') : (isset($grupo) ? $grupo->patrocinar : '')}}" autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('site') ? ' has-error' : '' }}">
                        <label for="">Site</label>
                        @if ($errors->has('site'))
                            <span class="help-site">
                                {{ $errors->first('site') }}
                            </span>
                        @endif
                        <input type="text" name="site" id="site" value="{{ old('site') != null ? old('site') : (isset($grupo) ? $grupo->site : '')}}" autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('feed') ? ' has-error' : '' }}">
                        <label for="">Feed</label>
                        @if ($errors->has('feed'))
                            <span class="help-feed">
                                {{ $errors->first('feed') }}
                            </span>
                        @endif
                        <input type="text" name="feed" id="feed" value="{{ old('feed') != null ? old('feed') : (isset($grupo) ? $grupo->feed : '')}}" autofocus>
                    </div>
                    <div class="form_element{{ $errors->has('categoria') ? ' has-error' : '' }}">
                        <label for="">Categoria</label>
                        @if ($errors->has('linguagem'))
                            <span class="help-categoria">
                                {{ $errors->first('categoria') }}
                            </span>
                        @endif
                        <select class="js-categoria-basic-single" name="categoria" id="categoria">
                            <option value=""></option>
                            @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}" {{ old('categoria') != null ? (old('categoria') == $categoria->id ? 'selected' : ''): (isset($grupo) ? ($grupo->categoria_id == $categoria->id ? 'selected' : '') : '')}}>{{$categoria->nome}}</option>
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
                            <option value="{{$status}}" {{ old('status') != null ? (old('status') == $status ? 'selected' : ''): (isset($grupo) ? ($grupo->status == $status ? 'selected' : '') : '')}}>{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                </fieldset>
                <fieldset class="info-geral">
                    <div class="form_element{{ $errors->has('descricao') ? ' has-error' : '' }}">
                        <label for="">Descrição</label>
                        @if ($errors->has('descricao'))
                            <span class="help-descricao">
                                {{ $errors->first('descricao') }}
                            </span>
                        @endif
                        <textarea name="descricao" id="descricao">{{ old('descricao') != null ? old('descricao') : (isset($grupo) ? $grupo->descricao : '')}}</textarea>
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
            $('.js-status-basic-single').select2({
                tags: true
            })
            $('.js-categoria-basic-single').select2({
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