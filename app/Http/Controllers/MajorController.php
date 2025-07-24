<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;

class MajorController extends Controller
{
    public function index() {
        $majors = Major::with('grades')->get();
        return view('major', [
            'title' => 'Majors',
            'majors' => $majors
        ]);
    }
}
