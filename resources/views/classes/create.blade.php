@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="background-color: #f8f9fa; height: 100vh; padding: 80px;">
    <div class="w-100" style="max-width: 600px;">
        <h1>Create Class</h1>
        <form action="{{ route('classes.store') }}" method="POST" class="shadow-lg" style="background-color: #1D4ED8;height: 40vh;color:white;padding:10px">
            @csrf
            <div class="mb-3">
                <label for="teacherid" class="form-label">Teacher ID</label>
                <input type="number" name="teacherid" id="teacherid" class="form-control" style="color: #000;" value="{{ old('teacherid') }}" required>
                @error('teacherid') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
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
                <input type="time" name="endtime" id="endtime" class="form-control" style="color: #000;" value="{{ old('endtime') }}" required>
                @error('endtime') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="credit_hours" class="form-label">Credit Hours</label>
                <input type="number" name="credit_hours" id="credit_hours" class="form-control" style="color: #000;" value="{{ old('credit_hours') }}" required>
                @error('credit_hours') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Class</button>
        </form>
    </div>
</div>
@endsection
