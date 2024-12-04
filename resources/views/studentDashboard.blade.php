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
        </div>
    </div>
@endsection
