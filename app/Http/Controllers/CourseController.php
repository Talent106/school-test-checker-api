<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CourseResource::collection(Course::all());
    }

    public function show(Request $request, int $id): CourseResource
    {
        $course = Course::findOrFail($id);

        return new CourseResource($course);
    }

    public function store(Request $request): CourseResource
    {
        $request->validate(['name' => 'required', 'school_id' => 'required']);
        $course = Course::create($request->all());

        return new CourseResource($course);
    }

    public function update(Request $request, int $id): CourseResource
    {
        $request->validate(['name' => 'required', 'school_id' => 'required']);
        $course = Course::findOrFail($id);
        $course->update($request->all());

        return new CourseResource($course);
    }

    public function destroy(Request $request, int $id): void
    {
        Course::findOrFail($id)->delete();

        return;
    }
}
