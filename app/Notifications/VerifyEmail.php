<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Bus\Queueable;

final class VerifyEmail extends BaseVerifyEmail
{
    use Queueable;
}
