<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class StudentController extends Controller {
    
    public function index() {
        $students = Student::with('classRoom')->get();
        return view('students.index', compact('students'));
    }

    public function create() {
        $classes = ClassRoom::all();
        return view('students.create', compact('classes'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'roll_no' => 'required|string',
            'class_room_id' => 'required|exists:class_rooms,id',
            'email' => 'required|email|unique:students,email',
            'dob' => 'required|date',
        ]);

        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Registe Successfully!');
    }

    public function edit($id) {
        $student = Student::findOrFail($id);
        $classes = ClassRoom::all();
        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, $id) {
        $student = Student::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'roll_no' => 'required|string',
            'class_room_id' => 'required|exists:class_rooms,id',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'dob' => 'required|date',
        ]);

        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Updated Successfully!');
    }

    public function destroy($id) {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Deleted Successfully!');
    }
}