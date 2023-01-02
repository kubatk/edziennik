@extends('layouts.teacher')

@section('content')
<h1>
    Jesteś w grupie:
    @if (isset($usergroup))
        {{$usergroup}}
    @else
        Unknown
    @endif
</h1>
@endsection
