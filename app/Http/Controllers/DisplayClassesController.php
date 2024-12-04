<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// to display classes of a specific teacher
class DisplayClassesController extends Controller
{
    public function showUserClasses()
    {
        $user = auth()->user(); // getting currently logged in user
        $classes = $user->classes; // get all classes created by user
        return view('dashboard', compact('classes'));
    }
}
