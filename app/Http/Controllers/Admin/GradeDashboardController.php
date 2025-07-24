<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GradeDashboard;
use App\Models\Grade;
use App\Models\Major;
use Illuminate\Http\Request;

class GradeDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $grade = $request->input('grade');
        $major = $request->input('major');

        $gradesQuery = Grade::with('major');

        if ($grade) {
            $gradesQuery->where('grade', $grade);
        }

        if ($major) {
            $gradesQuery->whereHas('major', function ($query) use ($major) {
                $query->where('nama', $major);
            });
        }

        $grades = $gradesQuery->paginate(25);
        $title = "Students";

        if ($request->ajax()) {
            return view('admin.grade.partials.grade-table', compact('grades'));
        }

        return view('admin.grade.index', [
            'title' => 'Grades',
            'grades' => $grades
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::with('students')->get();
        return view('admin.grade.create', [
            'title' => 'Create New Data',
            'grades' => Grade::all(),
            'majors' => Major::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'grade'     => 'required|string',
            'major_id'  => 'required|exists:majors,id',
            'class_number' => 'required|string',
        ]);

        $grade = Grade::create([
            'grade'     => $validated['grade'],
            'major_id'  => $validated['major_id'],
            'class_number' => $validated['class_number'],
        ]);

        return redirect('admin/grades/')->with('success', 'Grade created succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GradeDashboard $gradeDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $grade = Grade::findOrfail($id);
        $grades = Grade::all();
        $majors = Major::all();

        return view('admin.grade.edit', [
            'title' => 'Edit grade data',
            'grade' => $grade,
            'grades' => $grades,
            'majors' => $majors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validated = $request->validate([
            'grade'     => 'required|string',
            'major_id'  => 'required|exists:majors,id',
            'class_number' => 'required|string',
        ]);

        $grade = Grade::findOrFail($id);

        $grade->update([
            'grade'     => $validated['grade'],
            'major_id'  => $validated['major_id'],
            'class_number' => $validated['class_number'],
        ]);

        return redirect('/admin/grades')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(String $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect('/admin/grades')->with('success', 'Grade deleted successfully');
    }
}
