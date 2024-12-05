@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <h1 class="text-white" style="margin-top: 20px;">Hello Student!</h1>
            <div style="display: flex; justify-content: center; margin-top: 50px;">
                <a href="{{ route('classes.DisplayAllClasses') }}" class="px-6 py-4 text-white rounded-md text-lg dark:bg-gray-700" >
                    Enroll in a Class
                </a>
            </div>
            <div class="container mt-8">
                <h2 class="text-xl font-bold mb-4 text-white">Your Attendance Progress</h2>
                @php
                    // Calculate the total number of classes and attended classes
                    $totalClasses = $classes->count();
                    $attendedClasses = $classes->filter(function($class) {
                        return $class->attendance_status == 'Present';
                    })->count();

                    // Calculate the attendance percentage
                    $attendancePercentage = $totalClasses > 0 ? ($attendedClasses / $totalClasses) * 100 : 0;
                @endphp
                <div class="w-full max-w-sm rounded-full h-6">
                    <div class="h-6 rounded-full flex items-center justify-center text-white text-sm" style="width: {{ $attendancePercentage }}%; background-color: 
                        @if($attendancePercentage < 75) red 
                        @elseif($attendancePercentage >= 75 && $attendancePercentage < 85) yellow 
                        @else green 
                        @endif">
                        {{ round($attendancePercentage, 2) }}%
                    </div>
                </div>
                <p class="text-white mt-2">Attendance: {{ round($attendancePercentage, 2) }}%</p>
            </div>
            <div class="container mt-8">
                <h1 class="text-2xl font-bold mb-4 text-white">Your Classes</h1>
                @if($classes->isEmpty())
                    <p>You haven't created any classes yet.</p>
                @else
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b text-left">Class Name</th>
                                <th class="py-2 px-4 border-b text-left">Start Time</th>
                                <th class="py-2 px-4 border-b text-left">End Time</th>
                                <th class="py-2 px-4 border-b text-left">Credit Hours</th>
                                <th class="py-2 px-4 border-b text-left">Attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $class)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $class->classname }}</td>
                                    <td class="py-2 px-4 border-b">{{ $class->starttime }}</td>
                                    <td class="py-2 px-4 border-b">{{ $class->endtime }}</td>
                                    <td class="py-2 px-4 border-b">{{ $class->credit_hours }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @if(isset($class->attendance_status))
                                            {{ $class->attendance_status }}
                                        @else
                                            No Record
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
