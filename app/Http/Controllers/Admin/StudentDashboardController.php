<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentDashboard;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Major;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $grade = $request->input('grade');
        $major = $request->input('major');

        $studentsQuery = Student::with('grade');

        if ($search) {
            $studentsQuery->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        if ($grade) {
            $studentsQuery->whereHas('grade', function ($query) use ($grade) {
                $query->where('grade', $grade);
            });
        }

        if ($major) {
            $studentsQuery->whereHas('grade.major', function ($query) use ($major) {
                $query->where('nama', $major);
            });
        }

        $students = $studentsQuery->paginate(25);
        $title = "Students";

        if ($request->ajax()) {
            return view('admin.student.partials.student-table', compact('students'));
        }

        return view('admin.student.index', compact('students', 'title'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.student.create', [
            'title' => 'Create New Data',
            'grades' => Grade::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input (excluding grade_id)
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required',
            'alamat'  => 'required|string|max:255',
            'grade'   => 'required|string',
            'major_id'=> 'required|exists:majors,id',
            'class_number' => 'required|string'
        ]);

        // Find the corresponding grade_id
        $grade = Grade::all()
            ->where('grade', $validated['grade'])
            ->where('major_id', $validated['major_id'])
            ->where('class_number', $validated['class_number'])
            ->first();

        // If no matching grade is found, return an error
        if (!$grade) {
            return back()->withErrors(['grade_id' => 'Invalid grade selection.'])->withInput();
        }

        // Store the student
        Student::create([
            'nama'     => $validated['nama'],
            'grade_id' => $grade->id,
            'email'    => $validated['email'],
            'alamat'   => $validated['alamat'],
        ]);


        return redirect('/admin/students')->with('success', 'Student updated successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(StudentDashboard $studentDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrfail($id);
        $grades = Grade::all();
        $majors = Major::all();

        return view('admin.student.edit', [
            'title' => 'Edit student data',
            'student' => $student,
            'grades'  => $grades,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required',
            'alamat'  => 'required|string|max:255',
            'grade'   => 'required|string',
            'major_id'=> 'required|integer',
            'class_number' => 'required|string'
        ]);

        $grade = Grade::all()
            ->where('grade', $validated['grade'])
            ->where('major_id', $validated['major_id'])
            ->where('class_number', $validated['class_number'])
            ->first();
        $student = Student::findOrFail($id);

        $student->update([
            'nama'     => $validated['nama'],
            'grade_id' => $grade->id,
            'email'  => $validated['email'],
            'alamat' => $validated['alamat']
        ]);

        return redirect('/admin/students')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect('/admin/students')->with('success', 'Student deleted successfully');
    }
}
