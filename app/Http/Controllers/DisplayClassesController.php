<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class DisplayClassesController extends Controller
{   
    // to display all classes
    public function DisplayAllClasses(){
        $classes=ClassModel::all();
        return view("classes.displayClasses",compact('classes'));
    }
    // to display classes of a specific teacher
    public function showUserClasses()
    {
        $user = auth()->user(); // getting currently logged in user
        $classes = $user->classes; // get all classes created by user
        return view('dashboard', compact('classes'));
    }
    // to display the classes in which a student is enrolled
    public function showStudentEnrolledClasses()
    {
        $user = auth()->user(); 
        $classes = $user->student()->with('attendances')->get();
        foreach ($classes as $class) {
            $attendance = $class->attendances->where('studentid', $user->id)->first();
            $class->attendance_status = $attendance ? ($attendance->isPresent ? 'Present' : 'Absent') : 'No Record';
        }
        return view('studentDashboard', compact('classes'));
    }
}
