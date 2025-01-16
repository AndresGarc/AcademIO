<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        return StudentResource::collection(Student::all());
    }

    public function show(Request $request, int $id)
    {
        $student = Student::where('id', $id)->first();
        return new StudentResource($student);
    }
}
