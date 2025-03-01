<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends Controller
{
    public function index(Request $request) : AnonymousResourceCollection
    {
        return StudentResource::collection(Student::all());
    }

    public function show(Request $request, int $id) : StudentResource
    {
        $student = Student::where('id', $id)->first();

        return new StudentResource($student);
    }

    public function create(StudentRequest $request) : JsonResponse
    {
        $new_student = Student::create([
            'signed_up_the' => now(), 
            ...$request->validated(),
        ]);

        return (new StudentResource($new_student))
            ->response()
            ->setStatusCode(201);
    }
}
