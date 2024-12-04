@extends('layouts.app')

@section('content')
<!-- Modal -->
<!-- Modal content -->
<div class="container d-flex justify-content-center align-items-center" style="background-color: #f8f9fa;">
<form action="{{ route('attendance.save', $classid) }}" method="POST">
    @csrf
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($students->isEmpty())
            <p>No students currently enrolled in this class.</p>
        @else
            @foreach($students as $student)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h5 class="text-xl font-semibold mb-2">{{ $student->fullname }}</h5>
                    <p class="text-gray-600 mb-4">Attendance:</p>
                    <input type="hidden" name="attendance[{{ $student->id }}]" value="0">
                    <input type="checkbox" name="attendance[{{ $student->id }}]" id="attendance_{{ $student->id }}" class="form-check-input" value="1">
                    <label for="attendance_{{ $student->id }}" class="form-check-label">Present</label>
                </div>
            @endforeach
        @endif
    </div>
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Save Attendance</button>
    </div>
</form>
@endsection

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
