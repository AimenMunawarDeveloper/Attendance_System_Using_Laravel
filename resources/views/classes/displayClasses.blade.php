@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="background-color: #f8f9fa; height: 100vh; padding: 80px;">
    <h1>Enroll in a class now</h1>

    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($classes->isEmpty())
            <p>No classes available at the moment.</p>
        @else
            @foreach($classes as $class)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h5 class="text-xl font-semibold mb-2">{{ $class->classname }}</h5>
                    <p class="text-gray-600 mb-4">Start time: {{ $class->starttime }}</p>
                    <p class="text-gray-600 mb-4">End time:{{ $class->endtime }}</p>
                    <form action="{{ route('classes.enroll', $class->id) }}" method="GET">
        <button type="submit">Enroll Now</button>
    </form> 
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
