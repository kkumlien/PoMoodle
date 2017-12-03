@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="login-panel card-container">

            <img class="login-img-card" src="{{asset('img/tomato-timer.png')}}"/>

            @if (!empty($successMessage))
                <div class="alert alert-success">
                        <p>{{ $successMessage }}</p>
                </div>
            @endif

            @if (!empty($errorMessage))
                <div class="alert alert-danger">
                    <p>{{ $errorMessage }}</p>
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="signin-form">
                {{ csrf_field() }}
                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="username"
                       required
                       autofocus>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="password"
                       required>
                <input type="text"
                       name="moodleSite"
                       class="form-control"
                       placeholder="moodle site"
                       required>
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin">
                    Log in
                </button>
            </form>

        </div>
    </div>

@endsection
