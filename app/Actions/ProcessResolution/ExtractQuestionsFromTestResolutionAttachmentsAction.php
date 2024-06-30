<?php

namespace App\Actions\ProcessResolution;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use thiagoalessio\TesseractOCR\TesseractOCR;
use App\Models\TestResolution;

class ExtractQuestionsFromTestResolutionAttachmentsAction
{
    public static function execute(TestResolution $testResolution): Collection
    {
        $testQuestions = [];

        foreach ($testResolution->attachments as $attachment) {
            $tmpFile = $attachment->makeUploadedFile();
            $data = (new TesseractOCR($tmpFile))->run();
            unlink($tmpFile->getRealPath());

            $file = self::makeUploadedFile($data);
            $questions = self::processFile($file);
            $testQuestions = array_merge($testQuestions, $questions);
        }

        return Collection::make($testQuestions);
    }

    private static function processFile(UploadedFile $file): array
    {
        $fileBuffer = fopen($file->getRealPath(), 'r');

        if (!$fileBuffer) {
            unlink($file->getRealPath());

            return [];
        }

        $questions = [];
        $currentQuestion = '';
        $lastLineIsEmpty = false;

        while (($line = fgets($fileBuffer)) !== false) {
            if ($line === '' || $line === "\n") {
                $lastLineIsEmpty = true;

                continue;
            }

            if ($lastLineIsEmpty && self::isNewQuestion($line)) {
                $questions[] = $currentQuestion;
                $currentQuestion = $line;
                $lastLineIsEmpty = false;

                continue;
            }

            $currentQuestion .= $line;
            $lastLineIsEmpty = false;
        }

        fclose($fileBuffer);
        unlink($file->getRealPath());
        $questions[] = $currentQuestion;

        return $questions;
    }

    private static function makeUploadedFile(string $content): UploadedFile
    {
        $fileName = uniqid() . '_test_file.txt';
        $targetPath = storage_path() . "/app/tmp/$fileName";
        $myFile = fopen($targetPath, 'w');
        fwrite($myFile, $content);
        fclose($myFile);

        return new UploadedFile($targetPath, $fileName, null, null, true);
    }

    private static function isNewQuestion(string $line): bool
    {
        return (self::isNumber($line[0]) && $line[1] == '-')
            || (self::isNumber($line[0]) && $line[1] == ' ')
            || (self::isNumber($line[0]) && self::isNumber($line[1]) && $line[2] == '-')
            || (self::isNumber($line[0]) && self::isNumber($line[1]) && $line[2] == ' ');
    }

    private static function isNumber(string $char): bool
    {
        return str_contains('0123456789', $char);
    }
}
