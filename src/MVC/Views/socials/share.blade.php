<style type="text/css">
    .twitter-share-button{
        vertical-align: bottom;
    }
</style>
@if(isset($facebook))
<div class="fb-share-button" data-href="{{Request::url()}}" data-layout="button" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
@endif
@if(isset($twitter))
<a class="twitter-share-button"
  href="https://twitter.com/intent/tweet?text={{$post->title}}">
Tweet</a>
@endif