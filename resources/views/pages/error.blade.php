@extends('layouts.app')

@section('content')

    <img src="{{asset('img/squashed-tomato.png')}}"/>

    @if (!empty($errorMessage))
        <div class="alert alert-danger">
            <p>{{ $errorMessage }}</p>
        </div>
    @endif

    <h2>error message</h2>
@endsection