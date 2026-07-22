<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        $classes = ClassRoom::all();
        $students = [];
        $selected_class = $request->class_room_id;

        if ($selected_class) {
            $students = Student::where('class_room_id', $selected_class)->get();
        }

        return view('attendance.create', compact('classes', 'students', 'selected_class'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array', 
            'attendance.*' => 'required|in:present,absent,late',
        ]);

        $date = $request->date;

        foreach ($request->attendance as $student_id => $status) {
            Attendance::updateOrCreate(
                ['student_id' => $student_id, 'date' => $date], 
                ['status' => $status]                           
            );
        }
            
        return redirect()->back()->with('success', $date . 'Updated Absent or Attendance or Late');
    }
}