<?php

namespace App\Http\Controllers;

use App\Actions\CreateAttachmentAction;
use App\Enum\TestResolutionStatusEnum;
use App\Http\Resources\TestResolutionResource;
use App\Jobs\ProcessTestResolutionJob;
use App\Models\TestResolution;
use App\Models\TestResolutionQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rules\File;
use Log;

class TestResolutionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TestResolutionResource::collection(TestResolution::all());
    }

    public function show(Request $request, int $id): TestResolutionResource
    {
        $testResolution = TestResolution::findOrFail($id);

        return new TestResolutionResource($testResolution);
    }

    public function store(Request $request): TestResolutionResource
    {
        $request->validate([
            'test_id' => 'required|integer',
            'student_id' => 'required|integer',
            'attachment_ids' => 'required|array',
        ]);

        $testResolution = TestResolution::create([...$request->all(), 'status' => TestResolutionStatusEnum::PENDING]);
        $testResolution->attachments()->sync($request->get('attachment_ids'));
        ProcessTestResolutionJob::dispatch($testResolution);

        return new TestResolutionResource($testResolution);
    }

    public function update(Request $request, int $id): TestResolutionResource
    {
        $request->validate(['test_id' => 'required|integer', 'student_id' => 'required|integer']);
        $testResolution = TestResolution::updateOrCreate(['id' => $id], $request->all());

        return new TestResolutionResource($testResolution);
    }

    public function destroy(Request $request, int $id): void
    {
        TestResolution::findOrFail($id)->delete();
    }
}
