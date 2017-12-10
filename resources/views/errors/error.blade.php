@extends('layouts.app')

@section('content')

    <div class="container" style="text-align: center">

        <div class="alert alert-danger pm-error">
            <h1>Whoops, looks like something went wrong.</h1>

            @if (!empty($errorMessage))
                <h3>{{ $errorMessage }}</h3>
            @endif

        </div>

        <div><img src="{{asset('img/squashed-tomato.png')}}"/></div>

    </div>

@endsection