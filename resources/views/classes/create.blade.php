@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="background-color: #f8f9fa; height: 100vh; padding: 80px;">
<button class="mb-4"><a href="{{ route('dashboard') }}"><i class="fa fa-angle-left fa-lg"></i></a></button>
    <div class="w-100 h-100 dark:bg-gray-700 text-white" style="padding:10px;max-width:600px">

        <h1>Create Class</h1>
        <form action="{{ route('classes.store') }}" method="POST" class="shadow-lg" style="padding: 10px;">
            @csrf
            <input type="hidden" name="teacherid" value="{{ auth()->user()->id }}">
            <div class="mb-3">
                <label for="classname" class="form-label">Class Name</label>
                <input type="text" name="classname" id="classname" class="form-control" style="color: #000;" value="{{ old('classname') }}" required>
                @error('classname') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="starttime" class="form-label">Start Time</label>
                <input type="time" name="starttime" id="starttime" class="form-control" style="color: #000;" value="{{ old('starttime') }}" required>
                @error('starttime') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="endtime" class="form-label">End Time</label>
                <input type="time" name="endtime" id="endtime" class="form-control " style="color: #000;" value="{{ old('endtime') }}" required>
                @error('endtime') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="credit_hours" class="form-label">Credit Hours</label>
                <input type="number" name="credit_hours" id="credit_hours" class="form-control" style="color: #000;" value="{{ old('credit_hours') }}" required>
                @error('credit_hours') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn dark:bg-gray-200 rounded text-black" style="padding:10px;margin:10px">Create Class</button>
        </form>
    </div>
</div>
@endsection
