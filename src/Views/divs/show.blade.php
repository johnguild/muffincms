<div class="content" @if($div->image) style="url('{{$div->image}}')" @endif>
    @include('texts.index', ['data' => $modules['Text'], 
    						'loc'=>'div'.$div->id.'-'.makeSlug($div->title), 
    						'view'=>'show', 
    						'opt'=>1, 'conf'=>0, 
    						'limit'=>1])
    <ul class="actions">
        <li>
            <a href="#" class="button alt">More</a>
        </li>
    </ul>
</div>