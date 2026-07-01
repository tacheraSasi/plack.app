<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Channel;

final readonly class DeleteChannel
{
    public function handle(Channel $channel): void
    {
        $channel->delete();
    }
}
