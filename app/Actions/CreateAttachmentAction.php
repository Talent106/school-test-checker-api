<?php

namespace App\Actions;

use App\Base\BaseModel;
use App\Models\Attachment;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Log;

class CreateAttachmentAction
{
    /**
     * @param Collection<UploadedFile>|UploadedFile $files
     * @return Attachment[]|array
     * */
    public static function execute(Collection|UploadedFile $files, ?BaseModel $attachable = null): array
    {
        $attachments = [];
        $files = $files instanceof Collection ? $files : Collection::make([$files]);

        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $attachment = Attachment::create([
                'original_file_name' => $file->getClientOriginalName(),
                'original_file_type' => $file->getMimeType(),
                'original_file_size' => $file->getSize(),
                'file_path' => 'files/'. User::getAuthenticated()->id . '/' . $file->getClientOriginalName(),
            ]);

            Storage::put($attachment->file_path, $file->get());

            $attachments[] = $attachment;
        }

        if ($attachable && count($attachments)) {
            $attachable->attachments()->attach(array_map(fn (Attachment $attachment) => $attachment->id, $attachments));
        }

        return $attachments;
    }
}
