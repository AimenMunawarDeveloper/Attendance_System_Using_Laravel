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
                <a href="{{ route('classes.DisplayAllClasses') }}" class="px-6 py-4 text-white rounded-md text-lg" style="background:#1D4ED8">
                    Enroll in a Class
                </a>
            </div>
            <!-- Container for classes -->
            <div class="container mt-8">
                <h1 class="text-2xl font-bold mb-4 text-white">Your Classes</h1>
                @if($classes->isEmpty())
                    <p>You haven't created any classes yet.</p>
                @else
                    <!-- Table for displaying classes -->
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b text-left">Class Name</th>
                                <th class="py-2 px-4 border-b text-left">Start Time</th>
                                <th class="py-2 px-4 border-b text-left">End Time</th>
                                <th class="py-2 px-4 border-b text-left">Credit Hours</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $class)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $class->classname }}</td>
                                    <td class="py-2 px-4 border-b">{{ $class->starttime }}</td>
                                    <td class="py-2 px-4 border-b">{{ $class->endtime }}</td>
                                    <td class="py-2 px-4 border-b">{{ $class->credit_hours }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
