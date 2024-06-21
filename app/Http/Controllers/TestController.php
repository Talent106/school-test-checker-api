<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrUpdateTestAction;
use App\DTO\TestDTO;
use App\Http\Requests\CreateOrUpdateTestRequest;
use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class TestController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TestResource::collection(Test::all());
    }

    public function show(Request $request, int $id): TestResource
    {
        $test = TestResource::findOrFail($id);

        return new TestResource($test);
    }

    public function store(CreateOrUpdateTestRequest $request): TestResource
    {
        $testDTO = TestDTO::createFromCollection(Collection::make($request->all()));
        $test = CreateOrUpdateTestAction::execute($testDTO);

        return new TestResource($test);
    }

    public function update(CreateOrUpdateTestRequest $request, int $id): TestResource
    {
        $testDTO = TestDTO::createFromCollection(Collection::make($request->all()));
        $test = CreateOrUpdateTestAction::execute($testDTO);

        return new TestResource($test);
    }

    public function destroy(Request $request, int $id): void
    {
        Test::findOrFail($id)->delete();
    }
}
