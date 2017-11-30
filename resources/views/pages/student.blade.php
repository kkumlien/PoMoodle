@extends('layouts.app')

@section('content')

    <div class="container">

        @include('layouts.header')

        @include('layouts.menu')

        <div class="student-home">

            @foreach($user->courses as $course)

                <div class="course-container well">
                    <h3><a href="/course?id={{$course->id}}">{{$course->fullname}}</a></h3>
                    <div>
                        {!! $course->summary !!}
                    </div>
                </div>

            @endforeach

        </div>

    </div>

@endsection