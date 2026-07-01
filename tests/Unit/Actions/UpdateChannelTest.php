<?php

declare(strict_types=1);

use App\Actions\UpdateChannel;
use App\Models\Channel;

it('may update a channel name', function (): void {
    $channel = Channel::factory()->create([
        'name' => 'general',
    ]);

    $action = resolve(UpdateChannel::class);

    $action->handle($channel, 'random');

    expect($channel->refresh()->name)->toBe('random');
});
