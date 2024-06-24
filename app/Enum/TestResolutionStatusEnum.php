<?php

namespace App\Enum;

enum TestResolutionStatusEnum: string
{
    case PENDING = 'PENDING';
    case RUNNING = 'RUNNING';
    case COMPLETED = 'COMPLETED';
}
