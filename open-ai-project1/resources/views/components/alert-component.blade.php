@props(['type'])
<div class="alert alert-{{$type}} alertt" role="alert">
    {{$slot}}
</div>