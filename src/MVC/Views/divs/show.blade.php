<article class="feature @if($key%2==0) left @else right @endif">
    @if($div->image)
        <span class="image"><img src="{{$div->image}}" alt="" /></span>
    @endif
    <div class="content" >
        @include('texts.index', ['data' => $modules['Text'], 
                                'loc'=>'home-articles-'.$div->id, 
                                'view'=>'show', 
                                'opt'=>1, 'conf'=>0, 
                                'limit'=>1])
        <ul class="actions">
            <li>
                <a href="#" class="button alt">More</a>
            </li>
        </ul>
    </div>
</article>

