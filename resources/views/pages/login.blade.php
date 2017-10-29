@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="login-panel card-container">

            <h1>{{config('app.name')}}</h1>
            <img class="login-img-card" src="{{asset('img/tomato-timer.png')}}"/>

            <form action="{{ route('login') }}" method="POST" class="signin-form">
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
                    Sign in
                </button>
            </form>

        </div>
    </div>

@endsection
