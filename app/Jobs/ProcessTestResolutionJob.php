<?php

namespace App\Jobs;

use App\Enum\TestResolutionStatusEnum;
use App\Models\TestResolution;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTestResolutionJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private TestResolution $testResolution)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->testResolution->update(['status' => TestResolutionStatusEnum::RUNNING]);
        //TODO: extract and analyse test
        $this->testResolution->update(['status' => TestResolutionStatusEnum::COMPLETED]);
    }
}
