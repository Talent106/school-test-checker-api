<?php

namespace App\Http\Controllers;

use App\Actions\CreateAttachmentAction;
use App\Http\Resources\AttachmentResource;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class AttachmentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AttachmentResource::collection(Attachment::all());
    }

    public function show(Request $request, int $id): AttachmentResource
    {
        $attachment = Attachment::findOrFail($id);

        return new Attachment($attachment);
    }

    public function upload(Request $request): AnonymousResourceCollection
    {
        $request->validate(['files' => 'required']);

        $files = $request->file('files') instanceof UploadedFile
            ? $request->file('files')
            : Collection::make($request->file('files'));
        $attachments = CreateAttachmentAction::execute($files);

        return AttachmentResource::collection($attachments);
    }
}
