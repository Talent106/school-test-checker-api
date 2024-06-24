<?php

namespace App\Models;

use App\Base\BaseModel;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $original_file_name
 * @property string $original_file_type
 * @property string $original_file_size
 * @property string $file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereOriginalFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereOriginalFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereOriginalFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment withoutTrashed()
 * @mixin \Eloquent
 */
class Attachment extends BaseModel
{
    protected $fillable = [
        'original_file_name',
        'original_file_type',
        'original_file_size',
        'file_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFile(): ?string
    {
        return Storage::get($this->file_path);
    }

    public function makeUploadedFile(): UploadedFile
    {
        $file = Storage::get($this->file_path);

        if (!$file) {
            throw new Exception("File not found for path [{$this->file_path}] and attachment_id [$this->id]");
        }

        $fileName = uniqid() . $this->original_file_name;
        $targetPath = storage_path() . "/app/tmp/$fileName";
        $myFile = fopen($targetPath, 'w');
        fwrite($myFile, $file);
        fclose($myFile);

        return new UploadedFile($targetPath, $fileName, null, null, true);
    }
}
