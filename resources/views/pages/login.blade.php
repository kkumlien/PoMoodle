@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="login-panel card-container">

            <img class="login-img-card" src="{{asset('img/tomato-timer.png')}}"/>

            @if ($errors->any())
                <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                </div>
            @endif

            @if (!empty($dangerMessage))
                <div class="alert alert-danger">
                    <p>{{ $dangerMessage }}</p>
                </div>
            @endif

            @if (!empty($successMessage))
                <div class="alert alert-success">
                        <p>{{ $successMessage }}</p>
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
    <!-- leo's code goes here-->
    @php
    function login($username, $password, $moodle_site){

        if ($moodle_site == "moodle.ie"){

            if ($username == 'finn' && $password == 'finn'){

                return "moodle and authentication are correct" ;
            }else{
                return "name and password arent correct";
            }
        }
        else{
            return "moodle site is not registered";
        }
    }//function brackets

    @endphp

    {{login("finn", "finn", "moodle.ie")}}

    <!--ends here -->




@endsection
