<h1>Plain Page</h1>


@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@header', 'tpl'=>'show'])

<hr>
@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@body', 'tpl'=>'show'])