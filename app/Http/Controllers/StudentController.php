<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller 
{
    public function index(Request $request)
    {
        $classes = ClassRoom::all();
        $query = Student::with('classRoom');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('roll_no', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class_room_id')) {
            $query->where('class_room_id', $request->class_room_id);
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        return view('students.index', compact('students', 'classes'));
    }
    public function trash()
    {
        $students = Student::onlyTrashed()->with('classRoom')->latest()->paginate(10);
        return view('students.trash', compact('students'));
    }
    public function restore($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('students.trash')->with('success', 'Student restored successfully!');
    }
    public function forceDelete($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);

        if ($student->image && Storage::disk('public')->exists($student->image)) {
            Storage::disk('public')->delete($student->image);
        }

        $student->forceDelete();

        return redirect()->route('students.trash')->with('success', 'Student permanently deleted!');
    }

    public function create() 
    {
        $classes = ClassRoom::all();
        return view('students.create', compact('classes'));
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'roll_no'       => 'required|string|unique:students,roll_no',
            'class_room_id' => 'required|exists:class_rooms,id',
            'email'         => 'required|email|unique:students,email',
            'dob'           => 'required|date',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('students', 'public');
            $validated['image'] = $path; 
        }

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Registered Successfully!');
    }

    public function edit($id) 
    {
        $student = Student::findOrFail($id);
        $classes = ClassRoom::all();
        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, $id) 
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'roll_no'       => 'required|string|unique:students,roll_no,' . $student->id,
            'class_room_id' => 'required|exists:class_rooms,id',
            'email'         => 'required|email|unique:students,email,' . $student->id,
            'dob'           => 'required|date',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
            }

            $path = $request->file('image')->store('students', 'public');
            $validated['image'] = $path;
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Updated Successfully!');
    }

    public function destroy($id) 
    {
        $student = Student::findOrFail($id);

        if ($student->image && Storage::disk('public')->exists($student->image)) {
            Storage::disk('public')->delete($student->image);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Deleted Successfully!');
    }
}