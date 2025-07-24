<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with('students')->get();
        return view('grade', [
            'title' => 'Grades',
            'grades' => $grades
        ]);
    }
}
