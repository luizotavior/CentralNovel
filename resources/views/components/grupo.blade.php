@isset($grupo)
<div class="card-grupo">
    <a href="{{route("grupo",$grupo->url)}}">
        @if(Storage::disk('public')->exists($grupo->capa))
            <img src="{{asset("storage/".$grupo->capa)}}" alt="{{$grupo->titulo}}">
        @else        
            <img src="{{asset('images/grupos/default.jpg')}}" alt="Grupo sem capa">
        @endif
        <h2>{{$grupo->nome}}</h2>
        <span class="tag">{!! $grupo->descricao !!}</span>
    </a>
    <div id="rating">
        <fieldset class="rating">
            <input type="radio" id="star5-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="5" {{($grupo->avgRating >= 5.0)?'checked':''}}/>
            <label class = "full" title="Impressionante - 5 stars"></label>
            <input type="radio" id="star4half-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="4 and a half" {{($grupo->avgRating >=4.5 and $grupo->avgRating < 5)?'checked':''}}/>
            <label class="half" title="Muito bom - 4.5 stars"></label>
            <input type="radio" id="star4-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="4" {{($grupo->avgRating >=4.0 and $grupo->avgRating < 4.5)?'checked':''}}/>
            <label class = "full" title="Muito bom - 4 stars"></label>
            <input type="radio" id="star3half-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="3 and a half" {{($grupo->avgRating >=3.5 and $grupo->avgRating < 4)?'checked':''}}/>
            <label class="half" title="Um pouco bom - 3.5 stars"></label>
            <input type="radio" id="star3-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="3" {{($grupo->avgRating >=3.0 and $grupo->avgRating < 3.5)?'checked':''}}/>
            <label class = "full" title="Razoável - 3 stars"></label>
            <input type="radio" id="star2half-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="2 and a half" {{($grupo->avgRating >=2.5 and $grupo->avgRating < 3)?'checked':''}}/>
            <label class="half" title="Um pouco ruim - 2.5 stars"></label>
            <input type="radio" id="star2-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="2" {{($grupo->avgRating >=2.0 and $grupo->avgRating < 2.5)?'checked':''}}/>
            <label class = "full"  title="Um pouco ruim - 2 stars"></label>
            <input type="radio" id="star1half-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="1 and a half" {{($grupo->avgRating >=1.5 and $grupo->avgRating < 2)?'checked':''}}/>
            <label class="half"  title="Muito ruim - 1.5 stars"></label>
            <input type="radio" id="star1-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="1" {{($grupo->avgRating >=1.0 and $grupo->avgRating < 1.5)?'checked':''}}/>
            <label class = "full" title="Muito ruim - 1 star"></label>
            <input type="radio" id="starhalf-grupo-{{$grupo->id}}" name="rating-grupo-{{$grupo->id}}" value="half" {{($grupo->avgRating >=0.5 and $grupo->avgRating < 1)?'checked':''}}/>
            <label class="half" title="Pessimo - 0.5 stars"></label>
        </fieldset>
        <span class="rating-value">{{number_format($grupo->avgRating, 1, '.', ',')}}</span>
    </div>
</div>
@endisset