<?php
namespace App\Http\Controllers;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Validator;
class ClassController extends Controller
{
    //using view helper we load the blade template called classes.create
    public function create(){
        return view("classes.create");
    }
    // handle form submission
    public function store(Request $request){
        $validatedData=$request->validate([
            'teacherid'=>'required|exists:users,id',
            'classname'=>'required|string|max:255',
            'starttime'=>'required|date_format:H:i',
            'endtime'=>'required|date_format:H:i',
            'credit_hours'=>'required|integer|min:1'
        ]);
        ClassModel::create($validatedData);// automatically maps key in validated data to columns in classes table
        return redirect()->route('dashboard')->with('success',"class created successfully");
    }
    // to display all classes for student
    public function DisplayAllClasses(){
        $classes=ClassModel::all();
        return view("classes.displayClasses",compact('classes'));
    }
    public function enroll($classid)
    {
        $class = ClassModel::find($classid);
        if (!$class) {
            return redirect()->route('classes.DisplayAllClasses')->with('error', 'Class not found');
        }
        $student = auth()->user();
        if ($student->student->contains($classid)) {
            return redirect()->route('classes.DisplayAllClasses')->with('error', 'You are already registered in this class');
        }else{
            $student->student()->attach($classid);
            return redirect()->route('classes.DisplayAllClasses')->with('success', 'You have been enrolled in the class');
        }
    }   
}
