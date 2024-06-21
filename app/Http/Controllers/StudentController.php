<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return StudentResource::collection(Student::all());
    }

    public function show(Request $request, int $id): StudentResource
    {
        $course = Student::findOrFail($id);

        return new StudentResource($course);
    }

    public function store(Request $request): StudentResource
    {
        $request->validate(['name' => 'required', 'course_id' => 'required', 'code' => 'sometimes|nullable']);
        $course = Student::create($request->all());

        return new StudentResource($course);
    }

    public function update(Request $request, int $id): StudentResource
    {
        $request->validate(['name' => 'required', 'course_id' => 'required', 'code' => 'sometimes|nullable']);
        $course = Student::findOrFail($id);
        $course->update($request->all());

        return new StudentResource($course);
    }

    public function destroy(Request $request, int $id): void
    {
        Student::findOrFail($id)->delete();

        return;
    }
}
