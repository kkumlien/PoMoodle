@extends('layouts.app')

@section('content')

    <div ng-controller="StudentController as vm" class="container">

        @include('layouts.header')

        @include('layouts.menu')

        <div class="student-home">

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
                                    @if($module->completionStatus->timecompleted > 0)
                                        {{gmdate("Y-m-d", $module->completionStatus->timecompleted)}}
                                    @endif
                                </td>
                                <td>
                                    N/A
                                </td>
                                <td>
                                    <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
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