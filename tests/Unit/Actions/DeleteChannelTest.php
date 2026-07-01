<?php

declare(strict_types=1);

use App\Actions\DeleteChannel;
use App\Models\Channel;

it('may delete a channel', function (): void {
    $channel = Channel::factory()->create();

    $action = resolve(DeleteChannel::class);

    $action->handle($channel);

    expect(Channel::query()->whereKey($channel->id)->exists())->toBeFalse();
});
