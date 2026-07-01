<?php

declare(strict_types=1);

use App\Actions\CreateChannel;
use App\Models\Channel;
use App\Models\Workspace;

it('may create channels', function (): void {
    $workspace = Workspace::factory()->create();

    $channel = resolve(CreateChannel::class)->handle(
        $workspace,
        'general',
    );

    expect($channel)
        ->toBeInstanceOf(Channel::class)
        ->and($channel->workspace->id)->toBe($workspace->id)
        ->and($channel->name)->toBe('general');
});
