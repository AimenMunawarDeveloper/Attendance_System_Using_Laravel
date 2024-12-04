<?php
namespace App\Http\Controllers;
use App\Models\ClassModel;
use App\Models\ClassStudent;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
    public function displayStudentsEnrolledInAClass($classid){
        $class = ClassModel::find($classid);
        if (!$class) {
            return redirect()->route('classes.DisplayAllClasses')->with('error', 'Class not found');
        }
        $students = $class->students;  
        return view('classes.displayStudentsInAClass',compact('students', 'classid'));
    }
    public function saveAttendance(Request $request, $classid)
    {
        $class = ClassModel::find($classid);
        if (!$class) {
            return redirect()->route('classes.DisplayAllClasses')->with('error', 'Class not found');
        }
        if ($request->has('attendance')) {
            foreach ($request->attendance as $studentid => $isPresent) {
                $attendance = Attendance::where('classid', $classid)
                                        ->where('studentid', $studentid)
                                        ->first();
                if ($attendance) {
                    $attendance->isPresent = $isPresent ? 1 : 0;
                    $attendance->date = Carbon::now(); 
                    $attendance->save(); 
                } else {
                    $attendance = new Attendance();
                    $attendance->classid = $classid;
                    $attendance->studentid = $studentid;
                    $attendance->isPresent = $isPresent ? 1 : 0; 
                    $attendance->date = Carbon::now();
                    $attendance->save(); 
                }
            }
        }
        return redirect()->route('dashboard')->with('success', 'Attendance saved successfully');
    }
}
