@if(isset($novel))
<div class="card-novel">
    <a href="{{route("novel",$novel->url)}}">
        @if(Storage::disk('gcs')->exists($novel->capa))
            <img src="{{ Storage::disk('gcs')->url($novel->capa) }}" alt="{{$novel->titulo}}">
        @else        
            <img src="{{ Storage::disk('gcs')->url('novels/default.jpg')}}" alt="Novel sem capa">
        @endif
        <h2>{{$novel->titulo}}</h2>
    </a>
    @if($novel->genero->count() >0)
    <a href="{{route('novels')}}?genero={{$novel->genero->shuffle()->first()->id}}">
        <span class="tag">{{$novel->genero->shuffle()->first()->nome}}</span>
    </a>
    @endif
    <div id="rating">
        <fieldset class="rating">
                <input type="radio" id="star5-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="5" {{($novel->avgRating >= 5.0)?'checked':''}}/>
                <label class = "full" title="Impressionante - 5 stars"></label>
                <input type="radio" id="star4half-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="4 and a half" {{($novel->avgRating >=4.5 and $novel->avgRating < 5)?'checked':''}}/>
                <label class="half" title="Muito bom - 4.5 stars"></label>
                <input type="radio" id="star4-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="4" {{($novel->avgRating >=4.0 and $novel->avgRating < 4.5)?'checked':''}}/>
                <label class = "full" title="Muito bom - 4 stars"></label>
                <input type="radio" id="star3half-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="3 and a half" {{($novel->avgRating >=3.5 and $novel->avgRating < 4)?'checked':''}}/>
                <label class="half" title="Um pouco bom - 3.5 stars"></label>
                <input type="radio" id="star3-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="3" {{($novel->avgRating >=3.0 and $novel->avgRating < 3.5)?'checked':''}}/>
                <label class = "full" title="Razoável - 3 stars"></label>
                <input type="radio" id="star2half-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="2 and a half" {{($novel->avgRating >=2.5 and $novel->avgRating < 3)?'checked':''}}/>
                <label class="half" title="Um pouco ruim - 2.5 stars"></label>
                <input type="radio" id="star2-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="2" {{($novel->avgRating >=2.0 and $novel->avgRating < 2.5)?'checked':''}}/>
                <label class = "full"  title="Um pouco ruim - 2 stars"></label>
                <input type="radio" id="star1half-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="1 and a half" {{($novel->avgRating >=1.5 and $novel->avgRating < 2)?'checked':''}}/>
                <label class="half"  title="Muito ruim - 1.5 stars"></label>
                <input type="radio" id="star1-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="1" {{($novel->avgRating >=1.0 and $novel->avgRating < 1.5)?'checked':''}}/>
                <label class = "full" title="Muito ruim - 1 star"></label>
                <input type="radio" id="starhalf-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" name="rating-{{ (isset($class) ? $class : 'rank') }}-{{$novel->id}}" value="half" {{($novel->avgRating >=0.5 and $novel->avgRating < 1)?'checked':''}}/>
                <label class="half" title="Pessimo - 0.5 stars"></label>
            </fieldset>
        <span class="rating-value">{{number_format($novel->avgRating, 1, '.', ',')}}</span>
    </div>
</div>
@endif