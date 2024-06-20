<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\ResourceResponse;

class SchoolController extends Controller
{
    public function index(): ResourceCollection
    {
        return new ResourceCollection(School::all());
    }

    public function show(Request $request, int $id): JsonResource
    {
        $school = School::findOrFail($id);

        return new JsonResource($school);
    }

    public function store(Request $request): JsonResource
    {
        $request->validate(['name' => 'required', 'inep_code' => 'sometimes|nullable']);
        $school = School::create($request->all());

        return new JsonResource($school);
    }

    public function update(Request $request, int $id): JsonResource
    {
        $request->validate(['name' => 'required', 'inep_code' => 'sometimes|nullable']);
        $school = School::findOrFail($id);
        $school->update($request->all());

        return new JsonResource($school);
    }

    public function destroy(Request $request, int $id): void
    {
        School::findOrFail($id)->delete();

        return;
    }
}
