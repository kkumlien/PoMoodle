@extends('layouts.app')

@section('content')

    <div ng-controller="StudentController as vm" class="container">

        @include('layouts.header')

        @include('layouts.menu')

        <div class="student-home">

            @foreach($user->courses as $course)

                <h3>{{$course->fullname}}</h3>

                <table class="activities-table">

                    <thead>
                    <tr>
                        <th>
                            Activity Name
                        </th>
                        <th>
                            Completed Date
                        </th>
                        <th>
                            Time
                        </th>
                        <th>
                            Edit Time
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($course->topics as $topic)

                        @if($topic->name != "General")
                            @foreach($topic->modules as $module)

                                <tr>
                                    <td>
                                        {{$module->name}}
                                    </td>
                                    <td>
                                        N/A
                                    </td>
                                    <td>
                                        N/A
                                    </td>
                                    <td>
                                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                                    </td>
                                </tr>

                            @endforeach
                        @endif

                    @endforeach
                    </tbody>

                </table>

            @endforeach

        </div>

    </div>

@endsection