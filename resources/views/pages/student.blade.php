@extends('layouts.app')

@section('content')

    <div ng-controller="StudentController as vm" class="container">

    @include('layouts.header')

    <!-- link the file to this file -->
        @include('layouts.menu')

        <div class="student-home">

            <h3> Team Project</h3>

            <table id="Team Project">
                <thead>

                <tr>
                    <th> Activity name</th>

                    <th>Completed Date</th>

                    <th>Time</th>

                    <th>Edit time</th>
                </tr>

                </thead>

                <tbody>

                <tr class="even">
                    <td>
                        Module Description
                    </td>
                    <td>
                        04-11-2017
                    </td>
                    <td>
                        1 hour
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>

                    </td>
                </tr>


                <tr>
                    <td>
                        Project Proposal File
                    </td>
                    <td>
                        04-11-2017
                    </td>
                    <td>
                        2 hours
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                <tr class="even">
                    <td>
                        Requirements Specification
                    </td>
                    <td>
                        06-10-2017
                    </td>
                    <td>
                        1 hour
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        Sprint Cycle/Scrum
                    </td>
                    <td>
                        08-10-2017
                    </td>
                    <td>
                        3 hours
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                </tbody>

            </table>


            <h3> Advanced Programming</h3>
            <table id="Advanced Programming">
                <thead>
                <tr>
                    <th>
                        Activity name
                    </th>
                    <th>
                        Completed Date
                    </th>
                    <th>
                        Time
                    </th>
                    <th>
                        Edit time
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr class="even">
                    <td>
                        Introduction to Algorithms
                    </td>
                    <td>
                        04-11-2017
                    </td>
                    <td>
                        1 hour
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        Revision ArrayList
                    </td>
                    <td>
                        04-10-2017
                    </td>
                    <td>
                        3 hours
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                <tr class="even">
                    <td>
                        RevisionArrayList Solution
                    </td>
                    <td>
                        06-8-2017
                    </td>
                    <td>
                        1 hour
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        RevisionNetBeans
                    </td>
                    <td>
                        08-8-2017
                    </td>
                    <td>
                        3 hours
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                </tbody>

            </table>


            <h3> Wireless Networking</h3>
            <table id="Wireless Networking">
                <thead>
                <tr>
                    <th>
                        Activity name
                    </th>
                    <th>
                        Completed Date
                    </th>
                    <th>
                        Time
                    </th>
                    <th>
                        Edit time
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr class="even">
                    <td>
                        Module Overview
                    </td>
                    <td>
                        20-10s-2017
                    </td>
                    <td>
                        1 hour
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        Introduction to Wireless Networking
                    </td>
                    <td>
                        023-10-2017
                    </td>
                    <td>
                        2 hours
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                <tr class="even">
                    <td>
                        Introduction to Internet of Things
                    </td>
                    <td>
                        15-8-2017
                    </td>
                    <td>
                        1 hour
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        Networking Overview
                    </td>
                    <td>
                        08-7-2017
                    </td>
                    <td>
                        2 hours
                    </td>
                    <td>
                        <button ng-click="vm.openModal()" class="btn btn-primary">Edit</button>
                    </td>
                </tr>

                </tbody>

            </table>


        </div>

        <br>
        </br>
        <br>
        </br>

    </div>

@endsection