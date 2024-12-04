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
        $user = auth()->user(); // getting currently logged in user
        $classes = $user->student; // get all classes created by user
        return view('studentDashboard', compact('classes'));
    }
}
