@extends('layouts.app')

@section('content')

    <div ng-controller="StudentCoursesController as vm" class="container">

        @include('layouts.header')

        @include('layouts.menu')

        <div class="student-courses">

            <h2>{{$course->fullname}}</h2>

            @foreach($course->topics as $topic)

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
                            Duration
                        </th>
                        <th>
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
                                @if($module->completionStatus->state == 1)
                                    {{gmdate("Y-m-d", $module->completionStatus->timecompleted)}}
                                @endif
                            </td>
                            <td>
                                <span ng-bind="vm.activity['_{{$module->completionStatus->cmid}}']"></span>
                            </td>
                            <td>
                                <button ng-click="vm.openModal('{{$module->completionStatus->cmid}}', '{{$module->name}}', '{{$module->completionStatus->duration_in_minutes}}')"
                                        ng-disabled="{{$module->completionStatus->state != 1}}"
                                        class="btn btn-primary">
                                    Edit
                                </button>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            @endforeach

        </div>
    </div>

@endsection