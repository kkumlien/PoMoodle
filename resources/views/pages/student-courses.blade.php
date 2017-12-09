@extends('layouts.app')

@section('content')

    <div ng-controller="StudentCoursesController as vm" class="container">

        @include('layouts.header')

        @include('layouts.menu')

        <div class="student-courses">

            <h2>{{$course->fullname}}</h2>

            @foreach($course->topics as $topic)

                    @foreach($topic->modules as $module)

                        @if(!empty($module->completionStatus))

                            @if($loop->first)

                            <h3>{{$topic->name}}</h3>

                            <table class="activities-table">

                            <thead>
                                <tr>
                                    <th>
                                        Activity
                                    </th>
                                    <th>
                                        Completed
                                    </th>
                                    <th>
                                        Duration
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>

                            @endif

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

                            @if($loop->last)

                                </tbody>
                            </table>

                            @endif

                        @endif

                    @endforeach

            @endforeach

        </div>
    </div>

@endsection