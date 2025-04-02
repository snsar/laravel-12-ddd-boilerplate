<?php

namespace App\Domain\User\Listeners;

use App\Domain\User\Events\UserCreated;
use Illuminate\Support\Facades\Log;

class LogUserCreated
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        Log::info('User created: ' . $event->user->id);
    }
}
