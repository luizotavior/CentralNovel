<div id="recomend-novel" class="painel">
    <h2>{{$titulo}}</h2>
    <ul class="recomend-novels">
        @foreach($novels as $novel)
        <li class="recomend-item">
            @component('components.novel',['novel' => $novel,'class' => 'recomendado']))
            @endcomponent
        </li>
        @endforeach
    </ul>
</div>