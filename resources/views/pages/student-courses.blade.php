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
                        <th style="width: 70%">
                            Activity
                        </th>
                        <th style="width: 10%">
                            Completed
                        </th>
                        <th style="width: 10%; text-align: center">
                            Duration
                        </th>
                        <th style="width: 10%">
                        </th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($topic->modules as $module)

                        @if(!empty($module->completionStatus))

                            <tr>
                            <td style="width: 70%">
                                {{$module->name}}
                            </td>
                            <td style="width: 10%">
                                @if($module->completionStatus->state == 1)
                                    {{gmdate("Y-m-d", $module->completionStatus->timecompleted)}}
                                @endif
                            </td>
                            <td style="width: 10%; text-align: center">
                                {{ \App\Models\CompletionStatus::convertToHoursMins($module->completionStatus->duration_in_minutes) }}
                            </td>
                            <td style="width: 10%">
                                <button ng-click="vm.openModal('{{$module->completionStatus->cmid}}', '{{$module->name}}', '{{$module->completionStatus->duration_in_minutes}}')"
                                        ng-disabled="{{$module->completionStatus->state != 1}}"
                                        class="btn btn-primary">
                                    Edit
                                </button>
                            </td>
                            </tr>

                        @endif

                    @endforeach

                    </tbody>
                </table>

            @endforeach

        </div>
    </div>

@endsection