@extends('layouts.app')

@section('content')

    <div class="container">

        @include('layouts.header')

        @include('layouts.menu')

        <div class="student-home">

            @foreach($user->courses as $course)

                <div class="course-container well">
                    <div class="row">
                        <div class="col-xs-10">
                            <h3>
                                <a href="/course?courseId={{$course->id}}">{{$course->fullname}}</a>
                            </h3>
                            <div class="row course-summary">
                                {!! $course->summary !!}
                            </div>
                        </div>

                        <div class="col-xs-2 chart">
                            <a href="/trends?id={{$course->id}}">
                                <div class="chart-icon"></div>
                            </a>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

    </div>

@endsection