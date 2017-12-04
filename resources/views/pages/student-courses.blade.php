@extends('layouts.app')

@section('content')

    <div ng-controller="StudentCoursesController as vm" class="container">

        @include('layouts.header')

        @include('layouts.menu')

        <div class="student-courses">

            <h2>{{$course->fullname}}</h2>

            @foreach($course->topics as $topic)
                @if($topic->name != "General")

                    <h3>{{$topic->name}}</h3>

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

                        @foreach($topic->modules as $module)

                            <tr>
                                <td>
                                    {{$module->name}}
                                </td>
                                <td>
                                    @if($module->completionStatus->state = 1)
                                        {{gmdate("Y-m-d", $module->completionStatus->timecompleted)}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <span ng-bind="vm.activity['_{{$module->completionStatus->cmid}}']"></span>
                                </td>
                                <td>
                                    <button ng-click="vm.openModal('{{$module->completionStatus->cmid}}', '{{$module->name}}', '{{$module->completionStatus->duration_in_minutes}}')"
                                            class="btn btn-primary">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                @endif
            @endforeach

        </div>

    </div>

@endsection