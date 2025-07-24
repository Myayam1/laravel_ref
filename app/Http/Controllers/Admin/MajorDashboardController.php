<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MajorDashboard;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $majors = Major::with('grades')->get();
        return view('admin.major.index', [
            'title' => 'Majors',
            'majors' => $majors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::with('grades')->get();
        return view('admin.major.create', [
            'title' => 'Create New Data',
            'majors' => Major::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'desc' => 'required|string|max:255',
        ]);

        $major = Major::create([
            'nama'     => $validated['nama'],
            'desc' => $validated['desc'],
        ]);

        return redirect('admin/majors/')->with('success', 'Major created succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MajorDashboard $majorDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $major = Major::findOrfail($id);;

        return view('admin.major.edit', [
            'title' => 'Edit major data',
            'major' => $major
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'desc'     => 'required|string|max:255',
        ]);

        $major = Major::findOrFail($id);

        $major->update([
            'nama'     => $validated['nama'],
            'desc'     => $validated['desc'],
        ]);

        return redirect('/admin/majors')->with('success', 'Major updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(String $id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        return redirect('/admin/majors')->with('success', 'Major deleted successfully');
    }
}
